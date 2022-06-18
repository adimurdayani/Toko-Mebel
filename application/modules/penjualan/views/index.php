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
                            <table id="basic-datatable" class="table nowrap w-100">
                                <thead>
                                    <tr>
                                        <th class="text-center">Aksi</th>
                                        <th>No</th>
                                        <th>Invoice</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Costumer</th>
                                        <th>Kasir</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php $no = 1;
                                    foreach ($get_penjualan_invoice as $data) : ?>
                                        <tr>
                                            <td class="text-center">
                                                <a href="<?= base_url('penjualan/detail_invoice/') . base64_encode($data->penjualan_invoice) ?>" class="btn btn-sm btn-success" title="Detail Invoice Penjualan" data-plugin="tippy" data-tippy-placement="top"><i class="fe-eye"></i></a>
                                                <!-- <a href="<?= base_url('penjualan/detail_invoice/') . base64_encode($data->penjualan_invoice) ?>" class="btn btn-sm btn-warning" title="Retur Penjualan" data-plugin="tippy" data-tippy-placement="top"><i class="fe-edit"></i></a> -->
                                                <a href="javascript:void(0);" data-target="#edit-kurir<?= $data->invoice_id ?>" class="btn btn-sm btn-secondary" data-toggle="modal" title="Edit Kurir" data-plugin="tippy" data-tippy-placement="top"><i class="fe-user-plus"></i></a>
                                                <a href="<?= base_url('penjualan/cetak_nota/') . base64_encode($data->penjualan_invoice) ?>" target="_blank" class="btn btn-sm btn-primary" title="Cetak Nota" data-plugin="tippy" data-tippy-placement="top"><i class="fe-printer"></i></a>
                                                <a href="<?= base_url('penjualan/surat_jalan/') . base64_encode($data->penjualan_invoice) ?>" target="_blank" class="btn btn-sm btn-blue" title="Cetak Surat Jalan" data-plugin="tippy" data-tippy-placement="top"><i class="fe-file"></i></a>
                                            </td>
                                            <td><?= $no++ ?></td>
                                            <td><?= $data->penjualan_invoice ?></td>
                                            <td><?= $data->invoice_tgl ?></td>
                                            <td>
                                                <?= $data->nama ?>
                                            </td>
                                            <td><?= $data->first_name ?> </td>
                                            <td>Rp.<?= rupiah($data->invoice_total) ?></td>
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

    <!-- edit modal content -->
    <?php foreach ($get_penjualan_invoice as $edit) : ?>
        <div id="edit-kurir<?= $edit->invoice_id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Kurir</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <?php echo form_open("penjualan/edit_kurir"); ?>
                    <div class="modal-body p-4">
                        <input type="hidden" name="invoice_id" value="<?= base64_encode($edit->invoice_id) ?>">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="invoice_kurir" class="control-label">Nama Kurir <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="invoice_kurir" value="<?= $edit->invoice_kurir ?>" placeholder=" Input nama kurir">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal"><i class="fe-arrow-left"></i> Tutup</button>
                        <button type="submit" class="btn btn-outline-success waves-effect waves-light"><i class="fe-save"></i> Simpan</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div><!-- /.modal -->
    <?php endforeach; ?>