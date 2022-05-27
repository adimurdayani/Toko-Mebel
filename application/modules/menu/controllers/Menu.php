<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
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
    } else if (!$this->ion_auth->is_admin()) {

      redirect('auth/block', 'refresh');
    } else {

      $data['title'] = 'Menu';
      $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
      $data['get_menu'] = $this->db->get('tb_menu')->result();

      $this->load->view('template/header', $data, FALSE);
      $this->load->view('template/topbar', $data, FALSE);
      $this->load->view('template/sidebar', $data, FALSE);
      $this->load->view('index', $data, FALSE);
      $this->load->view('template/footer', $data, FALSE);
    }
  }

  public function tambah()
  {
    $this->form_validation->set_rules('menu', 'menu', 'trim|required');
    $this->form_validation->set_rules('nomor_urut', 'menu', 'trim|required|is_unique[tb_menu.nomor_urut]');

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

      redirect('menu');
    } else {
      # code...
      $data = [
        'menu' => $this->input->post('menu'),
        'nomor_urut' => $this->input->post('nomor_urut')
      ];

      $this->db->insert('tb_menu', $data);
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
      redirect('menu');
    }
  }

  public function edit()
  {
    $this->form_validation->set_rules('menu', 'menu', 'trim|required');

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

      redirect('menu', 'refresh');
    } else {
      # code...
      $id = base64_decode($this->input->post('id_menu'));

      $data = [
        'menu' => $this->input->post('menu'),
        'nomor_urut' => $this->input->post('nomor_urut')
      ];

      $this->db->where('id_menu', $id);

      $this->db->update('tb_menu', $data);
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
      redirect('menu');
    }
  }

  public function hapus($id)
  {
    $this->db->delete('tb_menu', ['id_menu' => $id]);
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
    redirect('menu', 'refresh');
  }

  public function hapus_all()
  {
    $id = $_POST['id_menu'];
    $this->m_user->delete($id);
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
    redirect('menu');
  }
}

/* End of file Menu.php */