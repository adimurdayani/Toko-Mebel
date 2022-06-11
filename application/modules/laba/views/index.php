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
                            <h4 class="header-title mb-2">Data Operasional Toko dari Pendapatan dan Pengeluaran</h4>

                            <?= form_open('laba/tambah') ?>
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="">Total Gaji Karyawan</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                            </div>
                                            <input type="number" name="gaji" class="form-control" value="0">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Biaya Listrik 1 Bulan</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                            </div>
                                            <input type="number" name="listrik" class="form-control" value="0">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Telepon & Internet</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                            </div>
                                            <input type="number" name="telp_internet" class="form-control" value="0">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Biaya Administrasi Bank</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                            </div>
                                            <input type="number" name="bank" class="form-control" value="0">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Biaya Pemeliharaan</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                            </div>
                                            <input type="number" name="pemeliharaan" class="form-control" value="0">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="">Biaya Perbaikan</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                            </div>
                                            <input type="number" name="perbaikan" class="form-control" value="0">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Biaya Sewa</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                            </div>
                                            <input type="number" name="sewa" class="form-control" value="0">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Biaya Transportasi</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                            </div>
                                            <input type="number" name="motor" class="form-control" value="0">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Pengeluaran Lainnya</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                            </div>
                                            <input type="number" name="pengeluaran_lain" class="form-control" value="0">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Biaya Tak Terduga</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                            </div>
                                            <input type="number" name="biaya_tak_terduga" class="form-control" value="0">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <button class="btn btn-success mt-4 float-right"><i class="fe-save"></i> Simpan</button>
                            <?= form_close() ?>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->

            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->