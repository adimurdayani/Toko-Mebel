<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Lunas extends CI_Controller
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
            $data['title'] = "Pembelian Lunas";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            
            $this->db->order_by('id', 'desc');
            $data['get_pembelian'] = $this->m_pembelian->get_all_pembelian();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('lunas', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }
}

/* End of file Belum_lunas.php */
