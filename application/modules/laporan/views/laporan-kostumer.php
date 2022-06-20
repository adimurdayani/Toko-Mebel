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

            $sql = "SELECT count(if(invoice_costumer='$invoice_costumer', invoice_costumer, NULL)) as invoice_costumer,
                        sum(if(invoice_costumer='$invoice_costumer', invoice_total, NULL)) as invoice_total
                        FROM tb_penjualan";
            $total_penjualan = $this->db->query($sql)->row();

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
                                <a href="<?= base_url('laporan/eksport/laporan_costumer_excel/') . base64_encode($invoice_costumer) ?>" class="btn btn-light excel">Export to excel</a>
                                <a href="<?= base_url('laporan/eksport/laporan_costumer_pdf/') . base64_encode($invoice_costumer) ?>" target="_blank" class="btn btn-light">Export to pdf</a>
                                <a href="<?= base_url('laporan/eksport/laporan_csv') ?>" class="btn btn-light">Export to csv</a>
                                <table id="basic-datatable" class="table nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Invoice</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Kustomer</th>
                                            <th class="text-center">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($get_penjualan as $data) :
                                            $kostumer = $this->db->get_where('tb_kostumer', ['id_kostumer' => $data->invoice_costumer])->row();
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td class="text-center"><?= $data->penjualan_invoice ?></td>
                                                <td class="text-center"><?= $data->invoice_tgl ?></td>
                                                <td class="text-center"><?= $kostumer->nama ?></td>
                                                <td class="text-right">Rp.<?= rupiah($data->invoice_total) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <div class="float-right mt-4"><strong>Total</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <h4 class="text-success">Rp.<?= rupiah($total_penjualan->invoice_total) ?></h4>
                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->

                    </div>
                    <!-- end row-->
                <?php endif; ?>

                </div> <!-- container -->

        </div> <!-- content -->