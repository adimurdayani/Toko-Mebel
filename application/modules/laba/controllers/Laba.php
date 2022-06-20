<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Laba extends CI_Controller
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

            $data['title'] = 'Data Operasional Toko';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

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
                $this->m_laba->tambah();
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
