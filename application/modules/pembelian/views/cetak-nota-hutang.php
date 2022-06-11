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
            <div class="col-md-6">
                <?php $suplier = $this->db->get_where('tb_suplier', ['id_suplier'=>$get_pembelian['invoice_suplier_id']])->row_array();?>
                <strong><?= $suplier['nama']?></strong><br>
                <?= $suplier['alamat']?> <br>
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
                        <span class="float-right">#<?= $get_pembelian['invoice_pembelian']?></span><br>
                        <strong class="float-right">Tanggal Pembelian</strong><br>
                        <span class="float-right"><?= $get_pembelian['invoice_tgl']?></span>
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
                    <th class="text-center">Keterangan</th>
                    <th class="text-center">Kuantitas</th>
                    <th class="text-center">Harga Satuan</th>
                    <th class="text-center">Jumlah</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                $no = 1; 
                $jml =0;
                $total = 0;
                foreach($get_invoice_pembelian as $data):
                    $jml = $data->barang_harga_beli*$data->barang_qty;
                    ?>
                    <?php $total += $data->barang_harga_beli*$data->barang_qty;?>
                <tr>
                    <td class="text-center"><?= $no++;?></td>
                    <td><?= $data->barang_nama?></td>
                    <td class="text-center"><?= $data->barang_qty?></td>
                    <td class="text-right">Rp.<?= rupiah($data->barang_harga_beli)?></td>
                    <td class="text-right">Rp.<?= rupiah($jml)?></td>
                </tr>
                <?php endforeach;?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-right" colspan="4">Total</th>
                    <th class="text-right">Rp.<?= rupiah($total)?></th>
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