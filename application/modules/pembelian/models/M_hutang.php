<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_hutang extends CI_Model {

    public function tambah()
    {
        $data = [
            'hutang_invoice' => $this->input->post('hutang_invoice'),
            'hutang_invoice_parent' => $this->input->post('hutang_invoice_parent'),
            'hutang_date' => $this->input->post('hutang_date'),
            'hutang_date_time' => date_indo('Y-m-d') . ' - ' . date('H:i:s'),
            'hutang_nominal' => preg_replace("/[^0-9]/", "", $this->input->post('hutang_nominal')),
            'hutang_tipe_pembayaran' => $this->input->post('hutang_tipe_pembayaran'),
            'hutang_cabang' => $this->input->post('hutang_cabang')
        ];
        return $this->db->insert('tb_hutang', $data);
    }

}

/* End of file M_hutang.php */
