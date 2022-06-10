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
                    <div class="card">
                        <div class="card-body table-responsive">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <h5>No.Invoice Produksi: &nbsp;</h5>
                                            <input type="text" class="form-control" placeholder="Input no. invoice" name="invoice" value="<?= $get_session_invoice['session_invoice']; ?>" id="invoice" readonly>
                                            <?php if ($session_jml == 0) : ?>
                                                <div class="input-group-append">
                                                    <button class="btn btn-info waves-effect waves-light" title="Tambah no. invoice" data-plugin="tippy" data-tippy-placement="top" data-toggle="modal" data-target="#tambah" type="button"><i class="fe-plus"></i></button>
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($session_jml != 0) : ?>
                                                <div class="input-group-append">
                                                    <button class="btn btn-warning waves-effect waves-light" title="Edit no. invoice" data-plugin="tippy" data-tippy-placement="top" data-toggle="modal" data-target="#edit" type="button"><i class="fe-edit"></i></button>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select name="kode_barang" id="kode_barang" class="form-control" data-toggle="select2">
                                            <option value="">-- Pilih kode material --</option>
                                            <?php foreach ($get_barang as $kode) : ?>
                                                <?php if ($kode->status_barang > 0) : ?>
                                                    <option value="<?= $kode->id_barang ?>"><?= $kode->barang_kode ?> - <?= $kode->barang_nama ?> - Rp.<?= rupiah($kode->barang_harga_beli) ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <a href="" class="btn btn-info" title="Cari kode barang" data-plugin="tippy" data-tippy-placement="top" data-toggle="modal" data-target="#databarang"><i class="fe-search"></i></a>
                                </div>
                            </div>

                            <h4 class="mt-4">Detil material yang digunakan</h4>
                            <table class="table table-bordered mb-4">
                                <thead>
                                    <tr>
                                        <th class="text-center">Kode Material</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Harga Persatuan</th>
                                        <th class="text-center">QTY</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $harga_modal  = 0;
                                    foreach ($get_produksi_keranjang as $data) :
                                        $user_group = $this->db->get_where('users_groups', ['user_id' => $session->id])->row();
                                    ?>
                                        <?php if ($data->keranjang_kasir_id == $user_group->group_id) : ?>
                                            <?php $harga_modal += $data->keranjang_harga_total; ?>
                                            <tr>
                                                <td style="vertical-align: middle;" class="text-center"><?= $data->keranjang_kode_barang ?></td>
                                                <td style="vertical-align: middle;"><?= $data->barang_nama ?></td>
                                                <td style="width: 200px; vertical-align: middle;">
                                                    Rp.<?= rupiah($data->keranjang_harga_modal) ?>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <?= $data->keranjang_barang_qty ?> <?= $data->nama_satuan ?> - <?= $data->nama_kategori ?>

                                                    <?php if ($data->keranjang_kategori_barang == 7) : ?>
                                                        <a href="" class="badge badge-warning float-right" data-target="#tambah-material<?= $data->keranjang_kategori_barang ?>" data-toggle="modal" title="Tentukan harga modal dari material yang digunakan" data-plugin="tippy" data-tippy-placement="top"><i class="fe-edit"></i></a>
                                                    <?php endif; ?>

                                                    <?php if ($data->keranjang_kategori_barang == 7) : ?>
                                                        <hr>
                                                        <strong>Detail Terpakai</strong>
                                                        <ul>
                                                            <li>Panjang:</li>
                                                            <ul>
                                                                <li><?= $data->keranjang_panjang ?> Cm</li>
                                                            </ul>
                                                            <li>Lebar:</li>
                                                            <ul>
                                                                <li><?= $data->keranjang_panjang ?> Cm</li>
                                                            </ul>
                                                        </ul>
                                                    <?php endif; ?>
                                                </td>
                                                <td style="vertical-align: middle;">Rp.<?= rupiah($data->keranjang_harga_modal) ?></td>
                                                </ul>
                                                <td class="text-center" style="vertical-align: middle;">
                                                    <a href="<?= base_url('produksi/hapus_detail_produksi/') . base64_encode($data->id_produksi_keranjang) ?>" class="btn btn-outline-danger hapus" title="Hapus Barang" data-plugin="tippy" data-tippy-placement="top"><i class="fe-trash"></i> </a>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                            <?= form_open('produksi/kirim_all_produksi') ?>
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="">Nama Produk <span class="text-danger">*</span></label>
                                        <input type="text" name="produksi_nama" id="produksi_nama" class="form-control" placeholder="Input nama produk" value="<?= set_value('produksi_nama') ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Keterangan Produk <span class="text-danger">*</span></label>
                                        <textarea name="produksi_keterangan" id="produksi_keterangan" class="form-control" rows="5"></textarea>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Stok Produk </label>
                                        <input type="number" name="produksi_stok" min="1" id="produksi_stok" class="form-control" placeholder="Input nama produk" value="1">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label for="">Modal <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                                    </div>
                                                    <input type="number" name="produksi_harga_modal" id="produksi_harga_modal" class="form-control" value="<?= $harga_modal ?>" readonly>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label for="">Harga Jual <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                                    </div>
                                                    <input type="number" name="produksi_harga_jual" id="produksi_harga_jual" class="form-control" value="<?= set_value('produksi_harga_jual') ?>" required>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="produksi_invoice" value="<?= $get_session_invoice['session_invoice']; ?>">
                            <?php foreach ($get_produksi_keranjang as $gps) : ?>
                                <input type="hidden" name="detail_invoice_produksi[]" value="<?= $get_session_invoice['session_invoice']; ?>">
                                <input type="hidden" name="detail_material_id[]" value="<?= $gps->keranjang_id_barang ?>">
                                <input type="hidden" name="detail_kode_barang[]" value="<?= $gps->keranjang_kode_barang ?>">
                                <input type="hidden" name="detail_harga_modal[]" value="<?= $gps->keranjang_harga_modal ?>">
                                <input type="hidden" name="detail_kategori_barang[]" value="<?= $gps->keranjang_kategori_barang ?>">
                                <input type="hidden" name="detail_harga_jual[]" value="<?= $gps->keranjang_harga_jual ?>">
                                <input type="hidden" name="detail_harga_total[]" value="<?= $harga_modal ?>">
                                <input type="hidden" name="detail_barang_panjang[]" value="<?= $gps->keranjang_panjang ?>">
                                <input type="hidden" name="detail_barang_lebar[]" value="<?= $gps->keranjang_lebar ?>">
                                <input type="hidden" name="detail_barang_qty[]" value="<?= $gps->keranjang_barang_qty ?>">
                            <?php endforeach; ?>

                            <?php if ($session_jml == 0) : ?>
                                <button type="button" class="btn btn-secondary mt-4 float-right"><i class="fe-package"></i> Proses</button>
                            <?php elseif ($session_jml != 0) : ?>
                                <?php if ($keranjang_jml == 0) : ?>
                                    <button type="button" class="btn btn-secondary mt-4 float-right"><i class="fe-package"></i> Proses</button>
                                <?php elseif ($keranjang_jml != 0) : ?>
                                    <button type="submit" class="btn btn-success mt-4 float-right"><i class="fe-package"></i> Proses</button>
                                <?php endif; ?>
                            <?php endif; ?>

                            <a href="<?= base_url('produksi') ?>" class="btn btn-secondary mt-4 float-right mr-2"><i class="fe-arrow-left"></i> Kembali</a>
                            <?= form_close() ?>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->

            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->

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
                                    <th class="text-center">Harga Persatuan</th>
                                    <th class="text-center">Stok</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($get_barang as $data) :
                                ?>
                                    <?php if ($data->status_barang > 0) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td><?= $data->barang_kode ?></td>
                                            <td><?= $data->barang_nama ?></td>
                                            <td>Rp.<?= rupiah($data->barang_harga_beli) ?></td>
                                            <td>
                                                <?php if ($data->barang_stok > 0) : ?>
                                                    <?= $data->barang_stok ?>
                                                <?php else : ?>
                                                    <div class="badge badge-outline-danger">Habis</div>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($data->barang_stok < 1) : ?>
                                                    <button type="button" class="btn btn-outline-danger btn-sm btn-disabled"><i class="fe-x"></i> Habis</button>
                                                <?php elseif ($data->barang_stok < 3) : ?>
                                                    <button type="button" class="btn btn-outline-warning btn-sm btn-disabled"> Stok Sedikit</button>
                                                <?php else : ?>
                                                    <button type="button" id="idbarang" data-idbarang="<?= $data->id_barang; ?>" class="btn btn-outline-success btn-sm idbarang"><i class="fe-plus"></i> Pilih</button>
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


    <!-- Tambah modal -->
    <?php foreach ($get_produksi_keranjang as $tambah) : ?>
        <div id="tambah-material<?= $tambah->keranjang_kategori_barang  ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tentukan harga modal <?= $tambah->barang_nama ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <?= form_open('produksi/edit_keranjang') ?>
                    <div class="modal-body p-4">

                        <input type="hidden" name="id_barang" value="<?= $tambah->keranjang_id_barang  ?>">

                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="">Panjang (Cm) Per Item</label>
                                    <input type="number" name="keranjang_panjang" value="<?= $tambah->keranjang_panjang  ?>" id="session_panjang" class="form-control" placeholder="Input panjang (cm) per item">
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Lebar (Cm) Per Item</label>
                                    <input type="number" name="session_lebar" value="<?= $tambah->keranjang_panjang  ?>" id="session_lebar" class="form-control" placeholder="Input lebar (cm) per item">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Harga material</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                </div>
                                <input type="number" name="keranjang_harga_modal" id="keranjang_harga_modal" class="form-control" value="<?= $tambah->keranjang_harga_modal ?>">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal"><i class="fe-arrow-left"></i> Tutup</button>
                        <button type="submit" class="btn btn-outline-success waves-effect"><i class="fe-save"></i> Simpan</button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div><!-- /.modal -->
    <?php endforeach; ?>

    <!-- Tambah modal -->
    <div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah No. Invoice</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <?php echo form_open("produksi/tambah_nomor_invoice"); ?>
                <div class="modal-body p-4">

                    <input type="hidden" name="pembelian_user" value="<?= base64_encode($session->id) ?>">
                    <div class="form-group mb-3">
                        <label for="session_invoice">No. Invoice <span class="text-danger">*</span></label>
                        <input type="text" id="session_invoice" name="session_invoice" class="form-control" value="<?= set_value('session_invoice') ?>" require>
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

    <?php if ($session_jml != 0) : ?>
        <div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit No. Invoice</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <?php echo form_open("produksi/edit_nomor_invoice"); ?>
                    <div class="modal-body p-4">

                        <input type="hidden" name="id_session" value="<?= base64_encode($get_session_invoice['id_session']) ?>">
                        <div class="form-group mb-3">
                            <label for="session_invoice">No. Invoice <span class="text-danger">*</span></label>
                            <input type="text" id="session_invoice" name="session_invoice" class="form-control" value="<?= $get_session_invoice['session_invoice'] ?>" require>
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
        $('.idbarang').on('click', function() {
            const idbarang = $(this).data('idbarang');
            console.log(idbarang);

            $.ajax({
                url: "<?= base_url('produksi/input_barang') ?>",
                type: 'post',
                data: {
                    idbarang: idbarang
                },
                success: function() {
                    Swal.fire({
                        type: "success",
                        title: "Sukses",
                        text: "Barang berhasil ditambahkan!"
                    })
                    document.location.href = "<?= base_url('produksi/tambah') ?>";
                }
            })
        });

        $('#kode_barang').on('change', function() {
            const id_barang = $('#kode_barang').val();
            console.log(id_barang);

            $.ajax({
                url: "<?= base_url('produksi/input_barang_select') ?>",
                type: 'post',
                data: {
                    id_barang: id_barang
                },
                success: function() {
                    Swal.fire({
                        type: "success",
                        title: "Sukses",
                        text: "Barang berhasil ditambahkan!"
                    })
                    document.location.href = "<?= base_url('produksi/tambah') ?>";
                }
            })
        });
    </script>