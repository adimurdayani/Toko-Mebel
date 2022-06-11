<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian extends CI_Controller
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
            $data['title'] = "Invoice Pembelian";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $this->db->order_by('id', 'desc');
            $data['get_pembelian'] = $this->m_pembelian->get_all_pembelian();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();
            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('index', $data, FALSE);
            $this->load->view('template/footer', $data, FALSE);
        }
    }

    public function post()
    {
        $this->form_validation->set_rules('nama', 'nama lengkap', 'trim|required');
        $this->form_validation->set_rules('phone', 'nomor hp', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            # code...
            $this->session->set_flashdata(
                'error',
                '$(document).ready(function(e) {
                    Swal.fire({
                        icon: "error",
                        type: "error",
                        title: "Oops...",
                        text: "Mohon lengkapi penginputan data anda.!"
                    })
                })'
            );

            redirect('pembelian');
        } else {
            # code...
            $data = [
                'nama' => $this->input->post('nama'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'alamat' => $this->input->post('alamat'),
                'status_kostumer' => $this->input->post('status_kostumer'),
                'created_at' => date_indo("Y-m-d"),
                'updated_at' => date_indo("Y-m-d")
            ];

            $this->db->insert('tb_pembelian', $data);
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
            redirect('pembelian');
        }
    }

    public function cetak_nota($kode_barang)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Nota Pembelian";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();

            $data['get_suplier'] = $this->m_pembelian->get_suplier();
            $getKode = base64_decode($kode_barang);
            
            $data['get_pembelian'] = $this->db->get_where('tb_pembelian', ['invoice_parent'=>$getKode])->row_array();

            $data['get_invoice_pembelian'] = $this->m_pembelian->get_all_invoice($getKode);
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->load->view('cetak-nota-pembelian', $data, FALSE);
        }
    }

    public function cetak_nota_hutang($kode_barang)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Nota Hutang";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();

            $data['get_suplier'] = $this->m_pembelian->get_suplier();
            $getKode = base64_decode($kode_barang);
            $data['get_pembelian'] = $this->db->get_where('tb_pembelian', ['invoice_parent'=>$getKode])->row_array();
            $data['get_invoice_pembelian'] = $this->m_pembelian->get_all_invoice($getKode);
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->load->view('cetak-nota-hutang', $data, FALSE);
        }
    }

    public function cetak_nota_lunas($kode_barang)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Nota Lunas";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();

            $data['get_suplier'] = $this->m_pembelian->get_suplier();
            $getKode = base64_decode($kode_barang);
            $data['get_pembelian'] = $this->db->get_where('tb_pembelian', ['invoice_parent'=>$getKode])->row_array();
            $data['get_invoice_pembelian'] = $this->m_pembelian->get_all_invoice($getKode);
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->load->view('cetak-nota-lunas', $data, FALSE);
        }
    }

    public function hapus_all()
    {
        $id = $_POST['invoice_parent'];
        $this->db->where_in('invoice_parent', $id);
        $this->m_pembelian->delete($id);
        $this->m_pembelian->delete_detail($id);
        $this->m_pembelian->delete_hutang($id);
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
        redirect('pembelian');
    }

    public function hapus($id)
    {
        $get_id = base64_decode($id);
        $this->db->delete('tb_pembelian', ['invoice_parent' => $get_id]);
        $this->db->delete('tb_pembelian_detail', ['pembelian_invoice_parent' => $get_id]);
        $this->db->delete('tb_hutang', ['hutang_invoice_parent' => $get_id]);
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
        redirect('pembelian');
    }

}

/* End of file Log_user.php */
