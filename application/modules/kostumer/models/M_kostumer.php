<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_kostumer extends CI_Model
{

    public function delete($id)
    {
        $this->db->where_in('id_kostumer', $id);
        $this->db->delete('tb_kostumer');
    }
}

/* End of file m_loguser.php */
