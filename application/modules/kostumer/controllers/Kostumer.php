<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kostumer extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_kostumer');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = "Kostumer";
        $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $this->db->order_by('id_kostumer', 'desc');
        $data['get_kostumer'] = $this->db->get('tb_kostumer')->result();
        $data['get_config'] = $this->db->get('tb_konfigurasi')->row();
        $this->load->view('template/header', $data, FALSE);
        $this->load->view('template/topbar', $data, FALSE);
        $this->load->view('template/sidebar', $data, FALSE);
        $this->load->view('index', $data, FALSE);
        $this->load->view('template/footer', $data, FALSE);
    }

    public function tambah()
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

            redirect('kostumer');
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

            $this->db->insert('tb_kostumer', $data);
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
            redirect('kostumer');
        }
    }

    public function tambah_kostumer()
    {
        $data['title'] = "Tambah Kostumer";
        $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $data['get_config'] = $this->db->get('tb_konfigurasi')->row();
        $this->form_validation->set_rules('nama', 'nama lengkap', 'trim|required');
        $this->form_validation->set_rules('phone', 'nomor hp', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            # code...
            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('tambah-kostumer', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
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

            $this->db->insert('tb_kostumer', $data);
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
            redirect('kostumer');
        }
    }

    public function edit()
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

            redirect('kostumer');
        } else {
            # code...
            $id = base64_decode($this->input->post('id_kostumer'));

            $data = [
                'nama' => $this->input->post('nama'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'alamat' => $this->input->post('alamat'),
                'status_kostumer' => $this->input->post('status_kostumer'),
                'updated_at' => date_indo("Y-m-d")
            ];

            $this->db->where('id_kostumer', $id);
            $this->db->update('tb_kostumer', $data);
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
            redirect('kostumer');
        }
    }

    public function hapus($id)
    {
        $get_id = base64_decode($id);
        $this->db->delete('tb_kostumer', ['id_kostumer' => $get_id]);
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

    public function hapus_all()
    {
        $id = $_POST['id_kostumer'];
        $this->db->where_in('id_kostumer', $id);
        $this->m_kostumer->delete($id);
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
        redirect('kostumer');
    }
}

/* End of file Log_user.php */
