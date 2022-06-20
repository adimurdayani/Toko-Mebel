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

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Tanggal Awal</label>
                                            <input type="date" name="tgl_awal" id="tgl_awal" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Tanggal Akhir</label>
                                            <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control" required>
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

            if (!empty($tgl_awal) || !empty($tgl_akhir)) :
                $this->db->where('invoice_tgl >=', date_indo($tgl_awal));
                $this->db->where('invoice_tgl <=', date_indo($tgl_akhir));
                $get_pembelian = $this->db->get('tb_pembelian')->result();

                foreach ($get_pembelian as $p) {
                    $suplier = $this->db->get_where('tb_suplier', ['id_suplier' => $p->invoice_suplier_id])->row();
                }
            ?>
                <div class="row">
                    <div class="col-lg">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <h4 class="header-title mb-2">Tabel <?= $title ?></h4>
                                <div class="btn-group mb-2">
                                    <a href="<?= base_url('laporan/eksport_pembelian/laporan_pembelian_periode_excel/') . base64_encode($suplier->id_suplier) ?>" class="btn btn-light">Export to Excel</a>
                                    <a href="<?= base_url('laporan/eksport_pembelian/laporan_pembelian_periode_pdf/') . base64_encode($suplier->id_suplier) ?>" target="_blank" class="btn btn-light">Export to PDF</a>
                                    <a href="<?= base_url('laporan/eksport_pembelian/laporan_pembelian_csv') ?>" class="btn btn-light">Export to CSV</a>
                                </div>
                                <table id="basic-datatable" class="table table-bordered nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Invoice</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Suplier</th>
                                            <th class="text-center">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($get_pembelian as $data) :
                                            $user = $this->db->get_where('tb_suplier', ['id_suplier' => $data->invoice_suplier_id])->row();

                                            $sql = "SELECT count(if(invoice_suplier_id='$user->id_suplier', invoice_suplier_id, NULL)) as invoice_suplier_id,
                                                    sum(if(invoice_suplier_id='$user->id_suplier', invoice_total, NULL)) as invoice_total
                                                    FROM tb_pembelian";
                                            $total_penjualan = $this->db->query($sql)->row();
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td class="text-center"><?= $data->invoice_pembelian ?></td>
                                                <td class="text-center"><?= $data->invoice_tgl ?></td>
                                                <td class="text-left"><?= $user->nama_perusahaan ?></td>
                                                <td class="text-right">Rp.<?= rupiah($data->invoice_total) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <div class="float-right mt-4"><strong>Total</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <h4 class="text-success">Rp.<?= rupiah($total_penjualan->invoice_total) ?></h4>
                                </div>
                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->

                </div>
                <!-- end row-->
            <?php endif; ?>

        </div> <!-- container -->

    </div> <!-- content -->