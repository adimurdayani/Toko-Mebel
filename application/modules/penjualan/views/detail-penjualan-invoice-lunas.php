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
                                <li class="breadcrumb-item"><a href="<?= base_url('penjualan') ?>">Invoice Penjualan</a></li>
                                <li class="breadcrumb-item"><a href="<?= base_url('penjualan/transaksi_cash') ?>">Transaksi</a></li>
                                <li class="breadcrumb-item active"><?= $title; ?></li>
                            </ol>
                        </div>
                        <h4 class="page-title"><?= $title; ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <!-- Logo & title -->
                        <div class="clearfix">
                            <div class="float-left">
                                <div class="auth-logo">
                                    <div class="logo logo-dark">
                                        <span class="logo-lg">
                                            <img src="<?= base_url() ?>assets/images/logo-dark.png" alt="" height="22">
                                        </span>
                                    </div>

                                    <div class="logo logo-light">
                                        <span class="logo-lg">
                                            <img src="<?= base_url() ?>assets/images/logo-light.png" alt="" height="22">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="float-right">
                                <h4 class="m-0 d-print-none"><?= $title; ?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mt-3">
                                    <p><b>Hello, <?= $get_kostumer->nama ?></b></p>
                                    <p class="text-muted">Thanks a lot because you keep purchasing our products. Our company
                                        promises to provide high quality products for you as well as outstanding
                                        customer service for every transaction. </p>
                                </div>

                            </div><!-- end col -->
                            <div class="col-md-4 offset-md-2">
                                <div class="mt-3 float-right">
                                    <p class="m-b-10"><strong>Tanggal Order &nbsp;: </strong> <span class="float-right"> &nbsp;&nbsp;&nbsp;&nbsp; <?= $get_kostumer->invoice_tgl ?></span></p>
                                    <p class="m-b-10"><strong>Order Status &nbsp;&nbsp;&nbsp;&nbsp;: </strong> <span class="float-right"><span class="badge badge-outline-success">Lunas</span></span></p>
                                    <p class="m-b-10"><strong>No. Invoice &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </strong> <span class="float-right"><?= $get_kostumer->penjualan_invoice ?> </span></p>
                                </div>
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row mt-3">
                            <div class="col-sm-6">
                                <h6>Dari</h6>
                                <address>
                                    Stanley Jones<br>
                                    795 Folsom Ave, Suite 600<br>
                                    San Francisco, CA 94107<br>
                                    <abbr title="Phone">P:</abbr> (123) 456-7890
                                </address>
                            </div> <!-- end col -->

                            <div class="col-sm-6">
                                <h6>Kostumer</h6>
                                <address>
                                    <?= $get_kostumer->nama ?><br>
                                    <?= $get_kostumer->alamat ?><br>
                                    <abbr title="Phone">P:</abbr> <?= $get_kostumer->phone ?><br>
                                    <strong>Email: </strong> &nbsp; <?php if ($get_kostumer->email == null) : ?> - <?php else : ?> <?= $get_kostumer->email ?> <?php endif; ?><br>
                                    <strong>Nama Kurir: </strong>&nbsp; -<br>
                                    <strong>Tipe Pembayaran: </strong> &nbsp; <?php if ($get_kostumer->invoice_tipe_transaksi == 1) : ?>Transfer <?php else : ?>Cash <?php endif; ?>
                                </address>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table mt-4 table-centered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Barang</th>
                                                <th style="width: 10%">Harga Beli</th>
                                                <th style="width: 10%">Qty</th>
                                                <th style="width: 10%" class="text-right">Sub Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            foreach ($get_invoice_penjualan as $data) :
                                                $subtotal = $data->keranjang_harga * $data->barang_qty;
                                            ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $data->barang_nama ?></td>
                                                    <td>Rp.<?= rupiah($data->keranjang_harga) ?></td>
                                                    <td><?= $data->barang_qty ?></td>
                                                    <td>Rp.<?= rupiah($subtotal) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div> <!-- end table-responsive -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="clearfix pt-5">
                                    <h6 class="text-muted">Notes:</h6>

                                    <small class="text-muted">
                                        Halaman ini telah ditingkatkan untuk dicetak. Klik tombol cetak di bagian bawah faktur.
                                    </small>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-sm-6">
                                <div class="float-right">
                                    <p><b>Total:</b> <span class="float-right">Rp.<?= rupiah($get_kostumer->invoice_total) ?></span></p>
                                    <p><b class="text-success">Bayar:</b> <span class="float-right"> &nbsp;&nbsp;&nbsp; Rp.<?= rupiah($get_kostumer->invoice_bayar) ?></span></p>
                                    <p><b class="text-danger">Kembali:</b> <span class="float-right"> &nbsp;&nbsp;&nbsp; Rp.<?= rupiah($get_kostumer->invoice_kembali) ?></span></p>
                                    <h3 class="text-success">Rp.<?= rupiah($get_kostumer->invoice_total) ?></h3>
                                </div>
                                <div class="clearfix"></div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="mt-4 mb-1">
                            <div class="text-right d-print-none">
                                <a href="<?= base_url('penjualan/piutang/lunas') ?>" class="btn btn-secondary waves-effect waves-light"><i class="fe-arrow-left"></i> Kembali</a>
                                <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-printer mr-1"></i> Print</a>
                            </div>
                        </div>
                    </div> <!-- end card-box -->
                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->