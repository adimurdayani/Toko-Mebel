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
                            <h4 class="header-title mb-2">Filter data laporan berdasarkan tanggal </h4>

                            <form action="" method="POST">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Tanggal Awal</label>
                                            <input type="date" name="tgl_awal" id="tgl_awal" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Tanggal Akhir</label>
                                            <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nama Produksi</label>
                                            <select name="id_produksi" id="id_produksi" class="form-control" data-toggle="select2" required>
                                                <option value="">-- Pilih Produksi --</option>
                                                <?php foreach ($get_produk as $data) : ?>
                                                    <option value="<?= $data->id_produksi ?>"><?= $data->produksi_nama ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-info mt-4 float-right"><i class="fe-filter"></i> Filter</button>
                            </form>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->

            </div>
            <!-- end row-->

            <?php

            $tgl_awal = $this->input->post('tgl_awal');
            $tgl_akhir = $this->input->post('tgl_akhir');
            $id_produksi = $this->input->post('id_produksi');

            $sql = "SELECT count(if(id_produksi='$id_produksi', id_produksi, NULL)) as id_produksi,
                        sum(if(id_produksi='$id_produksi', produksi_terjual, NULL)) as produksi_terjual
                        FROM tb_produksi";
            $total_terjual = $this->db->query($sql)->row();

            if (!empty($tgl_awal) || !empty($tgl_akhir) || !empty($id_produksi)) :
                $this->db->where('updated_at >=', date_indo($tgl_awal));
                $this->db->where('updated_at <=', date_indo($tgl_akhir));
                $this->db->where('id_produksi', $id_produksi);
                $get_penjualan = $this->db->get('tb_produksi')->result();

                $this->db->where('id_produksi', $id_produksi);
                $get_total = $this->db->get('tb_produksi')->num_rows();
            ?>
                <div class="row">
                    <div class="col-lg">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <h4 class="header-title mb-2">Tabel <?= $title ?></h4>
                                <div class="btn-group mb-2">
                                    <button type="button" class="btn btn-light">Export Excel</button>
                                    <button type="button" class="btn btn-light">Export PDF</button>
                                    <button type="button" class="btn btn-light">Export CSV</button>
                                </div>
                                <table id="basic-datatable" class="table nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Invoice</th>
                                            <th>Tanggal</th>
                                            <th>Produk</th>
                                            <th>QTY Terjual</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($get_penjualan as $data) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $data->produksi_invoice ?></td>
                                                <td><?= $data->updated_at ?></td>
                                                <td><?= $data->produksi_nama ?></td>
                                                <td><?= $data->produksi_terjual ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <div class="float-right mt-4">
                                    <h4><strong>Total</strong> <strong class="text-success">terjual <?= $get_total ?>x</strong> dengan jumlah keseluruhan <strong>QTY Terjual <?= $total_terjual->produksi_terjual ?></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </h4>
                                </div>
                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->

                </div>
                <!-- end row-->
            <?php endif; ?>

        </div> <!-- container -->

    </div> <!-- content -->