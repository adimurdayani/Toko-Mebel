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
                <div class="col-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-lg-6">
                                <h4>Input No. Invoice</h4>
                                <small class="pt-0">Tanggal: &nbsp;<?= date_indo('Y-m-d') ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Jam: &nbsp;<?= date('H:i:s a') ?></small>
                            </div>
                            <div class="col-lg-6">
                                <form method="POST" class="float-right" action="<?= base_url('home') ?>">
                                    <div class="form-group">
                                        <label for="invoice" class="sr-only">Search</label>
                                        <div class="input-group">
                                            <input type="search" class="form-control" autocomplete="off" autofocus id="invoice" name="invoice" placeholder="Search...">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-success waves-effect waves-light"><i class="fe-search mr-1"></i> Check</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div> <!-- end row -->
                    </div> <!-- end card-box -->
                </div> <!-- end col-->
            </div>
            <!-- end row-->

            <div class="row">
                <?php if ($get_penjualan_detail != null) : ?>
                    <?php foreach ($get_penjualan_detail as $data) :
                        $penjualan  = $this->db->get('tb_penjualan', ['penjualan_invoice' => $data['penjualan_invoice']])->row_array();

                        $kostumer = $this->db->get_where('tb_kostumer', ['id_kostumer' => $penjualan['invoice_costumer']])->row_array();
                    ?>
                        <div class="col-md-6 col-xl-3">
                            <div class="card-box product-box">

                                <div class="product-action">
                                    <a href="javascript: void(0);" class="btn btn-success btn-xs waves-effect waves-light"><i class="mdi mdi-eye"></i></a>
                                </div>

                                <div class="bg-light">
                                    <img src="<?= base_url('assets/images/') ?>pack.webp" alt="product-pic" class="img-fluid" />
                                </div>

                                <div class="product-info">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h5 class="font-16 mt-0 sp-line-1"><a href="#" class="text-dark"><?= $data['produksi_nama'] ?></a> </h5>
                                            <div class="text-warning mb-2 font-13">
                                                <strong>Pesanan Dari: </strong><br>
                                                <small class="text-muted">An: <?= $kostumer['nama'] ?><br>Phone: <?= $kostumer['phone'] ?><br>Alamat: <?= $kostumer['alamat'] ?></small>
                                            </div>
                                            <h6 class="m-0"> <span class="text-muted"> No. Invoice : <strong>#<?= $data['penjualan_invoice'] ?></strong></span></h6>
                                        </div>
                                        <div class="col-auto">
                                            <div class="badge badge-success">
                                                <h6>Proses</h6>
                                            </div>
                                        </div>
                                    </div> <!-- end row -->
                                </div> <!-- end product info-->
                            </div> <!-- end card-box-->
                        </div> <!-- end col-->
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->