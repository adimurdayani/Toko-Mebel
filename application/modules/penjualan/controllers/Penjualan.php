<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_penjualan');
        is_logged_in();
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Invoice Penjualan";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_penjualan_invoice'] = $this->m_penjualan->get_all_penjualan();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();
            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('index', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function detail_invoice($get_invoice)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Detail Invoice Penjualan";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();

            $no_invoice = base64_decode($get_invoice);
            $data['get_kostumer'] = $this->m_penjualan->get_kostumer($no_invoice);
            $data['get_invoice_penjualan'] = $this->m_penjualan->get_all_invoice($no_invoice);
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('detail-penjualan-invoice', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function cetak_nota($get_invoice)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Nota Penjualan";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();

            $no_invoice = base64_decode($get_invoice);
            $data['get_kostumer'] = $this->m_penjualan->get_kostumer($no_invoice);
            $data['get_invoice_penjualan'] = $this->m_penjualan->get_all_invoice($no_invoice);
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->load->view('cetak-nota-penjualan', $data, FALSE);
        }
    }

    public function cetak_nota_hutang($get_invoice)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Nota Hutang";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();

            $no_invoice = base64_decode($get_invoice);
            $data['get_kostumer'] = $this->m_penjualan->get_kostumer();
            $data['get_invoice_penjualan'] = $this->m_penjualan->get_all_invoice($no_invoice);
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->load->view('cetak-nota-hutang', $data, FALSE);
        }
    }

    public function cetak_nota_lunas($get_invoice)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Nota Lunas";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();

            $no_invoice = base64_decode($get_invoice);
            $data['get_kostumer'] = $this->m_penjualan->get_kostumer();
            $data['get_invoice_penjualan'] = $this->m_penjualan->get_all_invoice($no_invoice);
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->load->view('cetak-nota-lunas', $data, FALSE);
        }
    }

    public function edit_kurir()
    {
        $this->form_validation->set_rules('invoice_kurir', 'nama lengkap kurir', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            # code...
            $this->session->set_flashdata(
                'error',
                '$(document).ready(function(e) {
                    Swal.fire({
                        icon: "error",
                        type: "error",
                        title: "Oops...",
                        text: "Nama kurir tidak boleh kosong!"
                    })
                })'
            );

            redirect('penjualan');
        } else {
            # code...

            $data = [
                'invoice_kurir' => $this->input->post('invoice_kurir')
            ];

            $this->db->where('invoice_id', base64_decode($this->input->post('invoice_id')));
            $this->db->update('tb_penjualan', $data);
            $this->session->set_flashdata(
                'success',
                '$(document).ready(function(e) {
                    Swal.fire({
                        type: "success",
                        title: "Sukses",
                        text: "Data berhasil disimpan!"
                    })
                })'
            );
            redirect('penjualan');
        }
    }

    public function hapus_all()
    {
        $id = $_POST['id'];
        $this->db->where_in('id', $id);
        $this->m_loguser->delete($id);
        $this->session->set_flashdata(
            'success',
            '$(document).ready(function(e) {
                Swal.fire({
                    type: "success",
                    title: "Sukses",
                    text: "Semua data berhasil dihapus!"
                })
            })'
        );
        redirect('log_user');
    }
}

/* End of file Log_user.php */
