<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Penawaran extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('m_penawaran');
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Penawaran";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->db->order_by('id_penawaran', 'desc');
            $data['get_penawaran'] = $this->db->get('tb_penawaran')->result();

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('index', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function tambah()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Penawaran";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->form_validation->set_rules('nama_barang', 'nama barang', 'trim|required');
            $this->form_validation->set_rules('harga', 'harga', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                # code...
                $this->load->view('template/header', $data, FALSE);
                $this->load->view('template/topbar', $data, FALSE);
                $this->load->view('template/sidebar', $data, FALSE);
                $this->load->view('tambah', $data, FALSE);
            } else {
                $this->m_penawaran->tambah();
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
                redirect('penawaran');
            }
        }
    }

    public function edit($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Penawaran";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();
            $getid = base64_decode($id);
            $data['get_penawaran'] = $this->db->get_where('tb_penawaran', ['id_penawaran' => $getid])->row_array();

            $this->form_validation->set_rules('nama_barang', 'nama barang', 'trim|required');
            $this->form_validation->set_rules('harga', 'harga', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                # code...
                $this->load->view('template/header', $data, FALSE);
                $this->load->view('template/topbar', $data, FALSE);
                $this->load->view('template/sidebar', $data, FALSE);
                $this->load->view('edit', $data, FALSE);
            } else {
                $this->m_penawaran->edit($id);
                $this->session->set_flashdata(
                    'success',
                    '$(document).ready(function(e) {
                        Swal.fire({
                        type: "success",
                        title: "Sukses",
                        text: "Data berhasil diupdate!"
                    })
                })'
                );
                redirect('penawaran');
            }
        }
    }

    public function hapus($id)
    {
        $getid = base64_decode($id);
        $this->db->delete('tb_penawaran', ['id_penawaran' => $getid]);
        redirect('penawaran', 'refresh');
    }

    public function hapus_all()
    {
        $id = $_POST['id_penawaran'];
        $this->m_penawaran->hapus_all($id);
        redirect('penawaran', 'refresh');
    }

    public function cetak_nota($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Nota Penawaran";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $getid = base64_decode($id);
            $this->db->order_by('id_penawaran', 'desc');
            $data['get_penawaran'] = $this->db->get_where('tb_penawaran', ['id_penawaran' => $getid])->row_array();
            $this->load->view('nota-penawaran', $data, FALSE);
        }
    }
}

/* End of file Penawaran.php */
