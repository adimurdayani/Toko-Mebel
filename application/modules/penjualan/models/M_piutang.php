<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_piutang extends CI_Model
{

    public function tambah()
    {

        $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $grup = $this->db->get_where('users_groups', ['user_id' => $user->id])->row();
        $data = [
            'piutang_invoice' => $this->input->post('piutang_invoice'),
            'piutang_date' => date_indo('Y-m-d'),
            'piutang_date_time' => date_indo('Y-m-d') . ' - ' . date('H:i:s'),
            'piutang_kasir' => $grup->group_id,
            'piutang_nominal' => preg_replace("/[^0-9]/", "", $this->input->post('piutang_nominal')),
            'piutang_tipe_pembayaran' => $this->input->post('piutang_tipe_pembayaran'),
            'piutang_cabang' => $grup->group_id
        ];
        return $this->db->insert('tb_penjualan_piutang', $data);
    }
}
