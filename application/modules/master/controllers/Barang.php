<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_data');
        is_logged_in();
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Barang";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();

            $data['get_barang'] = $this->m_data->get_all_barang();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('barang', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function tambah()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Tambah Barang";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();

            $data['get_kategori'] = $this->db->get('tb_kategori')->result();
            $data['get_satuan'] = $this->db->get('tb_satuan')->result();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->form_validation->set_rules('barang_kode', 'kode barang', 'trim|required|is_unique[tb_barang.barang_kode]');
            $this->form_validation->set_rules('barang_nama', 'nama barang', 'trim|required');
            $this->form_validation->set_rules('barang_harga', 'harga jual', 'trim|required');
            $this->form_validation->set_rules('barang_kategori_id', 'harga jual', 'trim|required');
            $this->form_validation->set_rules('barang_satuan_id', 'harga jual', 'trim|required');
            $no = $this->db->get('tb_barang')->num_rows();

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header', $data, FALSE);
                $this->load->view('template/topbar', $data, FALSE);
                $this->load->view('template/sidebar', $data, FALSE);
                $this->load->view('tambah-barang', $data, FALSE);
                $this->load->view('template/footer', $data, FALSE);
                # code...
            } else {
                # code...
                $data = [
                    'barang_kode' => $this->input->post('barang_kode'),
                    'barang_kode_slug' => $this->input->post('barang_kode'),
                    'barang_kode_count' => $no + 1,
                    'barang_nama' => $this->input->post('barang_nama'),
                    'barang_harga_beli' => 0,
                    'barang_harga' => $this->input->post('barang_harga'),
                    'barang_tanggal' => date_indo("Y-m-d"),
                    'barang_stok' => $this->input->post('barang_stok'),
                    'barang_kategori_id' => $this->input->post('barang_kategori_id'),
                    'barang_satuan_id' => $this->input->post('barang_satuan_id'),
                    'barang_deskripsi' => $this->input->post('barang_deskripsi'),
                    'barang_terjual' => 0
                ];

                $this->db->insert('tb_barang', $data);
                $this->session->set_flashdata(
                    'success',
                    '$(document).ready(function(e) {
                    Swal.fire({
                        type: "success",
                        title: "Sukses",
                        text: "Data berhasil disimpan!"
                    })
                })'
                );
                redirect('master/barang');
            }
        }
    }

    public function edit($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Edit Barang";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();

            $data['get_kategori'] = $this->db->get('tb_kategori')->result();
            $data['get_satuan'] = $this->db->get('tb_satuan')->result();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $getId =  base64_decode($id);
            $data['get_barang'] = $this->db->get_where('tb_barang', ['id_barang' => $getId])->row();

            $this->form_validation->set_rules('barang_nama', 'nama barang', 'trim|required');
            $this->form_validation->set_rules('barang_harga', 'harga jual', 'trim|required');
            $this->form_validation->set_rules('barang_kategori_id', 'kategori barang', 'trim|required');
            $this->form_validation->set_rules('barang_satuan_id', 'satuan kategori', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header', $data, FALSE);
                $this->load->view('template/topbar', $data, FALSE);
                $this->load->view('template/sidebar', $data, FALSE);
                $this->load->view('edit-barang', $data, FALSE);
                $this->load->view('template/footer', $data, FALSE);
                # code...
            } else {
                # code...
                $id =  base64_decode($this->input->post('id_barang'));
                $data = [
                    'barang_nama' => $this->input->post('barang_nama'),
                    'barang_harga' => $this->input->post('barang_harga'),
                    'barang_kategori_id' => $this->input->post('barang_kategori_id'),
                    'barang_stok' => $this->input->post('barang_stok'),
                    'barang_tanggal' => date_indo("Y-m-d"),
                    'barang_satuan_id' => $this->input->post('barang_satuan_id'),
                    'barang_deskripsi' => $this->input->post('barang_deskripsi')
                ];

                $this->db->where('id_barang', $id);
                $this->db->update('tb_barang', $data);
                $this->session->set_flashdata(
                    'success',
                    '$(document).ready(function(e) {
                    Swal.fire({
                        type: "success",
                        title: "Sukses",
                        text: "Data berhasil disimpan!"
                    })
                })'
                );
                redirect('master/barang');
            }
        }
    }

    public function hapus($id)
    {
        $getId = base64_decode($id);
        $this->db->delete('tb_barang', ['id_barang' => $getId]);
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
        redirect('master/barang');
    }

    public function hapus_all()
    {
        $id = $_POST['id_barang'];
        $this->m_data->delete_barang($id);
        $this->session->set_flashdata(
            'success',
            '$(document).ready(function(e) {
                Swal.fire({
                    type: "success",
                    title: "Sukses",
                    text: "Semua data berhasil dihapus!"
                })
            })'
        );
        redirect('master/barang');
    }


    private function generate_code($panjang_angka)
    {
        $code = '1234567890QWERTYUIOPASDFGHJKLZXCVBNM' . time();
        $string = '';
        for ($i = 0; $i < $panjang_angka; $i++) {
            $pos = rand(0, strlen($code) - 1);
            $string .= $code[$pos];
        }
        return 'KB-' . date('Y') . '/' . date('m') . '/' . $string;
    }
}
