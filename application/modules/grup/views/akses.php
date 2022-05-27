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
                                <li class="breadcrumb-item"><a href="<?= base_url('user') ?>">User Manajemen</a></li>
                                <li class="breadcrumb-item"><a href="<?= base_url('grup') ?>">Grup User</a></li>
                                <li class="breadcrumb-item active"><?= $title; ?></li>
                            </ol>
                        </div>
                        <h4 class="page-title"><?= $title; ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-7">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <a href="<?= base_url('grup') ?>" class="btn btn-outline-secondary mb-2"><i class="fe-arrow-left"></i> Kembali</a>
                            <h4 class="header-title">Level: <?= $get_grup['description']; ?></h4>

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Menu</th>
                                        <th class="text-center">Akses</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($get_menu as $data) : ?>
                                        <tr>
                                            <td><?= $data->menu ?></td>
                                            <td class="text-center">
                                                <input type="checkbox" class="ubahakses" <?= check_akses($get_grup['id'], $data->id_menu); ?> data-userid="<?= $get_grup['id'] ?>" data-menuid="<?= $data->id_menu ?>">
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