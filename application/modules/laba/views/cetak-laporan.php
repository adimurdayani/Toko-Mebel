<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <?php if (!empty($get_config)) : ?>
        <link rel="shortcut icon" href="<?= base_url('assets/images/upload/') . $get_config->icon_web ?>">
    <?php endif; ?>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <style>
        .verikal_center {
            /*mengatur border bagian kiri tag div */
            border-left: 2px solid black;
            /* mengatur tinggi tag div*/
            height: 100px;
            /*mengatur lebar tag div*/
            width: 2px;
        }

        .hosizontal_center {
            /*mengatur border bagian kiri tag div */
            border-top: 3px solid black;
            /* mengatur tinggi tag div*/
            height: 2px;
            /*mengatur lebar tag div*/
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container p-3">

        <?php
        $jml = $this->db->get('tb_toko', ['toko_user_id' => $session->id])->num_rows();
        if ($jml != 0) {
            $toko = $this->db->get_where('tb_toko', ['toko_user_id' => $session->id])->row_array();
        } else {
            $toko = 0;
        } ?>

        <div class="text-center mb-4">
            <img src="<?= base_url('assets/images/upload/') . $get_config->logo_nota ?>" alt="" class="float-right" width="100px">
            <p>
                <strong style="font-size: 30px;"><?= $toko['toko_nama'] ?></strong><br>
                <strong style="font-size:20px;">Laporan Laba Bersih</strong><br>
                <span class="text-muted pt-0"><?= $toko['toko_alamat'] ?>. <?= $toko['toko_wa'] ?></span>
            </p>
            <div class="hosizontal_center pt-0 "></div>
        </div>

        <p>Laporan <strong>LABA BERSIH</strong> Tanggal: <?= $get_laba['biaya_tanggal'] ?></p>
        <table class="table table-bordered">
            <tr>
                <th colspan="2">1. Pendapatan</th>
            </tr>
            <tr>
                <td>a. Sub Total Penjualan</td>
                <td class="text-right">Rp.<?= rupiah($pendapatan['invoice_sub_total']) ?></td>
            </tr>
            <tr>
                <td>a. Pendapatan Lain </td>
                <td class="text-right">Rp.0</td>
            </tr>
            <tr>
                <th>Total Pendapatan</th>
                <th class="text-right">Rp.<?= rupiah($pendapatan['invoice_sub_total']) ?></th>
            </tr>
            <tr>
                <th colspan="2">2. HPP</th>
            </tr>
            <tr>
                <td>a. HPP (Harga Pokok Penjualan)</td>
                <td class="text-right">Rp.<?= rupiah($get_barang_beli['barang_harga_beli']) ?></td>
            </tr>
            <?php
            $laba_kotor = 0;
            $margin_kotor = 0;
            $laba_kotor =  $pendapatan['invoice_sub_total'] - $get_barang_beli['barang_harga_beli'];
            $margin_kotor =  round($pendapatan['invoice_sub_total'] / $get_barang_beli['barang_harga_beli'] * 100);

            ?>
            <tr>
                <th>Laba / Rugi Kotor</th>
                <th class="text-right">Rp.<?= rupiah($laba_kotor) ?></th>
            </tr>
            <tr>
                <th>Margin Laba / Rugi Kotor</th>
                <th class="text-right"><?= $margin_kotor ?>%</th>
            </tr>
            <tr>
                <th colspan="2">3. Biaya Pengeluaran</th>
            </tr>
            <tr>
                <td>a. Total Gaji Pengawai</td>
                <td class="text-right">Rp.<?= rupiah($get_laba['gaji']) ?></td>
            </tr>
            <tr>
                <td>b. Biaya Listrik 1 Bulan</td>
                <td class="text-right">Rp.<?= rupiah($get_laba['listrik']) ?></td>
            </tr>
            <tr>
                <td>c. Telpon & Internet</td>
                <td class="text-right">Rp.<?= rupiah($get_laba['telp_internet']) ?></td>
            </tr>
            <tr>
                <td>d. Transportasi & Bensin</td>
                <td class="text-right">Rp.<?= rupiah($get_laba['motor']) ?></td>
            </tr>
            <?php
            $pemeliharaan = 0;
            $pemeliharaan =  $get_laba['perbaikan'] + $get_laba['pemeliharaan'];
            ?>
            <tr>
                <td>e. Pemeliharaan & Perbaikan</td>
                <td class="text-right">Rp.<?= rupiah($pemeliharaan) ?></td>
            </tr>
            <tr>
                <td>f. Sewa</td>
                <td class="text-right">Rp.<?= rupiah($get_laba['sewa']) ?></td>
            </tr>
            <tr>
                <td>g. Biaya Tak Terduga</td>
                <td class="text-right">Rp.<?= rupiah($get_laba['biaya_tak_terduga']) ?></td>
            </tr>
            <tr>
                <td>h. Pengeluaran Lain</td>
                <td class="text-right">Rp.<?= rupiah($get_laba['pengeluaran_lain']) ?></td>
            </tr>
            <tr>
                <td>i. Administrasi Bank</td>
                <td class="text-right">Rp.<?= rupiah($get_laba['bank']) ?></td>
            </tr>
            <?php
            $jml_pengeluaran = 0;
            $jml_pengeluaran =  $get_laba['gaji'] + $get_laba['listrik'] + $get_laba['telp_internet'] + $get_laba['motor'] + $pemeliharaan + $get_laba['sewa'] + $get_laba['biaya_tak_terduga'] + $get_laba['pengeluaran_lain'] + $get_laba['pengeluaran_lain'];
            ?>
            <tr>
                <th>Total Biaya Pengeluaran</th>
                <th class="text-right">Rp.<?= rupiah($jml_pengeluaran) ?></th>
            </tr>
            <?php
            $laba_bersih = 0;
            $laba_bersih = $pendapatan['invoice_sub_total'] - $jml_pengeluaran;
            ?>
            <tr>
                <th>Laba Bersih</th>
                <th class="text-right">Rp.<?= rupiah($laba_bersih) ?></th>
            </tr>
            <?php
            $hasil = 0;
            $margin_bersih = $laba_bersih / $pendapatan['invoice_sub_total'];
            $hasil = $margin_bersih * 100;

            $pendapatan_bersih = 0;
            $hasil_p = $hasil / 100;
            $pendapatan_bersih =  $hasil_p * $pendapatan['invoice_sub_total'];

            ?>
            <tr>
                <th>Margin</th>
                <th class="text-right"><?= round($hasil) ?>%</th>
            </tr>
        </table>
    </div>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script>
        window.print();
    </script>
</body>

</html>