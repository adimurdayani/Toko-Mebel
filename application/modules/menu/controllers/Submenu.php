<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Submenu extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    $this->load->model('m_submenu');
  }

  public function index()
  {
    if (!$this->ion_auth->logged_in()) {

      redirect('auth', 'refresh');
    } else if (!$this->ion_auth->is_admin()) {

      redirect('auth/block', 'refresh');
    } else {

      $data['title'] = 'Sub Menu';
      $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
      $data['get_submenu'] = $this->m_submenu->get_all_submenu();
      $data['get_menu'] = $this->db->get('tb_menu')->result();

      $this->load->view('template/header', $data, FALSE);
      $this->load->view('template/topbar', $data, FALSE);
      $this->load->view('template/sidebar', $data, FALSE);
      $this->load->view('submenu', $data, FALSE);
      $this->load->view('template/footer', $data, FALSE);
    }
  }

  public function tambah()
  {
    $this->form_validation->set_rules('submenu', 'sub menu', 'trim|required');
    $this->form_validation->set_rules('icon', 'icon menu', 'trim|required');
    $this->form_validation->set_rules('url', 'url menu', 'trim|required');

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

      redirect('menu/submenu', 'refresh');
    } else {
      # code...
      $data = [
        'id_menu' => $this->input->post('id_menu'),
        'submenu' => $this->input->post('submenu'),
        'icon' => $this->input->post('icon'),
        'url' => $this->input->post('url'),
        'collapse' => $this->input->post('collapse'),
        'nomor_urut' => $this->input->post('nomor_urut')
      ];

      $this->db->insert('tb_submenu', $data);
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
      redirect('menu/submenu');
    }
  }

  public function edit()
  {
    $this->form_validation->set_rules('submenu', 'sub menu', 'trim|required');
    $this->form_validation->set_rules('icon', 'icon menu', 'trim|required');
    $this->form_validation->set_rules('url', 'url menu', 'trim|required');

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

      redirect('menu/submenu', 'refresh');
    } else {
      # code...
      $id = base64_decode($this->input->post('id_submenu'));

      $data = [
        'id_menu' => $this->input->post('id_menu'),
        'submenu' => $this->input->post('submenu'),
        'icon' => $this->input->post('icon'),
        'url' => $this->input->post('url'),
        'collapse' => $this->input->post('collapse'),
        'nomor_urut' => $this->input->post('nomor_urut')
      ];

      $this->db->where('id_submenu', $id);

      $this->db->update('tb_submenu', $data);
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
      redirect('menu/submenu');
    }
  }

  public function hapus($id)
  {
    $id_submenu = base64_decode($id);
    $this->db->delete('tb_submenu', ['id_submenu' => $id_submenu]);
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
    redirect('menu/submenu', 'refresh');
  }

  public function hapus_all()
  {
    $id = $_POST['id_submenu'];
    $id_submenu = base64_decode($id);
    $this->m_submenu->delete($id_submenu);
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
  }

  public function detail_menu_collapse($id)
  {
    if (!$this->ion_auth->logged_in()) {

      redirect('auth', 'refresh');
    } else if (!$this->ion_auth->is_admin()) {

      redirect('auth/block', 'refresh');
    } else {

      $data['title'] = 'Data Submenu';
      $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();

      $id_submenu = base64_decode($id);
      $data['get_menu_collapse'] = $this->m_submenu->get_all_menu_collapse($id_submenu);
      $data['get_menu'] = $this->db->get('tb_menu')->result();
      $data['get_submenu'] = $this->db->get('tb_submenu')->result();
      $data['get_submenu_id'] = $this->db->get_where('tb_submenu', ['id_submenu' => $id_submenu])->row();

      $this->load->view('template/header', $data, FALSE);
      $this->load->view('template/topbar', $data, FALSE);
      $this->load->view('template/sidebar', $data, FALSE);
      $this->load->view('menu_collapse', $data, FALSE);
      $this->load->view('template/footer', $data, FALSE);
    }
  }

  public function tambah_menu_collapse()
  {
    $this->form_validation->set_rules('judul', 'menu collapse', 'trim|required');
    $this->form_validation->set_rules('url', 'url menu', 'trim|required');
    $id_submenu = base64_decode($this->input->post('submenu_id'));

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
      redirect('menu/submenu/detail_menu_collapse/' . base64_decode($id_submenu));
    } else {
      # code...
      $submenuId = base64_decode($this->input->post('submenu_id'));
      $menuId = base64_decode($this->input->post('menu_id'));

      $data = [
        'menu_id' => $menuId,
        'submenu_id' => $submenuId,
        'judul' => $this->input->post('judul'),
        'url' => $this->input->post('url'),
        'is_active' => $this->input->post('is_active'),
        'nomor_urut' => $this->input->post('nomor_urut')
      ];

      $this->db->insert('tb_submenu_expan', $data);
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
      redirect('menu/submenu/detail_menu_collapse/' . base64_encode($id_submenu));
    }
  }


  public function edit_menu_collapse()
  {
    $this->form_validation->set_rules('judul', 'menu collapse', 'trim|required');
    $this->form_validation->set_rules('url', 'url menu', 'trim|required');

    $id_submenu = base64_decode($this->input->post('submenu_id'));
    $id = base64_decode($this->input->post('sub_id'));
    $menuid = base64_decode($this->input->post('menu_id'));

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
      redirect('menu/submenu/detail_menu_collapse/' . base64_encode($id_submenu));
    } else {
      # code...
      $data = [
        'menu_id' => $menuid,
        'submenu_id' => $id_submenu,
        'judul' => $this->input->post('judul'),
        'url' => $this->input->post('url'),
        'is_active' => $this->input->post('is_active'),
        'nomor_urut' => $this->input->post('nomor_urut')
      ];

      $this->db->where('sub_id', $id);
      $this->db->update('tb_submenu_expan', $data);
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
      redirect('menu/submenu/detail_menu_collapse/' . base64_encode($id_submenu));
    }
  }

  public function hapus_menu_collapse($id)
  {
    $id_submenu = base64_decode($id);
    $idsubmenu = $this->db->get_where('tb_submenu_expan', ['sub_id' => $id_submenu])->row();

    $this->db->delete('tb_submenu_expan', ['sub_id' => $id_submenu]);
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
    redirect('menu/submenu/detail_menu_collapse/' . base64_encode($idsubmenu->submenu_id));
  }

  public function hapus_all_menu_collapse()
  {
    $id = $_POST['sub_id'];

    $this->m_submenu->delete_menu_collapse($id);
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
  }
}

/* End of file Menu.php */