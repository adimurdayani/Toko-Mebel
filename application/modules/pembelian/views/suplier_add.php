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

                            <?= form_open() ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Nama Lengkap</label>
                                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Input nama lengkap">
                                    </div>

                                    <div class="form-group">
                                        <label for="">No. Whatshapp</label>
                                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Input nomor whatsapp">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Alamat</label>
                                        <textarea name="alamat" id="alamat" rows="5" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Nama Perusahaan Suplier</label>
                                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Contoh: PT. Bintang">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <select name="status_suplier" id="status_suplier" class="form-control">
                                            <option value="">-- Pilih sattus --</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-outline-success float-right mt-4"><i class="fe-save"></i> Simpan</button>
                            <a href="<?= base_url('pembelian/suplier') ?>" class="btn btn-outline-secondary float-right mt-4 mr-2"><i class="fe-arrow-left"></i> Kembali</a>
                            <?= form_close() ?>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->

            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->