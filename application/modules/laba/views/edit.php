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
                            <h4 class="header-title mb-2">Edit Data Operasional Toko dari Pendapatan dan Pengeluaran</h4>

                            <?= form_open() ?>
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="">Total Gaji Karyawan</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                            </div>
                                            <input type="hidden" name="id_biaya" value="<?= rupiah($get_laba['id_biaya']) ?>">
                                            <input type="text" name="gaji" class="form-control" id="gaji" value="<?= rupiah($get_laba['gaji']) ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Biaya Listrik 1 Bulan</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                            </div>
                                            <input type="text" name="listrik" id="listrik" class="form-control" value="<?= rupiah($get_laba['listrik']) ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Telepon & Internet</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                            </div>
                                            <input type="text" name="telp_internet" id="telp_internet" class="form-control" value="<?= rupiah($get_laba['telp_internet']) ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Biaya Administrasi Bank</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                            </div>
                                            <input type="text" name="bank" id="bank" class="form-control" value="<?= rupiah($get_laba['bank']) ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Biaya Pemeliharaan</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                            </div>
                                            <input type="text" name="pemeliharaan" id="pemeliharaan" class="form-control" value="<?= rupiah($get_laba['pemeliharaan']) ?>">
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
                                            <input type="text" name="perbaikan" id="perbaikan" class="form-control" value="<?= rupiah($get_laba['perbaikan']) ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Biaya Sewa</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                            </div>
                                            <input type="text" name="sewa" id="sewa" class="form-control" value="<?= rupiah($get_laba['sewa']) ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Biaya Transportasi</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                            </div>
                                            <input type="text" name="motor" id="motor" class="form-control" value="<?= rupiah($get_laba['motor']) ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Pengeluaran Lainnya</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                            </div>
                                            <input type="text" name="pengeluaran_lain" id="pengeluaran_lain" class="form-control" value="<?= rupiah($get_laba['pengeluaran_lain']) ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Biaya Tak Terduga</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                            </div>
                                            <input type="text" name="biaya_tak_terduga" id="biaya_tak_terduga" class="form-control" value="<?= rupiah($get_laba['biaya_tak_terduga']) ?>">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <button class="btn btn-warning mt-4 float-right"><i class="fe-save"></i> Ubah</button>
                            <?= form_close() ?>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->

            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->

    <?php echo $this->load->view('template/footer'); ?>
    <script type="text/javascript">
        var bank = document.getElementById('bank');
        bank.addEventListener('keyup', function(e) {
            bank.value = formatRupiah(this.value);
        });

        var motor = document.getElementById('motor');
        motor.addEventListener('keyup', function(e) {
            motor.value = formatRupiah(this.value);
        });

        var listrik = document.getElementById('listrik');
        listrik.addEventListener('keyup', function(e) {
            listrik.value = formatRupiah(this.value);
        });

        var perbaikan = document.getElementById('perbaikan');
        perbaikan.addEventListener('keyup', function(e) {
            perbaikan.value = formatRupiah(this.value);
        });

        var pemeliharaan = document.getElementById('pemeliharaan');
        pemeliharaan.addEventListener('keyup', function(e) {
            pemeliharaan.value = formatRupiah(this.value);
        });

        var sewa = document.getElementById('sewa');
        sewa.addEventListener('keyup', function(e) {
            sewa.value = formatRupiah(this.value);
        });

        var pengeluaran_lain = document.getElementById('pengeluaran_lain');
        pengeluaran_lain.addEventListener('keyup', function(e) {
            pengeluaran_lain.value = formatRupiah(this.value);
        });

        var telp_internet = document.getElementById('telp_internet');
        telp_internet.addEventListener('keyup', function(e) {
            telp_internet.value = formatRupiah(this.value);
        });

        var biaya_tak_terduga = document.getElementById('biaya_tak_terduga');
        biaya_tak_terduga.addEventListener('keyup', function(e) {
            biaya_tak_terduga.value = formatRupiah(this.value);
        });

        var gaji = document.getElementById('gaji');
        gaji.addEventListener('keyup', function(e) {
            gaji.value = formatRupiah(this.value);
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