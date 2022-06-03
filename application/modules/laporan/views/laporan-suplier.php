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
                            <h4 class="header-title mb-2">Filter data laporan suplier berdasarkan tanggal</h4>

                            <form action="" method="post">
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
                                            <label for="">Nama Suplier</label>
                                            <select name="invoice_suplier_id" id="invoice_suplier_id" class="form-control" data-toggle="select2" required>
                                                <option value="">-- Pilih Suplier --</option>
                                                <?php foreach ($get_suplier as $sp) : ?>
                                                    <option value="<?= $sp->id_suplier ?>"><?= $sp->nama_perusahaan ?></option>
                                                <?php endforeach; ?>
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
            $invoice_suplier = $this->input->post('invoice_suplier_id');

            if (!empty($tgl_awal) || !empty($tgl_akhir) || !empty($invoice_suplier)) :
                $this->db->where('invoice_created >=', date_indo($tgl_awal));
                $this->db->where('invoice_created <=', date_indo($tgl_akhir));
                $this->db->where('invoice_suplier_id', $invoice_suplier);
                $get_pembelain = $this->db->get('tb_pembelian')->result();
            ?>
                <div class="row">
                    <div class="col-lg">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <h4 class="header-title mb-2">Tabel <?= $title ?></h4>
                                <div class="btn-group mb-2">
                                    <button type="button" class="btn btn-light">Export Excel</button>
                                    <button type="button" class="btn btn-light">Export PDF</button>
                                    <button type="button" class="btn btn-light">Export CSV</button>
                                </div>
                                <table id="basic-datatable" class="table nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Invoice</th>
                                            <th>Tanggal</th>
                                            <th>Suplier</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($get_pembelain as $data) :
                                            $suplier = $this->db->get_where('tb_suplier', ['id_suplier' => $data->invoice_suplier_id])->row();
                                        ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $data->invoice_pembelian ?></td>
                                                <td><?= $data->invoice_tgl ?></td>
                                                <td><?= $suplier->nama_perusahaan ?></td>
                                                <td>Rp.<?= rupiah($data->invoice_total) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->

                </div>
                <!-- end row-->
            <?php endif; ?>

        </div> <!-- container -->

    </div> <!-- content -->