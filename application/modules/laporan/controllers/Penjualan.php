<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Laporan Penjualan Perperiode";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_grup'] = $this->db->get_where('users_groups', ['user_id' => $data['session']->id])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('laporan-penjualan-periode', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function produksi()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Laporan Penjualan Perproduk";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();
            $data['get_produk'] = $this->db->get('tb_produksi')->result();

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('laporan-penjualan-produksi', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }
}

/* End of file Laporan.php */
