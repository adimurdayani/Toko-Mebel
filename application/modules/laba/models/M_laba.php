<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_laba extends CI_Model
{

    public function tambah()
    {
        $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $data = [
            'bank' => preg_replace("/[^0-9]/", "", $this->input->post('bank')),
            'motor' => preg_replace("/[^0-9]/", "", $this->input->post('motor')),
            'listrik' => preg_replace("/[^0-9]/", "", $this->input->post('listrik')),
            'perbaikan' => preg_replace("/[^0-9]/", "", $this->input->post('perbaikan')),
            'pemeliharaan' => preg_replace("/[^0-9]/", "", $this->input->post('pemeliharaan')),
            'sewa' => preg_replace("/[^0-9]/", "", $this->input->post('sewa')),
            'gaji' => preg_replace("/[^0-9]/", "", $this->input->post('gaji')),
            'telp_internet' => preg_replace("/[^0-9]/", "", $this->input->post('telp_internet')),
            'pengeluaran_lain' => preg_replace("/[^0-9]/", "", $this->input->post('pengeluaran_lain')),
            'biaya_tak_terduga' => preg_replace("/[^0-9]/", "", $this->input->post('biaya_tak_terduga')),
            'biaya_tanggal' => date_indo('Y-m-d') . ' - ' . date('H:i:s'),
            'biaya_kasir_id' => $user->id
        ];
        return $this->db->insert('tb_biaya_kas', $data);
    }

    public function edit()
    {
        $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $data = [
            'bank' => preg_replace("/[^0-9]/", "", $this->input->post('bank')),
            'motor' => preg_replace("/[^0-9]/", "", $this->input->post('motor')),
            'listrik' => preg_replace("/[^0-9]/", "", $this->input->post('listrik')),
            'perbaikan' => preg_replace("/[^0-9]/", "", $this->input->post('perbaikan')),
            'pemeliharaan' => preg_replace("/[^0-9]/", "", $this->input->post('pemeliharaan')),
            'sewa' => preg_replace("/[^0-9]/", "", $this->input->post('sewa')),
            'gaji' => preg_replace("/[^0-9]/", "", $this->input->post('gaji')),
            'telp_internet' => preg_replace("/[^0-9]/", "", $this->input->post('telp_internet')),
            'pengeluaran_lain' => preg_replace("/[^0-9]/", "", $this->input->post('pengeluaran_lain')),
            'biaya_tak_terduga' => preg_replace("/[^0-9]/", "", $this->input->post('biaya_tak_terduga')),
            'biaya_tanggal' => date_indo('Y-m-d') . ' - ' . date('H:i:s'),
            'biaya_kasir_id' => $user->id
        ];
        $this->db->where('id_biaya', $this->input->post('id_biaya'));
        return $this->db->update('tb_biaya_kas', $data);
    }

    public function get_total_all_pendapatan()
    {
        $sql = "SELECT sum(if(invoice_sub_total, invoice_sub_total, NULL)) as invoice_sub_total
                        FROM tb_penjualan";
        return $this->db->query($sql)->row_array();
    }

    public function get_total_pembelian_barang()
    {
        $sql = "SELECT sum(if(barang_harga_beli, barang_harga_beli, NULL)) as barang_harga_beli
                        FROM tb_barang";
        return $this->db->query($sql)->row_array();
    }

    public function hapus($id)
    {
        return $this->db->delete('tb_biaya_kas', ['id_biaya' => $id]);
    }

    public function hapus_all($id)
    {
        $this->db->where_in('id_biaya', $id);
        return $this->db->delete('tb_biaya_kas');
    }
}

/* End of file M_laba.php */
