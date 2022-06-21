<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Suplier extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_pembelian');
        is_logged_in();
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Data Suplier";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $this->db->order_by('id_suplier', 'desc');
            $data['get_suplier'] = $this->db->get('tb_suplier')->result();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();
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
        } else {
            $data['title'] = "Tambah Data Suplier";
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
                $this->load->view('suplier_add', $data, FALSE);
                $this->load->view('template/footer', $data, FALSE);
            } else {
                # code...

                $data = [
                    'nama' => $this->input->post('nama'),
                    'nama_perusahaan' => $this->input->post('nama_perusahaan'),
                    'phone' => $this->input->post('phone'),
                    'email' => $this->input->post('email'),
                    'alamat' => $this->input->post('alamat'),
                    'status_suplier' => 1,
                    'created_at' => date_indo("Y-m-d"),
                    'updated_at' => date_indo("Y-m-d")
                ];

                $this->db->insert('tb_suplier', $data);
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
                redirect('pembelian/suplier');
            }
        }
    }

    public function edit($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Tambah Data Suplier";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $getid = base64_decode($id);
            $data['get_suplier'] = $this->db->get_where('tb_suplier', ['id_suplier' => $getid])->row_array();


            $this->form_validation->set_rules('nama', 'nama lengkap', 'trim|required');
            $this->form_validation->set_rules('phone', 'nomor hp', 'trim|required');
            $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                # code...
                $this->load->view('template/header', $data, FALSE);
                $this->load->view('template/topbar', $data, FALSE);
                $this->load->view('template/sidebar', $data, FALSE);
                $this->load->view('suplier_edit', $data, FALSE);
                $this->load->view('template/footer', $data, FALSE);
            } else {
                # code...
                $id = $this->input->post('id_suplier');

                $data = [
                    'nama' => $this->input->post('nama'),
                    'nama_perusahaan' => $this->input->post('nama_perusahaan'),
                    'phone' => $this->input->post('phone'),
                    'email' => $this->input->post('email'),
                    'alamat' => $this->input->post('alamat'),
                    'created_at' => date_indo("Y-m-d"),
                    'updated_at' => date_indo("Y-m-d")
                ];

                $this->db->where('id_suplier', $id);
                $this->db->update('tb_suplier', $data);
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
                redirect('pembelian/suplier');
            }
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
        $this->db->delete('tb_suplier', ['id_suplier' => $get_id]);
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
        redirect('pembelian/suplier');
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
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();
            $this->db->order_by('id', 'desc');
            $data['get_log'] = $this->db->get('tb_visitor')->result();
            $this->load->view('cetak', $data, FALSE);
        }
    }

    public function ubahsuplier()
    {

        $suplierid = $this->input->post('suplierid');
        $suplierstatus = $this->input->post('suplierstatus');

        if ($suplierstatus > 0) {

            $data = [
                'status_suplier' => 0,
                'created_at' => date_indo("Y-m-d")
            ];

            $this->db->where('id_suplier', $suplierid);
            $this->db->update('tb_suplier', $data);

            $this->session->set_flashdata(
                'success',
                '$(document).ready(function(e) {
                    Swal.fire({
                        type: "success",
                        title: "Sukses",
                        text: "Suplier berhasil di Non-Aktifkan!"
                    })
                })'
            );
        } else {
            $data = [
                'status_suplier' => 1,
                'created_at' => date_indo("Y-m-d")
            ];

            $this->db->where('id_suplier', $suplierid);
            $this->db->update('tb_suplier', $data);

            $this->session->set_flashdata(
                'success',
                '$(document).ready(function(e) {
                    Swal.fire({
                        type: "success",
                        title: "Sukses",
                        text: "Suplier berhasil di Aktifkan!"
                    })
                })'
            );
        }
    }
}

/* End of file Log_user.php */
