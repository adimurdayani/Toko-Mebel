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
                            <h4 class="header-title mb-2">Tabel <?= $title ?></h4>
                            <div class="btn-group mb-2">
                                <a href="<?= base_url('laporan/eksport_barang/laporan_barang_stok_excel') ?>" class="btn btn-light">Export to Excel</a>
                                <a href="<?= base_url('laporan/eksport_barang/laporan_barang_stok_pdf') ?>" target="_blank" class="btn btn-light">Export to PDF</a>
                                <a href="<?= base_url('laporan/eksport_barang/laporan_barang_csv') ?>" class="btn btn-light">Export to CSV</a>
                            </div>
                            <table id="basic-datatable" class="table table-bordered nowrap w-100">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Kode Barang</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Kategori</th>
                                        <th class="text-center">Harga Beli</th>
                                        <th class="text-center">Harga Jual</th>
                                        <th class="text-center">Stok</th>
                                        <th class="text-center">Satuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($get_barang as $data) : ?>
                                        <?php if ($data->barang_stok == 0) : ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td class="text-center"><?= $data->barang_kode ?></td>
                                                <td class="text-center"><?= $data->barang_nama ?></td>
                                                <td><?= $data->nama_kategori ?></td>
                                                <td class="text-right">Rp.<?= rupiah($data->barang_harga_beli) ?></td>
                                                <td class="text-right">Rp.<?= rupiah($data->barang_harga) ?></td>
                                                <td class="text-center"><?= $data->barang_stok ?></td>
                                                <td><?= $data->nama_satuan ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->

            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->