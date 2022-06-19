<?php

defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Eksport_pembelian extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('m_laporan');
    }

    public function laporan_pembelian_periode_excel($suplier_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
            $style_head = [
                'font' => [
                    'bold' => true,
                    'size' => 25
                ], // Set font nya jadi bold
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
                ]
            ];

            $style_col = [
                'font' => ['bold' => true], // Set font nya jadi bold
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
                ],
                'borders' => [
                    'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                    'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                    'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                    'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
                ]
            ];

            $style_money = [
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
                ],
                'borders' => [
                    'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                    'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                    'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                    'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
                ],
                'numberFormat' => [
                    'formatCode' => \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1
                ]

            ];
            // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
            $style_row = [
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
                ],
                'borders' => [
                    'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                    'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                    'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                    'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
                ]
            ];

            $style_total = [
                'font' => [
                    'bold' => true
                ],
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
                ],
                'borders' => [
                    'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                    'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                    'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                    'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
                ]
            ];

            $style_money_total = [
                'font' => [
                    'bold' => true
                ],
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
                ],
                'borders' => [
                    'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                    'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                    'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                    'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
                ],
                'numberFormat' => [
                    'formatCode' => \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1
                ]

            ];

            $sheet->setCellValue('A1', "DATA LAPORAN pembelian PERPERIODE");
            $sheet->mergeCells('A1:E1');
            $sheet->getStyle('A1')->applyFromArray($style_head);
            // Buat header tabel nya pada baris ke 3
            $sheet->setCellValue('A3', "NO");
            $sheet->setCellValue('B3', "INVOICE");
            $sheet->setCellValue('C3', "TANGGAL");
            $sheet->setCellValue('D3', "KOSTUMER");
            $sheet->setCellValue('E3', "TOTAL");
            // Apply style header yang telah kita buat tadi ke masing-masing kolom header
            $sheet->getStyle('A3')->applyFromArray($style_col);
            $sheet->getStyle('B3')->applyFromArray($style_col);
            $sheet->getStyle('C3')->applyFromArray($style_col);
            $sheet->getStyle('D3')->applyFromArray($style_col);
            $sheet->getStyle('E3')->applyFromArray($style_col);

            $this->db->where('invoice_suplier_id', base64_decode($suplier_id));
            $pembelian =  $this->db->get('tb_pembelian')->result();
            $total = $this->m_laporan->get_all_laporansuplier(base64_decode($suplier_id));
            $no = 1;
            $numrow = 4;
            foreach ($pembelian as $data) {
                $user = $this->db->get_where('tb_suplier', ['id_suplier' => $data->invoice_suplier_id])->row();
                $sheet->setCellValue('A' . $numrow, $no);
                $sheet->setCellValue('B' . $numrow, $data->invoice_pembelian);
                $sheet->setCellValue('C' . $numrow, $data->invoice_tgl);
                $sheet->setCellValue('D' . $numrow, $user->nama_perusahaan);
                $sheet->setCellValue('E' . $numrow, $data->invoice_total);


                $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('E' . $numrow)->applyFromArray($style_money);

                $no++;
                $numrow++;
            }

            $sheet->setCellValue('D' . $numrow, 'TOTAL');
            $sheet->setCellValue('E' . $numrow, $total->invoice_total);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_total);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_money_total);

            // Set width kolom
            $sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
            $sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
            $sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C
            $sheet->getColumnDimension('D')->setWidth(20); // Set width kolom D
            $sheet->getColumnDimension('E')->setWidth(30); // Set width kolom E

            // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
            $sheet->getDefaultRowDimension()->setRowHeight(-1);
            // Set orientasi kertas jadi LANDSCAPE
            $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
            // Set judul file excel nya
            $sheet->setTitle("Laporan Penjualan Perperiode");
            // Proses file excel
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="laporan-penjualan-periode.xlsx"'); // Set nama file excel nya
            header('Cache-Control: max-age=0');
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }
    }

    public function laporan_pembelian_periode_pdf($suplier_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Laporan Pembelian Barang PDF";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->db->where('invoice_suplier_id', base64_decode($suplier_id));
            $data['pembelian_transaksi'] =  $this->db->get('tb_pembelian')->result();

            $data['pembelian_transaksi_date'] =  $this->db->get('tb_pembelian')->row_array();
            $data['total'] = $this->m_laporan->get_all_laporansuplier(base64_decode($suplier_id));
            $this->load->view('cetak-laporan-pembelian-periode', $data, FALSE);
        }
    }

    public function laporan_pembelian_material_excel($barang_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
            $style_head = [
                'font' => [
                    'bold' => true,
                    'size' => 25
                ], // Set font nya jadi bold
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
                ]
            ];

            $style_col = [
                'font' => ['bold' => true], // Set font nya jadi bold
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
                ],
                'borders' => [
                    'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                    'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                    'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                    'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
                ]
            ];

            // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
            $style_row = [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
                ],
                'borders' => [
                    'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                    'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                    'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                    'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
                ]
            ];

            $style_total = [
                'font' => [
                    'bold' => true
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
                ],
                'borders' => [
                    'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                    'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                    'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                    'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
                ]
            ];

            $sheet->setCellValue('A1', "DATA LAPORAN PERMATERIAL");
            $sheet->mergeCells('A1:E1');
            $sheet->getStyle('A1')->applyFromArray($style_head);
            // Buat header tabel nya pada baris ke 3
            $sheet->setCellValue('A3', "NO");
            $sheet->setCellValue('B3', "INVOICE");
            $sheet->setCellValue('C3', "TANGGAL");
            $sheet->setCellValue('D3', "MATERIAL");
            $sheet->setCellValue('E3', "QTY PEMBELIAN");
            // Apply style header yang telah kita buat tadi ke masing-masing kolom header
            $sheet->getStyle('A3')->applyFromArray($style_col);
            $sheet->getStyle('B3')->applyFromArray($style_col);
            $sheet->getStyle('C3')->applyFromArray($style_col);
            $sheet->getStyle('D3')->applyFromArray($style_col);
            $sheet->getStyle('E3')->applyFromArray($style_col);

            $this->db->where('barang_id', base64_decode($barang_id));
            $penjualan_material =  $this->db->get('tb_pembelian_detail')->result();
            $total = $this->m_laporan->get_laporan_pembelian_material(base64_decode($barang_id));
            $no = 1;
            $numrow = 4;
            foreach ($penjualan_material as $data) {
                $barang = $this->db->get_where('tb_barang', ['id_barang' => $data->barang_id])->row();
                $sheet->setCellValue('A' . $numrow, $no);
                $sheet->setCellValue('B' . $numrow, $data->pembelian_invoice);
                $sheet->setCellValue('C' . $numrow, $data->pembelian_date);
                $sheet->setCellValue('D' . $numrow, $barang->barang_nama);
                $sheet->setCellValue('E' . $numrow, $data->barang_qty);


                $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);

                $no++;
                $numrow++;
            }

            $sheet->setCellValue('D' . $numrow, 'TOTAL');
            $sheet->setCellValue('E' . $numrow, $total->barang_qty);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_total);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_total);

            // Set width kolom
            $sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
            $sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
            $sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C
            $sheet->getColumnDimension('D')->setWidth(30); // Set width kolom D
            $sheet->getColumnDimension('E')->setWidth(20); // Set width kolom E

            // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
            $sheet->getDefaultRowDimension()->setRowHeight(-1);
            // Set orientasi kertas jadi LANDSCAPE
            $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
            // Set judul file excel nya
            $sheet->setTitle("Laporan Material");
            // Proses file excel
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="laporan-material.xlsx"'); // Set nama file excel nya
            header('Cache-Control: max-age=0');
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }
    }

    public function laporan_pembelian_material_pdf($barang_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Laporan Pembelian Material PDF";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->db->where('barang_id', base64_decode($barang_id));
            $data['pembelian_detail'] =  $this->db->get('tb_pembelian_detail')->result();
            $data['total'] = $this->m_laporan->get_laporan_pembelian_material(base64_decode($barang_id));

            $data['pembelian_detail_date'] =  $this->db->get('tb_pembelian_detail')->row_array();
            $this->load->view('cetak-laporan-pembelian-material', $data, FALSE);
        }
    }

    public function laporan_pembelian_csv()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $spreadsheet->getProperties()->setCreator('My Notes Code')
                ->setLastModifiedBy('My Notes Code')
                ->setTitle("Data Laporan Pembelian")
                ->setSubject("penjualan")
                ->setDescription("Laporan Semua Data pembelian")
                ->setKeywords("Data Pembelian");
            // Buat header tabel nya pada baris ke 3
            $sheet->setCellValue('A1', "id");
            $sheet->setCellValue('B1', "invoice_suplier_id");
            $sheet->setCellValue('C1', "invoice_pembelian");
            $sheet->setCellValue('D1', "invoice_parent");
            $sheet->setCellValue('E1', "invoice_total");
            $sheet->setCellValue('F1', "invoice_bayar");
            $sheet->setCellValue('G1', "invoice_kembali");
            $sheet->setCellValue('H1', "invoice_kasir");
            $sheet->setCellValue('I1', "invoice_tgl");
            $sheet->setCellValue('J1', "invoice_created");
            $sheet->setCellValue('K1', "invoice_updated");
            $sheet->setCellValue('L1', "invoice_kasir_edit");
            $sheet->setCellValue('M1', "invoice_total_lama");
            $sheet->setCellValue('N1', "invoice_bayar_lama");
            $sheet->setCellValue('O1', "invoice_kembali_lama");
            $sheet->setCellValue('P1', "invoice_hutang");
            $sheet->setCellValue('Q1', "invoice_hutang_dp");
            $sheet->setCellValue('R1', "invoice_hutang_jatuh_tempo");
            $sheet->setCellValue('S1', "invoice_hutang_lunas");
            $sheet->setCellValue('T1', "invoice_pembelian_cabang");

            $penualan =  $this->db->get('tb_pembelian')->result();
            $no = 1;
            $numrow = 2;
            foreach ($penualan as $data) {
                $sheet->setCellValue('A' . $numrow, $no);
                $sheet->setCellValue('B' . $numrow, $data->invoice_suplier_id);
                $sheet->setCellValue('C' . $numrow, $data->invoice_pembelian);
                $sheet->setCellValue('D' . $numrow, $data->invoice_parent);
                $sheet->setCellValue('E' . $numrow, $data->invoice_total);
                $sheet->setCellValue('F' . $numrow, $data->invoice_bayar);
                $sheet->setCellValue('G' . $numrow, $data->invoice_kembali);
                $sheet->setCellValue('H' . $numrow, $data->invoice_kasir);
                $sheet->setCellValue('I' . $numrow, $data->invoice_tgl);
                $sheet->setCellValue('J' . $numrow, $data->invoice_created);
                $sheet->setCellValue('K' . $numrow, $data->invoice_updated);
                $sheet->setCellValue('L' . $numrow, $data->invoice_kasir_edit);
                $sheet->setCellValue('M' . $numrow, $data->invoice_total_lama);
                $sheet->setCellValue('N' . $numrow, $data->invoice_bayar_lama);
                $sheet->setCellValue('O' . $numrow, $data->invoice_kembali_lama);
                $sheet->setCellValue('P' . $numrow, $data->invoice_hutang);
                $sheet->setCellValue('Q' . $numrow, $data->invoice_hutang_dp);
                $sheet->setCellValue('R' . $numrow, $data->invoice_hutang_jatuh_tempo);
                $sheet->setCellValue('S' . $numrow, $data->invoice_hutang_lunas);
                $sheet->setCellValue('T' . $numrow, $data->invoice_pembelian_cabang);

                $no++;
                $numrow++;
            }

            // Set width kolom
            $sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
            $sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
            $sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C
            $sheet->getColumnDimension('D')->setWidth(20); // Set width kolom D
            $sheet->getColumnDimension('E')->setWidth(30); // Set width kolom E

            // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
            $sheet->getDefaultRowDimension()->setRowHeight(-1);
            // Set orientasi kertas jadi LANDSCAPE
            $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
            // Set judul file excel nya
            $sheet->setTitle("Laporan Pembelian");
            // Proses file excel
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="laporan-pembelian.csv"'); // Set nama file excel nya
            header('Cache-Control: max-age=0');
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
            $writer->setDelimiter(';');
            $writer->setEnclosure('"');
            $writer->setLineEnding("\r\n");
            $writer->setSheetIndex(0);
            $writer->save('php://output');
        }
    }

    public function laporan_pembelian_material_csv()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $spreadsheet->getProperties()->setCreator('My Notes Code')
                ->setLastModifiedBy('My Notes Code')
                ->setTitle("Data Laporan Pembelian Material")
                ->setSubject("penjualan")
                ->setDescription("Laporan Semua Data pembelian Material")
                ->setKeywords("Data Pembelian Material");
            // Buat header tabel nya pada baris ke 3
            $sheet->setCellValue('A1', "id");
            $sheet->setCellValue('B1', "pembelian_barang_id");
            $sheet->setCellValue('C1', "barang_id");
            $sheet->setCellValue('D1', "barang_qty");
            $sheet->setCellValue('E1', "keranjang_id_kasir");
            $sheet->setCellValue('F1', "pembelian_invoice");
            $sheet->setCellValue('G1', "pembelian_invoice_parent");
            $sheet->setCellValue('H1', "pembelian_date");
            $sheet->setCellValue('I1', "barang_qty_lama");
            $sheet->setCellValue('J1', "barang_qty_lama_parent");
            $sheet->setCellValue('K1', "barang_harga_beli");
            $sheet->setCellValue('L1', "pembelian_cabang_id");

            $penualan =  $this->db->get('tb_pembelian_detail')->result();
            $no = 1;
            $numrow = 2;
            foreach ($penualan as $data) {
                $sheet->setCellValue('A' . $numrow, $no);
                $sheet->setCellValue('B' . $numrow, $data->pembelian_barang_id);
                $sheet->setCellValue('C' . $numrow, $data->barang_id);
                $sheet->setCellValue('D' . $numrow, $data->barang_qty);
                $sheet->setCellValue('E' . $numrow, $data->keranjang_id_kasir);
                $sheet->setCellValue('F' . $numrow, $data->pembelian_invoice);
                $sheet->setCellValue('G' . $numrow, $data->pembelian_invoice_parent);
                $sheet->setCellValue('H' . $numrow, $data->pembelian_date);
                $sheet->setCellValue('I' . $numrow, $data->barang_qty_lama);
                $sheet->setCellValue('J' . $numrow, $data->barang_qty_lama_parent);
                $sheet->setCellValue('K' . $numrow, $data->barang_harga_beli);
                $sheet->setCellValue('L' . $numrow, $data->pembelian_cabang_id);

                $no++;
                $numrow++;
            }

            // Set width kolom
            $sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
            $sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
            $sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C
            $sheet->getColumnDimension('D')->setWidth(20); // Set width kolom D
            $sheet->getColumnDimension('E')->setWidth(30); // Set width kolom E

            // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
            $sheet->getDefaultRowDimension()->setRowHeight(-1);
            // Set orientasi kertas jadi LANDSCAPE
            $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
            // Set judul file excel nya
            $sheet->setTitle("Laporan Pembelian Material");
            // Proses file excel
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="laporan-pembelian-material.csv"'); // Set nama file excel nya
            header('Cache-Control: max-age=0');
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
            $writer->setDelimiter(';');
            $writer->setEnclosure('"');
            $writer->setLineEnding("\r\n");
            $writer->setSheetIndex(0);
            $writer->save('php://output');
        }
    }
}

/* End of file Eksport_penjualan.php */
