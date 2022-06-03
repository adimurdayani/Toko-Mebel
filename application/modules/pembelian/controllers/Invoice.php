<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Invoice extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_pembelian');
        is_logged_in();
    }

    public function detail($kode_barang)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Invoice Transaksi Barang";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_suplier'] = $this->m_pembelian->get_suplier();
            $getKode = base64_decode($kode_barang);
            $data['get_invoice_pembelian'] = $this->m_pembelian->get_all_invoice($getKode);
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('invoice', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function detail_hutang($kode_barang)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Invoice Transaksi Barang";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();

            $data['get_suplier'] = $this->m_pembelian->get_suplier();
            $getKode = base64_decode($kode_barang);
            $data['get_invoice_pembelian'] = $this->m_pembelian->get_all_invoice($getKode);

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('invoice-hutang', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function detail_invoice($kode_barang)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Invoice Transaksi Barang";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();

            $data['get_suplier'] = $this->m_pembelian->get_suplier();
            $getKode = base64_decode($kode_barang);
            $data['get_invoice_pembelian'] = $this->m_pembelian->get_all_invoice($getKode);

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('detail-pembelian-invoice', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function detail_invoice_hutang($kode_barang)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Detail Invoice Pembelian Hutang";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();

            $data['get_suplier'] = $this->m_pembelian->get_suplier();
            $getKode = base64_decode($kode_barang);
            $data['get_invoice_pembelian'] = $this->m_pembelian->get_all_invoice($getKode);

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('detail-pembelian-invoice-hutang', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function detail_invoice_hutang_lunas($kode_barang)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Detail Invoice Pembelian Lunas";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();

            $data['get_suplier'] = $this->m_pembelian->get_suplier();
            $getKode = base64_decode($kode_barang);
            $data['get_invoice_pembelian'] = $this->m_pembelian->get_all_invoice($getKode);

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('detail-pembelian-invoice-lunas', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }
}

/* End of file Invoice.php */
