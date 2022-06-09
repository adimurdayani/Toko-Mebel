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
                        <div class="card-body">
                            <h4 class="header-title">Form Input</h4>
                            <p class="sub-header">
                                Sesuaikan nama website anda dengan cara mengisi form input di bawah.
                            </p>

                            <?php if ($get_total == 0) : ?>
                                <?= form_open_multipart('konfigurasi/tambah') ?>

                                <div class="form-group mb-3">
                                    <label for="simpleinput">Nama Website</label>
                                    <input type="text" id="simpleinput" name="nama_web" class="form-control">
                                    <?= form_error('nama_web', '<small class="text-danger">', '</small>') ?>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Upload Icon Website</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input input1" id="icon_web" name="icon_web">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-outline-success"><i class="fe-save"></i></button>

                                <?= form_close() ?>

                            <?php else : ?>
                                <?= form_open_multipart('konfigurasi/edit') ?>
                                <input type="hidden" id="id" name="id" value="<?= $get_config->id ?>" class="form-control">
                                <div class="form-group mb-3">
                                    <label for="nama_web">Nama Website</label>
                                    <input type="text" id="nama_web" name="nama_web" value="<?= $get_config->nama_web ?>" class="form-control">
                                    <?= form_error('nama_web', '<small class="text-danger">', '</small>') ?>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>Upload Icon Website</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input input1" id="icon_web" name="icon_web">
                                                    <label class="custom-file-label">Choose file</label>
                                                </div>
                                            </div>
                                            <img src="<?= base_url('assets/images/upload/') . $get_config->icon_web ?>" alt="" class="img-thumbnail mt-2" width="100px">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>Upload Logo Website</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input input1" id="logo_web" name="logo_web">
                                                    <label class="custom-file-label">Choose file</label>
                                                </div>
                                            </div>
                                            <img src="<?= base_url('assets/images/upload/') . $get_config->logo_web ?>" alt="" class="img-thumbnail mt-2" width="100px">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>Upload Logo small Website</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input input1" id="logo_small_web" name="logo_small_web">
                                                    <label class="custom-file-label">Choose file</label>
                                                </div>
                                            </div>
                                            <img src="<?= base_url('assets/images/upload/') . $get_config->logo_small_web ?>" alt="" class="img-thumbnail mt-2" width="100px">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-outline-success float-right"><i class="fe-save"></i> Simpan</button>

                                <?= form_close() ?>

                            <?php endif ?>

                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div><!-- end col -->
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-lg">
                    <div class="card">
                        <div class="card-body">
                            <?php if ($get_total == 0) : ?>
                                <?= form_open_multipart('konfigurasi/tambah') ?>

                                <div class="form-group mb-3">
                                    <label>Upload Logo Nota</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input input1" id="logo_nota" name="logo_nota">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-outline-success"><i class="fe-save"></i></button>

                                <?= form_close() ?>

                            <?php else : ?>
                                <?= form_open_multipart('konfigurasi/edit_logo_nota') ?>
                                <input type="hidden" id="id" name="id" value="<?= $get_config->id ?>" class="form-control">

                                <div class="form-group mb-3">
                                    <label>Upload Logo Nota</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input input1" id="logo_nota" name="logo_nota">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                    <img src="<?= base_url('assets/images/upload/') . $get_config->logo_nota ?>" alt="" class="img-thumbnail mt-2" width="100px">
                                </div>

                                <button type="submit" class="btn btn-outline-success float-right"><i class="fe-save"></i> Simpan</button>

                                <?= form_close() ?>

                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- container -->

    </div> <!-- content -->