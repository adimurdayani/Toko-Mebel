<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_home');
    }


    public function index()
    {
        $data['title'] = "Home";

        $ip = $this->input->ip_address();
        $date = date("Y-m-d");
        $waktu = time();
        $timeinsert = date("Y-m-d H:i:s");
        $browser = $this->agent->browser();
        $browser_versi = $this->agent->version();
        $os = $this->agent->platform();

        // cek berdasarkan IP, apakah user sudah pernah mengakses hari ini
        $cek_ip = $this->db->query("SELECT * FROM tb_visitor WHERE ip='" . $ip . "' AND date='" . $date . "'")->num_rows();
        $cek_user_ip = isset($cek_ip) ? ($cek_ip) : 0;

        // kalau belum ada, simpan data user tersebut ke database
        if ($cek_user_ip == 0) {
            $this->db->query("INSERT INTO tb_visitor(ip, date, hits, os, browser, versi, online, time) VALUES('" . $ip . "','" . $date . "','1','" . $os . "','" . $browser . "','" . $browser_versi . "','" . $waktu . "','" . $timeinsert . "')");
        } else { //jika sudah ada, update
            $this->db->query("UPDATE tb_visitor SET hits=hits+1, os='" . $os . "', browser='" . $browser . "', versi='" . $browser_versi . "', online='" . $waktu . "' WHERE ip='" . $ip . "' AND date='" . $date . "'");
        }

        $data['get_config'] = $this->db->get('tb_konfigurasi')->row_array();

        $invoice = $this->input->post('invoice');
        $data['get_penjualan_detail'] = $this->m_home->get_all_produk($invoice);

        $this->load->view('template/header', $data, FALSE);
        $this->load->view('template/topbar', $data, FALSE);
        $this->load->view('index', $data, FALSE);
        $this->load->view('template/footer', $data, FALSE);
    }

    public function tentang()
    {
        $data['title'] = "Tentang";

        $data['get_config'] = $this->db->get('tb_konfigurasi')->row_array();

        $this->load->view('template/header', $data, FALSE);
        $this->load->view('template/topbar', $data, FALSE);
        $this->load->view('tentang', $data, FALSE);
        $this->load->view('template/footer', $data, FALSE);
    }
}

/* End of file Home.php */
