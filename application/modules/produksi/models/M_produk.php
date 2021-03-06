<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_produk extends CI_Model
{

    public function get_all_produk()
    {
        $querybarang = "SELECT `tb_produksi_keranjang`.*, `tb_barang`.`barang_nama`,`tb_kategori`.`nama_kategori`,`tb_satuan`.`nama_satuan`
        FROM `tb_produksi_keranjang`
        JOIN  `tb_barang` ON `tb_produksi_keranjang`.`keranjang_id_barang` = `tb_barang`.`id_barang`
        JOIN  `tb_kategori` ON `tb_produksi_keranjang`.`keranjang_kategori_barang` = `tb_kategori`.`id`
        JOIN  `tb_satuan` ON `tb_barang`.`barang_satuan_id` = `tb_satuan`.`id`
        ORDER BY `tb_produksi_keranjang`.`id_produksi_keranjang` DESC
        ";
        return $this->db->query($querybarang)->result();
    }

    public function get_all_produk_detail($getKode)
    {
        $querybarang = "SELECT `tb_produksi_detail`.*, `tb_barang`.`barang_nama`,`tb_kategori`.`nama_kategori`
        FROM `tb_produksi_detail`
        JOIN  `tb_barang` ON `tb_produksi_detail`.`detail_material_id` = `tb_barang`.`id_barang`
        JOIN  `tb_kategori` ON `tb_produksi_detail`.`detail_kategori_barang` = `tb_kategori`.`id`
        WHERE `tb_produksi_detail`.`detail_invoice_produksi` = $getKode
        ORDER BY `tb_produksi_detail`.`id_produksi_detail` DESC
        ";
        return $this->db->query($querybarang)->result();
    }
}

/* End of file M_produk.php */
