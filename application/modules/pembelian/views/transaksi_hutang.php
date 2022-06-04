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
                                <li class="breadcrumb-item active"><a href="<?= base_url('pembelian') ?>">Invoice Pembelian</a></li>
                                <li class="breadcrumb-item active"><?= $title ?></li>
                            </ol>
                        </div>
                        <h4 class="page-title"><?= $title ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <?php
            $kode_barang = isset($get_pembelian_session['pembelian_input']);
            if ($kode_barang == null) {
                $kode_barang = 0;
            } else {
                $kode_barang = $kode_barang;
            }

            ?>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">

                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a href="<?= base_url('pembelian/transaksi_cash') ?>" class="nav-link">
                                        Cash
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#hutang" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                        Hutang
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">

                                <div class="tab-pane show active" id="hutang">

                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <h5>No.Invoice:</h5>
                                                    <input type="text" class="form-control" placeholder="Input no. invoice" name="invoice" value="<?= $kode_barang; ?>" id="invoice" readonly>
                                                    <?php if ($kode_barang == null) : ?>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-info waves-effect waves-light" title="Tambah no. invoice" data-plugin="tippy" data-tippy-placement="top" data-toggle="modal" data-target="#tambah" type="button"><i class="fe-plus"></i></button>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if ($kode_barang != null) : ?>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-warning waves-effect waves-light" title="Edit no. invoice" data-plugin="tippy" data-tippy-placement="top" data-toggle="modal" data-target="#edit" type="button"><i class="fe-edit"></i></button>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <select name="invoice_barang_id" id="invoice_barang_id" class="form-control" data-toggle="select2">
                                                            <option value="">Kode Barang</option>
                                                            <?php foreach ($get_kode as $kode) : ?>
                                                                <option value="<?= $kode->id_barang ?>"><?= $kode->barang_kode ?> - <?= $kode->barang_nama ?>- Rp.<?= rupiah($kode->barang_harga_beli) ?></option>
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
                                                <th class="text-center">Harga Beli</th>
                                                <th class="text-center">QTY</th>
                                                <th class="text-center">Sub Total</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            $total = 0;
                                            foreach ($get_keranjang as $k) :
                                                $sub_total = $k->keranjang_harga * $k->keranjang_qty;
                                                $user_group = $this->db->get_where('users_groups', ['user_id' => $session->id])->row();
                                                $stok = $this->db->get_where('tb_barang', ['id_barang' => $k->barang_id])->row();
                                            ?>
                                                <?php if ($k->keranjang_id_kasir == $user_group->group_id) : ?>
                                                    <?php $total += $sub_total; ?>
                                                    <tr>
                                                        <td class="text-center"><?= $no++ ?></td>
                                                        <td><?= $k->keranjang_nama ?></td>
                                                        <td>
                                                            Rp.<?= rupiah($k->keranjang_harga) ?>
                                                            <a href="javascript:void(0);" class="btn btn-outline-info waves-effect waves-light float-right" title="Edit harga beli" data-plugin="tippy" data-tippy-placement="top" data-toggle="modal" data-target="#hargabeli<?= $k->keranjang_id ?>"><i class="fe-edit"></i></a>
                                                        </td>
                                                        <td class="text-center" style="width: 150px;">
                                                            <?php echo form_open("pembelian/transaksi_hutang/edit_qty_hutang") ?>
                                                            <input type="hidden" name="keranjang_id" value="<?= base64_encode($k->keranjang_id) ?>">
                                                            <input type="hidden" name="id_barang" class="form-control" value="<?= base64_encode($k->barang_id) ?>">
                                                            <div class="input-group">
                                                                <input type="number" name="keranjang_qty" class="form-control" value="<?= $k->keranjang_qty ?>">
                                                                <button type="submit" class="btn btn-sm btn-outline-info waves-effect waves-light" title="Refresh" data-plugin="tippy" data-tippy-placement="top"><i class="fe-refresh-ccw"></i></button>
                                                            </div>
                                                            <?php echo form_close() ?>
                                                        </td>
                                                        <td>Rp.<?= rupiah($sub_total) ?></td>
                                                        <td class="text-center">
                                                            <a href="<?= base_url('pembelian/transaksi_hutang/hapus_keranjang_barang_hutang/') . base64_encode($k->keranjang_id) ?>" class="btn btn-outline-danger hapus" title="Hapus Barang" data-plugin="tippy" data-tippy-placement="top"><i class="fe-trash"></i> </a>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>

                                    <?php echo form_open("pembelian/transaksi_hutang/kirim_all_hutang_pembelian") ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Suplier</label>
                                                <select name="invoice_suplier_id" id="invoice_suplier_id" class="form-control" data-toggle="select2" required>
                                                    <option value="">-- Pilih Suplier --</option>
                                                    <?php foreach ($get_suplier as $suplier) : ?>
                                                        <?php if ($suplier->status_suplier == 1) : ?>
                                                            <option value="<?= $suplier->id_suplier ?>"><?= $suplier->nama ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach ?>
                                                </select>
                                                <small class="mt-0"><a href="<?= base_url('pembelian/suplier/tambah') ?>"><i class="fe-plus"></i> Tambah Suplier</a></small>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Jatuh Tempo</label>
                                                <input type="date" name="invoice_hutang_jatuh_tempo" id="invoice_hutang_jatuh_tempo" class="form-control" required>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="col ml-4">
                                                <h4>Total &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Rp.<input type="text" style="border: 0px;" autocomplete="off" id="angka1" name="total" value="<?= $total ?>" readonly></h4>
                                                <div class="row mt-3">
                                                    <div class="col-md-2">
                                                        <h4 class="text-danger">DP.</h4>
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
                                                <p class="text-success mt-3">Sisa Piutang &nbsp;&nbsp;&nbsp;&nbsp; Rp.<input type="text" style="border: 0px;" autocomplete="off" id="angka3" value="<?= $total - $total - $total ?>" name="kembali" disabled></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php foreach ($get_keranjang as $gk) : ?>
                                        <input type="hidden" name="kode_barang" value="<?= $kode_barang; ?>">
                                        <input type="hidden" name="barang_id[]" value="<?= $gk->barang_id; ?>">
                                        <input type="hidden" name="keranjang_qty[]" value="<?= $gk->keranjang_qty; ?>">
                                        <input type="hidden" name="keranjang_id_kasir[]" value="<?= $gk->keranjang_id_kasir; ?>">
                                        <input type="hidden" name="pembelian_invoice[]" value="<?= $kode_barang; ?>">
                                        <input type="hidden" name="barang_harga_beli[]" value="<?= $gk->keranjang_harga; ?>">
                                    <?php endforeach; ?>

                                    <?php if ($kode_barang != null) : ?>

                                        <?php if ($get_keranjang_jml < 1) : ?>
                                            <button type="submit" class="btn btn-success mt-4 float-right"><i class="fe-credit-card"></i> Simpan Payment</button>
                                        <?php endif; ?>

                                        <?php if ($get_keranjang_jml > 0) : ?>
                                            <a href="javascript:void(0);" class="btn btn-secondary mt-4 float-right btn-disabled"><i class="fe-credit-card"></i> Simpan Payment</a>
                                        <?php endif; ?>

                                    <?php endif; ?>
                                    <?php if ($kode_barang == null) : ?>
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
        <div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah No. Invoice</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <?php echo form_open("pembelian/transaksi_hutang/tambah_no_invoice"); ?>
                    <div class="modal-body p-4">

                        <input type="hidden" name="pembelian_user" value="<?= base64_encode($session->id) ?>">
                        <div class="form-group mb-3">
                            <label for="pembelian_input">No. Invoice <span class="text-danger">*</span></label>
                            <input type="text" id="pembelian_input" name="pembelian_input" class="form-control" value="<?= set_value('pembelian_input') ?>" require>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal"><i class="fe-arrow-left"></i> Tutup</button>
                        <button type="submit" class="btn btn-outline-success"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div><!-- /.modal -->


        <!-- Tambah modal -->
        <?php foreach ($get_keranjang as $edit) : ?>
            <div id="hargabeli<?= $edit->keranjang_id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Harga Beli</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <?php echo form_open("pembelian/transaksi_hutang/edit_harga_beli_hutang"); ?>
                        <div class="modal-body p-4">

                            <input type="hidden" name="keranjang_id" value="<?= base64_encode($edit->keranjang_id) ?>">
                            <div class="form-group mb-3">
                                <label for="keranjang_harga">Harga Beli <span class="text-danger">*</span></label>
                                <input type="number" id="keranjang_harga" name="keranjang_harga" class="form-control" value="<?= $edit->keranjang_harga ?>" require>
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
                                        <th class="text-center">Kode Barang</th>
                                        <th class="text-center">Nama Barang</th>
                                        <th class="text-center">Satuan</th>
                                        <th class="text-center">Stok</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($get_barang as $data) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td><?= $data->barang_kode ?></td>
                                            <td><?= $data->barang_nama ?></td>
                                            <td><?= $data->nama_satuan ?></td>
                                            <td>
                                                <?php if ($data->barang_stok > 0) : ?>
                                                    <?= $data->barang_stok ?>
                                                <?php else : ?>
                                                    <div class="badge badge-outline-danger">Habis</div>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" id="idbarang" data-idbarang="<?= $data->id_barang; ?>" class="btn btn-outline-success btn-sm idbarang"><i class="fe-shopping-cart"></i> Pilih</button>
                                            </td>
                                        </tr>
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

        <!-- Tambah modal -->
        <?php if ($kode_barang != null) : ?>
            <div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit No. Invoice</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <?php echo form_open("pembelian/transaksi_hutang/edit_no_invoice"); ?>
                        <div class="modal-body p-4">

                            <input type="hidden" name="pembelian_id" value="<?= base64_encode($get_pembelian_session['pembelian_id']) ?>">
                            <div class="form-group mb-3">
                                <label for="pembelian_input">No. Invoice <span class="text-danger">*</span></label>
                                <input type="text" id="pembelian_input" name="pembelian_input" class="form-control" value="<?= $get_pembelian_session['pembelian_input'] ?>" require>
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
        <?php endif; ?>

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

            $('.idbarang').on('click', function() {
                const idbarang = $(this).data('idbarang');
                console.log(idbarang);

                $.ajax({
                    url: "<?= base_url('pembelian/transaksi_hutang/input_idbarang_dua') ?>",
                    type: 'post',
                    data: {
                        idbarang: idbarang
                    },
                    success: function() {
                        Swal.fire({
                            type: "success",
                            title: "Sukses",
                            text: "Barang berhasil ditambahkan ke keranjang!"
                        })
                        document.location.href = "<?= base_url('pembelian/transaksi_hutang') ?>";
                    }
                })
            });

            $('#invoice_barang_id').on('change', function() {
                const id_barang = $('#invoice_barang_id').val();
                console.log(id_barang);

                $.ajax({
                    url: "<?= base_url('pembelian/transaksi_hutang/input_idbarang') ?>",
                    type: 'post',
                    data: {
                        id_barang: id_barang
                    },
                    success: function() {
                        Swal.fire({
                            type: "success",
                            title: "Sukses",
                            text: "Barang berhasil ditambahkan ke keranjang!"
                        })
                        document.location.href = "<?= base_url('pembelian/transaksi_hutang') ?>";
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