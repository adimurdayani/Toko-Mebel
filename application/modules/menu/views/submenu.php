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
                        <form action="<?= base_url('menu/submenu/hapus_all/') ?>" method="POST" id="form-delete">
                            <div class="row p-2">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-danger" id="hapus"><i class="fe-trash"></i> Hapus</button>
                                    <a href="javascript:void(0);" data-target="#tambah" data-toggle="modal" class="btn btn-outline-blue"><i class="fe-plus"></i> Tambah Sub Menu</a>
                                </div>
                            </div>
                            <div class="card-body table-responsive">
                                <h4 class="header-title">Data <?= $title; ?></h4>
                                <table id="basic-datatable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="chack-all"></th>
                                            <th class="text-center">Menu</th>
                                            <th class="text-center">Posisi Ke</th>
                                            <th class="text-center">Sub Menu</th>
                                            <th class="text-center">Icon</th>
                                            <th class="text-center">Url</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php foreach ($get_submenu as $data) : ?>
                                            <tr>
                                                <td><input type="checkbox" class="check-item" name="id[]" value="<?= $data->id_submenu ?>"></td>
                                                <td><?= $data->menu ?></td>
                                                <td>
                                                    <?= $data->nomor_urut ?>
                                                    <a href="" class="badge badge-success ml-2" data-target="#edit_urutan<?= $data->id_submenu ?>" data-toggle="modal" title="Edit Urutan Menu <?= $data->submenu ?>" data-plugin="tippy" data-tippy-placement="top"><i class="fe-edit"></i></a>
                                                </td>
                                                <td><?= $data->submenu ?></td>
                                                <td><?= $data->icon ?></td>
                                                <td><?= $data->url ?></td>
                                                <td class="float-right">
                                                    <?php if ($data->collapse == 1) : ?>
                                                        <a href="javascript:void(0);" data-target="#add-collapse<?= $data->id_submenu ?>" data-toggle="modal" class="btn btn-outline-success" title="Tambah Menu Collapse <?= $data->submenu ?>" data-plugin="tippy" data-tippy-placement="top"><i class="fe-plus"></i> </a>
                                                        <a href="<?= base_url('menu/submenu/detail_menu_collapse/') . base64_encode($data->id_submenu) ?>" class="btn btn-outline-info" title="Tambah Menu Collapse <?= $data->submenu ?>" data-plugin="tippy" data-tippy-placement="top"><i class="fe-eye"></i> </a>
                                                    <?php endif; ?>
                                                    <a href="javascript:void(0);" data-target="#edit<?= $data->id_submenu ?>" class="btn btn-outline-warning" data-toggle="modal" title="Edit Sub Menu <?= $data->submenu ?>" data-plugin="tippy" data-tippy-placement="top"><i class="fe-edit"></i></a>
                                                    <a href="<?= base_url('menu/submenu/hapus/') . base64_encode($data->id_submenu) ?>" class="btn btn-outline-danger hapus" title="Hapus Sub Menu <?= $data->submenu ?>" data-plugin="tippy" data-tippy-placement="top"><i class="fe-trash"></i> </a>
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
                    <h4 class="modal-title">Tambah Submenu</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <?php echo form_open("menu/submenu/tambah"); ?>
                <div class="modal-body p-4">

                    <div class="form-group">
                        <label for="nomor_urut" class="control-label">Posisi Ke <span class="text-danger">*</span></label>
                        <input type="nomor" class="form-control" name="nomor_urut" placeholder="Posisi menu ke">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_menu">Nama Menu <span class="text-danger">*</span></label>
                                <select name="id_menu" class="form-control" id="id_menu">
                                    <?php foreach ($get_menu as $m) : ?>
                                        <option value="<?= $m->id_menu ?>"><?= $m->menu ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="submenu" class="control-label">Nama Sub Menu <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="submenu" placeholder="Nama Sub Menu">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="icon" class="control-label">Icon <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="icon" placeholder="fe-home">
                    </div>

                    <div class="form-group">
                        <label for="url" class="control-label">Url <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="url" placeholder="Nama url">
                    </div>

                    <div class="form-group">
                        <label for="collapse">Aktif Collapse <span class="text-danger">*</span></label>
                        <select name="collapse" class="form-control" id="collapse">
                            <option value="1">Aktif</option>
                            <option value="0">Non-Aktif</option>
                        </select>
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

    <!-- Tambah modal -->
    <?php foreach ($get_submenu as $tambah) : ?>
        <div id="add-collapse<?= $tambah->id_submenu ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Menu Collapse <?= $tambah->submenu ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <?php echo form_open("menu/submenu/tambah_menu_collapse"); ?>
                    <div class="modal-body p-4">
                        <input type="hidden" name="submenu_id" value="<?= base64_encode($tambah->id_submenu) ?>">
                        <input type="hidden" name="menu_id" value="<?= base64_encode($tambah->id_menu) ?>">

                        <div class="form-group">
                            <label for="nomor_urut" class="control-label">Posisi Ke <span class="text-danger">*</span></label>
                            <input type="nomor" class="form-control" name="nomor_urut" placeholder="Posisi menu ke">
                        </div>

                        <div class="form-group">
                            <label for="judul" class="control-label">Menu Collapse <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="judul" placeholder="Nama menu collapse">
                        </div>

                        <div class="form-group">
                            <label for="url" class="control-label">Url <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="url" placeholder="Nama url">
                        </div>

                        <div class="form-group">
                            <label for="is_active">Aktif <span class="text-danger">*</span></label>
                            <select name="is_active" class="form-control" id="is_active">
                                <option value="1">Aktif</option>
                                <option value="0">Non-Aktif</option>
                            </select>
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
    <?php endforeach; ?>

    <!-- edit modal content -->
    <?php foreach ($get_submenu as $edit) : ?>
        <div id="edit<?= $edit->id_submenu ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Menu</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <?php echo form_open("menu/submenu/edit"); ?>
                    <div class="modal-body p-4">
                        <input type="hidden" name="id_submenu" value="<?= base64_encode($edit->id_submenu) ?>">

                        <div class="form-group">
                            <label for="nomor_urut" class="control-label">Posisi Ke<span class="text-danger">*</span></label>
                            <input type="nomor" class="form-control" name="nomor_urut" placeholder="Nomor urut sub menu" value="<?= $edit->nomor_urut ?>">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_menu">Nama Menu <span class="text-danger">*</span></label>
                                    <select name="id_menu" class="form-control" id="id_menu">
                                        <?php foreach ($get_menu as $m) : ?>
                                            <option value="<?= $m->id_menu ?>" <?php if ($m->id_menu == $edit->id_menu) : ?> selected <?php endif; ?>><?= $m->menu ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="submenu" class="control-label">Nama Sub Menu <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="submenu" value="<?= $edit->submenu ?>" placeholder="Nama Menu">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="icon" class="control-label">Icon <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="icon" placeholder="fe-home" value="<?= $edit->icon ?>">
                        </div>

                        <div class="form-group">
                            <label for="url" class="control-label">Url <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="url" placeholder="Nama url" value="<?= $edit->url ?>">
                        </div>

                        <div class="form-group">
                            <label for="collapse">Aktif Collapse <span class="text-danger">*</span></label>
                            <select name="collapse" class="form-control" id="collapse">
                                <option value="1" <?php if ($edit->collapse == 1) : ?> selected <?php endif; ?>>Aktif</option>
                                <option value="0" <?php if ($edit->collapse == 0) : ?> selected <?php endif; ?>>Non-Aktif</option>
                            </select>
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