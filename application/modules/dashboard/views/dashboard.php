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
                        <h4 class="page-title"><?= $title ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-md-6">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded bg-soft-primary">
                                    <i class="dripicons-wallet font-24 avatar-title text-primary"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1">Rp.<span data-plugin="counterup"><?= rupiah($total_pendapatan->invoice_sub_total) ?> </span></h3>
                                    <p class="text-muted mb-1 text-truncate">Total Pendapatan</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded bg-soft-success">
                                    <i class="dripicons-document font-24 avatar-title text-success"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"><?= $total_invoice_penjualan_cash ?></span></h3>
                                    <p class="text-muted mb-1 text-truncate">Invoice Penjualan Cash</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->
            </div>
            <div class="row">
                <?php $barang_terjual = 0;
                foreach ($total_barang as $barang) : ?>
                    <?php $barang_terjual += $barang->barang_terjual; ?>
                <?php endforeach; ?>
                <div class="col-md-4">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded bg-soft-info">
                                    <i class="dripicons-basket font-24 avatar-title text-info"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"><?= $barang_terjual ?></span></h3>
                                    <p class="text-muted mb-1 text-truncate">Total Barang Terjual</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-4">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded bg-soft-warning">
                                    <i class="dripicons-box font-24 avatar-title text-warning"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"><?= $jml_barang ?></span></h3>
                                    <p class="text-muted mb-1 text-truncate">Jumlah Barang</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-4">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded bg-soft-warning">
                                    <i class="dripicons-document font-24 avatar-title text-warning"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"><?= $jml_invoice_penjualan; ?></span></h3>
                                    <p class="text-muted mb-1 text-truncate">Total Invoice Penjualan</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->
            </div>
            <!-- end row-->
            <div class="row">
                <div class="col-lg-4">
                    <div class="card-box">

                        
                    </div> <!-- end card-box -->
                </div>
                <div class="col-lg-8">
                    <div class="card-box pb-2">

                    </div> <!-- end card-box -->
                </div> <!-- end col-->
            </div>

        </div> <!-- container -->

    </div> <!-- content -->