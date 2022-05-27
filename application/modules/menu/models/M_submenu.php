<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_submenu extends CI_Model
{

  public function get_all_submenu()
  {
    $querysubmenu = "SELECT `tb_submenu`.*, `tb_menu`.`menu`
                      FROM `tb_submenu`
                      JOIN  `tb_menu` ON `tb_submenu`.`id_menu` = `tb_menu`.`id_menu`
                      ORDER BY `tb_submenu`.`id_submenu` DESC
                  ";
    return $this->db->query($querysubmenu)->result();
  }

  public function get_all_menu_collapse($id)
  {
    $querysubmenu = "SELECT `tb_submenu_expan`.*, `tb_menu`.`menu`,`tb_submenu`.`submenu`
                      FROM `tb_submenu_expan`
                      JOIN  `tb_menu` ON `tb_submenu_expan`.`menu_id` = `tb_menu`.`id_menu`
                      JOIN  `tb_submenu` ON `tb_submenu_expan`.`submenu_id` = `tb_submenu`.`id_submenu`
                      WHERE `tb_submenu_expan`.`submenu_id` = $id
                      ORDER BY `tb_submenu_expan`.`nomor_urut` ASC
                  ";
    return $this->db->query($querysubmenu)->result();
  }

  public function delete($id)
  {
    $this->db->where_in('id_submenu', $id);
    $this->db->delete('tb_submenu');
  }

  public function delete_menu_collapse($id)
  {
    $this->db->where_in('sub_id', $id);
    $this->db->delete('tb_submenu_expan');
  }
}

/* End of file M_data.php */