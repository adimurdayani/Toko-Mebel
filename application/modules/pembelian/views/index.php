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
                            <h4 class="header-title mb-2">Tabel <?= $title ?></h4>
                            <form action="<?= base_url('pembelian/hapus_all/') ?>" method="POST" id="form-delete">

                                <a href="<?= base_url('pembelian/transaksi_cash') ?>" class="btn btn-outline-info mb-3"><i class="fe-plus"></i> Tambah Transaksi Pembelian</a>
                                <button type="submit" class="btn btn-outline-danger mb-3" id="hapus"><i class="fe-trash"></i> Hapus</button>

                                <table id="basic-datatable" class="table nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th style="width: 50px;"><input type="checkbox" id="chack-all"></th>
                                            <th class="text-center">Aksi</th>
                                            <th>No</th>
                                            <th class="text-center">Invoice</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Suplier</th>
                                            <th class="text-center">Total</th>
                                            <th class="text-center">Bayar</th>
                                            <th class="text-center">Kembali</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php $no = 1;
                                        foreach ($get_pembelian as $data) : ?>
                                            <?php if ($data->invoice_hutang == 0 && $data->invoice_kasir == $session->id) : ?>
                                                <tr>
                                                    <td><input type="checkbox" class="check-item" name="invoice_parent[]" value="<?= $data->invoice_parent ?>"></td>
                                                    <td class="text-center">
                                                        <a href="<?= base_url('pembelian/hapus/') . base64_encode($data->invoice_parent) ?>" class="btn btn-sm btn-danger hapus" title="Hapus Pembelian" data-plugin="tippy" data-tippy-placement="top"><i class="fe-trash"></i> </a>
                                                        <a href="<?= base_url('pembelian/invoice/detail_invoice/') . base64_encode($data->invoice_parent) ?>" class="btn btn-sm btn-info" title="Detail Invoice Pembelian" data-plugin="tippy" data-tippy-placement="top"><i class="fe-eye"></i></a>
                                                        <!-- <a href="<?= base_url('pembelian/invoice/detail/') . base64_encode($data->invoice_parent) ?>" class="btn btn-sm btn-warning" title="Retur Pembelian" data-plugin="tippy" data-tippy-placement="top"><i class="fe-edit"></i></a> -->
                                                        <a href="<?= base_url('pembelian/cetak_nota/') . base64_encode($data->invoice_parent) ?>" target="_blank" class="btn btn-sm btn-success" title="Cetak Nota" data-plugin="tippy" data-tippy-placement="top"><i class="fe-printer"></i> </a>
                                                    </td>
                                                    <td><?= $no++ ?></td>
                                                    <td class="text-center"><?= $data->invoice_pembelian ?></td>
                                                    <td class="text-center"><?= $data->invoice_created ?></td>
                                                    <td><?= $data->nama_perusahaan ?> </td>
                                                    <td class="text-right">Rp.<?= rupiah($data->invoice_total) ?></td>
                                                    <td class="text-right">Rp.<?= rupiah($data->invoice_bayar) ?></td>
                                                    <td class="text-right">Rp.<?= rupiah($data->invoice_kembali) ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </form>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->

            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->