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
                                <li class="breadcrumb-item active"><?= $title; ?></li>
                            </ol>
                        </div>
                        <h4 class="page-title"><?= $title; ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <a href="<?= base_url('produksi/tambah') ?>" class="btn btn-outline-info mb-4"><i class="fe-plus"></i> Tambah Produksi</a>
                            <h4 class="header-title mb-2">Tabel <?= $title; ?></h4>

                            <table id="basic-datatable" class="table nowrap w-100">
                                <thead>
                                    <tr>
                                        <th class="text-center">Aksi</th>
                                        <th>Kode Produksi</th>
                                        <th>Nama Produk</th>
                                        <th>Harga Jual</th>
                                        <th>Stok</th>
                                        <th>Status</th>
                                        <th>Aktif</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php foreach ($get_produksi as $data) : ?>
                                        <tr>
                                            <td class="text-center">
                                                <a href="<?= base_url('produksi/invoice/detail/') . base64_encode($data->produksi_invoice) ?>" class="btn btn-outline-info" title="Lihat Detail Invoice Produksi" data-plugin="tippy" data-tippy-placement="top"><i class="fe-eye"></i></a>
                                                <a href="javascript:void(0);" class="btn btn-outline-primary" title="Lihat Material Produksi" data-plugin="tippy" data-tippy-placement="top"><i class="fe-package"></i></a>
                                                <a href="javascript:void(0);" data-target="#edit<?= $data->id_produksi ?>" class="btn btn-outline-warning" data-toggle="modal" title="Edit Produk" data-plugin="tippy" data-tippy-placement="top"><i class="fe-edit"></i></a>
                                                <a href="<?= base_url('produksi/hapus_produksi/') . base64_encode($data->id_produksi) ?>" class="btn btn-outline-danger hapus" title="Hapus Produk" data-plugin="tippy" data-tippy-placement="top"><i class="fe-trash"></i> </a>
                                            </td>
                                            <td><?= $data->produksi_invoice ?></td>
                                            <td><?= $data->produksi_nama ?></td>
                                            <td>Rp.<?= rupiah($data->produksi_harga_total) ?></td>
                                            <td>
                                                <?php if ($data->produksi_stok != 0) : ?>
                                                    <?= $data->produksi_stok ?> Unit
                                                <?php else : ?>
                                                    <div class="badge badge-danger"><i class="fe-x"></i> Habis</div>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($data->produksi_status == "Dalam pesanan") : ?>
                                                    <div class="badge badge-outline-warning"><?= $data->produksi_status ?></div>
                                                <?php endif; ?>

                                                <?php if ($data->produksi_status == "Proses") : ?>
                                                    <div class="badge badge-outline-blue"><?= $data->produksi_status ?></div>
                                                <?php endif; ?>

                                                <?php if ($data->produksi_status == "Selesai") : ?>
                                                    <div class="badge badge-outline-success"><?= $data->produksi_status ?></div>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <input type="checkbox" class="editstatusproduksi" <?= check_active_produksi($data->is_active) ?> data-idproduksi="<?= $data->id_produksi ?>" data-active="<?= $data->is_active ?>">
                                            </td>
                                        </tr>
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