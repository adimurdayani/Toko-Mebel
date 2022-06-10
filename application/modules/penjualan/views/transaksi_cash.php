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
                                <li class="breadcrumb-item active"><a href="<?= base_url('penjualan') ?>">Invoice Penjualan</a></li>
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
                    <div class="card">
                        <div class="card-body table-responsive">

                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a href="#cash" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                        Cash
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('penjualan/transaksi_hutang/') ?>" class="nav-link ">
                                        Hutang
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">

                                <?php
                                if ($get_jml_penjualan < 1) {
                                    $jml_penjualan = 0;
                                } else {
                                    $this->db->order_by('invoice_id', 'desc');
                                    $this->db->where('invoice_cabang', $session->id);
                                    $penjualan = $this->db->get('tb_penjualan')->row();
                                    $jml_penjualan = $penjualan->penjualan_invoice_count;
                                }
                                $jml_penjualan = $jml_penjualan + 1;
                                $today = date("Ymd");
                                $no_invoice = $today . $jml_penjualan;
                                ?>

                                <div class="tab-pane  show active" id="cash">

                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <h4>No.Invoice: &nbsp; <?= $no_invoice; ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <select name="invoice_barang_id" id="invoice_barang_id" class="form-control" data-toggle="select2">
                                                            <option value="">-- Kode Barang --</option>
                                                            <?php foreach ($get_barang as $kode) : ?>
                                                                <?php if ($kode->is_active > 0) : ?>
                                                                    <option value="<?= $kode->id_produksi  ?>"><?= $kode->produksi_invoice ?> - <?= $kode->produksi_nama ?> - Rp.<?= rupiah($kode->produksi_harga_total) ?></option>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <button class="btn btn-info waves-effect waves-light" type="button" title="Cara data barang" data-plugin="tippy" data-tippy-placement="top" data-toggle="modal" data-target="#databarang"><i class="fe-search"></i> Cari</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- basic summernote-->

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">Harga</th>
                                                <th class="text-center">QTY</th>
                                                <th class="text-center">Sub Total</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $total = 0;
                                            $total_beli = 0;
                                            foreach ($get_penjualan_keranjang as $gpk) :
                                                $id_barang      = $gpk->barang_id;
                                                $stok_parent    = $this->db->get_where('tb_produksi', ['id_produksi ' => $id_barang])->row();
                                                $stok           = $stok_parent->produksi_stok;

                                                $sub_total_beli = +$gpk->keranjang_harga_beli * $gpk->keranjang_qty;
                                                $sub_total      = +$gpk->keranjang_harga * $gpk->keranjang_qty;

                                                $user_group     = $this->db->get_where('users_groups', ['user_id' => $session->id])->row();
                                            ?>
                                                <?php if ($gpk->keranjang_id_kasir == $user_group->group_id) :
                                                    $total_beli += $sub_total_beli;
                                                    $total      += $sub_total;
                                                ?>
                                                    <tr>
                                                        <td class="text-center"><?= $no++ ?></td>
                                                        <td><?= $gpk->keranjang_nama ?></td>
                                                        <td class="text-right">
                                                            Rp.<?= rupiah($gpk->keranjang_harga) ?>
                                                        </td>
                                                        <td class="text-center"> <?= $gpk->keranjang_qty ?> </td>
                                                        <td class="text-right">Rp.<?= rupiah($sub_total) ?></td>
                                                        <td class="text-center">
                                                            <a href="javascript:void(0);" class="btn btn-outline-warning" data-target="#edit<?= $gpk->keranjang_id ?>" data-toggle="modal" title="Edit Data" data-plugin="tippy" data-tippy-placement="top"><i class="fe-edit"></i> </a>
                                                            <a href="<?= base_url('penjualan/transaksi_cash/hapus_keranjang/') . base64_encode($gpk->keranjang_id) ?>" class="btn btn-outline-danger hapus" title="Hapus Barang" data-plugin="tippy" data-tippy-placement="top"><i class="fe-trash"></i> </a>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>

                                    <?php echo form_open("penjualan/transaksi_cash/kirim_all_penjualan") ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Kostumer</label>
                                                <select name="invoice_kostumer" id="invoice_kostumer" class="form-control" data-toggle="select2" required>
                                                    <option value="">-- Pilih Suplier --</option>
                                                    <option value="0">Umum</option>
                                                    <?php foreach ($get_kostumer as $kostumer) : ?>
                                                        <?php if ($kostumer->status_kostumer == 1) : ?>
                                                            <option value="<?= $kostumer->id_kostumer ?>"><?= $kostumer->nama ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach ?>
                                                </select>
                                                <small class="mt-0"><a href="<?= base_url('kostumer/tambah_kostumer') ?>"><i class="fe-plus"></i> Tambah Kostumer</a></small>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Tipe Pembayaran</label>
                                                <select name="invoice_tipe_pembayaran" id="invoice_tipe_pembayaran" class="form-control" required>
                                                    <option value="">-- Pilih Pembayaran --</option>
                                                    <option value="0">Cash</option>
                                                    <option value="1">Transfer</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col ml-6">
                                                <h4>Total &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Rp.<input type="text" style="border: 0px;" autocomplete="off" id="angka1" name="total" value="<?= $total ?>" readonly></h4>

                                                <div class="row mt-3">
                                                    <div class="col-md-2">
                                                        <h4 class="text-success">Bayar.</h4>
                                                    </div>
                                                    <div class="col">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                                            </div>
                                                            <input type="number" autocomplete="off" id="angka2" name="bayar" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <p class="text-danger mt-3">Kembalian &nbsp;&nbsp;&nbsp;&nbsp; Rp.<input type="text" style="border: 0px;" autocomplete="off" id="angka3" value="<?= $total - $total - $total ?>" name="kembali" disabled></p>

                                            </div>
                                        </div>
                                    </div>
                                    <?php foreach ($get_penjualan_keranjang as $gk) : ?>
                                        <input type="hidden" name="barang_id[]" value="<?= $gk->barang_id; ?>">
                                        <input type="hidden" min="1" name="keranjang_qty[]" value="<?= $gk->keranjang_qty; ?>">
                                        <input type="hidden" name="keranjang_harga_beli[]" value="<?= $gk->keranjang_harga_beli; ?>">
                                        <input type="hidden" name="keranjang_harga[]" value="<?= $gk->keranjang_harga; ?>">
                                        <input type="hidden" name="penjualan_invoice[]" value="<?= $no_invoice; ?>">
                                    <?php endforeach; ?>
                                    <input type="hidden" name="penjualan_invoice_count" value="<?= $jml_penjualan; ?>">
                                    <input type="hidden" name="penjualan_invoice_get" value="<?= $no_invoice; ?>">
                                    <input type="hidden" name="invoice_total_beli" value="<?= $total_beli; ?>">


                                    <?php if ($get_keranjang_jml < 1) : ?>
                                        <button type="submit" class="btn btn-success mt-4 float-right"><i class="fe-credit-card"></i> Simpan Payment</button>
                                    <?php endif; ?>

                                    <?php if ($get_keranjang_jml > 0) : ?>
                                        <a href="javascript:void(0);" class="btn btn-secondary mt-4 float-right btn-disabled"><i class="fe-credit-card"></i> Simpan Payment</a>
                                    <?php endif; ?>
                                    <?php echo form_close() ?>

                                </div>

                            </div>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->

            </div> <!-- container -->

        </div> <!-- content -->

        <!-- Tambah modal -->
        <?php foreach ($get_penjualan_keranjang as $edit) : ?>
            <div id="edit<?= $edit->keranjang_id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Barang</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <?php echo form_open("penjualan/transaksi_cash/edit_data"); ?>
                        <div class="modal-body p-4">

                            <input type="hidden" name="keranjang_id" value="<?= base64_encode($edit->keranjang_id) ?>">
                            <div class="form-group mb-3">
                                <label for="keranjang_harga">Harga <span class="text-danger">*</span></label>
                                <input type="number" id="keranjang_harga" name="keranjang_harga" class="form-control" value="<?= $edit->keranjang_harga ?>" require>
                            </div>

                            <div class="form-group mb-3">
                                <label for="keranjang_qty">Edit QTY <span class="text-danger">*</span></label>
                                <input type="number" id="keranjang_qty" name="keranjang_qty" class="form-control" value="<?= $edit->keranjang_qty ?>" require>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal"><i class="fe-arrow-left"></i> Tutup</button>
                            <button type="submit" class="btn btn-outline-warning"><i class="fa fa-save"></i> Update</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div><!-- /.modal -->
        <?php endforeach; ?>


        <!-- Tambah modal -->
        <div id="databarang" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Data Barang Keseluruhan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">

                        <div class="table-responsive">
                            <table class="table table-hover" id="basic-datatable">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th class="text-center">Kode Produksi</th>
                                        <th class="text-center">Nama Barang</th>
                                        <th class="text-center">Harga</th>
                                        <th class="text-center">Stok</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($get_barang as $data) : ?>
                                        <?php if ($data->is_active > 0) : ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td><?= $data->produksi_invoice ?></td>
                                                <td><?= $data->produksi_nama ?></td>
                                                <td>Rp.<?= rupiah($data->produksi_harga_total) ?></td>
                                                <td>
                                                    <?php if ($data->produksi_stok > 0) : ?>
                                                        <?= $data->produksi_stok ?>
                                                    <?php else : ?>
                                                        <div class="badge badge-outline-danger">Habis</div>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if ($data->produksi_stok < 1) : ?>
                                                        <button type="button" class="btn btn-outline-danger btn-sm btn-disabled"><i class="fe-x"></i> Habis</button>
                                                    <?php elseif ($data->produksi_stok < 3) : ?>
                                                        <button type="button" class="btn btn-outline-warning btn-sm idproduksi" id="idproduksi" data-idproduksi="<?= $data->id_produksi; ?>"> Stok Sedikit</button>
                                                    <?php else : ?>
                                                        <button type="button" id="idproduksi" data-idproduksi="<?= $data->id_produksi; ?>" class="btn btn-outline-success btn-sm idproduksi"><i class="fe-shopping-cart"></i> Pilih</button>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal"><i class="fe-arrow-left"></i> Tutup</button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal -->

        <?php $this->load->view('template/footer'); ?>

        <script>
            $(document).ready(function() {
                $('#angka1, #angka2').keyup(function() {
                    var total_hargabarang = $('#angka1').val();
                    var bayar = (isNaN($('#angka2').val())) ? 0 : $('#angka2').val();

                    var jml = parseInt(bayar) - parseInt(total_hargabarang);
                    if (bayar != 0) {
                        $('#angka3').val(jml);
                    } else {
                        $('#angka3').val();
                    }
                })

            });

            $('.idproduksi').on('click', function() {
                const idproduksi = $(this).data('idproduksi');
                console.log(idproduksi);

                $.ajax({
                    url: "<?= base_url('penjualan/transaksi_cash/input_idbarang_dua') ?>",
                    type: 'post',
                    data: {
                        idproduksi: idproduksi
                    },
                    success: function() {
                        Swal.fire({
                            type: "success",
                            title: "Sukses",
                            text: "Barang berhasil ditambahkan ke keranjang!"
                        })
                        document.location.href = "<?= base_url('penjualan/transaksi_cash') ?>";
                    }
                })
            });

            $('#invoice_barang_id').on('change', function() {
                const id_produksi = $('#invoice_barang_id').val();
                console.log(id_produksi);

                $.ajax({
                    url: "<?= base_url('penjualan/transaksi_cash/input_idbarang') ?>",
                    type: 'post',
                    data: {
                        id_produksi: id_produksi
                    },
                    success: function() {
                        Swal.fire({
                            type: "success",
                            title: "Sukses",
                            text: "Barang berhasil ditambahkan ke keranjang!"
                        })
                        document.location.href = "<?= base_url('penjualan/transaksi_cash') ?>";
                    }
                })
            });

            function formatRupiah(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }
        </script>