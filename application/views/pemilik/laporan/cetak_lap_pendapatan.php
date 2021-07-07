<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .logo {
            height: 80px;
            width: 80px;
            margin-bottom: -15px;

        }

        .header {
            display: flex;
        }

        h1 {
            font-family: "Times New Roman", Times, serif;
        }
    </style>
</head>

<body>
    <div>
        <img class="logo" src="<?= base_url('assets/img/logo_kiddos.jpeg') ?>" alt="">
    </div>
    <hr>
    <div style="text-align:center;">
        <h2><span>Laporan Pendapatan</span></h2>
    </div>
    <table align="center" border="1" cellspacing="0" cellpadding="10">
        <thead>
            <tr>
                <th>No</th>
                <th>Sekolah</th>
                <th>NIS</th>
                <th>Kelas</th>
                <th>Nama</th>
                <th>Tanggal Pembayaran</th>
                <th>Keterangan</th>
                <th>Bayar</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($pendapatan as $dapat) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $dapat['nama_sekolah'] ?></td>
                    <td><?= $dapat['nis'] ?></td>
                    <td><?= $dapat['nama_kelas'] ?></td>
                    <td><?= $dapat['nama_siswa'] ?></td>
                    <td><?= $dapat['tanggal_dibayar'] ?></td>
                    <td><?= 'pembayaran catering bulan ' . getMonthIndo(date('F', strtotime($dapat['tanggal_mulai']))) . ' ' . date('Y', strtotime($dapat['tanggal_mulai'])) ?></td>
                    <td><?= $dapat['total_bayar'] ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <th class="border">Total Pendapatan</th>
                <td class="border text-center" colspan="7" align="center"><?= $total_pendapatan ?></td>
            </tr>
        </tbody>
    </table>
</body>

</html>