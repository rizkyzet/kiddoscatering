<!DOCTYPE html>
<html>

<head>
    <title>Report Table</title>
    <style type="text/css">
        #outtable {
            padding: 20px;
            border: 1px solid #e3e3e3;
            width: 600px;
            border-radius: 5px;
        }

        .short {
            width: 50px;
        }

        .normal {
            width: 150px;
            text-align: center;
        }


        .logo {
            height: 80px;
            width: 80px;
            margin-bottom: -15px;
        }

        table {
            /* page-break-inside: avoid; */
            /* page-break-before: always; */
            page-break-inside: avoid;
        }
    </style>
</head>

<body>
    <div>
        <img class="logo" src="<?= base_url('assets/img/logo_kiddos.jpeg') ?>" alt="">
    </div>
    <hr>
    <div id="outtable">
        <table border="0" cellspacing="0" cellpadding="5">
            <tr>
                <th>Tanggal</th>
                <td><?= $tanggal ?></td>
            </tr>

            <tr>
                <th style="text-align: left;">Menu</th>
                <td><?= $nama_makanan_hari_ini ? $nama_makanan_hari_ini['nama_makanan'] : 'belum ditentukan' ?></td>
            </tr>

            <tr>
                <th style="text-align: left;">Sekolah</th>
                <td><?= $sekolah['nama_sekolah'] ?></td>
            </tr>

        </table>

        <br><br>
        <?php foreach ($pengiriman as $data) : ?>
            <table border="1" cellspacing="0" cellpadding="10">
                <thead>
                    <tr>
                        <th colspan="3"><?= $data['nama_kelas'] ?></th>
                    </tr>
                    <tr>

                        <th class="short">Waktu</th>
                        <th class="short">Jumlah</th>
                        <th class="normal">Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Pagi</td>
                        <td><?= $data['pagi'] ?></td>
                        <td style="width: 500px;">
                            <ul>
                                <?php foreach ($data['catatan_pagi'] as $pagi) : ?>
                                    <li style="font-size: 13px;"><?= $pagi['nama_siswa'] . " ganti menu " . $pagi['menu_pengganti'] ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </td>

                    </tr>
                    <tr>
                        <td>Siang</td>
                        <td><?= $data['siang'] ?></td>
                        <td>
                            <ul>
                                <?php foreach ($data['catatan_siang'] as $siang) : ?>
                                    <li style="font-size: 13px;"><?= $siang['nama_siswa'] . " ganti menu " . $siang['menu_pengganti'] ?></li>
                                <?php endforeach; ?>
                            </ul>

                        </td>

                    </tr>


                </tbody>

            </table>

            <br>
        <?php endforeach; ?>
        <br>
        <hr>
        <table border="1" cellspacing="0" cellpadding="10">
            <thead>
                <tr>
                    <th>Total Pagi</th>
                    <th>Total Siang</th>
                    <th>Total Pesanan</th>
                </tr>

            </thead>
            <tbody>
                <tr>
                    <td><?= $total['total_pagi'] ?></td>
                    <td><?= $total['total_siang'] ?></td>
                    <td><?= $total['total_pemesanan'] ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>