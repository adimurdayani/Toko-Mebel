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
                                <li class="breadcrumb-item"><a href="<?= base_url('produksi') ?>">Produksi</a></li>
                                <li class="breadcrumb-item"><a href="<?= base_url('produksi/tambah') ?>">Tambah Produksi</a></li>
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
                            <div class="float-right">
                                <div class="auth-logo">
                                    <div class="logo logo-dark">
                                        <span class="logo-lg">
                                            <img src="<?= base_url('assets/images/upload/') . $get_config->logo_nota ?>" alt="" height="100">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="float-left">
                                <h4 class="m-0 d-print-none"><?= $title; ?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mt-3">
                                    <?php
                                    $jml = $this->db->get('tb_toko', ['toko_user_id' => $session->id])->num_rows();
                                    if ($jml != 0) {
                                        $toko = $this->db->get_where('tb_toko', ['toko_user_id' => $get_produksi->produksi_kasir])->row_array();
                                    } else {
                                        $toko = 0;
                                    } ?>
                                    <h6>Dari</h6>
                                    <address>
                                        <?= $toko['toko_nama'] ?><br>
                                        <?= $toko['toko_kota'] ?><br>
                                        <?= $toko['toko_alamat'] ?><br>
                                        <abbr title="Phone">P:</abbr> <?= $toko['toko_wa'] ?>
                                    </address>
                                </div>

                            </div><!-- end col -->
                            <div class="col-md-4 offset-md-2">
                                <div class="mt-3 float-right">
                                    <p class="m-b-10"><strong>Tanggal Order &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;</strong> <span class="float-right"> <?= $get_produksi->created_at ?></span></p>
                                    <p class="m-b-10"><strong>Order Status &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;</strong> <span class="float-right"><span class="badge badge-outline-primary"><?= $get_produksi->produksi_status ?></span></span></p>
                                    <p class="m-b-10"><strong>No. Invoice Produksi &nbsp;&nbsp;&nbsp;: </strong> <span class="float-right"><?= $get_produksi->produksi_invoice ?> </span></p>
                                </div>
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table mt-4 table-centered table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Nama Barang</th>
                                                <th class="text-center" style="width: 20%">Detail</th>
                                                <th class="text-center" style="width: 10%">Qty</th>
                                                <th class="text-center" style="width: 10%">Harga</th>
                                                <th style="width: 10%" class="text-right">Sub Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            $subtotal = 0;
                                            $total = 0;
                                            foreach ($get_invoice_produksi as $data) :
                                                $subtotal  = $data->detail_barang_qty * $data->detail_harga_modal;
                                                $total += $subtotal;
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?= $no++ ?></td>
                                                    <td><?= $data->barang_nama ?></td>
                                                    <td>
                                                        <?php if ($data->detail_kategori_barang == 7) : ?>
                                                            <hr>
                                                            <strong>Detail Terpakai</strong>
                                                            <ul>
                                                                <li>Panjang:</li>
                                                                <ul>
                                                                    <li><?= $data->detail_barang_panjang ?> Cm</li>
                                                                </ul>
                                                                <li>Lebar:</li>
                                                                <ul>
                                                                    <li><?= $data->detail_barang_panjang ?> Cm</li>
                                                                </ul>
                                                            </ul>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="text-center"><?= $data->detail_barang_qty ?></td>
                                                    <td class="text-right">Rp.<?= rupiah($data->detail_harga_modal) ?></td>
                                                    <td class="text-right">Rp.<?= rupiah($subtotal) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td colspan="5" class="text-right"><strong>Total</strong></td>
                                                <td class="text-right"><strong>Rp.<?= rupiah($total) ?></strong></td>
                                            </tr>
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
                                    <p><b>Total Harga Jual &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</b> <span class="float-right">Rp.<?= rupiah($total) ?></span></p>
                                    <h3 class="text-success">Rp.<?= rupiah($total) ?></h3>
                                </div>
                                <div class="clearfix"></div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="mt-4 mb-1">
                            <div class="text-right d-print-none">
                                <a href="javascript:history.go(-1)" class="btn btn-secondary waves-effect waves-light"><i class="fe-arrow-left"></i> Kembali</a>
                                <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-printer mr-1"></i> Print</a>
                            </div>
                        </div>
                    </div> <!-- end card-box -->
                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->