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
    </style>
</head>

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
            <div class="col-md-6">

            </div>
            <?php
            $jml = $this->db->get('tb_toko', ['toko_user_id' => $session->id])->num_rows();
            if ($jml != 0) {
                $toko = $this->db->get_where('tb_toko', ['toko_user_id' => $session->id])->row_array();
            } else {
                $toko = 0;
            } ?>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <strong class="float-right">No. Invoice</strong><br>
                        <span class="float-right">#<?= $pembelian_transaksi_date['invoice_pembelian'] ?></span><br>
                        <strong class="float-right">Tanggal Penjualan</strong><br>
                        <span class="float-right"><?= $pembelian_transaksi_date['invoice_tgl'] ?></span>


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
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Invoice</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Suplier</th>
                    <th class="text-center">Total</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $no = 1;
                foreach ($pembelian_transaksi as $data) :
                    $suplier = $this->db->get_where('tb_suplier', ['id_suplier' => $data->invoice_suplier_id])->row(); ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td><?= $data->invoice_pembelian ?></td>
                        <td class="text-center"><?= $data->invoice_tgl ?></td>
                        <td class="text-center"><?= $suplier->nama_perusahaan ?></td>
                        <td class="text-center">Rp.<?= rupiah($data->invoice_total) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-right" colspan="4">Total Terjual</th>
                    <th class="text-right">Rp.<?= rupiah($total->invoice_total) ?></th>
                </tr>
            </tfoot>
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