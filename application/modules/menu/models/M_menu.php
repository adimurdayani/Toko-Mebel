<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_menu extends CI_Model
{

    public function delete($id)
    {
        $this->db->where_in('id', $id);
        $this->db->delete('tb_menu');
    }
}
