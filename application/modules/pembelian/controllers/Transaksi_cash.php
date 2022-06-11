<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_cash extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_pembelian');
        is_logged_in();
    }


    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Transaksi Pembelian";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_kode'] = $this->db->get('tb_barang')->result();
            $data['get_suplier'] = $this->db->get('tb_suplier')->result();
            $data['get_barang'] = $this->m_pembelian->get_all_barang();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $get_pembelian = $this->db->get('tb_pembelian')->num_rows();
            $jml_pembelian = $get_pembelian + 1;
            $tglsekarang = date("Ymd");
            $pembeliansekarang = $tglsekarang . $jml_pembelian;

            $user =  $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $group_id = $this->db->get_where('users_groups', ['user_id' => $user->id])->row();

            $keranjangArray = array('keranjang_id_kasir' => $user->id, 'keranjang_cabang' => $group_id->group_id);
            $this->db->where($keranjangArray);
            $data['get_keranjang'] = $this->db->get_where('tb_pembelian_keranjang')->result();

            $arrayWhere = array('pembelian_parent' => $pembeliansekarang, 'pembelian_user' => $group_id->group_id, 'pembelian_cabang' => $user->id);
            $this->db->where($arrayWhere);
            $data['get_pembelian_session'] = $this->db->get('tb_pembelian_session')->row_array();

            $this->db->where('keranjang_harga <', 1);
            $data['get_keranjang_jml'] = $this->db->get('tb_pembelian_keranjang')->num_rows();

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('transaksi_cash', $data, FALSE);
        }
    }

    public function tambah_no_invoice()
    {

        $this->form_validation->set_rules('pembelian_input', 'No. invoice', 'trim|required|is_unique[tb_pembelian.invoice_pembelian]');

        if ($this->form_validation->run() == FALSE) {
            # code...
            $this->session->set_flashdata(
                'error',
                '$(document).ready(function(e) {
                    Swal.fire({
                        icon: "error",
                        type: "error",
                        title: "Oops...",
                        text: "No. Invoice sudah digunakan!"
                    })
                })'
            );

            redirect('pembelian/transaksi_cash', 'refresh');
        } else {
            # code...

            $user =  $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $group_id = $this->db->get_where('users_groups', ['user_id' => $user->id])->row();
            $get_pembelian = $this->db->get('tb_pembelian')->num_rows();
            $jmlPembelian = $get_pembelian + 1;

            $data = [
                'pembelian_input' => $this->input->post('pembelian_input'),
                'pembelian_parent' => date("Ymd") . $jmlPembelian,
                'pembelian_user' => base64_decode($this->input->post('pembelian_user')),
                'pembelian_delete' => date("Ymd") . rand(0, 10000),
                'pembelian_cabang' => $group_id->group_id,
            ];

            $this->db->insert('tb_pembelian_session', $data);
            redirect('pembelian/transaksi_cash', 'refresh');
        }
    }


    public function edit_no_invoice()
    {
        $pembelian_id = base64_decode($this->input->post('pembelian_id'));

        $this->form_validation->set_rules('pembelian_input', 'No. invoice', 'trim|required|is_unique[tb_pembelian.invoice_pembelian]');

        if ($this->form_validation->run() == FALSE) {
            # code...
            $this->session->set_flashdata(
                'error',
                '$(document).ready(function(e) {
                    Swal.fire({
                        icon: "error",
                        type: "error",
                        title: "Oops...",
                        text: "No. Invoice sudah digunakan!"
                    })
                })'
            );

            redirect('pembelian/transaksi_cash', 'refresh');
        } else {

            $data = [
                'pembelian_input' => $this->input->post('pembelian_input')
            ];

            $this->db->where('pembelian_id', $pembelian_id);
            $this->db->update('tb_pembelian_session', $data);
            redirect('pembelian/transaksi_cash', 'refresh');
        }
    }

    public function edit_harga_beli()
    {
        $keranjang_id = base64_decode($this->input->post('keranjang_id'));

        $data = [
            'keranjang_harga' => $this->input->post('keranjang_harga')
        ];

        $this->db->where('keranjang_id', $keranjang_id);
        $this->db->update('tb_pembelian_keranjang', $data);
        redirect('pembelian/transaksi_cash', 'refresh');
    }

    public function edit_qty()
    {
        $keranjang_id = base64_decode($this->input->post('keranjang_id'));

        $data = [
            'keranjang_qty' => $this->input->post('keranjang_qty')
        ];

        $this->db->where('keranjang_id', $keranjang_id);
        $this->db->update('tb_pembelian_keranjang', $data);
        redirect('pembelian/transaksi_cash', 'refresh');
    }

    public function input_idbarang()
    {
        $id_barang = $this->input->post('id_barang');
        $data_barang = $this->db->get_where('tb_barang', ['id_barang' => $id_barang])->row();
        $keranjang = $this->db->get_where('tb_pembelian_keranjang', ['barang_id' => $id_barang])->row();

        $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $group_id = $this->db->get_where('users_groups', ['user_id' => $user->id])->row();
        $get_pembelian = $this->db->get('tb_pembelian')->num_rows();
        $jml_pembelian = $get_pembelian + 1;

        if ($keranjang->barang_id == $id_barang) {
            $update_barang = [
                'barang_stok' => $data_barang->barang_stok + 1
            ];

            $this->db->where('id_barang', $id_barang);
            $this->db->update('tb_barang', $update_barang);

            $update_keranjang = [
                'keranjang_qty' => $keranjang->keranjang_qty + 1,
            ];
            $this->db->where('barang_id', $keranjang->barang_id);
            $this->db->update('tb_pembelian_keranjang', $update_keranjang);
        } else {
            $data = [
                'keranjang_nama' => $data_barang->barang_nama,
                'keranjang_harga' => 0,
                'barang_id' => $id_barang,
                'keranjang_qty' => 1,
                'keranjang_id_kasir' => $group_id->group_id,
                'keranjang_id_cek' => $id_barang . $user->id . $jml_pembelian,
                'keranjang_cabang' => $group_id->group_id
            ];
            $this->db->insert('tb_pembelian_keranjang', $data);

            $update_barang = [
                'barang_stok' => $data_barang->barang_stok + 1
            ];

            $this->db->where('id_barang', $id_barang);
            $this->db->update('tb_barang', $update_barang);
        }
    }

    public function input_idbarang_dua()
    {
        $id_barang = $this->input->post('idbarang');
        $data_barang = $this->db->get_where('tb_barang', ['id_barang' => $id_barang])->row();
        $keranjang = $this->db->get_where('tb_pembelian_keranjang', ['barang_id' => $id_barang])->row();

        $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $group_id = $this->db->get_where('users_groups', ['user_id' => $user->id])->row();

        $get_pembelian = $this->db->get('tb_pembelian')->num_rows();
        $jml_pembelian = $get_pembelian + 1;

        if ($keranjang->barang_id == $id_barang) {
            $update_barang = [
                'barang_stok' => $data_barang->barang_stok + 1
            ];

            $this->db->where('id_barang', $id_barang);
            $this->db->update('tb_barang', $update_barang);

            $update_keranjang = [
                'keranjang_qty' => $keranjang->keranjang_qty + 1,
            ];
            $this->db->where('barang_id', $keranjang->barang_id);
            $this->db->update('tb_pembelian_keranjang', $update_keranjang);
        } else {
            $data = [
                'keranjang_nama' => $data_barang->barang_nama,
                'keranjang_harga' => 0,
                'barang_id' => $id_barang,
                'keranjang_qty' => 1,
                'keranjang_id_kasir' => $group_id->group_id,
                'keranjang_id_cek' => $id_barang . $user->id . $jml_pembelian,
                'keranjang_cabang' => $group_id->group_id
            ];
            $this->db->insert('tb_pembelian_keranjang', $data);

            $update_barang = [
                'barang_stok' => $data_barang->barang_stok + 1
            ];

            $this->db->where('id_barang', $id_barang);
            $this->db->update('tb_barang', $update_barang);
        }
    }

    public function kirim_all_pembelian()
    {
        $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $group = $this->db->get_where('users_groups', ['user_id' => $user->id])->row();

        $get_pembelian = $this->db->get('tb_pembelian')->num_rows();
        $jml_pembelian = $get_pembelian + 1;
        $tglsekarang = date("Ymd");
        $pembeliansekarang = $tglsekarang . $jml_pembelian;

        $barang_id = $_POST['barang_id'];
        $barang_qty = $_POST['keranjang_qty'];
        $keranjang_id_kasir = $_POST['keranjang_id_kasir'];
        $pembelian_invoice = $_POST['pembelian_invoice'];
        $barang_harga_beli = $_POST['barang_harga_beli'];

        $get_data = array();
        $index = 0;

        foreach ($barang_harga_beli as $databarang) {
            array_push($get_data, array(
                'pembelian_barang_id' => $barang_id[$index],
                'barang_id' => $barang_id[$index],
                'barang_qty' => $barang_qty[$index],
                'keranjang_id_kasir' => $keranjang_id_kasir[$index],
                'pembelian_invoice' => $pembelian_invoice[$index],
                'pembelian_invoice_parent' => $pembeliansekarang,
                'pembelian_date' => date_indo('Y-m-d'),
                'barang_qty_lama' => $barang_qty[$index],
                'barang_qty_lama_parent' => $barang_qty[$index],
                'barang_harga_beli' => $databarang
            ));
            $index++;
        }
        $this->db->insert_batch('tb_pembelian_detail', $get_data);

        $kode_barang = $this->input->post('pembelian_invoice_get');
        $data = [
            'invoice_suplier_id' => $this->input->post('invoice_suplier_id'),
            'invoice_pembelian' => $kode_barang,
            'invoice_parent' => $pembeliansekarang,
            'invoice_total' => $this->input->post('total'),
            'invoice_bayar' => $this->input->post('bayar'),
            'invoice_kembali' => $this->input->post('total') - $this->input->post('bayar'),
            'invoice_kasir' => $group->group_id,
            'invoice_tgl' => date_indo('Y-m-d'),
            'invoice_created' => date_indo('Y-m-d'),
            'invoice_total_lama' => $this->input->post('total'),
            'invoice_bayar_lama' => $this->input->post('bayar'),
            'invoice_kembali_lama' => $this->input->post('total') - $this->input->post('bayar'),
            'invoice_hutang' => 0,
            'invoice_hutang_dp' => 0,
            'invoice_hutang_lunas' => 0,
            'invoice_pembelian_cabang' => $group->group_id,
        ];

        $this->db->insert('tb_pembelian', $data);

        $this->hapus_session_id($user->id);
        $this->hapus_keranjang_id($user->id);
        $detail = $this->db->get_where('tb_pembelian_detail', ['pembelian_invoice' => $kode_barang])->row();
        $this->session->set_flashdata(
            'success',
            '$(document).ready(function(e) {
                    Swal.fire({
                    type: "success",
                    title: "Sukses",
                    text: "Transaksi pembelian berhasil disimpan!"
                })
            })'
        );
        redirect('pembelian/invoice/detail/' . base64_encode($detail->pembelian_invoice_parent));
    }

    public function hapus_keranjang_barang($id)
    {
        $getId =  base64_decode($id);
        $keranjang = $this->db->get_where('tb_pembelian_keranjang', ['keranjang_id' => $getId])->row();
        $barang = $this->db->get_where('tb_barang', ['id_barang' => $keranjang->barang_id])->row();

        $data = [
            'barang_stok' =>  $barang->barang_stok - $keranjang->keranjang_qty,
        ];

        $this->db->where('id_barang', $barang->id_barang);
        $this->db->update('tb_barang', $data);

        $this->db->delete('tb_pembelian_keranjang', ['keranjang_id' => $getId]);
        redirect('pembelian/transaksi_cash');
    }

    private function hapus_session_id($id)
    {
        $this->db->delete('tb_pembelian_session', ['pembelian_user' => $id]);
    }
    private function hapus_keranjang_id($id)
    {
        $this->db->delete('tb_pembelian_keranjang', ['keranjang_id_kasir' => $id]);
    }

    public function update_stok()
    {
        $id_barang = $this->input->post('id_barang');
        $barang = $this->db->get_where('tb_barang', ['id_barang' => $id_barang])->row();
    }
}

/* End of file Transaksi_cash.php */
