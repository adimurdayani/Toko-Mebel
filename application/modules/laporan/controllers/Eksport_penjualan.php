<?php

defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Eksport_penjualan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('m_laporan');
    }

    public function laporan_penjualan_periode_excel($invoice_tipe_transaksi)
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

            $sheet->setCellValue('A1', "DATA LAPORAN PENJUALAN PERPERIODE");
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

            $this->db->where('invoice_tipe_transaksi', base64_decode($invoice_tipe_transaksi));
            $penualan_kasir =  $this->db->get('tb_penjualan')->result();
            $total = $this->m_laporan->get_laporan_penjualan_transaksi(base64_decode($invoice_tipe_transaksi));
            $no = 1;
            $numrow = 4;
            foreach ($penualan_kasir as $data) {
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
            $sheet->setTitle("Laporan Penjualan Perperiode");
            // Proses file excel
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="laporan-penjualan-periode.xlsx"'); // Set nama file excel nya
            header('Cache-Control: max-age=0');
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }
    }

    public function laporan_penjualan_periode_pdf($invoice_tipe_transaksi)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Laporan Transaksi PDF";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->db->where('invoice_tipe_transaksi', base64_decode($invoice_tipe_transaksi));
            $data['penjualan_transaksi'] =  $this->db->get('tb_penjualan')->result();

            $data['penjualan_transaksi_date'] =  $this->db->get('tb_penjualan')->row_array();
            $data['total'] = $this->m_laporan->get_laporan_penjualan_transaksi(base64_decode($invoice_tipe_transaksi));
            $this->load->view('cetak-laporan-transaksi', $data, FALSE);
        }
    }

    public function laporan_penjualan_produksi_excel($produksi_kategori)
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

            $sheet->setCellValue('A1', "DATA LAPORAN PERPRODUKSI");
            $sheet->mergeCells('A1:E1');
            $sheet->getStyle('A1')->applyFromArray($style_head);
            // Buat header tabel nya pada baris ke 3
            $sheet->setCellValue('A3', "NO");
            $sheet->setCellValue('B3', "INVOICE");
            $sheet->setCellValue('C3', "TANGGAL");
            $sheet->setCellValue('D3', "PRODUK");
            $sheet->setCellValue('E3', "QTY TERJUAL");
            // Apply style header yang telah kita buat tadi ke masing-masing kolom header
            $sheet->getStyle('A3')->applyFromArray($style_col);
            $sheet->getStyle('B3')->applyFromArray($style_col);
            $sheet->getStyle('C3')->applyFromArray($style_col);
            $sheet->getStyle('D3')->applyFromArray($style_col);
            $sheet->getStyle('E3')->applyFromArray($style_col);

            $this->db->where('produksi_kategori', base64_decode($produksi_kategori));
            $penjualan_produk =  $this->db->get('tb_produksi')->result();
            $total = $this->m_laporan->get_laporan_penjualan_produksi(base64_decode($produksi_kategori));
            $no = 1;
            $numrow = 4;
            foreach ($penjualan_produk as $data) {
                $kategori = $this->db->get_where('tb_kategori_produk', ['id' => $data->produksi_kategori])->row();
                $sheet->setCellValue('A' . $numrow, $no);
                $sheet->setCellValue('B' . $numrow, $data->produksi_invoice);
                $sheet->setCellValue('C' . $numrow, $data->updated_at);
                $sheet->setCellValue('D' . $numrow, $kategori->nama_kategori);
                $sheet->setCellValue('E' . $numrow, $data->produksi_terjual);


                $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);

                $no++;
                $numrow++;
            }

            $sheet->setCellValue('D' . $numrow, 'TOTAL');
            $sheet->setCellValue('E' . $numrow, $total->produksi_terjual);
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
            $sheet->setTitle("Laporan Produksi");
            // Proses file excel
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="laporan-produksi.xlsx"'); // Set nama file excel nya
            header('Cache-Control: max-age=0');
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }
    }

    public function laporan_penjualan_produksi_pdf($produksi_kategori)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        } else {
            $data['title'] = "Laporan Produksi Barang PDF";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->db->where('produksi_kategori', base64_decode($produksi_kategori));
            $data['penjualan_transaksi'] =  $this->db->get('tb_produksi')->result();
            $data['total'] = $this->m_laporan->get_laporan_penjualan_produksi(base64_decode($produksi_kategori));

            $data['penjualan_transaksi_date'] =  $this->db->get('tb_produksi')->row_array();
            $this->load->view('cetak-laporan-produksi-barang', $data, FALSE);
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
                ->setTitle("Data Laporan Produksi")
                ->setSubject("penjualan")
                ->setDescription("Laporan Semua Data Produksi")
                ->setKeywords("Data Produksi");
            // Buat header tabel nya pada baris ke 3
            $sheet->setCellValue('A1', "id_produksi ");
            $sheet->setCellValue('B1', "produksi_nama");
            $sheet->setCellValue('C1', "produksi_kategori");
            $sheet->setCellValue('D1', "produksi_keterangan");
            $sheet->setCellValue('E1', "produksi_invoice");
            $sheet->setCellValue('F1', "produksi_harga_modal");
            $sheet->setCellValue('G1', "produksi_harga_jual");
            $sheet->setCellValue('H1', "produksi_harga_total");
            $sheet->setCellValue('I1', "produksi_stok");
            $sheet->setCellValue('J1', "produksi_status");
            $sheet->setCellValue('K1', "created_at");
            $sheet->setCellValue('L1', "updated_at");
            $sheet->setCellValue('M1', "produksi_kasir");
            $sheet->setCellValue('N1', "is_active");
            $sheet->setCellValue('O1', "produksi_terjual");

            $penualan =  $this->db->get('tb_produksi')->result();
            $no = 1;
            $numrow = 2;
            foreach ($penualan as $data) {
                $sheet->setCellValue('A' . $numrow, $no);
                $sheet->setCellValue('B' . $numrow, $data->produksi_nama);
                $sheet->setCellValue('C' . $numrow, $data->produksi_kategori);
                $sheet->setCellValue('D' . $numrow, $data->produksi_keterangan);
                $sheet->setCellValue('E' . $numrow, $data->produksi_invoice);
                $sheet->setCellValue('F' . $numrow, $data->produksi_harga_modal);
                $sheet->setCellValue('G' . $numrow, $data->produksi_harga_jual);
                $sheet->setCellValue('H' . $numrow, $data->produksi_harga_total);
                $sheet->setCellValue('I' . $numrow, $data->produksi_stok);
                $sheet->setCellValue('J' . $numrow, $data->produksi_status);
                $sheet->setCellValue('K' . $numrow, $data->created_at);
                $sheet->setCellValue('L' . $numrow, $data->updated_at);
                $sheet->setCellValue('M' . $numrow, $data->produksi_kasir);
                $sheet->setCellValue('N' . $numrow, $data->is_active);
                $sheet->setCellValue('O' . $numrow, $data->produksi_terjual);

                $no++;
                $numrow++;
            }

            // Set width kolom
            $sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
            $sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
            $sheet->getColumnDimension('C')->setWidth(15); // Set width kolom C
            $sheet->getColumnDimension('D')->setWidth(15); // Set width kolom D
            $sheet->getColumnDimension('E')->setWidth(15); // Set width kolom E

            // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
            $sheet->getDefaultRowDimension()->setRowHeight(-1);
            // Set orientasi kertas jadi LANDSCAPE
            $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
            // Set judul file excel nya
            $sheet->setTitle("Laporan Produksi");
            // Proses file excel
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="laporan-produksi.csv"'); // Set nama file excel nya
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
