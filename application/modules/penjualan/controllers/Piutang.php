<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Piutang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('m_penjualan');
        $this->load->model('m_piutang');
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Piutang Belum Lunas";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_penjualan_hutang'] = $this->m_penjualan->get_all_penjualan();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();
            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('piutang-belum-lunas', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function cicilan_piutang($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Cicilan Piutang";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $get_id = base64_decode($id);
            $data['get_piutang'] = $this->db->get_where('tb_penjualan_piutang', ['piutang_invoice' => $get_id])->result();
            $data['get_piutang_id'] = $this->db->get_where('tb_penjualan_piutang', ['piutang_invoice' => $get_id])->row();
            $data['get_total_cicilan'] = $this->m_penjualan->get_total_cicilan($get_id);
            $data['get_penjualan'] = $this->db->get_where('tb_penjualan', ['penjualan_invoice' => $get_id])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->form_validation->set_rules('piutang_nominal', 'nominal piutang', 'trim|required');
            $this->form_validation->set_rules('piutang_tipe_pembayaran', 'tipe pembayaran', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header', $data, FALSE);
                $this->load->view('template/topbar', $data, FALSE);
                $this->load->view('template/sidebar', $data, FALSE);
                $this->load->view('cicilan-piutang', $data, FALSE);
            } else {
                # code...
                $this->m_piutang->tambah();
                $penjualan = $this->db->get_where('tb_penjualan', ['penjualan_invoice' => $get_id])->row();

                $piutang_nominal = preg_replace("/[^0-9]/", "", $this->input->post('piutang_nominal'));
                $invoice_bayar_lama  = $this->input->post('invoice_bayar');
                $invoice_bayar = $invoice_bayar_lama + $piutang_nominal;
                $invoice_total = $this->input->post('invoice_total');
                $invoice_kembali = $invoice_bayar - $invoice_total;


                if ($invoice_bayar >= $invoice_total) {
                    $update_lunas = [
                        'invoice_bayar' => $invoice_bayar,
                        'invoice_kembali' => $invoice_kembali,
                        'invoice_piutang' => 0,
                        'invoice_piutang_lunas' => 1
                    ];
                    $this->db->where('penjualan_invoice', $get_id);
                    $this->db->update('tb_penjualan', $update_lunas);
                } else {
                    $update_lunas = [
                        'invoice_bayar' => $invoice_bayar,
                        'invoice_kembali' => $invoice_kembali
                    ];
                    $this->db->where('penjualan_invoice', $get_id);
                    $this->db->update('tb_penjualan', $update_lunas);
                }

                $this->session->set_flashdata(
                    'success',
                    '$(document).ready(function(e) {
                            Swal.fire({
                            type: "success",
                            title: "Sukses",
                            text: "Cicilan piutang berhasil disimpan!"
                        })
                    })'
                );
                $this->invoice_piutang_update($penjualan->invoice_id);
                redirect('penjualan/piutang/cicilan_piutang/' . base64_encode($get_id));
            }
        }
    }

    private function invoice_piutang_update($id)
    {
        $penjualan = $this->db->get_where('tb_penjualan', ['invoice_id' => $id])->row();
        if ($penjualan->invoice_kembali != 0) {
            $update_penjualan = [
                'invoice_kembali' => $penjualan->invoice_kembali - $this->input->post('piutang_nominal')
            ];
            $this->db->where('penjualan_invoice', $penjualan->penjualan_invoice);
            $this->db->update('tb_penjualan', $update_penjualan);
        }
    }

    public function hapus($id)
    {
        $get_id = base64_decode($id);
        $piutang = $this->db->get_where('tb_penjualan_piutang', ['id_piutang' => $get_id])->row();
        $this->db->delete('tb_penjualan_piutang', ['id_piutang' => $get_id]);
        $this->session->set_flashdata(
            'success',
            '$(document).ready(function(e) {
                Swal.fire({
                    type: "success",
                    title: "Sukses",
                    text: "Data berhasil dihapus!"
                })
            })'
        );
        redirect('penjualan/piutang/cicilan_piutang/' . base64_encode($piutang->piutang_invoice));
    }

    public function lunas()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Piutang Lunas";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_penjualan_hutang'] = $this->m_penjualan->get_all_penjualan();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();
            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('piutang-lunas', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function cicilan_piutang_lunas($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Cicilan Piutang";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $get_id = base64_decode($id);
            $data['get_piutang'] = $this->db->get_where('tb_penjualan_piutang', ['piutang_invoice' => $get_id])->result();
            $data['get_piutang_id'] = $this->db->get_where('tb_penjualan_piutang', ['piutang_invoice' => $get_id])->row();
            $data['get_total_cicilan'] = $this->m_penjualan->get_total_cicilan($get_id);
            $data['get_penjualan'] = $this->db->get_where('tb_penjualan', ['penjualan_invoice' => $get_id])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('cicilan-piutang-lunas', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }
}

/* End of file Piutang.php */
