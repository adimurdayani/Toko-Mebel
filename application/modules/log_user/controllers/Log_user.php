<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Log_user extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_loguser');
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else if (!$this->ion_auth->is_admin()) {
            redirect('auth/block', 'refresh');
        } else {
            $data['title'] = "Log Users";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $this->db->order_by('id', 'desc');
            $data['get_log'] = $this->db->get('tb_visitor')->result();
            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('log-user', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function hapus_all()
    {
        $id = $_POST['id'];
        $this->db->where_in('id', $id);
        $this->m_loguser->delete($id);
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
