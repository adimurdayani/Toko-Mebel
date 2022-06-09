<?php

function is_logged_in()
{

  $ci = get_instance();

  // if (!$ci->ion_auth->logged_in()) {
  //   redirect('auth', 'refresh');
  // } else if (!$ci->ion_auth->is_admin()) {
  //   redirect('auth/block', 'refresh');
  // } else {

  // }

  if (!$ci->session->userdata('email')) {
    redirect('auth');
  } else {
    $id = $ci->db->get_where('users', ['email' => $ci->session->userdata('email')])->row_array();

    $group = $ci->db->get_where('users_groups', ['user_id' => $ci->session->userdata('id')])->row_array();

    $menurl = $ci->uri->segment(2);

    $querymenu = $ci->db->get_where('tb_menu', ['menu' => $menurl])->row_array();
    $menu_id = isset($querymenu['id_menu']);

    $aksesmenu = $ci->db->get_where('tb_akses_menu', [
      'user_id' => isset($group['group_id']),
      'menu_id' => $menu_id
    ]);

    if ($aksesmenu->num_rows() > 1) {
      redirect('auth/block');
    }
  }
}

function check_akses($user_id, $menu_id)
{

  $ci = get_instance();

  $ci->db->where('user_id', $user_id);
  $ci->db->where('menu_id', $menu_id);
  $result = $ci->db->get('tb_akses_menu');

  if ($result->num_rows() > 0) {
    return "checked='checked'";
  }
}

function check_kategori($id_kategori)
{
  $ci = get_instance();
  $ci->db->where('status_kategori', $id_kategori);
  $result = $ci->db->get('tb_kategori')->row_array();

  if ($result['status_kategori'] > 0) {
    return "checked='checked'";
  }
}

function check_satuan($id_satuan)
{
  $ci = get_instance();
  $ci->db->where('status_satuan', $id_satuan);
  $result = $ci->db->get('tb_satuan')->row_array();

  if ($result['status_satuan'] > 0) {
    return "checked='checked'";
  }
}

function check_suplier($status_suplier)
{
  $ci = get_instance();
  $ci->db->where('status_suplier', $status_suplier);
  $result = $ci->db->get('tb_suplier')->row();

  if ($result->status_suplier > 0) {
    return "checked='checked'";
  }
}


function check_user($aktif)
{
  $ci = get_instance();
  $ci->db->where('active', $aktif);
  $result = $ci->db->get('users')->row();

  if ($result->active > 0) {
    return "checked='checked'";
  }
}

function check_status_barang($status)
{
  $ci = get_instance();
  $ci->db->where('status_barang', $status);
  $result = $ci->db->get('tb_barang')->row();

  if ($result->status_barang > 0) {
    return "checked='checked'";
  }
}

function check_status_submenu($status)
{
  $ci = get_instance();
  $ci->db->where('active', $status);
  $result = $ci->db->get('tb_submenu')->row();

  if ($result->active > 0) {
    return "checked='checked'";
  }
}

function check_status_collapse($collepse)
{
  $ci = get_instance();
  $ci->db->where('collapse', $collepse);
  $result = $ci->db->get('tb_submenu')->row();

  if ($result->collapse > 0) {
    return "checked='checked'";
  }
}

function check_status_menu_collapse($menu_collapse)
{
  $ci = get_instance();
  $ci->db->where('is_active', $menu_collapse);
  $result = $ci->db->get('tb_submenu_expan')->row();

  if ($result->is_active > 0) {
    return "checked='checked'";
  }
}

function check_active_produksi($is_active)
{
  $ci = get_instance();
  $ci->db->where('is_active', $is_active);
  $result = $ci->db->get('tb_produksi')->row();

  if ($result->is_active > 0) {
    return "checked='checked'";
  }
}
