<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_pembelian extends CI_Model
{

    public function delete($id)
    {
        $this->db->where_in('id', $id);
        $this->db->delete('tb_pembelian');
    }
}

/* End of file m_loguser.php */
