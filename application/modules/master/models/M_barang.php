<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_barang extends CI_Model
{

    public function tambah()
    {

        $no = $this->db->get('tb_barang')->num_rows();
        $data = [
            'barang_kode' => $this->input->post('barang_kode'),
            'barang_kode_slug' => $this->input->post('barang_kode'),
            'barang_kode_count' => $no + 1,
            'barang_nama' => $this->input->post('barang_nama'),
            'barang_harga_beli' => 0,
            'barang_harga' => preg_replace("/[^0-9]/", "", $this->input->post('barang_harga')),
            'barang_tanggal' => date_indo("Y-m-d"),
            'barang_stok' => $this->input->post('barang_stok'),
            'barang_kategori_id' => $this->input->post('barang_kategori_id'),
            'barang_satuan_id' => $this->input->post('barang_satuan_id'),
            'barang_deskripsi' => $this->input->post('barang_deskripsi'),
            'barang_terjual' => 0,
            'status_barang' => 1,
        ];

        return $this->db->insert('tb_barang', $data);
    }

    public function tambah_detail()
    {
        $data = [
            'detail_kode_barang' =>   $this->input->post('barang_kode'),
            'detail_panjang' => 0,
            'detail_lebar' => 0,
        ];
        return $this->db->insert('tb_barang_detail', $data);
    }

    public function edit()
    {
        $id =  base64_decode($this->input->post('id_barang'));
        $data = [
            'barang_nama' => $this->input->post('barang_nama'),
            'barang_harga' => preg_replace("/[^0-9]/", "", $this->input->post('barang_harga')),
            'barang_kategori_id' => $this->input->post('barang_kategori_id'),
            'barang_stok' => $this->input->post('barang_stok'),
            'barang_tanggal' => date_indo("Y-m-d"),
            'barang_satuan_id' => $this->input->post('barang_satuan_id'),
            'barang_deskripsi' => $this->input->post('barang_deskripsi')
        ];

        $this->db->where('id_barang', $id);
        return $this->db->update('tb_barang', $data);
    }
}

/* End of file M_barang.php */
