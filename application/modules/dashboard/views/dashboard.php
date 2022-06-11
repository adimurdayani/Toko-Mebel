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
                        <h4 class="page-title"><?= $title ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-md-6">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded bg-soft-primary">
                                    <i class="dripicons-wallet font-24 avatar-title text-primary"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span id="pendapatan">0 </span></h3>
                                    <p class="text-muted mb-0 text-truncate">Total Pendapatan hari ini</p>
                                    <small class="text-muted mb-1">tanggal: <?= date('d/m/Y') ?></small>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded bg-soft-success">
                                    <i class="dripicons-document font-24 avatar-title text-success"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span id="invoice_cash"></span></h3>
                                    <p class="text-muted mb-0 text-truncate">Invoice Penjualan Cash</p>
                                    <small class="text-muted mb-1">tanggal: <?= date('d/m/Y') ?></small>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->
            </div>
            <div class="row">

                <!--  -->
                <div class="col-md-4">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded bg-soft-success">
                                    <i class="dripicons-basket font-24 avatar-title text-success"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h4 class="text-dark mt-1"><span id="total_all_pendapatan">0</span></h4>
                                    <p class="text-muted mb-1 text-truncate">Pendapatan</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-4">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded bg-soft-info">
                                    <i class="dripicons-basket font-24 avatar-title text-info"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h4 class="text-dark mt-1"><span data-plugin="counterup" id="barang_terjual"></span></h4>
                                    <p class="text-muted mb-1 text-truncate">Total Produksi</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-4">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded bg-soft-primary">
                                    <i class="dripicons-box font-24 avatar-title text-primary"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h4 class="text-dark mt-1"><span data-plugin="counterup" id="jml_barang"></span></h4>
                                    <p class="text-muted mb-1 text-truncate">Jumlah Barang</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <!-- <div class="col-md-3">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded bg-soft-warning">
                                    <i class="dripicons-document font-24 avatar-title text-warning"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"><?= $jml_invoice_penjualan; ?></span></h3>
                                    <p class="text-muted mb-1 text-truncate">Total Invoice</p>
                                </div>
                            </div>
                        </div> 
                    </div> 
                </div>  -->
            </div>
            <!-- end row-->
            <div class="row">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="float-right">
                                <h4 class="header-title mb-3">Rp.200.000.000</h4>
                            </div>
                            <h4 class="header-title mb-3">Dikurangi Biaya: </h4>

                            <div class="todoapp">
                                <div class="row">
                                    <div class="col">
                                        <strong id="todo-message">Biaya administrasi bank</strong>
                                    </div>
                                    <div class="col-auto">
                                        <a href="javascript:void(0);" class="float-right btn btn-light btn-sm" id="btn-archive">Archive</a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <strong id="todo-message">Biaya kendaraan bermotor</strong>
                                    </div>
                                    <div class="col-auto">
                                        <a href="javascript:void(0);" class="float-right btn btn-light btn-sm" id="btn-archive">Archive</a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <strong id="todo-message">Biaya listrik</strong>
                                    </div>
                                    <div class="col-auto">
                                        <a href="javascript:void(0);" class="float-right btn btn-light btn-sm" id="btn-archive">Archive</a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <strong id="todo-message">Biaya perbaikan & pemeliharaan</strong>
                                    </div>
                                    <div class="col-auto">
                                        <a href="javascript:void(0);" class="float-right btn btn-light btn-sm" id="btn-archive">Rp.12.000.000</a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <strong id="todo-message">Biaya sewa</strong>
                                    </div>
                                    <div class="col-auto">
                                        <a href="javascript:void(0);" class="float-right btn btn-light btn-sm" id="btn-archive">Archive</a>
                                    </div>
                                </div>

                                <div style="max-height: 310px;" data-simplebar>
                                    <ul class="list-group list-group-flush todo-list" id="todo-list"></ul>
                                </div>

                            </div> <!-- end .todoapp-->

                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div>
                <div class="col-lg-7">
                    <div class="card-box pb-2 table-responsive">
                        <h4 class="header-title mb-2">Hutang Kostumer</h4>
                        <table id="basic-datatable" class="table nowrap w-100">
                            <thead>
                                <tr>
                                    <th class="text-center">Aksi</th>
                                    <th>No</th>
                                    <th>Invoice</th>
                                    <th>Transaksi</th>
                                    <th>Kostumer</th>
                                    <th>Jatuh Tempo</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php $no = 1;
                                foreach ($get_penjualan_hutang as $data) : ?>
                                    <?php if ($data->invoice_piutang == 1) : ?>
                                        <tr>
                                            <td class="text-center">
                                                <a href="<?= base_url('penjualan/invoice/detail_invoice_piutang/') . base64_encode($data->penjualan_invoice) ?>" class="btn btn-outline-info" title="Detail Invoice Penjualan" data-plugin="tippy" data-tippy-placement="top"><i class="fe-eye"></i></a>
                                                <a href="<?= base_url('penjualan/piutang/cicilan_piutang/') . base64_encode($data->penjualan_invoice) ?>" class="btn btn-outline-warning" title="Cicilan Hutang" data-plugin="tippy" data-tippy-placement="top"><i class="mdi mdi-cash-plus"></i> </a>
                                                <a href="<?= base_url('penjualan/cetak_nota_hutang/') . base64_encode($data->penjualan_invoice) ?>" target="_blank" class="btn btn-outline-success" title="Cetak Nota Hutang" data-plugin="tippy" data-tippy-placement="top"><i class="fe-printer"></i> </a>
                                            </td>
                                            <td><?= $no++ ?></td>
                                            <td><?= $data->penjualan_invoice ?></td>
                                            <td><?= $data->invoice_tgl ?></td>
                                            <td><?= $data->nama ?> </td>
                                            <td>
                                                <?php
                                                $tgl1 = strtotime($data->invoice_piutang_jatuh_tempo);
                                                $tgl2 = strtotime(date_indo('Y-m-d'));
                                                $hasil = $tgl2 - $tgl1;
                                                $hari = $hasil / 60 / 60 / 24;
                                                ?>
                                                <?php if ($hari != 0) : ?>
                                                    <strike><?= $data->invoice_piutang_jatuh_tempo ?></strike>
                                                    <div class="badge badge-danger">Lewat <?= $hari ?> Hari</div>
                                                <?php else : ?>
                                                    <?= $data->invoice_piutang_jatuh_tempo ?>
                                                <?php endif; ?>
                                            </td>
                                            <td>Rp.<?= rupiah($data->invoice_total) ?></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div> <!-- end card-box -->
                </div> <!-- end col-->
            </div>

        </div> <!-- container -->

    </div> <!-- content -->
    <?php echo $this->load->view('template/footer');?>
    <script>
        $(document).ready(function() {
                load_data();
                function load_data() {
                    $.ajax({
                        url: "<?= base_url('dashboard/load_data'); ?>",
                        type:"post",
                        dataType: "JSON",
                        success: function(data) {
                            var pendapatan = 0;
                            var total = formatRupiah1(data.total, 'Rp.');
                            if (data.pendapatan === null) {
                                pendapatan = formatRupiah3('0','Rp.');
                                }else{
                                    pendapatan = formatRupiah2(data.pendapatan, 'Rp.');
                                }
                            $('#pendapatan').html(pendapatan);
                            $('#total_all_pendapatan').html(total);
                            $('#invoice_cash').html(data.invoice_cash);
                            $('#jml_barang').html(data.jml_barang);
                            $('#barang_terjual').html(data.barang_terjual);
                            // console.log(total);
                        }
                    })
                }
                setInterval(function(){ load_data(); },10000);
            });

        function formatRupiah1(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }

            function formatRupiah2(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }

            function formatRupiah3(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }
            
    </script>