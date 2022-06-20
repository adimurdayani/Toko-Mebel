<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Laba extends CI_Controller
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

            $data['title'] = 'Data Operasional Toko';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();
            $data['get_laba'] = $this->db->get('tb_biaya_kas')->result_array();

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('index', $data, FALSE);
            // $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function tambah()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {

            $data['title'] = 'Data Operasional Toko';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->form_validation->set_rules('gaji', 'gaji', 'trim');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header', $data, FALSE);
                $this->load->view('template/topbar', $data, FALSE);
                $this->load->view('template/sidebar', $data, FALSE);
                $this->load->view('index', $data, FALSE);
                // $this->load->view('template/footer', $data, FALSE);
            } else {
                $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
                $data = [
                    'bank' => preg_replace("/[^0-9]/", "", $this->input->post('bank')),
                    'motor' => preg_replace("/[^0-9]/", "", $this->input->post('motor')),
                    'listrik' => preg_replace("/[^0-9]/", "", $this->input->post('listrik')),
                    'perbaikan' => preg_replace("/[^0-9]/", "", $this->input->post('perbaikan')),
                    'pemeliharaan' => preg_replace("/[^0-9]/", "", $this->input->post('pemeliharaan')),
                    'sewa' => preg_replace("/[^0-9]/", "", $this->input->post('sewa')),
                    'gaji' => preg_replace("/[^0-9]/", "", $this->input->post('gaji')),
                    'telp_internet' => preg_replace("/[^0-9]/", "", $this->input->post('telp_internet')),
                    'pengeluaran_lain' => preg_replace("/[^0-9]/", "", $this->input->post('pengeluaran_lain')),
                    'biaya_tak_terduga' => preg_replace("/[^0-9]/", "", $this->input->post('biaya_tak_terduga')),
                    'biaya_tanggal' => date_indo('Y-m-d') . ' - ' . date('H:i:s'),
                    'biaya_kasir_id' => $user->id
                ];
                $this->db->insert('tb_biaya_kas', $data);
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
                redirect('laba');
            }
        }
    }
}

/* End of file Laba.php */
