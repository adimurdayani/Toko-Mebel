<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_penawaran extends CI_Model
{

    public function tambah()
    {
        $nama_barang = $this->input->post('nama_barang');
        $keterangan = $this->input->post('keterangan');
        $penawaran_qty = $this->input->post('penawaran_qty');
        $harga =  preg_replace("/[^0-9]/", "", $this->input->post('harga'));
        $diskon = preg_replace("/[^0-9]/", "", $this->input->post('diskon'));
        $harga_total = $harga * $penawaran_qty;
        $total = $harga_total - $diskon;

        $data = [
            'nama_barang' => $nama_barang,
            'keterangan' => $keterangan,
            'harga' =>  $harga_total,
            'diskon' =>  $diskon,
            'total' => $total,
            'tanggal' => date_indo('Y-m-d'),
            'penawaran_qty' => $penawaran_qty
        ];
        return $this->db->insert('tb_penawaran', $data);
    }

    public function edit()
    {
        $nama_barang = $this->input->post('nama_barang');
        $keterangan = $this->input->post('keterangan');
        $penawaran_qty = $this->input->post('penawaran_qty');
        $harga =  preg_replace("/[^0-9]/", "", $this->input->post('harga'));
        $diskon = preg_replace("/[^0-9]/", "", $this->input->post('diskon'));
        $harga_total = $harga * $penawaran_qty;
        $total = $harga_total - $diskon;

        $data = [
            'nama_barang' => $nama_barang,
            'keterangan' => $keterangan,
            'harga' => $harga_total,
            'diskon' => $diskon,
            'total' => $total,
            'tanggal' => date_indo('Y-m-d'),
            'penawaran_qty' => $penawaran_qty
        ];
        $this->db->where('id_penawaran', $this->input->post('id_penawaran'));
        return $this->db->update('tb_penawaran', $data);
    }

    public function hapus_all($id)
    {
        $this->db->where_in('id_penawaran', $id);
        return $this->db->delete('tb_penawaran');
    }
}

/* End of file M_penawaran.php */
