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
                                <li class="breadcrumb-item active"><a href="<?= base_url('pembelian/invoice_pembelian') ?>">Invoice Pembelian</a></li>
                                <li class="breadcrumb-item active"><?= $title ?></li>
                            </ol>
                        </div>
                        <h4 class="page-title"><?= $title ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <?= form_open_multipart('berita/post_berita') ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="invoice">No. Invoice</label>
                                        <input type="number" name="invoice" id="invoice" class="form-control" placeholder="Input invoice">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Kode Barang</label>
                                        <select name="invoice_barang_id" id="invoice_barang_id" class="form-control" data-toggle="select2">
                                            <option value="">-- Pilih Kode Barang --</option>
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- basic summernote-->

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Harga Beli</th>
                                        <th>QTY</th>
                                        <th>Sub Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Suplier</label>
                                        <select name="invoice_suplier" id="invoice_suplier" class="form-control" data-toggle="select2">
                                            <option value="">-- Pilih Suplier --</option>
                                            <option value=""></option>
                                        </select>
                                        <small class="mt-0"><a href=""><i class="fe-plus"></i> Tambah Suplier</a></small>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col ml-4">
                                            <table>
                                                <tr>
                                                    <td style="width: 100px;">
                                                        <h4>Total</h4>
                                                    </td>
                                                    <td>Rp.</td>
                                                    <td>0</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h4>Bayar</h4>
                                                    </td>
                                                    <td>Rp.</td>
                                                    <td><input type="number" name="invoice_bayar" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5>Kembali</h5>
                                                    </td>
                                                    <td>Rp.</td>
                                                    <td></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <a href="" class="btn btn-outline-success mt-4 float-right"><i class="fe-credit-card"></i> Simpan Payment</a>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->

            </div> <!-- container -->
            <?= form_close() ?>

        </div> <!-- content -->