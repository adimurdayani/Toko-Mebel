<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Konfigurasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth', 'refresh');
        } else {
            $data['title'] = 'Konfigurasi Website';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();
            $data['get_total'] = $this->db->get('tb_konfigurasi')->num_rows();

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('index', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function tambah()
    {
        $this->form_validation->set_rules('nama_web', 'nama web', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
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
            redirect('konfigurasi', 'refresh');
        } else {

            $config['upload_path']    = './assets/images/upload/';
            $config['allowed_types']  = 'jpg|png|jpeg|svg';
            $config['max_size']       = '1024';
            $config['encrypt_name']    = TRUE;

            $this->load->library('upload', $config);

            if (!empty($_FILES['icon_web'])) {
                # code...
                $this->upload->do_upload('icon_web');
                $data_icon = $this->upload->data();
                $file_icon = $data_icon['file_name'];
            }

            if (!empty($_FILES['logo_web'])) {
                # code...
                $this->upload->do_upload('logo_web');
                $data_logo = $this->upload->data();
                $file_logo = $data_logo['file_name'];
            }

            if (!empty($_FILES['logo_small_web'])) {
                # code...
                $this->upload->do_upload('logo_small_web');
                $data_logo_small = $this->upload->data();
                $file_logo_small = $data_logo_small['file_name'];
            }

            $data = [
                'nama_web' => $this->input->post('nama_web'),
                'icon_web' => $file_icon,
                'logo_web' => $file_logo,
                'logo_small_web' => $file_logo_small,
                'updated_at' => date_indo("Y-m-d"),
            ];
            $this->db->insert('tb_konfigurasi', $data);
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
            redirect('konfigurasi', 'refresh');
        }
    }

    public function edit()
    {
        $this->form_validation->set_rules('nama_web', '', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
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
            redirect('konfigurasi', 'refresh');
        } else {

            $id = $this->input->post('id');

            $config['upload_path']    = './assets/images/upload/';
            $config['allowed_types']  = 'jpg|png|jpeg|svg';
            $config['max_size']       = '1024';
            $config['encrypt_name']    = TRUE;

            $this->load->library('upload', $config);

            if (!empty($_FILES['icon_web'])) {
                # code...
                $this->upload->do_upload('icon_web');
                $data_icon = $this->upload->data();
                $file_icon = $data_icon['file_name'];
            }

            if (!empty($_FILES['logo_web'])) {
                # code...
                $this->upload->do_upload('logo_web');
                $data_logo = $this->upload->data();
                $file_logo = $data_logo['file_name'];
            }

            if (!empty($_FILES['logo_small_web'])) {
                # code...
                $this->upload->do_upload('logo_small_web');
                $data_logo_small = $this->upload->data();
                $file_logo_small = $data_logo_small['file_name'];
            }


            $data_img = $this->db->get_where('tb_konfigurasi', ['id' => $id])->row();
            if ($data_img->icon_web != null) {
                $target_img = './assets/images/upload/' . $data_img->icon_web;
                unlink($target_img);
            } elseif ($data_img->logo_web != null) {
                $target_img = './assets/images/upload/' . $data_img->logo_web;
                unlink($target_img);
            } elseif ($data_img->logo_small_web != null) {
                $target_img = './assets/images/upload/' . $data_img->logo_small_web;
                unlink($target_img);
            }

            $data = [
                'nama_web' => $this->input->post('nama_web'),
                'icon_web' => $file_icon,
                'logo_web' => $file_logo,
                'logo_small_web' => $file_logo_small,
                'updated_at' => date_indo("Y-m-d"),
            ];

            $this->db->where('id', $id);
            $this->db->update('tb_konfigurasi', $data);
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
            redirect('konfigurasi', 'refresh');
        }
    }

    public function edit_logo_nota()
    {
        $id = $this->input->post('id');

        $config['upload_path']    = './assets/images/upload/';
        $config['allowed_types']  = 'jpg|png|jpeg|svg';
        $config['max_size']       = '1024';
        $config['encrypt_name']    = TRUE;

        $this->load->library('upload', $config);

        if (!empty($_FILES['logo_nota'])) {
            # code...
            $this->upload->do_upload('logo_nota');
            $data_nota = $this->upload->data();
            $file_nota = $data_nota['file_name'];
        }

        $data_img = $this->db->get_where('tb_konfigurasi', ['id' => $id])->row();
        if ($data_img->logo_nota != null) {
            $target_img = './assets/images/upload/' . $data_img->logo_nota;
            unlink($target_img);
        }

        $data = [
            'logo_nota' => $file_nota,
            'updated_at' => date_indo("Y-m-d"),
        ];

        $this->db->where('id', $id);
        $this->db->update('tb_konfigurasi', $data);
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
        redirect('konfigurasi', 'refresh');
    }
}

/* End of file Konfigurasi.php */
