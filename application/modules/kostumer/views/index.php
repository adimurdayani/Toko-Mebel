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
                                <li class="breadcrumb-item active"><?= $title ?></li>
                            </ol>
                        </div>
                        <h4 class="page-title"><?= $title ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <h4 class="header-title mb-2">Tabel <?= $title ?></h4>
                            <form action="<?= base_url('kostumer/hapus_all/') ?>" method="POST" id="form-delete">

                                <a href="javascript:void(0);" data-target="#tambah" data-toggle="modal" class="btn btn-outline-info mb-3"><i class="fe-plus"></i> Tambah Data</a>
                                <button type="submit" class="btn btn-outline-danger mb-3" id="hapus"><i class="fe-trash"></i> Hapus</button>

                                <table id="basic-datatable" class="table nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th style="width: 50px;"><input type="checkbox" id="chack-all"></th>
                                            <th class="text-center">Aksi</th>
                                            <th>Nama</th>
                                            <th>Nomor HP</th>
                                            <th>Email</th>
                                            <th>Alamat</th>
                                            <th>Status</th>
                                            <th>Tanggal Pos</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php foreach ($get_kostumer as $data) : ?>
                                            <tr>
                                                <td><input type="checkbox" class="check-item" name="id_kostumer[]" value="<?= $data->id_kostumer ?>"></td>
                                                <td>
                                                    <a href="javascript:void(0);" data-target="#edit<?= $data->id_kostumer ?>" class="btn btn-outline-warning" data-toggle="modal" title="Edit Kostumer" data-plugin="tippy" data-tippy-placement="top"><i class="fe-edit"></i></a>
                                                    <a href="<?= base_url('kostumer/hapus/') . base64_encode($data->id_kostumer) ?>" class="btn btn-outline-danger hapus" title="Hapus Kostumer" data-plugin="tippy" data-tippy-placement="top"><i class="fe-trash"></i> </a>
                                                </td>
                                                <td><?= $data->nama ?></td>
                                                <td><?= $data->phone ?></td>
                                                <td><?= $data->email ?> </td>
                                                <td><?= $data->alamat ?></td>
                                                <td>
                                                    <?php if ($data->status_kostumer == 1) :  ?>
                                                        <div class="badge badge-outline-success">Aktif</div>
                                                    <?php else : ?>
                                                        <div class="badge badge-outline-danger">Tidak Aktif</div>
                                                    <?php endif ?>
                                                </td>
                                                <td><?= $data->updated_at ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </form>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->

            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->


    <!-- Tambah modal -->
    <div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Menu</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <?php echo form_open("kostumer/tambah"); ?>
                <div class="modal-body p-4">

                    <div class="form-group mb-3">
                        <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" id="nama" name="nama" class="form-control" value="<?= set_value('nama') ?>" require>
                    </div>

                    <div class="form-group mb-3">
                        <label for="phone">No. Whatshapp <span class="text-danger">*</span></label>
                        <input type="number" id="phone" name="phone" class="form-control" value="<?= set_value('phone') ?>" require>
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email <small class="text-danger">(Tidak Wajib)</small></label>
                        <input type="text" id="email" name="email" class="form-control" value="<?= set_value('email') ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label for="alamat">Alamat <span class="text-danger">*</span></label>
                        <input type="text" id="alamat" name="alamat" class="form-control" value="<?= set_value('alamat') ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label for="status_kostumer">Status <span class="text-danger">*</span></label>
                        <select name="status_kostumer" id="status_kostumer" class="form-control">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
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

    <!-- edit modal -->
    <?php foreach ($get_kostumer as $edit) : ?>
        <div id="edit<?= $edit->id_kostumer ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit <?= $edit->nama ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <?php echo form_open("kostumer/edit"); ?>
                    <div class="modal-body p-4">
                        <input type="hidden" name="id_kostumer" value="<?= base64_encode($edit->id_kostumer) ?>">
                        <div class="form-group mb-3">
                            <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" id="nama" name="nama" class="form-control" value="<?= $edit->nama ?>" require>
                        </div>

                        <div class="form-group mb-3">
                            <label for="phone">No. Whatshapp <span class="text-danger">*</span></label>
                            <input type="number" id="phone" name="phone" class="form-control" value="<?= $edit->phone ?>" require>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email <small class="text-danger">(Tidak Wajib)</small></label>
                            <input type="text" id="email" name="email" class="form-control" value="<?= $edit->email ?>">
                        </div>

                        <div class="form-group mb-3">
                            <label for="alamat">Alamat <span class="text-danger">*</span></label>
                            <input type="text" id="alamat" name="alamat" class="form-control" value="<?= $edit->alamat ?>">
                        </div>

                        <div class="form-group mb-3">
                            <label for="status_kostumer">Status <span class="text-danger">*</span></label>
                            <select name="status_kostumer" id="status_kostumer" class="form-control">
                                <option value="1" <?php if ($edit->status_kostumer  == 1) : ?> selected <?php endif; ?>>Aktif</option>
                                <option value="0" <?php if ($edit->status_kostumer  == 0) : ?> selected <?php endif; ?>>Tidak Aktif</option>
                            </select>
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