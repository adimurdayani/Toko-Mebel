<?php

defined('BASEPATH') or exit('No direct script access allowed');

class m_loguser extends CI_Model
{

    public function delete($id)
    {
        $this->db->where_in('id', $id);
        $this->db->delete('tb_user_koneksi');
    }
}

/* End of file m_loguser.php */
