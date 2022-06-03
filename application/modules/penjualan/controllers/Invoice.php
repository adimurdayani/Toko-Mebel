<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Invoice extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_penjualan');
        is_logged_in();
    }

    public function detail($invoice_penjualan)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Invoice Penjualan";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_kostumer'] = $this->m_penjualan->get_kostumer();
            $getinvoice = base64_decode($invoice_penjualan);
            $data['get_invoice_penjualan'] = $this->m_penjualan->get_all_invoice($getinvoice);
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('invoice', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function detail_hutang($invoice_penjualan)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Invoice Penjualan";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_kostumer'] = $this->m_penjualan->get_kostumer();
            $getinvoice = base64_decode($invoice_penjualan);
            $data['get_invoice_penjualan'] = $this->m_penjualan->get_all_invoice($getinvoice);
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('invoice-hutang', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function detail_invoice_piutang($invoice_penjualan)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Invoice Penjualan";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_kostumer'] = $this->m_penjualan->get_kostumer();
            $getinvoice = base64_decode($invoice_penjualan);
            $data['get_invoice_penjualan'] = $this->m_penjualan->get_all_invoice($getinvoice);
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('detail-penjualan-invoice-piutang', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function detail_invoice_piutang_lunas($invoice_penjualan)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Invoice Penjualan";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_kostumer'] = $this->m_penjualan->get_kostumer();
            $getinvoice = base64_decode($invoice_penjualan);
            $data['get_invoice_penjualan'] = $this->m_penjualan->get_all_invoice($getinvoice);
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('detail-penjualan-invoice-lunas', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }
}

/* End of file Invoice.php */
