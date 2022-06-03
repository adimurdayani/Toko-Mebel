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
                                <li class="breadcrumb-item"><a href="<?= base_url('master/barang/') ?>"> Data Barang</a> </li>
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
                                    <input type="hidden" name="id_barang" value="<?= base64_encode($get_barang->id_barang) ?>">
                                    <div class="form-group">
                                        <label for="">Kode Barang</label>
                                        <input type="text" name="barang_kode" id="barang_kode" class="form-control" value="<?= $get_barang->barang_kode ?>" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Nama Barang</label>
                                        <input type="text" name="barang_nama" id="barang_nama" class="form-control" value="<?= $get_barang->barang_nama ?>" placeholder="Input nomor whatsapp" required>
                                        <small class="text-danger"><?= form_error('barang_nama') ?></small>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Deskripsi</label>
                                        <textarea name="barang_deskripsi" id="barang_deskripsi" rows="5" class="form-control"><?= $get_barang->barang_deskripsi ?></textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Harga Jual <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                    </div>
                                                    <input type="number" name="barang_harga" id="barang_harga" class="form-control" value="<?= $get_barang->barang_harga ?>">
                                                </div>
                                                <small class="text-danger"><?= form_error('barang_harga') ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="">Kategori <span class="text-danger">*</span></label>
                                        <select name="barang_kategori_id" id="barang_kategori_id" class="form-control " data-toggle="select2">
                                            <option value="">-- Pilih kategori --</option>
                                            <?php foreach ($get_kategori as $kategori) : ?>
                                                <option value="<?= $kategori->id ?>" <?php if ($get_barang->barang_kategori_id == $kategori->id) : ?> selected <?php endif; ?>><?= $kategori->nama_kategori ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="text-danger"><?= form_error('barang_kategori_id') ?></small>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Satuan <span class="text-danger">*</span></label>
                                        <select name="barang_satuan_id" id="barang_satuan_id" class="form-control " data-select2-id="satuan">
                                            <option value="">-- Pilih satuan --</option>
                                            <?php foreach ($get_satuan as $satuan) : ?>
                                                <option value="<?= $satuan->id ?>" <?php if ($get_barang->barang_satuan_id == $satuan->id) : ?> selected <?php endif; ?>><?= $satuan->nama_satuan ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="text-danger"><?= form_error('barang_satuan_id') ?></small>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Stok <span class="text-danger">*</span></label>
                                        <input type="number" name="barang_stok" id="barang_stok" class="form-control" value="<?= $get_barang->barang_stok ?>">
                                        <small class="text-danger"><?= form_error('barang_stok') ?></small>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-outline-warning float-right mt-4"><i class="fe-save"></i> Update</button>
                            <a href="<?= base_url('master/barang') ?>" class="btn btn-outline-secondary float-right mt-4 mr-2"><i class="fe-arrow-left"></i> Kembali</a>
                            <?= form_close() ?>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->

            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->