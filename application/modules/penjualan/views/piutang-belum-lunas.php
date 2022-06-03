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
                                        <th>Kostumer</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php $no = 1;
                                    foreach ($get_penjualan_hutang as $data) : ?>
                                        <?php if ($data->invoice_piutang == 1) : ?>
                                            <tr>
                                                <td class="text-center">
                                                    <a href="<?= base_url('penjualan/invoice/detail_invoice_piutang/') . base64_encode($data->penjualan_invoice) ?>" class="btn btn-outline-info" title="Detail Invoice Penjualan" data-plugin="tippy" data-tippy-placement="top"><i class="fe-eye"></i></a>
                                                    <a href="<?= base_url('penjualan/piutang/cicilan_piutang/') . base64_encode($data->penjualan_invoice) ?>" class="btn btn-outline-warning" title="Cicilan Hutang" data-plugin="tippy" data-tippy-placement="top"><i class="mdi mdi-cash-plus"></i> </a>
                                                    <a href="<?= base_url('penjualan/cetak_nota_hutang/') . base64_encode($data->penjualan_invoice) ?>" target="_blank" class="btn btn-outline-success" title="Cetak Nota Hutang" data-plugin="tippy" data-tippy-placement="top"><i class="fe-printer"></i> </a>
                                                </td>
                                                <td><?= $no++ ?></td>
                                                <td><?= $data->penjualan_invoice ?></td>
                                                <td><?= $data->invoice_tgl ?></td>
                                                <td><?= $data->nama ?> </td>
                                                <td><?= $data->invoice_piutang_jatuh_tempo ?> </td>
                                                <td>Rp.<?= rupiah($data->invoice_total) ?></td>
                                            </tr>
                                        <?php endif; ?>
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