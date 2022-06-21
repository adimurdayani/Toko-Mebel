<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_pembelian extends CI_Model
{

    public function delete($id)
    {
        $this->db->where_in('invoice_parent', $id);
        $this->db->delete('tb_pembelian');
    }

    public function delete_detail($id)
    {
        $this->db->where_in('pembelian_invoice_parent', $id);
        $this->db->delete('tb_pembelian_detail');
    }

    public function delete_hutang($id)
    {
        $this->db->where_in('hutang_invoice_parent', $id);
        $this->db->delete('tb_hutang');
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

    public function get_suplier()
    {
        $querybarang = "SELECT *
                        FROM `tb_pembelian`
                        JOIN  `tb_suplier` ON `tb_pembelian`.`invoice_suplier_id` = `tb_suplier`.`id_suplier`
                        ORDER BY `tb_pembelian`.`id` DESC
                        ";
        return $this->db->query($querybarang)->row();
    }

    public function get_all_pembelian()
    {
        $querybarang = "SELECT *
                        FROM `tb_pembelian`
                        JOIN  `tb_suplier` ON `tb_pembelian`.`invoice_suplier_id` = `tb_suplier`.`id_suplier`
                        ORDER BY `tb_pembelian`.`id` DESC
                        ";
        return $this->db->query($querybarang)->result();
    }

    public function get_all_invoice($invoice_pembelian)
    {
        $querybarang = "SELECT `tb_pembelian_detail`.*, `tb_barang`.`barang_nama`
                        FROM `tb_pembelian_detail`
                        JOIN  `tb_barang` ON `tb_pembelian_detail`.`barang_id` = `tb_barang`.`id_barang`
                        WHERE `tb_pembelian_detail`.`pembelian_invoice_parent` = $invoice_pembelian
                        ORDER BY `tb_pembelian_detail`.`id` DESC
                        ";
        return $this->db->query($querybarang)->result();
    }

    function kirim_all_pembelian($data)
    {
        $this->db->insert_batch('tb_pembelian', $data);

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }

        return FALSE;
    }

    public function get_total_cicilan($kode_barang)
    {
        $sql = "SELECT count(if(hutang_invoice_parent='$kode_barang', hutang_invoice_parent, NULL)) as hutang_invoice_parent,
                        sum(if(hutang_invoice_parent='$kode_barang',hutang_nominal, NULL)) as hutang_nominal
                        FROM tb_hutang";
        return $this->db->query($sql)->row();
    }

    public function update_harga_barang()
    {
        $data = [
            'barang_harga_beli' => preg_replace("/[^0-9]/", "", $this->input->post('keranjang_harga'))
        ];
        $this->db->where('id_barang', base64_decode($this->input->post('barang_id')));
        return $this->db->update('tb_barang', $data);
    }

    public function update_qty_barang($id)
    {

        $keranjang = $this->db->get_where('tb_pembelian_keranjang', ['keranjang_id' => $id])->row();
        $barang = $this->db->get_where('tb_barang', ['id_barang' => $keranjang->barang_id])->row();
        $data = [
            'barang_stok' => $barang->barang_stok + $this->input->post('keranjang_qty') - 1
        ];
        $this->db->where('id_barang', $keranjang->barang_id);
        return $this->db->update('tb_barang', $data);
    }
}

/* End of file m_loguser.php */
