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
                            <h4 class="header-title mb-2">Form <?= $title ?></h4>
                            <?= form_open('kostumer/tambah_kostumer') ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" name="nama" class="form-control" placeholder="Input nama lengkap" value="<?= set_value('nama'); ?>" required>
                                        <small class="text-danger"><?= form_error('nama') ?></small>
                                    </div>

                                    <div class="form-group">
                                        <label for="">No. Whatshapp <span class="text-danger">*</span></label>
                                        <input type="text" name="phone" class="form-control" placeholder="Input no. whatsapp" required value="<?= set_value('phone'); ?>">
                                        <small class="text-danger"><?= form_error('phone') ?></small>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Email <span class="text-danger">(Tidak Wajib)</span></label>
                                        <input type="email" name="email" class="form-control" placeholder="Input email" value="<?= set_value('email'); ?>">
                                        <small class="text-danger"><?= form_error('email') ?></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Alamat <span class="text-danger">*</span></label>
                                        <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="5"><?= set_value('alamat'); ?></textarea>
                                        <small class="text-danger"><?= form_error('alamat') ?></small>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Status </label>
                                        <select name="status_kostumer" id="status_kostumer" class="form-control">
                                            <option value="1">Aktif</option>
                                            <option value="0">Tidak aktif</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success float-right mt-4 ml-2"><i class="fe-save"></i> Simpan</button>
                            <a href="<?= base_url('penjualan/transaksi_cash') ?>" class="btn btn-secondary float-right mt-4"><i class="fe-arrow-left"></i> Kembali</a>
                            <?= form_close() ?>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->

            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->