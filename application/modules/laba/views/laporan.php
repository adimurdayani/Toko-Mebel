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
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">

                            <form action="<?= base_url('laba/laporan/hapus_all/') ?>" method="POST" id="form-delete">

                                <button type="submit" class="btn btn-outline-danger mb-3" id="hapus"><i class="fe-trash"></i> Hapus</button>

                                <table id="basic-datatable" class="table table-bordered nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" style="vertical-align: middle;"><input type="checkbox" id="chack-all"></th>
                                            <th style="vertical-align: middle;" class="text-center" rowspan="2">Aksi</th>
                                            <th style="vertical-align: middle;" class="text-center" rowspan="2">No.</th>
                                            <th class="text-center" style="vertical-align: middle;" rowspan="2">Tanggal</th>
                                            <th style="vertical-align: middle;" class="text-center" colspan="6">Operasional</th>
                                            <th class="text-center" style="vertical-align: middle;" rowspan="2">Gaji</th>
                                            <th class="text-center" style="vertical-align: middle;" rowspan="2">Pengeluaran Lain</th>
                                            <th class="text-center" style="vertical-align: middle;" rowspan="2">Biaya tak terduga</th>
                                            <th class="text-center" style="vertical-align: middle;" rowspan="2">Total</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Bank</th>
                                            <th class="text-center">Kendaraan</th>
                                            <th class="text-center">Listrik</th>
                                            <th class="text-center">Perbaikan & <br> Pemeliharaan</th>
                                            <th class="text-center">Telp/Internet</th>
                                            <th class="text-center">Sewa</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $no = 1;
                                        $jml = 0;
                                        $total = 0;
                                        $subtotal = 0;
                                        foreach ($get_laba as $data) :
                                            $jml =  $data['perbaikan'] + $data['pemeliharaan'];
                                            $total +=  $data['perbaikan'] + $data['pemeliharaan'] + $data['bank'] + $data['motor'] + $data['listrik'] + $data['telp_internet'] + $data['sewa'] + $data['gaji'] + $data['pengeluaran_lain'] + $data['biaya_tak_terduga'];
                                            $subtotal += $total;
                                        ?>
                                            <tr>
                                                <td><input type="checkbox" class="check-item" value="<?= $data['id_biaya'] ?>" name="id_biaya[]"></td>
                                                <td class="text-center">
                                                    <a href="<?= base_url('laba/laporan/edit/') . base64_encode($data['id_biaya']) ?>" class="btn btn-sm btn-warning" title="Edit" data-plugin="tippy" data-tippy-placement="top"><i class="fe-edit"></i></a>
                                                    <a href="<?= base_url('laba/laporan/cetak/') . base64_encode($data['id_biaya']) ?>" class="btn btn-sm btn-info" title="Cetak Laba Bersih" data-plugin="tippy" data-tippy-placement="top"><i class="fe-edit"></i></a>
                                                    <a href="<?= base_url('laba/laporan/hapus/') . base64_encode($data['id_biaya']) ?>" class="btn btn-sm btn-danger hapus" title="Hapus" data-plugin="tippy" data-tippy-placement="top"><i class="fe-trash"></i></a>
                                                </td>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td><?= $data['biaya_tanggal'] ?></td>
                                                <td class="text-right">Rp.<?= rupiah($data['bank']) ?></td>
                                                <td class="text-right">Rp.<?= rupiah($data['motor']) ?></td>
                                                <td class="text-right">Rp.<?= rupiah($data['listrik']) ?></td>
                                                <td class="text-right">Rp.<?= rupiah($jml) ?></td>
                                                <td class="text-right">Rp.<?= rupiah($data['telp_internet']) ?></td>
                                                <td class="text-right">Rp.<?= rupiah($data['sewa']) ?></td>
                                                <td class="text-right">Rp.<?= rupiah($data['gaji']) ?></td>
                                                <td class="text-right">Rp.<?= rupiah($data['pengeluaran_lain']) ?></td>
                                                <td class="text-right">Rp.<?= rupiah($data['biaya_tak_terduga']) ?></td>
                                                <td class="text-right">Rp.<?= rupiah($total) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="13"><strong class="float-right font-18">Total</strong></td>
                                            <td class="text-center" style="vertical-align:middle;"><strong class="text-danger float-right">Rp.<?= rupiah($subtotal) ?></strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </form>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->

            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->