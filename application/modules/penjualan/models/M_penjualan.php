<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_penjualan extends CI_Model
{

    public function delete($id)
    {
        $this->db->where_in('id', $id);
        $this->db->delete('tb_penjualan');
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

    public function get_all_penjualan()
    {
        $queryPenjualan = "SELECT `tb_penjualan`.*, `users`.`first_name`,`tb_kostumer`.`nama`
                        FROM `tb_penjualan`
                        JOIN  `users` ON `tb_penjualan`.`invoice_kasir` = `users`.`id`
                        JOIN  `tb_kostumer` ON `tb_penjualan`.`invoice_costumer` = `tb_kostumer`.`id_kostumer`
                        ORDER BY `tb_penjualan`.`invoice_id` DESC
                        ";
        return $this->db->query($queryPenjualan)->result();
    }

    public function get_kostumer()
    {
        $querybarang = "SELECT *
                        FROM `tb_penjualan`
                        JOIN  `tb_kostumer` ON `tb_penjualan`.`invoice_costumer` = `tb_kostumer`.`id_kostumer`
                        ORDER BY `tb_penjualan`.`invoice_id` DESC
                        ";
        return $this->db->query($querybarang)->row();
    }

    public function get_all_invoice($invoice_penjualan)
    {
        $querybarang = "SELECT `tb_penjualan_detail`.*, `tb_produksi`.`produksi_nama`
                        FROM `tb_penjualan_detail`
                        JOIN  `tb_produksi` ON `tb_penjualan_detail`.`barang_id` = `tb_produksi`.`id_produksi`
                        WHERE `tb_penjualan_detail`.`penjualan_invoice` = $invoice_penjualan
                        ORDER BY `tb_penjualan_detail`.`id_penjualan` DESC
                        ";
        return $this->db->query($querybarang)->result();
    }

    public function get_total_cicilan($piutang_invoice)
    {
        $sql = "SELECT count(if(piutang_invoice='$piutang_invoice', piutang_invoice, NULL)) as piutang_invoice,
                        sum(if(piutang_invoice='$piutang_invoice',piutang_nominal, NULL)) as piutang_nominal
                        FROM tb_penjualan_piutang";
        return $this->db->query($sql)->row();
    }
}

/* End of file m_loguser.php */
