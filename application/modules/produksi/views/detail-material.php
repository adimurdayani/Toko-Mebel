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
                        <div class="mt-2 mb-1">
                            <div class="d-print-none">
                                <a href="javascript:history.go(-1)" class="btn btn-secondary waves-effect waves-light"><i class="fe-arrow-left"></i> Kembali</a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table mt-2 table-centered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Nama Barang</th>
                                                <th class="text-center" style="width: 20%">Detail</th>
                                                <th class="text-center" style="width: 10%">Qty</th>
                                                <th class="text-center" style="width: 10%">Harga Modal</th>
                                                <th style="width: 10%" class="text-right">Sub Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            $subtotal = 0;
                                            foreach ($get_invoice_produksi as $data) :
                                                $subtotal  = $data->detail_barang_qty * $data->detail_harga_jual
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
                                                    <td class="text-right">Rp.<?= rupiah($data->detail_harga_jual) ?></td>
                                                    <td class="text-right">Rp.<?= rupiah($subtotal) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div> <!-- end table-responsive -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div> <!-- end card-box -->
                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->