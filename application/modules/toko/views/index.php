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
                            <h4 class="header-title">Data <?= $title; ?></h4>
                            <a href="javascript:void(0);" class="btn btn-outline-info mb-2" data-target="#tambah" data-toggle="modal"><i class="fe-plus"></i> Tambah Toko</a>
                            <table class="table table-hover" id="basic-datatable">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nama Toko</th>
                                        <th class="text-center">Kota</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($get_toko as $data) : ?>
                                        <?php if ($data->toko_user_id == $session->id) : ?>
                                            <tr>
                                                <td><?= $data->toko_nama ?></td>
                                                <td><?= $data->toko_kota ?></td>
                                                <td class="text-center">
                                                    <?php if ($data->toko_status == 1) : ?>
                                                        <div class="badge badge-success">Aktif</div>
                                                    <?php else : ?>
                                                        <div class="badge badge-danger">Non-Aktif</div>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="javascript:void(0);" data-target="#edit<?= $data->id_toko ?>" class="btn btn-outline-warning" data-toggle="modal" title="Edit Toko" data-plugin="tippy" data-tippy-placement="top"><i class="fe-edit"></i></a>
                                                    <?php if ($data->toko_user_id != $session->id) : ?>
                                                        <a href="<?= base_url('toko/hapus/') . base64_encode($data->id_toko) ?>" class="btn btn-outline-danger hapus" title="Hapus Toko" data-plugin="tippy" data-tippy-placement="top"><i class="fe-trash"></i></a>
                                                    <?php else : ?>
                                                        <a href="javascript:void(0);" class="btn btn-outline-secondary disable-btn" title="Hapus Toko" data-plugin="tippy" data-tippy-placement="top"><i class="fe-trash"></i></a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->

            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->

    <!-- Tambah modal -->
    <div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Toko</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <?php echo form_open("toko/tambah"); ?>
                <div class="modal-body p-4">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="toko_nama">Nama Toko <span class="text-danger">*</span></label>
                                <input type="text" id="toko_nama" name="toko_nama" class="form-control" value="<?= set_value('toko_nama') ?>" require>
                            </div>

                            <div class="form-group mb-3">
                                <label for="toko_kota">Kota Toko <span class="text-danger">*</span></label>
                                <input type="text" id="toko_kota" name="toko_kota" class="form-control" value="<?= set_value('toko_kota') ?>" require>
                            </div>

                            <div class="form-group mb-3">
                                <label for="toko_alamat">Alamat <span class="text-danger">*</span></label>
                                <textarea id="toko_alamat" name="toko_alamat" class="form-control" require rows="3"></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="phone">No. Telp <span class="text-danger">*</span></label>
                                <input type="number" id="toko_tlpn" name="toko_tlpn" class="form-control" value="<?= set_value('toko_tlpn') ?>" require>
                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="form-group mb-3">
                                <label for="phone">No. Whatshapp <span class="text-danger">*</span></label>
                                <input type="number" id="toko_wa" name="toko_wa" class="form-control" value="<?= set_value('toko_wa') ?>" require>
                            </div>

                            <div class="form-group mb-3">
                                <label for="toko_email">Email <small class="text-danger">*</small></label>
                                <input type="email" id="toko_email" name="toko_email" class="form-control" value="<?= set_value('toko_email') ?>" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="toko_ongkir">Ongkir <small class="text-danger">(Tidak Wajib)</small></label>
                                <input type="number" id="toko_ongkir" name="toko_ongkir" class="form-control" value="0">
                            </div>
                        </div>
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

    <?php foreach ($get_toko as $edit) : ?>
        <!-- edit modal -->
        <div id="edit<?= $edit->id_toko ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">edit Toko</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <?php echo form_open("toko/edit"); ?>
                    <div class="modal-body p-4">
                        <input type="hidden" name="id_toko" value="<?= $edit->id_toko ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="toko_nama">Nama Toko <span class="text-danger">*</span></label>
                                    <input type="text" id="toko_nama" name="toko_nama" class="form-control" value="<?= $edit->toko_nama ?>" require>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="toko_kota">Kota Toko <span class="text-danger">*</span></label>
                                    <input type="text" id="toko_kota" name="toko_kota" class="form-control" value="<?= $edit->toko_kota ?>" require>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="toko_alamat">Alamat <span class="text-danger">*</span></label>
                                    <textarea id="toko_alamat" name="toko_alamat" class="form-control" require rows="3"><?= $edit->toko_alamat ?></textarea>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="phone">No. Telp <span class="text-danger">*</span></label>
                                    <input type="number" id="toko_tlpn" name="toko_tlpn" class="form-control" value="<?= $edit->toko_tlpn ?>" require>
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="form-group mb-3">
                                    <label for="phone">No. Whatshapp <span class="text-danger">*</span></label>
                                    <input type="number" id="toko_wa" name="toko_wa" class="form-control" value="<?= $edit->toko_wa ?>" require>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="toko_email">Email <small class="text-danger">*</small></label>
                                    <input type="email" id="toko_email" name="toko_email" class="form-control" value="<?= $edit->toko_email ?>" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="toko_ongkir">Ongkir <small class="text-danger">(Tidak Wajib)</small></label>
                                    <input type="number" id="toko_ongkir" name="toko_ongkir" class="form-control" value="<?= $edit->toko_ongkir ?>">
                                </div>
                            </div>
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