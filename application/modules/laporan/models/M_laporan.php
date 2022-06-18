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
}

/* End of file M_model.php */
