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

</head>
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
            <p class="pr-0">
                <strong style="font-size: 30px;"><?= $toko['toko_nama'] ?></strong><br>
                <strong style="font-size:20px;">Laporan Data Material Terpakai</strong><br>
                <span class="text-muted pt-0"><?= $toko['toko_alamat'] ?>. <?= $toko['toko_wa'] ?></span>
            </p>
            <div class="hosizontal_center pt-0 "></div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Keterangan</th>
                    <th class="text-center">Kuantitas</th>
                    <th class="text-center">Jumlah</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $no = 1;
                $total = 0;
                foreach ($get_invoice_penjualan as $data) :
                    $total += $data->barang_qty * $data->keranjang_harga;
                ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= $data->produksi_nama; ?></td>
                        <td class="text-center"><?= $data->barang_qty; ?></td>
                        <td class="text-right">Rp.<?= rupiah($data->keranjang_harga); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-right" colspan="3">Total</th>
                    <th class="text-right">Rp.<?= rupiah($total); ?></th>
                </tr>
            </tfoot>
        </table>

        <div class="row pt-4">
            <div class="col-md-9">

            </div>
            <div class="col-md pt-4">
                <p>Luwu, <?= date_indo('Y-m-d') ?></p>
                <br>
                <br>
                <u>CV. Lombu Cipta Perkasa</u>
            </div>
        </div>
    </div>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script>
        window.print();
    </script>
</body>

</html>