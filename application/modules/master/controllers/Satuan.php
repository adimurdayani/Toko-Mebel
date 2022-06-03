<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Satuan extends CI_Controller
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
            $data['title'] = "Satuan";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();

            $this->db->order_by('id', 'desc');
            $data['get_satuan'] = $this->db->get('tb_satuan')->result_array();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('satuan', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function tambah()
    {
        $this->form_validation->set_rules('nama_satuan', 'nama satuan', 'trim|required');

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

            redirect('master/satuan');
        } else {
            # code...
            $data = [
                'nama_satuan' => $this->input->post('nama_satuan'),
                'status_satuan' => 1,
                'created_at' => date_indo("Y-m-d")
            ];

            $this->db->insert('tb_satuan', $data);
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
            redirect('master/satuan');
        }
    }

    public function edit()
    {
        $this->form_validation->set_rules('nama_satuan', 'nama satuan', 'trim|required');

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

            redirect('master/satuan');
        } else {
            # code...
            $id = base64_decode($this->input->post('id'));

            $data = [
                'nama_satuan' => $this->input->post('nama_satuan'),
                'created_at' => date_indo("Y-m-d")
            ];

            $this->db->where('id', $id);

            $this->db->update('tb_satuan', $data);
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
            redirect('master/satuan');
        }
    }

    public function hapus($id)
    {
        $getId = base64_decode($id);
        $this->db->delete('tb_satuan', ['id' => $getId]);
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
        redirect('master/satuan');
    }

    public function hapus_all()
    {
        $id = $_POST['id'];
        $this->m_data->delete_satuan($id);
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
        redirect('master/satuan');
    }

    public function ubahaktif()
    {

        $satuanid = $this->input->post('satuanid');
        $statussatuan = $this->input->post('statussatuan');

        if ($statussatuan > 0) {

            $data = [
                'status_satuan' => 0,
                'created_at' => date_indo("Y-m-d")
            ];

            $this->db->where('id', $satuanid);
            $this->db->update('tb_satuan', $data);

            $this->session->set_flashdata(
                'success',
                '$(document).ready(function(e) {
                    Swal.fire({
                        type: "success",
                        title: "Sukses",
                        text: "Satuan berhasil diupdate!"
                    })
                })'
            );
        } else {
            $data = [
                'status_satuan' => 1,
                'created_at' => date_indo("Y-m-d")
            ];

            $this->db->where('id', $satuanid);
            $this->db->update('tb_satuan', $data);

            $this->session->set_flashdata(
                'success',
                '$(document).ready(function(e) {
                    Swal.fire({
                        type: "success",
                        title: "Sukses",
                        text: "Satuan berhasil diupdate!"
                    })
                })'
            );
        }
    }
}

/* End of file Kategori.php */
