<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_home extends CI_Model
{

    public function get_all_produk($invoice)
    {
        if (!empty($invoice)) {
            $querybarang = "SELECT `tb_penjualan_detail`.*, `tb_produksi`.`produksi_nama`
                            FROM `tb_penjualan_detail`
                            JOIN  `tb_produksi` ON `tb_penjualan_detail`.`barang_id` = `tb_produksi`.`id_produksi`
                            WHERE `tb_penjualan_detail`.`penjualan_invoice` =  $invoice
                            ";
            return $this->db->query($querybarang)->result_array();
        }
    }
}

/* End of file M_home.php */
