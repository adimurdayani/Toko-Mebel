<?php

defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Eksport extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('m_laporan');
    }

    public function laporan_kasir_excel($invoice_kasir)
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
            $sheet->setCellValue('A1', "DATA LAPORAN"); // Set kolom A1 dengan tulisan "DATA SISWA"
            $sheet->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
            $sheet->getStyle('A1')->applyFromArray($style_head); // Set bold kolom A1
            // Buat header tabel nya pada baris ke 3
            $sheet->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
            $sheet->setCellValue('B3', "INVOICE"); // Set kolom B3 dengan tulisan "NIS"
            $sheet->setCellValue('C3', "TANGGAL"); // Set kolom C3 dengan tulisan "NAMA"
            $sheet->setCellValue('D3', "KASIR"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
            $sheet->setCellValue('E3', "TOTAL"); // Set kolom E3 dengan tulisan "ALAMAT"
            // Apply style header yang telah kita buat tadi ke masing-masing kolom header
            $sheet->getStyle('A3')->applyFromArray($style_col);
            $sheet->getStyle('B3')->applyFromArray($style_col);
            $sheet->getStyle('C3')->applyFromArray($style_col);
            $sheet->getStyle('D3')->applyFromArray($style_col);
            $sheet->getStyle('E3')->applyFromArray($style_col);

            $this->db->where('invoice_kasir', base64_decode($invoice_kasir));
            $penualan_kasir =  $this->db->get('tb_penjualan')->result();
            $total = $this->m_laporan->get_all_laporankasir(base64_decode($invoice_kasir));
            $no = 1;
            $numrow = 4;
            foreach ($penualan_kasir as $data) {
                $user = $this->db->get_where('users', ['id' => $data->invoice_kasir])->row();
                $sheet->setCellValue('A' . $numrow, $no);
                $sheet->setCellValue('B' . $numrow, $data->penjualan_invoice);
                $sheet->setCellValue('C' . $numrow, $data->invoice_tgl);
                $sheet->setCellValue('D' . $numrow, $user->first_name);
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
            $sheet->setTitle("Laporan Kasir");
            // Proses file excel
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="laporan-kasir.xlsx"'); // Set nama file excel nya
            header('Cache-Control: max-age=0');
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }
    }

    public function laporan_csv()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $spreadsheet->getProperties()->setCreator('My Notes Code')
                ->setLastModifiedBy('My Notes Code')
                ->setTitle("Data Laporan Penjualan")
                ->setSubject("penjualan")
                ->setDescription("Laporan Semua Data penjualan")
                ->setKeywords("Data penjualan");
            // Buat header tabel nya pada baris ke 3
            $sheet->setCellValue('A1', "invoice_id");
            $sheet->setCellValue('B1', "penjualan_invoice");
            $sheet->setCellValue('C1', "penjualan_invoice_count");
            $sheet->setCellValue('D1', "invoice_tgl");
            $sheet->setCellValue('E1', "invoice_costumer");
            $sheet->setCellValue('F1', "invoice_kurir");
            $sheet->setCellValue('G1', "invoice_status_kurir");
            $sheet->setCellValue('H1', "invoice_tipe_transaksi");
            $sheet->setCellValue('I1', "invoice_total_beli");
            $sheet->setCellValue('J1', "invoice_total");
            $sheet->setCellValue('K1', "invoice_ongkir");
            $sheet->setCellValue('L1', "invoice_sub_total");
            $sheet->setCellValue('M1', "invoice_bayar");
            $sheet->setCellValue('N1', "invoice_kembali");
            $sheet->setCellValue('O1', "invoice_kasir");
            $sheet->setCellValue('P1', "invoice_date");
            $sheet->setCellValue('Q1', "invoice_date_edit");
            $sheet->setCellValue('R1', "invoice_kasir_edit");
            $sheet->setCellValue('S1', "invoice_total_beli_lama");
            $sheet->setCellValue('T1', "invoice_total_lama");
            $sheet->setCellValue('U1', "invoice_ongkir_lama");
            $sheet->setCellValue('V1', "invoice_sub_total_lama");
            $sheet->setCellValue('W1', "invoice_bayar_lama");
            $sheet->setCellValue('X1', "invoice_kembali_lama");
            $sheet->setCellValue('Y1', "invoice_marketplace");
            $sheet->setCellValue('Z1', "invoice_ekspedisi");
            $sheet->setCellValue('AA1', "invoice_no_resi");
            $sheet->setCellValue('AB1', "invoice_date_selesai_kurir");
            $sheet->setCellValue('AC1', "invoice_piutang");
            $sheet->setCellValue('AD1', "invoice_piutang_dp");
            $sheet->setCellValue('AE1', "invoice_piutang_jatuh_tempo");
            $sheet->setCellValue('AF1', "invoice_piutang_lunas");
            $sheet->setCellValue('AG1', "invoice_cabang");

            $penualan_kasir =  $this->db->get('tb_penjualan')->result();
            $no = 1;
            $numrow = 2;
            foreach ($penualan_kasir as $data) {
                $sheet->setCellValue('A' . $numrow, $no);
                $sheet->setCellValue('B' . $numrow, $data->penjualan_invoice);
                $sheet->setCellValue('C' . $numrow, $data->penjualan_invoice_count);
                $sheet->setCellValue('D' . $numrow, $data->invoice_tgl);
                $sheet->setCellValue('E' . $numrow, $data->invoice_costumer);
                $sheet->setCellValue('F' . $numrow, $data->invoice_kurir);
                $sheet->setCellValue('G' . $numrow, $data->invoice_status_kurir);
                $sheet->setCellValue('H' . $numrow, $data->invoice_tipe_transaksi);
                $sheet->setCellValue('I' . $numrow, $data->invoice_total_beli);
                $sheet->setCellValue('J' . $numrow, $data->invoice_total);
                $sheet->setCellValue('K' . $numrow, $data->invoice_ongkir);
                $sheet->setCellValue('L' . $numrow, $data->invoice_sub_total);
                $sheet->setCellValue('M' . $numrow, $data->invoice_bayar);
                $sheet->setCellValue('N' . $numrow, $data->invoice_kembali);
                $sheet->setCellValue('O' . $numrow, $data->invoice_kasir);
                $sheet->setCellValue('P' . $numrow, $data->invoice_date);
                $sheet->setCellValue('Q' . $numrow, $data->invoice_date_edit);
                $sheet->setCellValue('R' . $numrow, $data->invoice_kasir_edit);
                $sheet->setCellValue('S' . $numrow, $data->invoice_total_beli_lama);
                $sheet->setCellValue('T' . $numrow, $data->invoice_total_lama);
                $sheet->setCellValue('U' . $numrow, $data->invoice_ongkir_lama);
                $sheet->setCellValue('V' . $numrow, $data->invoice_sub_total_lama);
                $sheet->setCellValue('W' . $numrow, $data->invoice_bayar_lama);
                $sheet->setCellValue('X' . $numrow, $data->invoice_kembali_lama);
                $sheet->setCellValue('Y' . $numrow, $data->invoice_marketplace);
                $sheet->setCellValue('Z' . $numrow, $data->invoice_ekspedisi);
                $sheet->setCellValue('AA' . $numrow, $data->invoice_date_selesai_kurir);
                $sheet->setCellValue('AB' . $numrow, $data->invoice_no_resi);
                $sheet->setCellValue('AC' . $numrow, $data->invoice_piutang);
                $sheet->setCellValue('AD' . $numrow, $data->invoice_piutang_dp);
                $sheet->setCellValue('AE' . $numrow, $data->invoice_piutang_jatuh_tempo);
                $sheet->setCellValue('AF' . $numrow, $data->invoice_piutang_lunas);
                $sheet->setCellValue('AG' . $numrow, $data->invoice_cabang);

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
            $sheet->setTitle("Laporan Kasir");
            // Proses file excel
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="laporan-penjualan.csv"'); // Set nama file excel nya
            header('Cache-Control: max-age=0');
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
            $writer->setDelimiter(';');
            $writer->setEnclosure('"');
            $writer->setLineEnding("\r\n");
            $writer->setSheetIndex(0);
            $writer->save('php://output');
        }
    }

    public function laporan_kasir_pdf($invoice_kasir)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Laporan Kasir PDF";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->db->where('invoice_kasir', base64_decode($invoice_kasir));
            $data['penjualan_kasir'] =  $this->db->get('tb_penjualan')->result();

            $data['penjualan_kasir_date'] =  $this->db->get('tb_penjualan')->row_array();
            $data['total'] = $this->m_laporan->get_all_laporankasir(base64_decode($invoice_kasir));
            $this->load->view('cetak-laporan-kasir', $data, FALSE);
        }
    }

    public function laporan_costumer_excel($invoice_costumer)
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
            $sheet->setCellValue('A1', "DATA LAPORAN"); // Set kolom A1 dengan tulisan "DATA SISWA"
            $sheet->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
            $sheet->getStyle('A1')->applyFromArray($style_head); // Set bold kolom A1
            // Buat header tabel nya pada baris ke 3
            $sheet->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
            $sheet->setCellValue('B3', "INVOICE"); // Set kolom B3 dengan tulisan "NIS"
            $sheet->setCellValue('C3', "TANGGAL"); // Set kolom C3 dengan tulisan "NAMA"
            $sheet->setCellValue('D3', "KOSTUMER"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
            $sheet->setCellValue('E3', "TOTAL"); // Set kolom E3 dengan tulisan "ALAMAT"
            // Apply style header yang telah kita buat tadi ke masing-masing kolom header
            $sheet->getStyle('A3')->applyFromArray($style_col);
            $sheet->getStyle('B3')->applyFromArray($style_col);
            $sheet->getStyle('C3')->applyFromArray($style_col);
            $sheet->getStyle('D3')->applyFromArray($style_col);
            $sheet->getStyle('E3')->applyFromArray($style_col);

            $this->db->where('invoice_costumer', base64_decode($invoice_costumer));
            $penualan_costumer =  $this->db->get('tb_penjualan')->result();
            $total = $this->m_laporan->get_all_laporancostumer(base64_decode($invoice_costumer));
            $no = 1;
            $numrow = 4;
            foreach ($penualan_costumer as $data) {
                $user = $this->db->get_where('tb_kostumer', ['id_kostumer' => $data->invoice_costumer])->row();
                $sheet->setCellValue('A' . $numrow, $no);
                $sheet->setCellValue('B' . $numrow, $data->penjualan_invoice);
                $sheet->setCellValue('C' . $numrow, $data->invoice_tgl);
                $sheet->setCellValue('D' . $numrow, $user->nama);
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
            $sheet->setTitle("Laporan Kostumer");
            // Proses file excel
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="laporan-kostumer.xlsx"'); // Set nama file excel nya
            header('Cache-Control: max-age=0');
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }
    }

    public function laporan_costumer_pdf($invoice_costumer)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Laporan Kostumer PDF";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->db->where('invoice_costumer', base64_decode($invoice_costumer));
            $data['penjualan_costumer'] =  $this->db->get('tb_penjualan')->result();

            $data['penjualan_costumer_date'] =  $this->db->get('tb_penjualan')->row_array();
            $data['total'] = $this->m_laporan->get_all_laporancostumer(base64_decode($invoice_costumer));
            $this->load->view('cetak-laporan-costumer', $data, FALSE);
        }
    }

    public function laporan_suplier_excel($invoice_suplier_id)
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
            $sheet->setCellValue('A1', "DATA LAPORAN"); // Set kolom A1 dengan tulisan "DATA SISWA"
            $sheet->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
            $sheet->getStyle('A1')->applyFromArray($style_head); // Set bold kolom A1
            // Buat header tabel nya pada baris ke 3
            $sheet->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
            $sheet->setCellValue('B3', "INVOICE"); // Set kolom B3 dengan tulisan "NIS"
            $sheet->setCellValue('C3', "TANGGAL"); // Set kolom C3 dengan tulisan "NAMA"
            $sheet->setCellValue('D3', "SUPLIER"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
            $sheet->setCellValue('E3', "TOTAL"); // Set kolom E3 dengan tulisan "ALAMAT"
            // Apply style header yang telah kita buat tadi ke masing-masing kolom header
            $sheet->getStyle('A3')->applyFromArray($style_col);
            $sheet->getStyle('B3')->applyFromArray($style_col);
            $sheet->getStyle('C3')->applyFromArray($style_col);
            $sheet->getStyle('D3')->applyFromArray($style_col);
            $sheet->getStyle('E3')->applyFromArray($style_col);

            $this->db->where('invoice_suplier_id', base64_decode($invoice_suplier_id));
            $penualan_suplier =  $this->db->get('tb_pembelian')->result();
            $total = $this->m_laporan->get_all_laporansuplier(base64_decode($invoice_suplier_id));
            $no = 1;
            $numrow = 4;
            foreach ($penualan_suplier as $data) {
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
            $sheet->setTitle("Laporan Suplier");
            // Proses file excel
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="laporan-suplier.xlsx"'); // Set nama file excel nya
            header('Cache-Control: max-age=0');
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }
    }

    public function laporan_suplier_csv()
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

    public function laporan_suplier_pdf($invoice_suplier_id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {

            $data['title'] = "Laporan Suplier PDF";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->db->where('invoice_suplier_id', base64_decode($invoice_suplier_id));
            $data['penjualan_suplier'] =  $this->db->get('tb_pembelian')->result();

            $data['penjualan_suplier_date'] =  $this->db->get('tb_pembelian')->row_array();
            $data['total'] = $this->m_laporan->get_all_laporansuplier(base64_decode($invoice_suplier_id));
            $this->load->view('cetak-laporan-suplier', $data, FALSE);
        }
    }
}

/* End of file Export.php */
