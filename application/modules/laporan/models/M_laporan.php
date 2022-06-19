<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_laporan extends CI_Model
{

    public function get_all_laporankasir($invoice_kasir)
    {
        $sql = "SELECT count(if(invoice_kasir='$invoice_kasir', invoice_kasir, NULL)) as invoice_kasir,
                        sum(if(invoice_kasir='$invoice_kasir', invoice_total, NULL)) as invoice_total
                        FROM tb_penjualan";
        return $this->db->query($sql)->row();
    }

    public function get_all_laporancostumer($invoice_costumer)
    {
        $sql = "SELECT count(if(invoice_costumer='$invoice_costumer', invoice_costumer, NULL)) as invoice_costumer,
                        sum(if(invoice_costumer='$invoice_costumer', invoice_total, NULL)) as invoice_total
                        FROM tb_penjualan";
        return $this->db->query($sql)->row();
    }

    public function get_all_laporansuplier($invoice_suplier)
    {
        $sql = "SELECT count(if(invoice_suplier_id='$invoice_suplier', invoice_suplier_id, NULL)) as invoice_suplier_id,
                        sum(if(invoice_suplier_id='$invoice_suplier', invoice_total, NULL)) as invoice_total
                        FROM tb_pembelian";
        return $this->db->query($sql)->row();
    }

    public function get_laporan_penjualan_transaksi($invoice_tipe_transaksi)
    {
        $sql = "SELECT count(if(invoice_tipe_transaksi='$invoice_tipe_transaksi', invoice_tipe_transaksi, NULL)) as invoice_tipe_transaksi,
                        sum(if(invoice_tipe_transaksi='$invoice_tipe_transaksi', invoice_total, NULL)) as invoice_total
                        FROM tb_penjualan";
        return $this->db->query($sql)->row();
    }

    public function get_laporan_penjualan_produksi($produksi_kategori)
    {
        $sql = "SELECT count(if(produksi_kategori='$produksi_kategori', produksi_kategori, NULL)) as produksi_kategori,
                        sum(if(produksi_kategori='$produksi_kategori', produksi_terjual, NULL)) as produksi_terjual
                        FROM tb_produksi";
        return $this->db->query($sql)->row();
    }

    public function get_laporan_pembelian_material($barang_id)
    {
        $sql = "SELECT count(if(barang_id='$barang_id', barang_id, NULL)) as barang_id,
                        sum(if(barang_id='$barang_id', barang_qty, NULL)) as barang_qty
                        FROM tb_pembelian_detail";
        return $this->db->query($sql)->row();
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

    public function get_all_penjualankasir($tgl_awal,  $tgl_akhir, $invoice_kasir)
    {
        $this->db->where('invoice_date >=', date_indo($tgl_awal));
        $this->db->where('invoice_date <=', date_indo($tgl_akhir));
        $this->db->where('invoice_kasir', $invoice_kasir);
        return $this->db->get('tb_penjualan')->result();
    }
}

/* End of file M_model.php */
