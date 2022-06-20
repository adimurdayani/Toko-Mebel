<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('m_laba');
    }


    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {

            $data['title'] = 'Data Laporan Pengeluaran';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();
            $data['get_laba'] = $this->db->get('tb_biaya_kas')->result_array();
            $data['pendapatan'] = $this->m_laba->get_total_all_pendapatan();

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('laporan', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function edit($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {

            $data['title'] = 'Data Operasional Toko';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $getid = base64_decode($id);
            $data['get_laba'] = $this->db->get_where('tb_biaya_kas', ['id_biaya' => $getid])->row_array();

            $this->form_validation->set_rules('gaji', 'gaji', 'trim');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header', $data, FALSE);
                $this->load->view('template/topbar', $data, FALSE);
                $this->load->view('template/sidebar', $data, FALSE);
                $this->load->view('edit', $data, FALSE);
            } else {
                $this->m_laba->edit();
                $this->session->set_flashdata(
                    'success',
                    '$(document).ready(function(e) {
                            Swal.fire({
                            type: "success",
                            title: "Sukses",
                            text: "Data berhasil diubah!"
                        })
                    })'
                );
                redirect('laba/laporan');
            }
        }
    }

    public function cetak($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {

            $data['title'] = 'Cetak Laporan Laba Bersih';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $getid = base64_decode($id);
            $data['get_laba'] = $this->db->get_where('tb_biaya_kas', ['id_biaya' => $getid])->row_array();
            $data['get_barang_beli'] = $this->m_laba->get_total_pembelian_barang();
            $data['pendapatan'] = $this->m_laba->get_total_all_pendapatan();

            $this->load->view('cetak-laporan', $data, FALSE);
        }
    }

    public function hapus($id)
    {
        $getid = base64_decode($id);
        $this->m_laba->hapus($getid);
        $this->session->set_flashdata(
            'success',
            '$(document).ready(function(e) {
                    Swal.fire({
                    type: "success",
                    title: "Sukses",
                    text: "Data berhasil dihapus!"
                })
            })'
        );
        redirect('laba/laporan');
    }

    public function hapus_all()
    {
        $getid = $_POST['id_biaya'];
        $this->m_laba->hapus_all($getid);
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
        redirect('laba/laporan');
    }
}

/* End of file Laporan.php */
