<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_data');
        is_logged_in();
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Kategori";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();

            $this->db->order_by('id', 'desc');
            $data['get_kategori'] = $this->db->get('tb_kategori')->result_array();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('kategori', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function tambah()
    {
        $this->form_validation->set_rules('nama_kategori', 'nama kategori', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            # code...
            $this->session->set_flashdata(
                'error',
                '$(document).ready(function(e) {
            Swal.fire({
                icon: "error",
                type: "error",
                title: "Oops...",
                text: "Nama menu dan nomor urut tidak boleh sama, dengan data yang ada!"
            })
        })'
            );

            redirect('master/kategori');
        } else {
            # code...
            $data = [
                'nama_kategori' => $this->input->post('nama_kategori'),
                'status_kategori' => 1,
                'created_at' => date_indo("Y-m-d")
            ];

            $this->db->insert('tb_kategori', $data);
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
            redirect('master/kategori');
        }
    }

    public function edit()
    {
        $this->form_validation->set_rules('nama_kategori', 'nama kategori', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            # code...
            $this->session->set_flashdata(
                'error',
                '$(document).ready(function(e) {
                    Swal.fire({
                        icon: "error",
                        type: "error",
                        title: "Oops...",
                        text: "Data gagal disimpan!"
                    })
                })'
            );

            redirect('master/kategori');
        } else {
            # code...
            $id = base64_decode($this->input->post('id'));

            $data = [
                'nama_kategori' => $this->input->post('nama_kategori'),
                'created_at' => date_indo("Y-m-d")
            ];

            $this->db->where('id', $id);

            $this->db->update('tb_kategori', $data);
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
            redirect('master/kategori');
        }
    }

    public function hapus($id)
    {
        $getId = base64_decode($id);
        $this->db->delete('tb_kategori', ['id' => $getId]);
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
        redirect('master/kategori');
    }

    public function hapus_all()
    {
        $id = $_POST['id'];
        $this->m_data->delete($id);
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
        redirect('master/kategori');
    }

    public function ubahaktif()
    {

        $kategori_id = $this->input->post('kategoriid');
        $status_id = $this->input->post('statuskategori');

        if ($status_id > 0) {

            $data = [
                'status_kategori' => 0,
                'created_at' => date_indo("Y-m-d")
            ];

            $this->db->where('id', $kategori_id);
            $this->db->update('tb_kategori', $data);

            $this->session->set_flashdata(
                'success',
                '$(document).ready(function(e) {
                    Swal.fire({
                        type: "success",
                        title: "Sukses",
                        text: "Kategori berhasil diupdate!"
                    })
                })'
            );
        } else {
            $data = [
                'status_kategori' => 1,
                'created_at' => date_indo("Y-m-d")
            ];

            $this->db->where('id', $kategori_id);
            $this->db->update('tb_kategori', $data);

            $this->session->set_flashdata(
                'success',
                '$(document).ready(function(e) {
                    Swal.fire({
                        type: "success",
                        title: "Sukses",
                        text: "Kategori berhasil diupdate!"
                    })
                })'
            );
        }
    }
}

/* End of file Kategori.php */
