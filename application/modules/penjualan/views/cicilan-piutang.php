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
                                <li class="breadcrumb-item active"><a href="<?= base_url('pembelian/belum_lunas/') ?>">Data Hutang</a></li>
                                <li class="breadcrumb-item active"><?= $title ?></li>
                            </ol>
                        </div>
                        <h4 class="page-title"><?= $title ?>
                            <?php if ($get_penjualan->invoice_piutang_lunas == 1) : ?>
                                <div class="badge badge-outline-success">Lunas</div>
                            <?php else : ?>
                                <div class="badge badge-outline-danger">Belum Lunas</div>
                                <small class="text-danger pt-0">Jatuh Tempo: <?= $get_penjualan->invoice_piutang_jatuh_tempo ?></small>
                            <?php endif; ?>
                        </h4>
                        <h4>No. Invoice: <?= $get_penjualan->penjualan_invoice ?></h4>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <h4 class="header-title mb-2">Tabel <?= $title ?> </h4>

                            <?= form_open('') ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="hidden" name="piutang_invoice" value="<?= $get_penjualan->penjualan_invoice ?>">
                                    <?php if ($get_penjualan->invoice_kembali == 0) : ?>
                                        <input type="hidden" name="invoice_kembali" value="0">
                                    <?php endif; ?>
                                    <div class="form-group">
                                        <label for="">Sub Total</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                            </div>
                                            <input type="text" class="form-control" readonly value="<?= rupiah($get_penjualan->invoice_total) ?>">
                                        </div>
                                    </div>
                                    <?php $no = 1;
                                    $total_cicilan = 0;
                                    foreach ($get_piutang as $data) :
                                        $total_cicilan += $data->piutang_nominal ?>
                                    <?php endforeach; ?>

                                    <div class="form-group">
                                        <label for="">Total Cicilan</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                            </div>
                                            <input type="text" class="form-control" readonly value="<?= rupiah($total_cicilan) ?>">

                                        </div>
                                    </div>

                                    <?php if ($get_penjualan->invoice_piutang_lunas != 1) : ?>
                                        <div class="form-group">
                                            <label for="">Tipe Pembayaran</label>
                                            <select name="piutang_tipe_pembayaran" id="piutang_tipe_pembayaran" class="form-control">
                                                <option value="">-- Pilih Pembayaran --</option>
                                                <option value="1">Cash</option>
                                                <option value="2">Transfer</option>
                                            </select>
                                            <small class="text-danger"><?= form_error('piutang_tipe_pembayaran') ?></small>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">DP</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                            </div>
                                            <input type="text" name="" id="" class="form-control" value="<?= rupiah($get_penjualan->invoice_bayar_lama) ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Sisa Hutang</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                            </div>
                                            <input type="text" autocomplete="off" class="form-control" value="<?= rupiah($get_penjualan->invoice_kembali) ?>" readonly>
                                        </div>
                                    </div>

                                    <?php if ($get_penjualan->invoice_piutang_lunas != 1) : ?>
                                        <div class="form-group">
                                            <label for="">Nominal Cicilan</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                                </div>
                                                <input type="text" name="piutang_nominal" autocomplete="off" id="piutang_nominal" class="form-control" value="0">
                                            </div>
                                            <small class="text-danger"><?= form_error('piutang_nominal') ?></small>
                                        </div>
                                    <?php endif; ?>
                                </div>

                            </div>

                            <input type="hidden" name="invoice_total" value="<?= $get_penjualan->invoice_total ?>">
                            <input type="hidden" name="invoice_kembali" value="<?= $get_penjualan->invoice_kembali ?>">
                            <input type="hidden" name="invoice_bayar" value="<?= $get_penjualan->invoice_bayar ?>">

                            <?php if ($get_penjualan->invoice_piutang_lunas != 1) : ?>
                                <button type="submit" class="btn btn-success mt-4 float-right"><i class="fe-save"></i> Simpan</button>
                            <?php endif; ?>
                            <a href="<?= base_url('penjualan/piutang') ?>" class="btn btn-secondary mt-4"><i class="fe-arrow-left"></i> Kembali</a>
                            <?= form_close() ?>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->

            </div>
            <!-- end row-->

            <div class="row">
                <div class="col-lg">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <h4 class="header-title mb-2">Riwayat Cicilan Piutang</h4>

                            <table id="basic-datatable" class="table nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Nominal</th>
                                        <th>Pembayaran</th>
                                        <th>Kasir</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php $no = 1;
                                    foreach ($get_piutang as $data) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $data->piutang_date_time ?></td>
                                            <td>Rp.<?= rupiah($data->piutang_nominal) ?></td>
                                            <td>
                                                <?php if ($data->piutang_tipe_pembayaran == 1) : ?>
                                                    <h4>
                                                        <div class="badge badge-outline-success"><i class="mdi mdi-cash"></i> Cash</div>
                                                    </h4>
                                                <?php else : ?>
                                                    <h4>
                                                        <div class="badge badge-outline-info"><i class="fe-credit-card"></i> Transfer</div>
                                                    </h4>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php $kasir = $this->db->get_where('tb_toko', ['toko_user_id' => $data->piutang_kasir])->row(); ?>
                                                <?= $kasir->toko_nama ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('penjualan/piutang/hapus/') . base64_encode($data->id_piutang) ?>" class="btn btn-outline-danger hapus" title="Hapus Riwayat Piutang" data-plugin="tippy" data-tippy-placement="top"><i class="fe-trash"></i> </a>
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

    <?php $this->load->view('template/footer'); ?>

    <script>
        if (document.getElementById('piutang_nominal')) {
            var hutang_nominal = document.getElementById('piutang_nominal');
            hutang_nominal.addEventListener('keyup', function(e) {
                hutang_nominal.value = formatRupiah(this.value);
            });
        }

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