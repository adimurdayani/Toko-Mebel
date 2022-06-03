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
                                    <h3 class="text-dark mt-1">Rp.<span data-plugin="counterup"><?= rupiah($total_pendapatan->invoice_sub_total) ?> </span></h3>
                                    <p class="text-muted mb-1 text-truncate">Total Pendapatan</p>
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
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"><?= $total_invoice_penjualan ?></span></h3>
                                    <p class="text-muted mb-1 text-truncate">Invoice Penjualan Cash</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->
            </div>
            <div class="row">
                <?php $barang_terjual = 0;
                foreach ($total_barang as $barang) : ?>
                    <?php $barang_terjual += $barang->barang_terjual; ?>
                <?php endforeach; ?>
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
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"><?= $barang_terjual ?></span></h3>
                                    <p class="text-muted mb-1 text-truncate">Total Barang Terjual</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-4">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded bg-soft-warning">
                                    <i class="dripicons-box font-24 avatar-title text-warning"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"><?= $jml_barang ?></span></h3>
                                    <p class="text-muted mb-1 text-truncate">Jumlah Barang</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-4">
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
                                    <p class="text-muted mb-1 text-truncate">Total Invoice Penjualan</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->
            </div>
            <!-- end row-->
            <div class="row">
                <div class="col-lg-4">
                    <div class="card-box">

                        <div class="card-widgets">
                            <a data-toggle="collapse" href="#cardCollpase8" role="button" aria-expanded="false" aria-controls="cardCollpase8"><i class="mdi mdi-minus"></i></a>
                            <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                        </div>
                        <h4 class="header-title mb-0">Pengunjung</h4>

                        <div id="cardCollpase8" class="collapse pt-3 show" dir="ltr">
                            <div id="apex-bar-1" class="apex-charts" data-colors="#1abc9c"></div>
                        </div> <!-- collapsed end -->
                    </div> <!-- end card-box -->
                </div>
                <div class="col-lg-8">
                    <div class="card-box pb-2">

                        <h4 class="header-title mb-3">Statistik Pengunjung</h4>

                        <div dir="ltr">
                            <div id="sales-analytics" class="mt-4" data-colors="#1abc9c,#4a81d4"></div>
                        </div>
                    </div> <!-- end card-box -->
                </div> <!-- end col-->
            </div>

        </div> <!-- container -->

    </div> <!-- content -->

    <?php $this->load->view('template/footer'); ?>
    <?php
    //Inisialisasi nilai variabel awal
    $tanggal = "";
    $total_pengunjung = null;
    $pengunjung_on = null;
    foreach ($get_total_hits as $item) {
        $jum = $item->hits;
        $total_pengunjung .= "$jum" . ", ";

        $online = $item->total;
        $pengunjung_on .= "$online" . ", ";

        $tang = $item->date;
        $tanggal .= "'$tang'" . ", ";
    }
    ?>
    <script>
        var dataColors;
        colors = ["#1abc9c"];
        (dataColors = $("#sales-analytics").data("colors")) && (colors = dataColors.split(","));
        var chart;
        options = {
            series: [{
                name: "Pengunjung",
                type: "column",
                data: [<?= $total_pengunjung ?>]
            }, {
                name: "Online",
                type: "line",
                data: [<?= $pengunjung_on ?>]
            }],
            chart: {
                height: 378,
                type: "line"
            },
            stroke: {
                width: [2, 3]
            },
            plotOptions: {
                bar: {
                    columnWidth: "50%"
                }
            },
            colors: colors,
            dataLabels: {
                enabled: !0,
                enabledOnSeries: [1]
            },
            labels: [<?= $tanggal ?>],
            xaxis: {
                type: "datetime"
            },
            legend: {
                offsetY: 7
            },
            grid: {
                padding: {
                    bottom: 20
                }
            },
            fill: {
                type: "gradient",
                gradient: {
                    shade: "light",
                    type: "horizontal",
                    shadeIntensity: .25,
                    gradientToColors: void 0,
                    inverseColors: !0,
                    opacityFrom: .75,
                    opacityTo: .75,
                    stops: [0, 0, 0]
                }
            },
            yaxis: [{
                title: {
                    text: "Range"
                }
            }]
        };

        (chart = new ApexCharts(document.querySelector("#sales-analytics"), options)).render(), $("#dash-daterange").flatpickr({
            altInput: !0,
            mode: "range",
            altFormat: "F j, y",
            defaultDate: "today"
        });
    </script>

    <?php
    //Inisialisasi nilai variabel awal
    $browser = "";
    $total_koneksi = null;
    foreach ($get_total_userkoneksi as $koneksi) {

        $brows = $koneksi->browser;
        $browser .= "'$brows'" . ", ";

        $tot_konek = $koneksi->hits;
        $total_koneksi .= "$tot_konek" . ", ";
    }
    ?>

    <script>
        colors = ["#1abc9c"];
        (dataColors = $("#apex-bar-1").data("colors")) && (colors = dataColors.split(","));
        options = {
            chart: {
                height: 380,
                type: "bar",
                toolbar: {
                    show: !1
                }
            },
            plotOptions: {
                bar: {
                    horizontal: !0
                }
            },
            dataLabels: {
                enabled: !1
            },
            series: [{
                name: "Total",
                data: [<?= $total_koneksi ?>]
            }],
            colors: colors,
            xaxis: {
                categories: [<?= $browser ?>]
            },
            states: {
                hover: {
                    filter: "none"
                }
            },
            grid: {
                borderColor: "#f1f3fa"
            }
        };

        (chart = new ApexCharts(document.querySelector("#apex-bar-1"), options)).render();
    </script>