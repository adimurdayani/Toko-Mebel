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
                            <form action="<?= base_url('pembelian/hapus_all/') ?>" method="POST" id="form-delete">

                                <a href="<?= base_url('pembelian/tambah') ?>" class="btn btn-outline-info mb-3"><i class="fe-plus"></i> Tambah Transaksi</a>
                                <button type="submit" class="btn btn-outline-danger mb-3" id="hapus"><i class="fe-trash"></i> Hapus</button>

                                <table id="basic-datatable" class="table nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th style="width: 50px;"><input type="checkbox" id="chack-all"></th>
                                            <th>No</th>
                                            <th>Invoice</th>
                                            <th>Tanggal</th>
                                            <th>Suplier</th>
                                            <th>Total</th>
                                            <th>Bayar</th>
                                            <th>Kembali</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php $no = 1;
                                        foreach ($get_pembelian as $data) : ?>
                                            <tr>
                                                <td><input type="checkbox" class="check-item" name="id[]" value="<?= $data->id ?>"></td>
                                                <td><?= $no++ ?></td>
                                                <td><?= $data->invoice ?></td>
                                                <td><?= $data->updated_at ?></td>
                                                <td><?= $data->suplier ?> - <?= $data->versi ?></td>
                                                <td><?= $data->bayar ?></td>
                                                <td><?= $data->kembali ?></td>
                                                <td><?= $data->total ?></td>
                                                <td>
                                                    <a href="javascript:void(0);" data-target="#edit<?= $data->id_kostumer ?>" class="btn btn-outline-warning" data-toggle="modal" title="Edit Kostumer" data-plugin="tippy" data-tippy-placement="top"><i class="fe-edit"></i></a>
                                                    <a href="<?= base_url('kostumer/hapus/') . base64_encode($data->id_kostumer) ?>" class="btn btn-outline-danger hapus" title="Hapus Kostumer" data-plugin="tippy" data-tippy-placement="top"><i class="fe-trash"></i> </a>
                                                </td>
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