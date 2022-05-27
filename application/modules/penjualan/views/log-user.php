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
                            <form action="<?= base_url('log_user/hapus_all/') ?>" method="POST" id="form-delete">
                                <button type="submit" class="btn btn-danger mb-3" id="hapus"><i class="fa fa-trash"></i> Hapus</button>
                                <a href="<?= base_url('log_user/cetak') ?>" class="btn btn-warning mb-3">Cetak <i class="fa fa-file-pdf"></i></a>
                                <table id="basic-datatable" class="table nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th style="width: 50px;"><input type="checkbox" id="chack-all"></th>
                                            <th>No</th>
                                            <th>IP Address</th>
                                            <th>Sistem Operasi</th>
                                            <th>Browser</th>
                                            <th>Tanggal/Waktu</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php $no = 1;
                                        foreach ($get_log as $data) : ?>
                                            <tr>
                                                <td><input type="checkbox" class="check-item" name="id[]" value="<?= $data->id ?>"></td>
                                                <td><?= $no++ ?></td>
                                                <td><?= $data->ip ?></td>
                                                <td><?= $data->os ?></td>
                                                <td><?= $data->browser ?> - <?= $data->versi ?></td>
                                                <td><?= $data->time ?></td>
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