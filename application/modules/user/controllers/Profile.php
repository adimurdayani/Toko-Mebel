<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_user');
        is_logged_in();
    }


    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Profile";

            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->form_validation->set_rules('first_name', 'first name', 'trim|required');
            $this->form_validation->set_rules('last_name', 'last name', 'trim|required');
            $this->form_validation->set_rules('email', 'email', 'trim|required');
            $this->form_validation->set_rules('company', 'company', 'trim|required');
            $this->form_validation->set_rules('phone', 'phone', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header', $data, FALSE);
                $this->load->view('template/topbar', $data, FALSE);
                $this->load->view('template/sidebar', $data, FALSE);
                $this->load->view('profile', $data, FALSE);
                $this->load->view('template/footer', $data, FALSE);
            } else {
                $data = [
                    'email' => $this->input->post('email'),
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'company' => $this->input->post('company'),
                    'phone' => $this->input->post('phone'),
                ];
                $this->db->where('id', $this->input->post('id'));
                $this->db->update('users', $data);
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
                redirect('user/profile', 'refresh');
            }
        }
    }

    public function edit_password()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Profile";

            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->form_validation->set_rules('password', 'first name', 'trim|required|min_length[7]');
            $this->form_validation->set_rules('confirm_password', 'last name', 'trim|required|min_length[7]|matches[password]');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header', $data, FALSE);
                $this->load->view('template/topbar', $data, FALSE);
                $this->load->view('template/sidebar', $data, FALSE);
                $this->load->view('profile', $data, FALSE);
                $this->load->view('template/footer', $data, FALSE);
            } else {
                $data = [
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                ];
                $this->db->where('id', $this->input->post('id'));
                $this->db->update('users', $data);
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
                redirect('user/profile', 'refresh');
            }
        }
    }
}

/* End of file Controllername.php */
