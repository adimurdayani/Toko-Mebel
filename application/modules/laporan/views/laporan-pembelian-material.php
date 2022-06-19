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
                                            <label for="">Nama Material</label>
                                            <select name="id_barang" id="id_barang" class="form-control" data-toggle="select2" required>
                                                <option value="">-- Pilih material --</option>
                                                <?php foreach ($get_material as $data) : ?>
                                                    <option value="<?= $data->id_barang ?>"><?= $data->barang_nama ?></option>
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
            $barang_id = $this->input->post('id_barang');

            $sql = "SELECT count(if(barang_id='$barang_id', barang_id, NULL)) as barang_id,
                        sum(if(barang_id='$barang_id', barang_qty, NULL)) as barang_qty
                        FROM tb_pembelian_detail";
            $total_barang = $this->db->query($sql)->row();

            if (!empty($tgl_awal) || !empty($tgl_akhir) || !empty($id_produksi)) :
                $this->db->where('pembelian_date >=', date_indo($tgl_awal));
                $this->db->where('pembelian_date <=', date_indo($tgl_akhir));
                $this->db->where('barang_id', $barang_id);
                $get_penjualan = $this->db->get('tb_pembelian_detail')->result();

                $this->db->where('barang_id', $barang_id);
                $jml_barang = $this->db->get('tb_pembelian_detail')->num_rows();
            ?>
                <div class="row">
                    <div class="col-lg">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <h4 class="header-title mb-2">Tabel <?= $title ?></h4>
                                <div class="btn-group mb-2">
                                    <a href="<?= base_url('laporan/eksport_pembelian/laporan_pembelian_material_excel/') . base64_encode($barang_id) ?>" class="btn btn-light">Export to Excel</a>
                                    <a href="<?= base_url('laporan/eksport_pembelian/laporan_pembelian_material_pdf/') . base64_encode($barang_id) ?>" target="_blank" class="btn btn-light">Export to PDF</a>
                                    <a href="<?= base_url('laporan/eksport_pembelian/laporan_pembelian_material_csv') ?>" class="btn btn-light">Export to CSV</a>
                                </div>
                                <table id="basic-datatable" class="table nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Invoice</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Material</th>
                                            <th class="text-center">QTY Pembelian</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($get_penjualan as $data) :
                                            $material = $this->db->get('tb_barang', ['id_barang' => $barang_id])->row();
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td class="text-center"><?= $data->pembelian_invoice ?></td>
                                                <td class="text-center"><?= $data->pembelian_date ?></td>
                                                <td><?= $material->barang_nama ?></td>
                                                <td class="text-center"><?= $data->barang_qty ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <div class="float-right mt-4">
                                    <h4><strong>Total</strong> <strong class="text-success">pembelian <?= $jml_barang ?>x</strong> dengan jumlah keseluruhan <strong>QTY pembelian <?= $total_barang->barang_qty ?></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </h4>
                                </div>
                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->

                </div>
                <!-- end row-->
            <?php endif; ?>

        </div> <!-- container -->

    </div> <!-- content -->