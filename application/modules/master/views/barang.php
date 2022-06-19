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
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a href="#tersedia" class="nav-link active">
                                        Barang Tersedia
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('master/barang/inden') ?>" class="nav-link">
                                        Barang Inden
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane show active" id="tersedia">
                                    <form action="<?= base_url('master/barang/hapus_all/') ?>" method="POST" id="form-delete">

                                        <a href="<?= base_url('master/barang/tambah') ?>" class="btn btn-outline-info mb-3 "><i class="fe-plus"></i> Tambah Data</a>
                                        <button type="submit" class="btn btn-outline-danger mb-3" id="hapus"><i class="fe-trash"></i> Hapus</button>

                                        <table id="basic-datatable" class="table nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" id="chack-all"></th>
                                                    <th class="text-center">Aksi</th>
                                                    <th class="text-center">No.</th>
                                                    <th class="text-center">Kode Barang</th>
                                                    <th class="text-center">Nama Barang</th>
                                                    <th class="text-center">Harga Beli</th>
                                                    <th class="text-center">Harga Jual</th>
                                                    <th class="text-center">Stok</th>
                                                    <th class="text-center">Detail</th>
                                                    <th class="text-center">Status</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                <?php $no = 1;
                                                foreach ($get_barang as $data) : ?>
                                                    <?php if ($data->status_barang != 0) : ?>
                                                        <tr>
                                                            <td><input type="checkbox" class="check-item" name="id_barang[]" value="<?= $data->id_barang ?>"></td>
                                                            <td class="text-center">
                                                                <a href="javascript:void(0);" class="btn btn-sm btn-info" data-target="#detail<?= $data->id_barang ?>" data-toggle="modal" title="Detail <?= $data->barang_nama ?>" data-plugin="tippy" data-tippy-placement="top"><i class="fe-eye"></i></a>
                                                                <a href="<?= base_url('master/barang/edit/') . base64_encode($data->id_barang) ?>" class="btn btn-sm btn-warning" title="Edit <?= $data->barang_nama ?>" data-plugin="tippy" data-tippy-placement="top"><i class="fe-edit"></i></a>
                                                                <a href="<?= base_url('master/barang/hapus/') . base64_encode($data->id_barang) ?>" class="btn btn-sm btn-danger hapus" title="Hapus <?= $data->barang_nama ?>" data-plugin="tippy" data-tippy-placement="top"><i class="fe-trash"></i> </a>
                                                            </td>
                                                            <td class="text-center"><?= $no++ ?></td>
                                                            <td><?= $data->barang_kode ?></td>
                                                            <td><?= $data->barang_nama ?></td>
                                                            <td>
                                                                <?php if ($data->barang_harga_beli != null) : ?>
                                                                    Rp.<?= rupiah($data->barang_harga_beli) ?>
                                                                <?php else : ?>
                                                                    Rp.0
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <?php if ($data->barang_harga != null) : ?>
                                                                    Rp.<?= rupiah($data->barang_harga) ?>
                                                                <?php else : ?>
                                                                    Rp.0
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <?php if ($data->barang_stok > 0) : ?>
                                                                    <?= $data->barang_stok ?> <?= $data->nama_satuan ?>
                                                                <?php else : ?>
                                                                    <div class="badge badge-danger">Habis</div>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php if ($data->barang_kategori_id == 7) : ?>
                                                                    <?php if ($jml_barang_detail == 0) : ?>
                                                                        <a href="javascript:void(0);" data-target="#tambah-detailbarang<?= $data->barang_kode ?>" data-toggle="modal" class="badge badge-success" title="Tambah panjang x lebar barang" data-plugin="tippy" data-tippy-placement="top"><i class="fe-plus"></i></a>
                                                                    <?php elseif ($jml_barang_detail != 0) : ?>
                                                                        <a href="javascript:void(0);" data-target="#edit<?= $data->barang_kode ?>" data-toggle="modal" class="badge badge-warning" title="Edit panjang x lebar barang" data-plugin="tippy" data-tippy-placement="top"><i class="fe-edit"></i></a>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td class="text-center"><input type="checkbox" class="ubahstatusbarang" <?= check_status_barang($data->status_barang) ?> data-statusid="<?= $data->id_barang ?>" data-statusbarang="<?= $data->status_barang ?>"></td>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->

            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->

    <!-- edit modal content -->
    <?php foreach ($get_barang as $detail) : ?>
        <div id="detail<?= $detail->id_barang ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail <?= $detail->barang_nama ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">

                        <div class="form-group">
                            <label for="">Kode Barang</label>
                            <input type="text" class="form-control" value="<?= $detail->barang_kode ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="">Nama Barang</label>
                            <input type="text" class="form-control" value="<?= $detail->barang_nama ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea rows="5" class="form-control" readonly><?= $detail->barang_deskripsi ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Harga Beli</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                                        </div>
                                        <input type="text" class="form-control" value="<?= rupiah($detail->barang_harga_beli) ?>" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Harga Jual</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                                        </div>
                                        <input type="text" class="form-control" value="<?= rupiah($detail->barang_harga) ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Kategori</label>
                            <input type="text" class="form-control" value="<?= $detail->nama_kategori ?>">
                        </div>

                        <div class="form-group">
                            <label for="">Satuan</label>
                            <input type="text" class="form-control" value="<?= $detail->nama_satuan ?>">
                        </div>

                        <div class="form-group">
                            <label for="">Stok</label>
                            <input type="number" class="form-control" value="<?= $detail->barang_stok ?>">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal"><i class="fe-arrow-left"></i> Tutup</button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal -->
    <?php endforeach; ?>

    <?php foreach ($get_barang as $tambah) : ?>
        <div id="tambah-detailbarang<?= $tambah->barang_kode ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Ukuran <?= $tambah->barang_nama ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <?= form_open('master/barang/pajanglebar') ?>
                    <div class="modal-body p-4">
                        <input type="hidden" name="detail_kode_barang" class="form-control" value="<?= $detail->barang_kode ?>">
                        <div class="form-group">
                            <label for="">Pajang (Cm) Per Item</label>
                            <input type="number" name="detail_panjang" class="form-control" value="0">
                        </div>

                        <div class="form-group">
                            <label for="">Lebar (Cm) Per Item</label>
                            <input type="number" name="detail_lebar" class="form-control" value="0">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal"><i class="fe-arrow-left"></i> Tutup</button>
                        <button type="submit" class="btn btn-outline-warning waves-effect"><i class="fe-save"></i> Simpan</button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div><!-- /.modal -->
    <?php endforeach; ?>

    <?php foreach ($get_barang_detail as $edit) : ?>
        <div id="edit<?= $edit->detail_kode_barang ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Ukuran <?= $edit->detail_kode_barang ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <?= form_open('master/barang/edit_pajanglebar') ?>
                    <div class="modal-body p-4">
                        <input type="hidden" name="detail_kode_barang" value="<?= base64_encode($edit->detail_kode_barang) ?>">
                        <div class="form-group">
                            <label for="">Pajang (Cm) Per Item</label>
                            <input type="number" name="detail_panjang" class="form-control" value="<?= $edit->detail_panjang ?>">
                        </div>

                        <div class="form-group">
                            <label for="">Lebar (Cm) Per Item</label>
                            <input type="number" name="detail_lebar" class="form-control" value="<?= $edit->detail_lebar ?>">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal"><i class="fe-arrow-left"></i> Tutup</button>
                        <button type="submit" class="btn btn-outline-warning waves-effect"><i class="fe-save"></i> Update</button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div><!-- /.modal -->
    <?php endforeach; ?>