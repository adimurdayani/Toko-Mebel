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
                            <?php if ($get_pembelian->invoice_hutang == 0) : ?>
                                <div class="badge badge-outline-success">Lunas</div>
                            <?php else : ?>
                                <div class="badge badge-outline-danger">Belum Lunas</div>
                                <small class="text-danger">Jatuh Tempo: <?= $get_pembelian->invoice_hutang_jatuh_tempo ?></small>
                            <?php endif; ?>
                        </h4>
                        <h4>No. Invoice: <?= $get_pembelian->invoice_pembelian ?></h4>

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
                                    <input type="hidden" name="hutang_date" value="<?= $get_pembelian->invoice_tgl ?>">
                                    <input type="hidden" name="hutang_invoice" value="<?= $get_pembelian->invoice_pembelian ?>">
                                    <input type="hidden" name="hutang_invoice_parent" value="<?= $get_pembelian->invoice_parent ?>">
                                    <?php if ($get_pembelian->invoice_kembali == 0) : ?>
                                        <input type="hidden" name="invoice_kembali" value="0">
                                    <?php endif; ?>
                                    <input type="hidden" name="hutang_cabang" value="<?= $session->id ?>">
                                    <div class="form-group">
                                        <label for="">Sub Total</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                            </div>
                                            <input type="text" name="" id="" class="form-control" readonly value="<?= rupiah($get_pembelian->invoice_total) ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Total Cicilan</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                            </div>
                                            <?php if (isset($get_total_cicilan->hutang_nominal)) : ?>
                                                <input type="text" name="" id="" class="form-control" readonly value="<?= rupiah($get_total_cicilan->hutang_nominal) ?>">
                                            <?php else : ?>
                                                <input type="text" name="invoice_cicilan" id="" class="form-control" readonly value="0">
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <?php if ($get_pembelian->invoice_hutang != 0) : ?>
                                        <div class="form-group">
                                            <label for="">Nominal Cicilan</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                                </div>
                                                <input type="number" name="hutang_nominal" id="hutang_nominal" class="form-control" value="0">
                                            </div>
                                            <small class="text-danger"><?= form_error('hutang_nominal') ?></small>
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
                                            <input type="text" name="" id="" class="form-control" readonly value="<?= rupiah($get_pembelian->invoice_bayar_lama) ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Sisa Hutang</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                            </div>
                                            <input type="text" name="" id="" class="form-control" readonly value="<?= rupiah($get_pembelian->invoice_kembali) ?>">
                                        </div>
                                    </div>

                                    <?php if ($get_pembelian->invoice_hutang != 0) : ?>
                                        <div class="form-group">
                                            <label for="">Tipe Pembayaran</label>
                                            <select name="hutang_tipe_pembayaran" id="hutang_tipe_pembayaran" class="form-control">
                                                <option value="">-- Pilih Pembayaran --</option>
                                                <option value="1">Cash</option>
                                                <option value="2">Transfer</option>
                                            </select>
                                            <small class="text-danger"><?= form_error('hutang_tipe_pembayaran') ?></small>
                                        </div>
                                    <?php endif; ?>
                                </div>

                            </div>
                            <?php if ($get_pembelian->invoice_hutang != 0) : ?>
                                <button type="submit" class="btn btn-success mt-4 float-right"><i class="fe-save"></i> Simpan</button>
                            <?php endif; ?>
                            <a href="<?= base_url('pembelian/belum_lunas') ?>" class="btn btn-secondary mt-4"><i class="fe-arrow-left"></i> Kembali</a>
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
                            <h4 class="header-title mb-2">Riwayat Cicilan</h4>

                            <table id="basic-datatable" class="table nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Nominal</th>
                                        <th>Pembayaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php $no = 1;
                                    foreach ($get_hutang as $data) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $data->hutang_date_time ?></td>
                                            <td>Rp.<?= rupiah($data->hutang_nominal) ?></td>
                                            <td>
                                                <?php if ($data->hutang_tipe_pembayaran == 1) : ?>
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
                                                <a href="<?= base_url('pembelian/belum_lunas/hapus/') . base64_encode($data->hutang_id) ?>" class="btn btn-outline-danger" title="Hapus Riwayat Hutang" data-plugin="tippy" data-tippy-placement="top"><i class="fe-trash"></i> </a>
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