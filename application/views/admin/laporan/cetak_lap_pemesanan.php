<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .warna-baris {
            background-color: silver;
        }

        .warna-baris2 {
            background-color: red;
        }

        .logo {
            height: 80px;
            width: 80px;
            margin-bottom: -15px;
        }
    </style>
</head>

<body>

    <div>
        <img class="logo" src="<?= base_url('assets/img/logo_kiddos.jpeg') ?>" alt="">
    </div>
    <hr>
    <div style="text-align:center;">
        <h2><span>Laporan Pemesanan</span></h2>
    </div>
    <table border="1" cellspacing="0" cellpadding="10">
        <tr>

            <th rowspan="2">No</th>
            <th rowspan="2">Nama</th>
            <th rowspan="2">Kelas</th>
            <?php foreach ($col_tanggal as $tgl) : ?>
                <?php if (date('l', strtotime($tgl)) == 'Saturday' or date('l', strtotime($tgl)) == 'Sunday') { ?>
                    <th class="warna-baris2"> <?= date('d', strtotime($tgl)) ?></th>
                <?php } else { ?>
                    <th> <?= date('d', strtotime($tgl)) ?></th>
                <?php } ?>
            <?php endforeach; ?>
        </tr>

        <tr>
            <?php foreach ($col_tanggal as $tgl) : ?>
                <?php if (date('l', strtotime($tgl)) == 'Saturday' or date('l', strtotime($tgl)) == 'Sunday') { ?>
                    <th class="warna-baris2"> <?= getDayIndo(date('D', strtotime($tgl))) ?></th>
                <?php } else { ?>
                    <th> <?= getDayIndo(date('D', strtotime($tgl))) ?></th>
                <?php } ?>
            <?php endforeach; ?>
        </tr>
        <?php $no = 1;
        foreach ($siswa as $index => $siswa) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $siswa['nama_siswa'] ?></td>
                <td><?= $kelas['nama_kelas'] ?></td>
                <?php foreach ($pemesanan[$index] as $p) : ?>
                    <td><?= $p['pesan'] ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>

        <tr>
            <th colspan="3">Total Pagi</th>
            <?php foreach ($jumlah_pagi as $index => $pagi) : ?>
                <td><?= $pagi + $jumlah_dobel[$index] ?></td>
            <?php endforeach; ?>
        </tr>
        <tr>

            <th colspan="3">Total Siang</th>
            <?php foreach ($jumlah_siang as $index => $siang) : ?>
                <td><?= $siang + $jumlah_dobel[$index] ?></td>
            <?php endforeach; ?>
        </tr>
        <tr>

            <th colspan="3">Total Order</th>

            <td style="text-align: center;" colspan="<?= $total_order['colspan'] ?>"><?= $total_order['pesan'] ?></td>

        </tr>

    </table>
</body>

</html>