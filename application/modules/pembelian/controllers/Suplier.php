<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Suplier extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_pembelian');
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else if (!$this->ion_auth->is_admin()) {
            redirect('auth/block', 'refresh');
        } else {
            $data['title'] = "Data Suplier";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $this->db->order_by('id_suplier', 'desc');
            $data['get_suplier'] = $this->db->get('tb_suplier')->result();
            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('suplier', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function tambah()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else if (!$this->ion_auth->is_admin()) {
            redirect('auth/block', 'refresh');
        } else {
            $data['title'] = "Tambah Data Suplier";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('suplier_add', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function post()
    {
        $this->form_validation->set_rules('nama', 'nama lengkap', 'trim|required');
        $this->form_validation->set_rules('phone', 'nomor hp', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            # code...
            $this->session->set_flashdata(
                'error',
                '$(document).ready(function(e) {
                    Swal.fire({
                        icon: "error",
                        type: "error",
                        title: "Oops...",
                        text: "Mohon lengkapi penginputan data anda.!"
                    })
                })'
            );

            redirect('pembelian');
        } else {
            # code...

            $data = [
                'nama' => $this->input->post('nama'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'alamat' => $this->input->post('alamat'),
                'status_kostumer' => $this->input->post('status_kostumer'),
                'created_at' => date_indo("Y-m-d"),
                'updated_at' => date_indo("Y-m-d")
            ];

            $this->db->insert('tb_pembelian', $data);
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
            redirect('pembelian');
        }
    }

    public function hapus_all()
    {
        $id = $_POST['id'];
        $this->db->where_in('id', $id);
        $this->m_pembelian->delete($id);
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
        redirect('log_user');
    }

    public function hapus($id)
    {
        $get_id = base64_decode($id);
        $this->db->delete('tb_pembelian', ['id' => $get_id]);
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
        redirect('kostumer');
    }

    public function cetak()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else if (!$this->ion_auth->is_admin()) {
            redirect('auth/block', 'refresh');
        } else {
            $data['title'] = "Cetak Log Users";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $this->db->order_by('id', 'desc');
            $data['get_log'] = $this->db->get('tb_visitor')->result();
            $this->load->view('cetak', $data, FALSE);
        }
    }
}

/* End of file Log_user.php */
