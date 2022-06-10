<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_dashboard extends CI_Model
{

    public function get_total()
    {
        $this->db->group_by('date');
        $this->db->select('date');
        $this->db->select('hits');
        $this->db->select("count(*) as total");
        return $this->db->from('tb_visitor')
            ->get()
            ->result();
    }

    public function get_total_userkoneksi()
    {
        $this->db->group_by('browser');
        $this->db->select('browser');
        $this->db->select('hits');
        $this->db->select("count(*) as total_koneksi");
        return $this->db->from('tb_visitor')
            ->get()
            ->result();
    }

    public function get_total_pendapatan()
    {
        $bulan_sekarang = date_indo("Y-m-d");
        $sql = "SELECT count(if(invoice_date='$bulan_sekarang', invoice_date, NULL)) as invoice_date,
                        sum(if(invoice_date='$bulan_sekarang', invoice_sub_total, NULL)) as invoice_sub_total
                        FROM tb_penjualan";
        return $this->db->query($sql)->row();
    }

    public function get_total_invoice_cash()
    {
        $bulan_sekarang = date_indo("Y-m-d");
        $sql = "SELECT count(if(invoice_date='$bulan_sekarang', invoice_date, NULL)) as invoice_date,
                        sum(if(invoice_date='$bulan_sekarang', invoice_tipe_transaksi, NULL)) as invoice_tipe_transaksi
                        FROM tb_penjualan";
        return $this->db->query($sql)->row();
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
}

/* End of file M_dashboard.php */
