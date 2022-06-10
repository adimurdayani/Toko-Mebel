<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
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
                        <img src="<?= base_url('assets/images/logo_lombu.png') ?>" alt="" width="40%">
                    </div>
                </div>

            </div>
        </div>
        <div class="row mt-2 mb-4">
            <div class="col-md-6">
                <strong>Nama Kostumer</strong><br>
                Alamat <br>
                <strong>No. Invoice</strong>
            </div>

            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <strong class="float-right">Tanggal diterbitkan</strong><br>
                        <span class="float-right">Alamat</span> <br>
                        <strong class="float-right">Tipe Pembayaran</strong><br>
                        <span class="float-right">Cash</span>
                    </div>
                    <div class="verikal_center"></div>
                    <div class="col-md-5">
                        <strong>Nama Perusahaan</strong><br>
                        <span>Alamat</span> <br>
                        <strong>Phone</strong><br>
                        <span>phone</span>
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
                <tr>
                    <td class="text-center">1</td>
                    <td>Lemari</td>
                    <td class="text-center">1</td>
                    <td class="text-right">Rp.100.000</td>
                    <td class="text-right">Rp.100.000</td>
                </tr>
                <tr>
                    <td class="text-center">1</td>
                    <td>Lemari</td>
                    <td class="text-center">1</td>
                    <td class="text-right">Rp.100.000</td>
                    <td class="text-right">Rp.100.000</td>
                </tr>
                <tr>
                    <td class="text-center">1</td>
                    <td>Lemari</td>
                    <td class="text-center">1</td>
                    <td class="text-right">Rp.100.000</td>
                    <td class="text-right">Rp.100.000</td>
                </tr>
                <tr>
                    <td class="text-center">1</td>
                    <td>Lemari</td>
                    <td class="text-center">1</td>
                    <td class="text-right">Rp.100.000</td>
                    <td class="text-right">Rp.100.000</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-right" colspan="4">Total</th>
                    <th class="text-right">Ro.200.000</th>
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