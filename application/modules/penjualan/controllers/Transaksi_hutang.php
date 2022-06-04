<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_hutang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_penjualan');
        is_logged_in();
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Transaksi Kasir";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();

            $this->db->order_by('keranjang_id', 'desc');
            $data['get_penjualan_keranjang'] = $this->db->get('tb_penjualan_keranjang')->result();

            $data['get_kostumer'] = $this->db->get('tb_kostumer')->result();
            $data['get_barang'] = $this->m_penjualan->get_all_barang();
            $data['get_jml_penjualan'] = $this->db->get_where('tb_penjualan', ['invoice_cabang' => $user->id])->num_rows();

            $this->db->where('keranjang_harga <', 1);
            $data['get_keranjang_jml'] = $this->db->get('tb_penjualan_keranjang')->num_rows();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('transaksi_hutang', $data, FALSE);
        }
    }

    public function input_idbarang()
    {
        $id_barang = $this->input->post('id_barang');
        $data_barang = $this->db->get_where('tb_barang', ['id_barang' => $id_barang])->row();

        $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $group_id = $this->db->get_where('users_groups', ['user_id' => $user->id])->row();
        $get_penjualan = $this->db->get('tb_penjualan')->num_rows();
        $jml_penjualan = $get_penjualan + 1;

        $data = [
            'keranjang_nama' => $data_barang->barang_nama,
            'keranjang_harga_beli' => $data_barang->barang_harga_beli,
            'keranjang_harga' => $data_barang->barang_harga,
            'barang_id' => $id_barang,
            'barang_kode_slug' => $id_barang,
            'keranjang_qty' => 1,
            'keranjang_id_kasir' => $user->id,
            'keranjang_id_cek' => $id_barang . $user->id . $jml_penjualan,
            'keranjang_cabang' => $group_id->group_id
        ];
        $this->db->insert('tb_penjualan_keranjang', $data);
    }

    public function input_idbarang_dua()
    {
        $id_barang = $this->input->post('idbarang');
        $data_barang = $this->db->get_where('tb_barang', ['id_barang' => $id_barang])->row();
        $keranjang = $this->db->get_where('tb_penjualan_keranjang', ['barang_id' => $id_barang])->row();

        $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $group_id = $this->db->get_where('users_groups', ['user_id' => $user->id])->row();
        $get_penjualan = $this->db->get('tb_penjualan')->num_rows();
        $jml_penjualan = $get_penjualan + 1;

        if ($keranjang->barang_id == $id_barang) {
            $update_keranjang = [
                'keranjang_qty' => $keranjang->keranjang_qty + 1,
            ];
            $this->db->where('barang_id', $keranjang->barang_id);
            $this->db->update('tb_penjualan_keranjang', $update_keranjang);
        } else {
            $data = [
                'keranjang_nama' => $data_barang->barang_nama,
                'keranjang_harga_beli' => $data_barang->barang_harga_beli,
                'keranjang_harga' => $data_barang->barang_harga,
                'barang_id' => $id_barang,
                'barang_kode_slug' => $id_barang,
                'keranjang_qty' => 1,
                'keranjang_id_kasir' => $user->id,
                'keranjang_id_cek' => $id_barang . $user->id . $jml_penjualan,
                'keranjang_cabang' => $group_id->group_id
            ];
            $this->db->insert('tb_penjualan_keranjang', $data);
        }
    }

    public function kirim_all_penjualan()
    {
        $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $group = $this->db->get_where('users_groups', ['user_id' => $user->id])->row();
        $this->db->delete('tb_penjualan_keranjang', ['keranjang_id_kasir' => $user->id]);

        $barang_id = $_POST['barang_id'];
        $barang_qty = $_POST['keranjang_qty'];
        $keranjang_harga_beli = $_POST['keranjang_harga_beli'];
        $keranjang_harga = $_POST['keranjang_harga'];
        $penjualan_invoice = $_POST['penjualan_invoice'];
        $penjualan_invoice_count = $this->input->post('penjualan_invoice_count');
        $invoice_total_beli = $this->input->post('invoice_total_beli');
        $penjualan_invoice_get = $this->input->post('penjualan_invoice_get');

        $getid = $this->db->get('tb_barang')->result_array();
        foreach ($getid as $key => $value) {
            $data_barang[] = [
                'id_barang' => $barang_id[$key],
                'barang_stok' => $value['barang_stok'] - $barang_qty[$key],
                'barang_terjual' => $barang_qty[$key]
            ];
            $this->db->update_batch('tb_barang', $data_barang, 'id_barang');
        }

        $get_data = array();
        $index = 0;

        foreach ($keranjang_harga_beli as $databarang) {
            array_push($get_data, array(
                'penjualan_barang_id' => $barang_id[$index],
                'barang_id' => $barang_id[$index],
                'barang_qty' => $barang_qty[$index],
                'keranjang_harga_beli' => $databarang,
                'keranjang_harga' => $keranjang_harga[$index],
                'keranjang_id_kasir' => $group->group_id,
                'penjualan_invoice' => $penjualan_invoice[$index],
                'barang_qty_lama' => $barang_qty[$index],
                'barang_qty_lama_parent' => $barang_qty[$index],
                'penjualan_cabang' => $group->group_id
            ));
            $index++;
        }
        $this->db->insert_batch('tb_penjualan_detail', $get_data);

        $data = [
            'penjualan_invoice' => $penjualan_invoice_get,
            'penjualan_invoice_count' => $penjualan_invoice_count,
            'invoice_tgl' => date_indo('Y-m-d') . ' - ' . date('H:i:s'),
            'invoice_costumer' => $this->input->post('invoice_kostumer'),
            'invoice_status_kurir' => 1,
            'invoice_tipe_transaksi' => $this->input->post('invoice_tipe_pembayaran'),
            'invoice_total_beli' => $invoice_total_beli,
            'invoice_total' => $this->input->post('total'),
            'invoice_sub_total' => $this->input->post('total'),
            'invoice_bayar' =>  $this->input->post('bayar'),
            'invoice_kembali' => $this->input->post('total') - $this->input->post('bayar'),
            'invoice_kasir' => $user->id,
            'invoice_date' => date_indo('Y-m-d'),
            'invoice_total_beli_lama' => $invoice_total_beli,
            'invoice_total_lama' => $this->input->post('total'),
            'invoice_sub_total_lama' => $this->input->post('total'),
            'invoice_bayar_lama' => $this->input->post('bayar'),
            'invoice_kembali_lama' => $this->input->post('total') - $this->input->post('bayar'),
            'invoice_piutang' => 1,
            'invoice_piutang_dp' => $this->input->post('bayar'),
            'invoice_piutang_jatuh_tempo' => date_indo($this->input->post('invoice_piutang_jatuh_tempo')),
            'invoice_cabang' => $group->group_id,
        ];

        $this->db->insert('tb_penjualan', $data);
        $this->session->set_flashdata(
            'success',
            '$(document).ready(function(e) {
                    Swal.fire({
                    type: "success",
                    title: "Sukses",
                    text: "Transaksi penjualan berhasil disimpan!"
                })
            })'
        );
        redirect('penjualan/invoice/detail_hutang/' . base64_encode($penjualan_invoice_get));
    }

    public function edit_data()
    {
        $this->form_validation->set_rules('keranjang_harga', 'harga', 'trim|required');
        $this->form_validation->set_rules('keranjang_qty', 'harga', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata(
                'error',
                '$(document).ready(function(e) {
                    Swal.fire({
                        icon: "error",
                        type: "error",
                        title: "Oops...",
                        text: "Pastikan input data anda tidak ada yang kosong!"
                    })
                })'
            );

            redirect('penjualan/transaksi_cash');
        } else {
            $data = [
                'keranjang_harga' => $this->input->post('keranjang_harga'),
                'keranjang_qty' => $this->input->post('keranjang_qty')
            ];

            $this->db->where('keranjang_id', base64_decode($this->input->post('keranjang_id')));
            $this->db->update('tb_penjualan_keranjang', $data);
            $this->session->set_flashdata(
                'success',
                '$(document).ready(function(e) {
                        Swal.fire({
                        type: "success",
                        title: "Sukses",
                        text: "Data berhasil diupdate!"
                    })
                })'
            );
            redirect('penjualan/transaksi_hutang');
        }
    }

    public function hapus_keranjang($id)
    {
        $getId =  base64_decode($id);
        $this->db->delete('tb_penjualan_keranjang', ['keranjang_id' => $getId]);
        $this->session->set_flashdata(
            'success',
            '$(document).ready(function(e) {
                Swal.fire({
                    type: "success",
                    title: "Sukses",
                    text: "Data berhasil dihapus!"
                })
            })'
        );
        redirect('penjualan/transaksi_hutang');
    }
}

/* End of file Kasir.php */