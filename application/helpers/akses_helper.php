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
    $menu_id = $querymenu['id_menu'];

    $aksesmenu = $ci->db->get_where('tb_akses_menu', [
      'user_id' => $group['group_id'],
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
