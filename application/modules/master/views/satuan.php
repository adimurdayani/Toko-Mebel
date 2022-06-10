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
                            <h4 class="header-title">Tabel Data <?= $title; ?></h4>
                            <form action="<?= base_url('master/satuan/hapus_all/') ?>" method="POST" id="form-delete">

                                <a href="javascript:void(0);" data-target="#tambah" data-toggle="modal" class="btn btn-outline-info mb-3"><i class="fe-plus"></i> Tambah Data</a>
                                <button type="submit" class="btn btn-outline-danger mb-3" id="hapus"><i class="fe-trash"></i> Hapus</button>

                                <table id="basic-datatable" class="table nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="chack-all"></th>
                                            <th class="text-center">No.</th>
                                            <th class="text-center">Satuan</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Tanggal Post</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php $no = 1;
                                        foreach ($get_satuan as $data) : ?>
                                            <tr>
                                                <td><input type="checkbox" class="check-item" name="id[]" value="<?= $data['id'] ?>"></td>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td><?= $data['nama_satuan'] ?></td>
                                                <td class="text-center"><input type="checkbox" class="ubahsatuan" <?= check_satuan($data['status_satuan']) ?> data-satuanid="<?= $data['id'] ?>" data-statussatuan="<?= $data['status_satuan'] ?>"></td>
                                                <td class="text-center"><?= $data['created_at'] ?></td>
                                                <td class="text-center">
                                                    <a href="javascript:void(0);" data-target="#edit<?= $data['id'] ?>" class="btn btn-sm btn-warning" data-toggle="modal" title="Edit <?= $data['nama_satuan'] ?>" data-plugin="tippy" data-tippy-placement="top"><i class="fe-edit"></i></a>
                                                    <a href="<?= base_url('master/satuan/hapus/') . base64_encode($data['id']) ?>" class="btn btn-sm btn-danger hapus" title="Hapus <?= $data['nama_satuan'] ?>" data-plugin="tippy" data-tippy-placement="top"><i class="fe-trash"></i> </a>
                                                </td>
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
                    <h4 class="modal-title">Tambah satuan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <?php echo form_open("master/satuan/tambah"); ?>
                <div class="modal-body p-4">

                    <div class="form-group mb-3">
                        <label for="nama_satuan">Nama satuan <span class="text-danger">*</span></label>
                        <input type="text" id="nama_satuan" name="nama_satuan" class="form-control" value="<?= set_value('nama_satuan') ?>" require>
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
    <?php foreach ($get_satuan as $edit) : ?>
        <div id="edit<?= $edit['id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit <?= $edit['nama_satuan'] ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <?php echo form_open("master/satuan/edit"); ?>
                    <div class="modal-body p-4">

                        <input type="hidden" name="id" value="<?= base64_encode($edit['id']) ?>">

                        <div class="form-group mb-3">
                            <label for="nama_satuan">Nama satuan <span class="text-danger">*</span></label>
                            <input type="text" id="nama_satuan" name="nama_satuan" class="form-control" value="<?= $edit['nama_satuan'] ?>" require>
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