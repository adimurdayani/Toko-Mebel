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
                <strong style="font-size:20px;">Laporan Data Material Terpakai</strong><br>
                <span class="text-muted pt-0"><?= $toko['toko_alamat'] ?>. <?= $toko['toko_wa'] ?></span>
            </p>
            <div class="hosizontal_center pt-0 "></div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Kode Barang</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Kategori</th>
                    <th class="text-center">Harga Beli</th>
                    <th class="text-center">Harga Jual</th>
                    <th class="text-center">Stok</th>
                    <th class="text-center">Satuan</th>
                </tr>
            </thead>

            <tbody>
                <?php $no = 1;
                foreach ($get_barang as $data) : ?>
                    <?php if ($data->barang_stok ==  0) : ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td class="text-center"><?= $data->barang_kode ?></td>
                            <td class="text-center"><?= $data->barang_nama ?></td>
                            <td><?= $data->nama_kategori ?></td>
                            <td class="text-right">Rp.<?= rupiah($data->barang_harga_beli) ?></td>
                            <td class="text-right">Rp.<?= rupiah($data->barang_harga) ?></td>
                            <td class="text-center"><?= $data->barang_stok ?></td>
                            <td><?= $data->nama_satuan ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
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