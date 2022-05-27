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
                        <h4 class="page-title">List Data <?= $title; ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg">
                    <div class="card">
                        <form action="<?= base_url('menu/hapus_all/') ?>" method="POST" id="form-delete">
                            <div class="row p-3">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-danger" id="hapus"><i class="fe-trash"></i> Hapus</button>
                                    <a href="javascript:void(0);" data-target="#tambah" data-toggle="modal" class="btn btn-outline-blue"><i class="fe-plus"></i> Tambah Menu</a>
                                </div>
                            </div>
                            <div class="card-body table-responsive">
                                <h4 class="header-title">Data <?= $title; ?></h4>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="chack-all"></th>
                                            <th>Nama Menu</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php foreach ($get_menu as $data) : ?>
                                            <tr>
                                                <td><input type="checkbox" class="check-item" name="id[]" value="<?= $data->id_menu ?>"></td>
                                                <td><?= $data->menu ?></td>
                                                <td>
                                                    <a href="javascript:void(0);" data-target="#edit<?= $data->id_menu ?>" class="btn btn-outline-warning" data-toggle="modal" title="Edit Menu" data-plugin="tippy" data-tippy-placement="top"><i class="fe-edit"></i></a>
                                                    <a href="<?= base_url('menu/hapus/') . $data->id_menu ?>" class="btn btn-outline-danger hapus" title="Hapus Menu" data-plugin="tippy" data-tippy-placement="top"><i class="fe-trash"></i> </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                            </div> <!-- end card body-->
                        </form>
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
                <?php echo form_open("menu/tambah"); ?>
                <div class="modal-body p-4">

                    <div class="form-group mb-3">
                        <label for="menu">Nama Menu <span class="text-danger">*</span></label>
                        <input type="text" id="menu" name="menu" class="form-control" value="<?= set_value('menu') ?>" require>
                    </div>

                    <div class="form-group mb-3">
                        <label for="nomor_urut">Nomor Urut Menu <span class="text-danger">*</span></label>
                        <input type="number" id="nomor_urut" name="nomor_urut" class="form-control" value="<?= set_value('nomor_urut') ?>" require>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal"><i class="fe-arrow-left"></i></button>
                    <button type="submit" class="btn btn-outline-success"><i class="fa fa-save"></i> </button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div><!-- /.modal -->

    <!-- edit modal content -->
    <?php foreach ($get_menu as $edit) : ?>
        <div id="edit<?= $edit->id_menu ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Menu</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <?php echo form_open("menu/edit"); ?>
                    <div class="modal-body p-4">
                        <input type="hidden" name="id_menu" value="<?= base64_encode($edit->id_menu) ?>">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="menu" class="control-label">Nama Menu <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="menu" value="<?= $edit->menu ?>" placeholder="Nama Menu">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nomor_urut">Nomor Urut Menu <span class="text-danger">*</span></label>
                            <input type="number" id="nomor_urut" name="nomor_urut" class="form-control" value="<?= $edit->nomor_urut ?>" require>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal"><i class="fe-arrow-left"></i></button>
                        <button type="submit" class="btn btn-outline-success waves-effect waves-light"><i class="fe-save"></i></button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div><!-- /.modal -->
    <?php endforeach; ?>