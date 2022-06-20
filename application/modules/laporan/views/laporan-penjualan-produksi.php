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
                                            <label for="">Nama Produksi</label>
                                            <select name="produksi_kategori" id="produksi_kategori" class="form-control" data-toggle="select2" required>
                                                <option value="">-- Pilih Produksi --</option>
                                                <?php foreach ($get_kategori as $data) : ?>
                                                    <?php if ($data->status_kategori == 1) : ?>
                                                        <option value="<?= $data->id ?>"><?= $data->nama_kategori ?></option>
                                                    <?php endif; ?>
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
            $produksi_kategori = $this->input->post('produksi_kategori');

            $sql = "SELECT count(if(produksi_kategori='$produksi_kategori', produksi_kategori, NULL)) as produksi_kategori,
                        sum(if(produksi_kategori='$produksi_kategori', produksi_terjual, NULL)) as produksi_terjual
                        FROM tb_produksi";
            $total_terjual = $this->db->query($sql)->row();

            if (!empty($tgl_awal) || !empty($tgl_akhir) || !empty($produksi_kategori)) :
                $this->db->where('updated_at >=', date_indo($tgl_awal));
                $this->db->where('updated_at <=', date_indo($tgl_akhir));
                $this->db->where('produksi_kategori', $produksi_kategori);
                $get_penjualan = $this->db->get('tb_produksi')->result();

                $this->db->where('produksi_kategori', $produksi_kategori);
                $get_total = $this->db->get('tb_produksi')->num_rows();
            ?>
                <div class="row">
                    <div class="col-lg">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <h4 class="header-title mb-2">Tabel <?= $title ?></h4>
                                <div class="btn-group mb-2">
                                    <a href="<?= base_url('laporan/eksport_penjualan/laporan_penjualan_produksi_excel/') . base64_encode($produksi_kategori) ?>" class="btn btn-light">Export to Excel</a>
                                    <a href="<?= base_url('laporan/eksport_penjualan/laporan_penjualan_produksi_pdf/') . base64_encode($produksi_kategori) ?>" target="_blank" class="btn btn-light">Export to PDF</a>
                                    <a href="<?= base_url('laporan/eksport_penjualan/laporan_csv') ?>" class="btn btn-light">Export to CSV</a>
                                </div>
                                <table id="basic-datatable" class="table table-bordered nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th class="text-center" >No</th>
                                            <th class="text-center">Invoice</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Produk</th>
                                            <th class="text-center" >QTY Terjual</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($get_penjualan as $data) : ?>
                                            <tr>
                                                <td  class="text-center"><?= $no++ ?></td>
                                                <td  class="text-center"><?= $data->produksi_invoice ?></td>
                                                <td  class="text-center"><?= $data->updated_at ?></td>
                                                <td ><?= $data->produksi_nama ?></td>
                                                <td  class="text-center"><?= $data->produksi_terjual ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <div class="float-right mt-4">
                                    <h4><strong>Total</strong> <strong class="text-success">terjual <?= $get_total ?>x</strong> dengan jumlah keseluruhan <strong>QTY Terjual <?= $total_terjual->produksi_terjual ?></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </h4>
                                </div>
                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->

                </div>
                <!-- end row-->
            <?php endif; ?>

        </div> <!-- container -->

    </div> <!-- content -->