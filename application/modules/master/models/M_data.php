<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_data extends CI_Model
{

    public function delete($id)
    {
        $this->db->where_in('id', $id);
        $this->db->delete('tb_kategori');
    }

    public function delete_satuan($id)
    {
        $this->db->where_in('id', $id);
        $this->db->delete('tb_satuan');
    }

    public function delete_barang($id)
    {
        $this->db->where_in('id_barang', $id);
        $this->db->delete('tb_barang');
    }

    public function get_all_barang()
    {
        $querybarang = "SELECT `tb_barang`.*, `tb_kategori`.`nama_kategori`,`tb_satuan`.`nama_satuan`
                        FROM `tb_barang`
                        JOIN  `tb_kategori` ON `tb_barang`.`barang_kategori_id` = `tb_kategori`.`id`
                        JOIN  `tb_satuan` ON `tb_barang`.`barang_satuan_id` = `tb_satuan`.`id`
                        ORDER BY `tb_barang`.`id_barang` DESC
                        ";
        return $this->db->query($querybarang)->result();
    }
}

/* End of file m_grup.php */
