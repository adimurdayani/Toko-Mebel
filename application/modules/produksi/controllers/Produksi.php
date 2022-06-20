<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Produksi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('m_produk');
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Produksi";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_produksi'] = $this->db->get('tb_produksi')->result();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('index', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function tambah()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Tambah Produksi";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_barang'] = $this->db->get('tb_barang')->result();
            $data['get_produksi_keranjang'] = $this->m_produk->get_all_produk();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $data['session_jml'] = $this->db->get('tb_produksi_session')->num_rows();
            $data['keranjang_jml'] = $this->db->get('tb_produksi_keranjang')->num_rows();
            $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $array = array('session_kasir_id' => $user->id, 'session_date' => date_indo('Y-m-d'));
            $this->db->where($array);
            $data['get_session_invoice'] = $this->db->get('tb_produksi_session')->row_array();
            $data['get_kategori_produksi'] = $this->db->get('tb_kategori_produk')->result_array();

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('tambah-produksi', $data, FALSE);
        }
    }

    public function input_barang()
    {
        $id_barang = $this->input->post('idbarang');
        $data_barang = $this->db->get_where('tb_barang', ['id_barang' => $id_barang])->row();
        $jml_dta = $this->db->get('tb_produksi_keranjang')->num_rows();
        $jml = $jml_dta + 1;
        $today = date_indo('Ymd');
        $parent = $today . $jml;

        $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $this->_update_barang($data_barang->id_barang);

        $data = [
            'keranjang_invoice_parent' => $parent,
            'keranjang_id_barang' => $id_barang,
            'keranjang_kategori_barang' => $data_barang->barang_kategori_id,
            'keranjang_kode_barang' => $data_barang->barang_kode,
            'keranjang_barang_qty' => 1,
            'keranjang_harga_modal' => $data_barang->barang_harga,
            'keranjang_harga_jual' => $data_barang->barang_harga_beli,
            'keranjang_harga_total' => $data_barang->barang_harga_beli,
            'keranjang_date' => date_indo("Y-m-d"),
            'keranjang_kasir_id' => $user->id,
            'keranjang_panjang' => 0,
            'keranjang_lebar' => 0
        ];
        $this->db->insert('tb_produksi_keranjang', $data);
    }

    public function input_barang_select()
    {
        $id_barang = $this->input->post('id_barang');
        $data_barang = $this->db->get_where('tb_barang', ['id_barang' => $id_barang])->row();
        $jml_dta = $this->db->get('tb_produksi_keranjang')->num_rows();
        $jml = $jml_dta + 1;
        $today = date_indo('Ymd');
        $parent = $today . $jml;
        $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $this->_update_barang($data_barang->id_barang);

        $data = [
            'keranjang_invoice_parent' => $parent,
            'keranjang_id_barang' => $id_barang,
            'keranjang_kategori_barang' => $data_barang->barang_kategori_id,
            'keranjang_kode_barang' => $data_barang->barang_kode,
            'keranjang_barang_qty' => 1,
            'keranjang_harga_modal' => $data_barang->barang_harga,
            'keranjang_harga_jual' => $data_barang->barang_harga_beli,
            'keranjang_harga_total' => $data_barang->barang_harga_beli,
            'keranjang_date' => date_indo("Y-m-d"),
            'keranjang_kasir_id' => $user->id,
            'keranjang_panjang' => 0,
            'keranjang_lebar' => 0
        ];
        $this->db->insert('tb_produksi_keranjang', $data);
    }

    public function edit_keranjang()
    {
        $id_barang = $this->input->post('id_barang');
        $barang = $this->db->get_where('tb_barang', ['id_barang' => $id_barang])->row();
        $getiddetail = $this->db->get_where('tb_barang_detail', ['detail_kode_barang' => $barang->barang_kode])->row();

        if ($getiddetail->detail_panjang > 1 && $getiddetail->detail_lebar > 1) {
            $data = [
                'keranjang_harga_modal' => preg_replace("/[^0-9]/", "", $this->input->post('keranjang_harga_modal')),
                'keranjang_harga_total' =>  preg_replace("/[^0-9]/", "", $this->input->post('keranjang_harga_modal')),
                'keranjang_panjang' => $this->input->post('keranjang_panjang'),
                'keranjang_lebar' => $this->input->post('keranjang_lebar')
            ];
            $this->db->where('keranjang_id_barang', $id_barang);
            $this->db->update('tb_produksi_keranjang', $data);

            $data_barang_detail = [
                'detail_panjang' => $getiddetail->detail_panjang - $this->input->post('keranjang_panjang'),
                'detail_lebar' => $getiddetail->detail_lebar - $this->input->post('keranjang_lebar')
            ];
            $this->db->where('id_detail_barang', $getiddetail->id_detail_barang);
            $this->db->update('tb_barang_detail', $data_barang_detail);
        } else {
            $this->_update_barang($barang->id_barang);
            $this->session->set_flashdata(
                'error',
                '$(document).ready(function(e) {
                    Swal.fire({
                        icon: "error",
                        type: "error",
                        title: "Oops...",
                        text: "Ukuran panjang dan lebar material sedikit, silahkan update ukuran material!"
                    })
                })'
            );

            redirect('produksi/tambah', 'refresh');
        }

        redirect('produksi/tambah', 'refresh');
    }

    private function _update_barang($id)
    {
        $barang = $this->db->get_where('tb_barang', ['id_barang' => $id])->row();
        $data = [
            'barang_stok' => $barang->barang_stok - 1,
            'barang_terjual' => $barang->barang_terjual + 1
        ];
        $this->db->where('id_barang', $barang->id_barang);
        $this->db->update('tb_barang', $data);
    }

    public function hapus_detail_produksi($id)
    {
        $getId =  base64_decode($id);
        $this->db->delete('tb_produksi_keranjang', ['keranjang_id_barang' => $getId]);
        $this->_update_barang_dua($getId);
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
        redirect('produksi/tambah');
    }

    private function _update_barang_dua($id)
    {
        $barang = $this->db->get_where('tb_barang', ['id_barang' => $id])->row();
        $data = [
            'barang_stok' => $barang->barang_stok + 1,
            'barang_terjual' => $barang->barang_terjual - 1
        ];
        $this->db->where('id_barang', $barang->id_barang);
        $this->db->update('tb_barang', $data);
    }

    public function hapus_produksi($id)
    {
        $getId =  base64_decode($id);
        $this->db->delete('tb_produksi', ['id_produksi' => $getId]);
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
        redirect('produksi');
    }

    public function kirim_all_produksi()
    {
        $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $group = $this->db->get_where('users_groups', ['user_id' => $user->id])->row();

        $this->db->delete('tb_produksi_keranjang', ['keranjang_kasir_id' => $user->id]);
        $this->db->delete('tb_produksi_session', ['session_kasir_id' => $user->id]);

        $detail_material_id = $_POST['detail_material_id'];
        $detail_kode_barang = $_POST['detail_kode_barang'];
        $detail_kategori_barang = $_POST['detail_kategori_barang'];
        $detail_harga_modal = $_POST['detail_harga_modal'];
        $detail_harga_jual = $_POST['detail_harga_jual'];
        $detail_harga_total = $_POST['detail_harga_total'];
        $detail_barang_panjang = $_POST['detail_barang_panjang'];
        $detail_barang_lebar = $_POST['detail_barang_lebar'];
        $detail_barang_qty = $_POST['detail_barang_qty'];
        $detail_invoice_produksi = $_POST['detail_invoice_produksi'];

        $get_data = array();
        $index = 0;

        foreach ($detail_harga_modal as $databarang) {
            array_push($get_data, array(
                'detail_invoice_produksi' => $detail_invoice_produksi[$index],
                'detail_material_id' => $detail_material_id[$index],
                'detail_kode_barang' => $detail_kode_barang[$index],
                'detail_kategori_barang' => $detail_kategori_barang[$index],
                'detail_harga_modal' => $databarang,
                'detail_harga_jual' => $detail_harga_jual[$index],
                'detail_harga_total' => $detail_harga_total[$index],
                'detail_tgl' => date_indo('Y-m-d') . ' - ' . date("H:i:s"),
                'created_at' => date_indo('Y-m-d'),
                'updated_at' => date_indo('Y-m-d'),
                'detail_kasir_id' => $user->id,
                'detail_cabang_id' => $group->group_id,
                'detail_barang_panjang' => $detail_barang_panjang[$index],
                'detail_barang_lebar' => $detail_barang_lebar[$index],
                'detail_barang_qty' => $detail_barang_qty[$index]
            ));
            $index++;
        }
        $this->db->insert_batch('tb_produksi_detail', $get_data);

        $data = [
            'produksi_nama' => $this->input->post('produksi_nama'),
            'produksi_kategori' => $this->input->post('produksi_kategori'),
            'produksi_keterangan' => $this->input->post('produksi_keterangan'),
            'produksi_invoice' => $this->input->post('produksi_invoice'),
            'produksi_harga_modal' => preg_replace("/[^0-9]/", "", $this->input->post('produksi_harga_modal')),
            'produksi_harga_jual' => preg_replace("/[^0-9]/", "", $this->input->post('produksi_harga_jual')),
            'produksi_harga_total' => preg_replace("/[^0-9]/", "", $this->input->post('produksi_harga_jual')),
            'produksi_stok' => $this->input->post('produksi_stok'),
            'produksi_status' => "Dalam pesanan",
            'created_at' => date_indo('Y-m-d') . ' - ' . date('H:i:s'),
            'updated_at' => date_indo('Y-m-d'),
            'produksi_kasir' => $user->id,
            'is_active' => 1,
        ];

        $this->db->insert('tb_produksi', $data);
        $detail = $this->db->get_where('tb_produksi', ['produksi_invoice' => $this->input->post('produksi_invoice')])->row();
        $this->session->set_flashdata(
            'success',
            '$(document).ready(function(e) {
                    Swal.fire({
                    type: "success",
                    title: "Sukses",
                    text: "Produksi berhasil disimpan!"
                })
            })'
        );
        redirect('produksi/invoice/detail/' . base64_encode($detail->produksi_invoice));
    }

    public function tambah_nomor_invoice()
    {
        $this->form_validation->set_rules('session_invoice', 'no. invoice produksi', 'trim|required|is_unique[tb_produksi.produksi_invoice]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata(
                'error',
                '$(document).ready(function(e) {
                    Swal.fire({
                        icon: "error",
                        type: "error",
                        title: "Oops...",
                        text: "No. Invoice sudah digunakan. Atau belum terisi!"
                    })
                })'
            );

            redirect('produksi/tambah', 'refresh');
        } else {
            $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data = [
                'session_invoice' => $this->input->post('session_invoice'),
                'session_date' => date_indo('Y-m-d'),
                'session_kasir_id' => $user->id
            ];
            $this->db->insert('tb_produksi_session', $data);
            $this->session->set_flashdata(
                'success',
                '$(document).ready(function(e) {
                        Swal.fire({
                        type: "success",
                        title: "Sukses",
                        text: "No. invoice produksi berhasil disimpan!"
                    })
                })'
            );
            redirect('produksi/tambah', 'refresh');
        }
    }

    public function edit_nomor_invoice()
    {
        $this->form_validation->set_rules('session_invoice', 'no. invoice produksi', 'trim|required|is_unique[tb_produksi_session.session_invoice]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata(
                'error',
                '$(document).ready(function(e) {
                    Swal.fire({
                        icon: "error",
                        type: "error",
                        title: "Oops...",
                        text: "No. Invoice sudah digunakan. Atau belum terisi!"
                    })
                })'
            );

            redirect('produksi/tambah', 'refresh');
        } else {
            $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $id = base64_decode($this->input->post('id_session'));

            $data = [
                'session_invoice' => $this->input->post('session_invoice'),
                'session_date' => date_indo('Y-m-d'),
                'session_kasir_id' => $user->id
            ];
            $this->db->where('id_session', $id);
            $this->db->update('tb_produksi_session', $data);
            $this->session->set_flashdata(
                'success',
                '$(document).ready(function(e) {
                        Swal.fire({
                        type: "success",
                        title: "Sukses",
                        text: "No. invoice produksi berhasil diupdate!"
                    })
                })'
            );
            redirect('produksi/tambah', 'refresh');
        }
    }

    public function editstatusproduksi()
    {

        $idproduksi = $this->input->post('idproduksi');
        $active = $this->input->post('active');

        if ($active > 0) {

            $data = [
                'is_active' => 0
            ];

            $this->db->where('id_produksi ', $idproduksi);
            $this->db->update('tb_produksi', $data);

            $this->session->set_flashdata(
                'success',
                '$(document).ready(function(e) {
                    Swal.fire({
                        type: "success",
                        title: "Sukses",
                        text: "Barang produksi masih dalam pesanan atau inden!"
                    })
                })'
            );
        } else {
            $data = [
                'is_active' => 1
            ];

            $this->db->where('id_produksi ', $idproduksi);
            $this->db->update('tb_produksi', $data);

            $this->session->set_flashdata(
                'success',
                '$(document).ready(function(e) {
                    Swal.fire({
                        type: "success",
                        title: "Sukses",
                        text: "Barang produksi berhasil diterima!"
                    })
                })'
            );
        }
    }

    public function hapus_parent()
    {
        $parent = $this->input->post('parent');
        $this->db->delete('tb_produksi_keranjang', ['keranjang_invoice_parent' => $parent]);
    }
}

/* End of file Produksi.php */
