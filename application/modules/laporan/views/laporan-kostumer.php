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
                            <h4 class="header-title mb-2">Filter data laporan kostumer berdasarkan tanggal</h4>

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
                                            <label for="">Nama Kostumer</label>
                                            <select name="invoice_costumer" id="invoice_costumer" class="form-control" data-toggle="select2" required>
                                                <option value="">-- Pilih Kostumer --</option>
                                                <?php foreach ($get_kostumer as $sp) : ?>
                                                    <option value="<?= $sp->id_kostumer ?>"><?= $sp->nama ?></option>
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
            $invoice_costumer = $this->input->post('invoice_costumer');

            if (!empty($tgl_awal) || !empty($tgl_akhir) || !empty($invoice_costumer)) :
                $this->db->where('invoice_date >=', date_indo($tgl_awal));
                $this->db->where('invoice_date <=', date_indo($tgl_akhir));
                $this->db->where('invoice_costumer', $invoice_costumer);
                $get_penjualan = $this->db->get('tb_penjualan')->result();
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
                                            <th>Kustomer</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($get_penjualan as $data) :
                                            $kostumer = $this->db->get_where('tb_kostumer', ['id_kostumer' => $data->invoice_costumer])->row();
                                        ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $data->penjualan_invoice ?></td>
                                                <td><?= $data->invoice_tgl ?></td>
                                                <td><?= $kostumer->nama ?></td>
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