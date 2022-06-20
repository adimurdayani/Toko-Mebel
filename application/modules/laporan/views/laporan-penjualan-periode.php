<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active"><?= $title ?></li>
                            </ol>
                        </div>
                        <h4 class="page-title"><?= $title ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <h4 class="header-title mb-2">Filter data laporan berdasarkan tanggal </h4>

                            <form action="" method="POST">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Tanggal Awal</label>
                                            <input type="date" name="tgl_awal" id="tgl_awal" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Tanggal Akhir</label>
                                            <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Pembayaran</label>
                                            <select name="invoice_tipe_transaksi" id="invoice_tipe_transaksi" class="form-control" data-toggle="select2" required>
                                                <option value="">-- Pilih pembayaran --</option>
                                                <option value="0">Cash</option>
                                                <option value="1">Transfer</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-info mt-4 float-right"><i class="fe-filter"></i> Filter</button>
                            </form>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->

            </div>
            <!-- end row-->

            <?php

            $tgl_awal = $this->input->post('tgl_awal');
            $tgl_akhir = $this->input->post('tgl_akhir');
            $invoice_tipe_transaksi = $this->input->post('invoice_tipe_transaksi');

            $sql = "SELECT count(if(invoice_tipe_transaksi='$invoice_tipe_transaksi', invoice_tipe_transaksi, NULL)) as invoice_tipe_transaksi,
                        sum(if(invoice_tipe_transaksi='$invoice_tipe_transaksi', invoice_total, NULL)) as invoice_total
                        FROM tb_penjualan";
            $total_penjualan = $this->db->query($sql)->row();

            if (!empty($tgl_awal) || !empty($tgl_akhir) || !empty($invoice_tipe_transaksi)) :
                $this->db->where('invoice_date >=', date_indo($tgl_awal));
                $this->db->where('invoice_date <=', date_indo($tgl_akhir));
                $this->db->where('invoice_tipe_transaksi', $invoice_tipe_transaksi);
                $get_penjualan = $this->db->get('tb_penjualan')->result();
            ?>
                <div class="row">
                    <div class="col-lg">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <h4 class="header-title mb-2">Tabel <?= $title ?></h4>
                                <div class="btn-group mb-2">
                                    <a href="<?= base_url('laporan/eksport_penjualan/laporan_penjualan_periode_excel/') . base64_encode($invoice_tipe_transaksi) ?>" class="btn btn-light">Export to Excel</a>
                                    <a href="<?= base_url('laporan/eksport_penjualan/laporan_penjualan_periode_pdf/') . base64_encode($invoice_tipe_transaksi) ?>" target="_blank" class="btn btn-light">Export to PDF</a>
                                    <a href="<?= base_url('laporan/eksport/laporan_csv') ?>" class="btn btn-light">Export to CSV</a>
                                </div>
                                <table id="basic-datatable" class="table table-bordered nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Invoice</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Kostumer</th>
                                            <th class="text-center">Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($get_penjualan as $data) :
                                            $user = $this->db->get_where('tb_kostumer', ['id_kostumer' => $data->invoice_costumer])->row();
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td class="text-center"><?= $data->penjualan_invoice ?></td>
                                                <td class="text-center"><?= $data->invoice_tgl ?></td>
                                                <td><?= $user->nama ?></td>
                                                <td class="text-right">Rp.<?= rupiah($data->invoice_total) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4"><strong class="float-right font-20">Total</strong></td>
                                            <td class="text-center" style="vertical-align: middle;"><strong class="text-success float-right">Rp.<?= rupiah($total_penjualan->invoice_total) ?></strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->

                </div>
                <!-- end row-->
            <?php endif; ?>

        </div> <!-- container -->

    </div> <!-- content -->