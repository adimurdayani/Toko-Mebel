<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Akses extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }


    public function get_akses($id)
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth', 'refresh');
        } else {

            $data['title'] = 'Akses User';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->db->where('id_menu !=', 4);
            $data['get_menu'] = $this->db->get('tb_menu')->result();

            $get_id = base64_decode($id);
            $data['get_grup'] = $this->db->get_where('groups', ['id' => $get_id])->row_array();

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('akses', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }


    public function ubahakses()
    {
        $menu_id = $this->input->post('menuId');
        $user_id = $this->input->post('userId');

        $data = [
            'user_id' => $user_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('tb_akses_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('tb_akses_menu', $data);
        } else {
            $this->db->delete('tb_akses_menu', $data);
        }
        $this->session->set_flashdata(
            'success',
            '$(document).ready(function(e) {
                Swal.fire({
                    type: "success",
                    title: "Sukses",
                    text: "Akses berhasil diupdate!"
                })
            })'
        );
    }
}

/* End of file Akses.php */
