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
}

/* End of file M_dashboard.php */
