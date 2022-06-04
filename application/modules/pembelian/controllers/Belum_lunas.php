<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Belum_lunas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('m_pembelian');
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
                $this->load->view('template/footer', $data, FALSE);
            } else {
                # code...

                $pembelian = $this->db->get_where('tb_pembelian', ['invoice_parent' => $get_id])->row();
                $update_pembelian = [
                    'invoice_kembali' => $pembelian->invoice_kembali - $this->input->post('hutang_nominal'),
                    'invoice_hutang' => $this->input->post('invoice_kembali')
                ];

                $this->db->where('invoice_parent', $get_id);
                $this->db->update('tb_pembelian', $update_pembelian);

                $data = [
                    'hutang_invoice' => $this->input->post('hutang_invoice'),
                    'hutang_invoice_parent' => $this->input->post('hutang_invoice_parent'),
                    'hutang_date' => $this->input->post('hutang_date'),
                    'hutang_date_time' => date_indo('Y-m-d') . ' - ' . date('H:i:s'),
                    'hutang_nominal' => $this->input->post('hutang_nominal'),
                    'hutang_tipe_pembayaran' => $this->input->post('hutang_tipe_pembayaran'),
                    'hutang_cabang' => $this->input->post('hutang_cabang')
                ];
                $this->db->insert('tb_hutang', $data);
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
                redirect('pembelian/belum_lunas/cicilan_hutang/' . base64_encode($get_id));
            }
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
}

/* End of file Belum_lunas.php */