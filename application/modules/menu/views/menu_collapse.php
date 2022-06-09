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
                        <h4 class="page-title">List <?= $title; ?> <?= $get_submenu_id->submenu ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg">
                    <div class="card">
                        <form action="<?= base_url('menu/submenu/hapus_all_menu_collapse/') ?>" method="POST" id="form-delete">
                            <div class="row p-2">
                                <div class="col-md-6">
                                    <a href="<?= base_url('menu/submenu') ?>" class="btn btn-outline-secondary"><i class="fe-arrow-left"></i> Kembali</a>
                                    <a href="javascript:void(0);" data-target="#tambah<?= $get_submenu_id->id_submenu ?>" data-toggle="modal" class="btn btn-outline-blue"><i class="fe-plus"></i> Menu Collapse</a>
                                    <button type="submit" class="btn btn-danger" id="hapus"><i class="fe-trash"></i> Hapus</button>
                                </div>
                            </div>
                            <div class="card-body table-responsive">
                                <h4 class="header-title">Tabel Submenu <?= $get_submenu_id->submenu ?></h4>
                                <table id="basic-datatable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="chack-all"></th>
                                            <th>Posisi Ke</th>
                                            <th>Nama Submenu</th>
                                            <th>Url</th>
                                            <th>Aktif</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php foreach ($get_menu_collapse as $data) : ?>
                                            <tr>
                                                <td><input type="checkbox" class="check-item" name="sub_id[]" value="<?= $data->sub_id ?>"></td>
                                                <td><?= $data->nomor_urut ?></td>
                                                <td><?= $data->judul ?></td>
                                                <td><?= $data->url ?></td>
                                                <td>
                                                    <input type="checkbox" class="editcollapsemenu" <?= check_status_menu_collapse($data->is_active) ?> data-statusid="<?= $data->sub_id ?>" data-menucollapse="<?= $data->is_active ?>" data-submenuid="<?= $data->submenu_id ?>">
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0);" data-target="#edit<?= $data->sub_id ?>" class="btn btn-outline-warning" data-toggle="modal" title="Edit Sub Menu" data-plugin="tippy" data-tippy-placement="top"><i class="fe-edit"></i></a>
                                                    <a href="<?= base_url('menu/submenu/hapus_menu_collapse/') . base64_encode($data->sub_id) ?>" class="btn btn-outline-danger hapus" title="Hapus Sub Menu" data-plugin="tippy" data-tippy-placement="top"><i class="fe-trash"></i> </a>
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
    <div id="tambah<?= $get_submenu_id->id_submenu ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Menu</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <?php echo form_open("menu/submenu/tambah_menu_collapse"); ?>
                <div class="modal-body p-4">

                    <input type="hidden" name="submenu_id" value="<?= base64_encode($get_submenu_id->id_submenu) ?>">
                    <input type="hidden" name="menu_id" value="<?= base64_encode($get_submenu_id->id_menu) ?>">

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

    <!-- edit modal content -->
    <?php foreach ($get_menu_collapse as $edit) : ?>
        <div id="edit<?= $edit->sub_id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Menu</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <?php echo form_open("menu/submenu/edit_menu_collapse"); ?>
                    <div class="modal-body p-4">
                        <input type="hidden" name="sub_id" value="<?= base64_encode($edit->sub_id) ?>">
                        <input type="hidden" name="submenu_id" value="<?= base64_encode($get_submenu_id->id_submenu) ?>">
                        <input type="hidden" name="menu_id" value="<?= base64_encode($get_submenu_id->id_menu) ?>">

                        <div class="form-group">
                            <label for="nomor_urut" class="control-label">Posisi Ke <span class="text-danger">*</span></label>
                            <input type="nomor" class="form-control" name="nomor_urut" placeholder="Posisi menu ke" value="<?= $edit->nomor_urut ?>">
                        </div>

                        <div class="form-group">
                            <label for="judul" class="control-label">Menu Collapse <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="judul" placeholder="Nama menu collapse" value="<?= $edit->judul ?>">
                        </div>

                        <div class="form-group">
                            <label for="url" class="control-label">Url <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="url" placeholder="Nama url" value="<?= $edit->url ?>">
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
                        <button type="submit" class="btn btn-outline-success waves-effect waves-light"><i class="fe-save"></i></button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div><!-- /.modal -->
    <?php endforeach; ?>