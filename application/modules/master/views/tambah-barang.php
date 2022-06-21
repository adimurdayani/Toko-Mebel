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
                                <li class="breadcrumb-item"><a href="<?= base_url('master/barang/') ?>">Data Barang</a> </li>
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

                            <?= form_open('master/barang/tambah') ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Kode Barang <span class="text-danger">*</span></label>
                                        <input type="text" name="barang_kode" id="barang_kode" class="form-control" placeholder="Contoh: 001" value="<?= set_value('barang_kode') ?>" required>
                                        <small class="text-danger"><?= form_error('barang_kode') ?></small>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Nama Barang <span class="text-danger">*</span></label>
                                        <input type="text" name="barang_nama" id="barang_nama" class="form-control" placeholder="Input nama barang" value="<?= set_value('barang_nama') ?>" required>
                                        <small class="text-danger"><?= form_error('barang_nama') ?></small>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Deskripsi</label>
                                        <textarea name="barang_deskripsi" id="barang_deskripsi" rows="5" class="form-control"><?= set_value('barang_deskripsi') ?></textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Harga Jual <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                    </div>
                                                    <input type="text" name="barang_harga" id="barang_harga" class="form-control" value="0" required>
                                                </div>
                                                <small class="text-danger"><?= form_error('barang_harga') ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="">Kategori <span class="text-danger">*</span></label>
                                        <select name="barang_kategori_id" id="barang_kategori_id" class="form-control " data-toggle="select2" required>
                                            <option value="">-- Pilih kategori --</option>
                                            <?php foreach ($get_kategori as $kategori) : ?>
                                                <?php if ($kategori->status_kategori == 1) : ?>
                                                    <option value="<?= $kategori->id ?>"><?= $kategori->nama_kategori ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="text-danger"><?= form_error('barang_kategori_id') ?></small>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Satuan <span class="text-danger">*</span></label>
                                        <select name="barang_satuan_id" id="barang_satuan_id" class="form-control " data-select2-id="satuan" required>
                                            <option value="">-- Pilih satuan --</option>
                                            <?php foreach ($get_satuan as $satuan) : ?>
                                                <?php if ($satuan->status_satuan == 1) : ?>
                                                    <option value="<?= $satuan->id ?>"><?= $satuan->nama_satuan ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="text-danger"><?= form_error('barang_satuan_id') ?></small>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Stok <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="barang_stok" id="barang_stok" value="0">
                                        <small class="text-danger"><?= form_error('barang_harga_jual') ?></small>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-outline-success float-right mt-4"><i class="fe-save"></i> Simpan</button>
                            <a href="<?= base_url('master/barang') ?>" class="btn btn-outline-secondary float-right mt-4 mr-2"><i class="fe-arrow-left"></i> Kembali</a>
                            <?= form_close() ?>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->

            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->
    <?php echo $this->load->view('template/footer'); ?>

    <script>
        var barang_harga = document.getElementById('barang_harga');
        barang_harga.addEventListener('keyup', function(e) {
            barang_harga.value = formatRupiah(barang_harga.value);
        });

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>