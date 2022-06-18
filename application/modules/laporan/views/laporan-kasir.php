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
                                            <label for="">Nama Kasir</label>
                                            <select name="invoice_kasir" id="invoice_kasir" class="form-control" data-toggle="select2" required>
                                                <option value="">-- Pilih Kasir --</option>
                                                <option value="<?= $get_grup->group_id ?>">Semua Kasir</option>
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
                                            <th>Kasir</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($get_penjualan as $data) :
                                            $user = $this->db->get_where('users', ['id' => $data->invoice_kasir])->row();
                                        ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $data->penjualan_invoice ?></td>
                                                <td><?= $data->invoice_tgl ?></td>
                                                <td><?= $user->first_name ?></td>
                                                <td>Rp.<?= rupiah($data->invoice_total) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <div class="float-right mt-4"><strong>Total</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <h4 class="text-success">Rp.<?= rupiah($total_penjualan->invoice_total) ?></h4>
                                </div>
                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->

                </div>
                <!-- end row-->
            <?php endif; ?>

        </div> <!-- container -->

    </div> <!-- content -->