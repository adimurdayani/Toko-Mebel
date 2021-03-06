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
                            <h4 class="header-title mb-2">Filter data laporan kasir berdasarkan tanggal </h4>

                            <form action="<?= base_url('laporan') ?>" method="POST">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Tanggal Awal</label>
                                            <input type="date" name="tgl_awal" id="tgl_awal" class="form-control tgl_awal" required>
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
                                            <label for="">Nama Kasir</label>
                                            <select name="invoice_kasir" id="invoice_kasir" class="form-control" data-toggle="select2" required>
                                                <option value="">-- Pilih Kasir --</option>
                                                <option value="<?= $get_grup->group_id ?>">Semua Kasir</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-info mt-4 float-right filter"><i class="fe-filter"></i> Filter</button>
                            </form>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->

            </div>
            <!-- end row-->

            <?php

            $tgl_awal = $this->input->post('tgl_awal');
            $tgl_akhir = $this->input->post('tgl_akhir');
            $invoice_kasir = $this->input->post('invoice_kasir');

            $sql = "SELECT count(if(invoice_kasir='$invoice_kasir', invoice_kasir, NULL)) as invoice_kasir,
                        sum(if(invoice_kasir='$invoice_kasir', invoice_total, NULL)) as invoice_total
                        FROM tb_penjualan";
            $total_penjualan = $this->db->query($sql)->row();

            if (!empty($tgl_awal) || !empty($tgl_akhir) || !empty($invoice_kasir)) :
                $this->db->where('invoice_date >=', date_indo($tgl_awal));
                $this->db->where('invoice_date <=', date_indo($tgl_akhir));
                $this->db->where('invoice_kasir', $invoice_kasir);
                $get_penjualan = $this->db->get('tb_penjualan')->result();
            ?>
                <div class="row">
                    <div class="col-lg">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <h4 class="header-title mb-2">Tabel <?= $title ?></h4>
                                <div class="btn-group mb-2">
                                    <a href="<?= base_url('laporan/eksport/laporan_kasir_excel/') . base64_encode($invoice_kasir) ?>" class="btn btn-light excel">Export to excel</a>
                                    <a href="<?= base_url('laporan/eksport/laporan_kasir_pdf/') . base64_encode($invoice_kasir) ?>" target="_blank" class="btn btn-light">Export to pdf</a>
                                    <a href="<?= base_url('laporan/eksport/laporan_csv') ?>" class="btn btn-light">Export to csv</a>
                                </div>
                                <table id="basic-datatable" class="table  table-bordered nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Invoice</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Kasir</th>
                                            <th class="text-center">Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($get_penjualan as $data) :
                                            $user = $this->db->get_where('users', ['id' => $data->invoice_kasir])->row();
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td class="text-center"><?= $data->penjualan_invoice ?></td>
                                                <td class="text-center"><?= $data->invoice_tgl ?></td>
                                                <td class="text-center"><?= $user->first_name ?></td>
                                                <td class="text-right">Rp.<?= rupiah($data->invoice_total) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4"><strong class="float-right font-20">Total</strong></td>
                                            <td style="vertical-align: middle;"><strong class="text-success float-right">Rp.<?= rupiah($total_penjualan->invoice_total) ?></strong></td>
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