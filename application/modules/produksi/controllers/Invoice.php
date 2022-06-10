<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Invoice extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_produk');
        is_logged_in();
    }

    public function detail($invoice_produksi)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Invoice Produksi Barang";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $getKode = base64_decode($invoice_produksi);
            $data['get_invoice_produksi'] = $this->m_produk->get_all_produk_detail($getKode);
            $data['get_produksi'] = $this->db->get_where('tb_produksi', ['produksi_invoice' => $getKode])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('invoice', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function detail_material($invoice_produksi)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Detail Material Produksi Barang";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $getKode = base64_decode($invoice_produksi);
            $data['get_invoice_produksi'] = $this->m_produk->get_all_produk_detail($getKode);
            $data['get_produksi'] = $this->db->get_where('tb_produksi', ['produksi_invoice' => $getKode])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('detail-material', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function cetak_nota($invoice_produksi)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Cetak Nota Produksi";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $getKode = base64_decode($invoice_produksi);
            $data['get_invoice_produksi'] = $this->m_produk->get_all_produk_detail($getKode);
            $data['get_produksi'] = $this->db->get_where('tb_produksi', ['produksi_invoice' => $getKode])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->load->view('cetak-nota-produksi', $data, FALSE);
        }
    }
}

/* End of file Invoice.php */
