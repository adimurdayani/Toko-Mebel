<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Belum_lunas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('m_pembelian');
        $this->load->model('m_hutang');
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Hutang Belum Lunas";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $this->db->order_by('id', 'desc');
            $data['get_pembelian'] = $this->m_pembelian->get_all_pembelian();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();
            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('belum_lunas', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function cicilan_hutang($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Cicilan Hutang";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $get_id = base64_decode($id);
            $data['get_hutang'] = $this->db->get_where('tb_hutang', ['hutang_invoice_parent' => $get_id])->result();
            $data['get_hutang_id'] = $this->db->get_where('tb_hutang', ['hutang_invoice_parent' => $get_id])->row();
            $data['get_total_cicilan'] = $this->m_pembelian->get_total_cicilan($get_id);
            $data['get_pembelian'] = $this->db->get_where('tb_pembelian', ['invoice_parent' => $get_id])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->form_validation->set_rules('hutang_nominal', 'nominal hutang', 'trim|required');
            $this->form_validation->set_rules('hutang_tipe_pembayaran', 'tipe pembayaran', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header', $data, FALSE);
                $this->load->view('template/topbar', $data, FALSE);
                $this->load->view('template/sidebar', $data, FALSE);
                $this->load->view('cicilan_hutang', $data, FALSE);
            } else {
                # code...
                $pembelian = $this->db->get_where('tb_pembelian', ['invoice_parent' => $get_id])->row();
                $this->m_hutang->tambah();

                $nominal = preg_replace("/[^0-9]/", "", $this->input->post('hutang_nominal'));
                $invoice_bayar_lama = $this->input->post('invoice_bayar');
                $invoice_bayar = $invoice_bayar_lama + $nominal;
                $invoice_total = $this->input->post('invoice_total');
                $invoice_kembali = $invoice_bayar - $invoice_total;

                if ($invoice_bayar >= $invoice_total) {
                    $update_lunas = [
                        'invoice_bayar' => $invoice_bayar,
                        'invoice_kembali' => $invoice_kembali,
                        'invoice_hutang' => 0,
                        'invoice_hutang_lunas' => 1
                    ];
                    $this->db->where('invoice_parent', $get_id);
                    $this->db->update('tb_pembelian', $update_lunas);
                } else {
                    $update_lunas = [
                        'invoice_bayar' => $invoice_bayar,
                        'invoice_kembali' => $invoice_kembali
                    ];
                    $this->db->where('invoice_parent', $get_id);
                    $this->db->update('tb_pembelian', $update_lunas);
                }
                $this->session->set_flashdata(
                    'success',
                    '$(document).ready(function(e) {
                                Swal.fire({
                                type: "success",
                                title: "Sukses",
                                text: "No. invoice berhasil disimpan!"
                            })
                        })'
                );
                $this->bayar_kembali($pembelian->id);
                redirect('pembelian/belum_lunas/cicilan_hutang/' . base64_encode($get_id));
            }
        }
    }

    public function bayar_kembali($id)
    {
        $pembelian = $this->db->get_where('tb_pembelian', ['id' => $id])->row();
        if ($pembelian->invoice_kembali >= 1) {
            $update_pembelian = [
                'invoice_kembali' => $pembelian->invoice_kembali - $this->input->post('hutang_nominal')
            ];
            $this->db->where('invoice_parent', $pembelian->invoice_parent);
            $this->db->update('tb_pembelian', $update_pembelian);
        }
    }

    public function cicilan_lunas($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Cicilan Hutang";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $get_id = base64_decode($id);
            $data['get_hutang'] = $this->db->get_where('tb_hutang', ['hutang_invoice' => $get_id])->result();
            $data['get_hutang_id'] = $this->db->get_where('tb_hutang', ['hutang_invoice' => $get_id])->row();
            $data['get_total_cicilan'] = $this->m_pembelian->get_total_cicilan($get_id);
            $data['get_pembelian'] = $this->db->get_where('tb_pembelian', ['invoice_pembelian' => $get_id])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('cicilan_lunas', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function hapus($id)
    {
        $get_id = base64_decode($id);
        $this->db->delete('tb_hutang', ['hutang_id' => $get_id]);
        redirect('belum_lunas', 'refresh');
    }
}

/* End of file Belum_lunas.php */
