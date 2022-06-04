<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_dashboard');
        is_logged_in();
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Dashboard";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();

            $date = date("Y-m-d");

            // jumlah pengujung sekarang
            $this->db->group_by('ip');
            $pengunjung_hariini = $this->db->get_where('tb_visitor', ['date' => $date])->num_rows();
            $db_pengunjung = $this->db->query("SELECT COUNT(hits) as hits FROM tb_visitor")->row();

            // total pengunjung
            $total_pengunjung = isset($db_pengunjung->hits) ? ($db_pengunjung->hits) : 0;
            $batas_waktu = time() - 300;

            // jumlah pengujung online
            $pengunjung_online = $this->db->query("SELECT * FROM tb_visitor WHERE online > '" . $batas_waktu . "'")->num_rows();

            $data['pengunjung_hariini'] = $pengunjung_hariini;
            $data['total_pengunjung'] = $total_pengunjung;
            $data['pengunjung_online'] = $pengunjung_online;

            $data['get_total_hits'] = $this->m_dashboard->get_total();
            $data['get_total_userkoneksi'] = $this->m_dashboard->get_total_userkoneksi();

            $data['total_pengguna'] = $this->db->get('users')->num_rows();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();
            $data['total_pendapatan'] =  $this->m_dashboard->get_total_pendapatan();

            $tglsekarang = date_indo('Y-m-d');
            $this->db->where('invoice_tipe_transaksi !=', 1);
            $this->db->where('invoice_date', $tglsekarang);
            $data['total_invoice_penjualan_cash'] =  $this->db->get('tb_penjualan')->num_rows();

            $data['total_barang'] =  $this->db->get_where('tb_barang')->result();
            $data['jml_barang'] =  $this->db->get_where('tb_barang')->num_rows();
            $data['jml_invoice_penjualan'] =  $this->db->get('tb_penjualan')->num_rows();

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('dashboard', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }
}

/* End of file Dashboard.php */
