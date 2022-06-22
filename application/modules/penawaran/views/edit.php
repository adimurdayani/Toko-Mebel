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
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <h4 class="header-title mb-2">Edit <?= $title ?></h4>

                            <?= form_open() ?>
                            <div class="form-group">
                                <label for="">Nama Barang</label>
                                <input type="hidden" name="id_penawaran" value="<?= $get_penawaran['id_penawaran'] ?>">
                                <textarea name="nama_barang" class="form-control" placeholder="Input nama barang" cols="30" rows="10"><?= $get_penawaran['nama_barang'] ?></textarea>
                                <small class="text-danger"><?= form_error('nama_barang') ?></small>
                            </div>
                            <div class="form-group">
                                <label for="">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="10"><?= $get_penawaran['keterangan'] ?></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Harga Penawaran</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="text" name="harga" id="harga" autocomplete="off" class="form-control" value="<?= rupiah($get_penawaran['harga']) ?>">
                                        </div>
                                        <small class="text-danger"><?= form_error('harga') ?></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Diskon</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="text" name="diskon" id="diskon" class="form-control" value="<?= rupiah($get_penawaran['diskon']) ?>">
                                        </div>
                                        <small class="text-danger"><?= form_error('diskon') ?></small>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="">Quantiti</label>
                                <input type="number" name="penawaran_qty" class="form-control" value="<?= $get_penawaran['penawaran_qty'] ?>" min="1" placeholder="Input nama barang">
                                <small class="text-danger"><?= form_error('penawaran_qty') ?></small>
                            </div>

                            <button class="btn btn-warning mt-4 float-right" type="submit"><i class="fe-save"></i> Update</button>
                            <a class="btn btn-secondary mt-4 float-right mr-2" href="<?= base_url('penawaran') ?>"><i class="fe-arrow-left"></i> Kembali</a>
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
        var harga = document.getElementById('harga');
        harga.addEventListener('keyup', function(e) {
            harga.value = formatRupiah(this.value);
        });

        var diskon = document.getElementById('diskon');
        diskon.addEventListener('keyup', function(e) {
            diskon.value = formatRupiah(this.value);
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