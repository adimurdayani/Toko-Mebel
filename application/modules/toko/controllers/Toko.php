<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Toko extends CI_Controller
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
            $data['title'] = "Invoice Penjualan";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_toko'] = $this->db->get('tb_toko')->result();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('index', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function tambah()
    {
        $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $grup = $this->db->get_where('users_groups', ['user_id' => $user->id])->row();
        $this->form_validation->set_rules('toko_nama', 'nama toko', 'trim|required');
        $this->form_validation->set_rules('toko_tlpn', 'No. telepon', 'trim|required');
        $this->form_validation->set_rules('toko_wa', 'No. whatsapp', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            # code...
            $this->session->set_flashdata(
                'error',
                '$(document).ready(function(e) {
                    Swal.fire({
                        icon: "error",
                        type: "error",
                        title: "Oops...",
                        text: "Gagal menyimpan data!"
                    })
                })'
            );

            redirect('toko', 'refresh');
        } else {
            $data = [
                'toko_nama' => $this->input->post('toko_nama'),
                'toko_kota' => $this->input->post('toko_kota'),
                'toko_alamat' => $this->input->post('toko_alamat'),
                'toko_tlpn' => $this->input->post('toko_tlpn'),
                'toko_wa' => $this->input->post('toko_wa'),
                'toko_email' => $this->input->post('toko_email'),
                'toko_status' => 1,
                'toko_ongkir' => $this->input->post('toko_ongkir'),
                'toko_cabang' => $grup->group_id,
                'toko_user_id' => $user->id
            ];
            $this->db->insert('tb_toko', $data);
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
            redirect('toko', 'refresh');
        }
    }

    public function edit()
    {
        $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $grup = $this->db->get_where('users_groups', ['user_id' => $user->id])->row();

        $this->form_validation->set_rules('toko_nama', 'nama toko', 'trim|required');
        $this->form_validation->set_rules('toko_tlpn', 'No. telepon', 'trim|required');
        $this->form_validation->set_rules('toko_wa', 'No. whatsapp', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            # code...
            $this->session->set_flashdata(
                'error',
                '$(document).ready(function(e) {
                    Swal.fire({
                        icon: "error",
                        type: "error",
                        title: "Oops...",
                        text: "Gagal mengupdate data!"
                    })
                })'
            );

            redirect('toko', 'refresh');
        } else {
            $id = $this->input->post('id_toko');

            $data = [
                'toko_nama' => $this->input->post('toko_nama'),
                'toko_kota' => $this->input->post('toko_kota'),
                'toko_alamat' => $this->input->post('toko_alamat'),
                'toko_tlpn' => $this->input->post('toko_tlpn'),
                'toko_wa' => $this->input->post('toko_wa'),
                'toko_email' => $this->input->post('toko_email'),
                'toko_status' => 1,
                'toko_ongkir' => $this->input->post('toko_ongkir'),
                'toko_cabang' => $grup->group_id,
                'toko_user_id' => $user->id
            ];
            $this->db->where('id_toko', $id);
            $this->db->update('tb_toko', $data);
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
            redirect('toko', 'refresh');
        }
    }

    public function hapus($id)
    {
        $getid = base64_decode($id);
        $this->db->delete('tb_toko', ['id_toko' => $getid]);
        redirect('toko', 'refresh');
    }
}

/* End of file Controllername.php */
