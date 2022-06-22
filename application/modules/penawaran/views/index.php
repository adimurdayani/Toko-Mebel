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
                            <form action="<?= base_url('penawaran/hapus_all/') ?>" method="POST" id="form-delete">

                                <a href="<?= base_url('penawaran/tambah') ?>" class="btn btn-outline-info mb-3"><i class="fe-plus"></i> Tambah</a>
                                <button type="submit" class="btn btn-outline-danger mb-3" id="hapus"><i class="fe-trash"></i> Hapus</button>

                                <table id="basic-datatable" class="table table-bordered nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th style="width: 50px;"><input type="checkbox" id="chack-all"></th>
                                            <th class="text-center">Aksi</th>
                                            <th>No</th>
                                            <th class="text-center">Nama Barang</th>
                                            <th class="text-center">Qty barang</th>
                                            <th class="text-center">Harga</th>
                                            <th class="text-center">Diskon</th>
                                            <th class="text-center">Total</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php $no = 1;
                                        foreach ($get_penawaran as $data) : ?>
                                            <tr>
                                                <td><input type="checkbox" class="check-item" name="id_penawaran[]" value="<?= $data->id_penawaran ?>"></td>
                                                <td class="text-center">
                                                    <a href="<?= base_url('penawaran/hapus/') . base64_encode($data->id_penawaran) ?>" class="btn btn-sm btn-danger hapus" title="Hapus Penawaran" data-plugin="tippy" data-tippy-placement="top"><i class="fe-trash"></i> </a>
                                                    <a href="<?= base_url('penawaran/edit/') . base64_encode($data->id_penawaran) ?>" class="btn btn-sm btn-warning" title="Edit Penawaran" data-plugin="tippy" data-tippy-placement="top"><i class="fe-edit"></i> </a>
                                                    <a href="<?= base_url('penawaran/cetak_nota/') . base64_encode($data->id_penawaran) ?>" target="_blank" class="btn btn-sm btn-success" title="Cetak Penawaran" data-plugin="tippy" data-tippy-placement="top"><i class="fe-printer"></i> </a>
                                                </td>
                                                <td><?= $no++ ?></td>
                                                <td><?= $data->nama_barang ?></td>
                                                <td class="text-center"><?= $data->penawaran_qty ?></td>
                                                <td class="text-right">Rp<?= rupiah($data->harga) ?></td>
                                                <td class="text-right">Rp.<?= rupiah($data->diskon) ?></td>
                                                <td class="text-right">Rp.<?= rupiah($data->total) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </form>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->

            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->