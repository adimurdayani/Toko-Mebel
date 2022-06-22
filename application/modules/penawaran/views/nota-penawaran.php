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
</style>

<body>
    <div class="container p-3">
        <div class="row">
            <div class="col-md-6">

            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <img src="<?= base_url('assets/images/upload/') . $get_config->logo_nota ?>" alt="" width="40%">
                    </div>
                </div>

            </div>
        </div>

        <div class="row mt-2 mb-4">
            <div class="col-md-8">
                <p>(......................................) <br> </p>
            </div>
            <?php
            $jml = $this->db->get('tb_toko', ['toko_user_id' => $session->id])->num_rows();
            if ($jml != 0) {
                $toko = $this->db->get_where('tb_toko', ['toko_user_id' => $session->id])->row_array();
            } else {
                $toko = 0;
            } ?>
            <div class="col-md">
                <div class="row">
                    <div class="col-md-6">
                        <strong class="float-right">Tanggal</strong><br>
                        <span class="float-right"><?= $get_penawaran['tanggal'] ?></span>
                    </div>
                    <div class="verikal_center"></div>
                    <div class="col-md-5">
                        <strong><?= $toko['toko_nama'] ?></strong><br>
                        <span><?= $toko['toko_alamat'] ?></span> <br>
                        <span><?= $toko['toko_wa'] ?></span>
                    </div>
                </div>
            </div>
        </div>
        <h5><strong><?= $get_penawaran['nama_barang'] ?></strong></h5>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th class="text-center">Keterangan</th>
                    <th class="text-center">Qty barang</th>
                    <th class="text-center">Harga</th>
                    <th class="text-center">Diskon</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><?= $get_penawaran['keterangan'] ?></td>
                    <td class="text-center"><?= $get_penawaran['penawaran_qty'] ?></td>
                    <td class="text-right">Rp.<?= rupiah($get_penawaran['harga']) ?></td>
                    <td class="text-right">Rp.<?= rupiah($get_penawaran['diskon']) ?></td>

                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"><strong class="float-right">Total</strong></td>
                    <td class="text-right"><strong>Rp.<?= rupiah($get_penawaran['total']) ?></strong></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script>
        // window.print();
    </script>
</body>

</html>