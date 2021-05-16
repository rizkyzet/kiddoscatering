<table class="table table-sm">
    <thead>
        <tr>
            <th>No</th>
            <th>Sekolah</th>
            <th>NIS</th>
            <th>Kelas</th>
            <th>Nama</th>
            <th>Tanggal Pembayaran</th>
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
                <td><?= $dapat['total_bayar'] ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <th class="border">Total Pendapatan</th>
            <td class="border text-center" colspan="6" class="text-center"><?= $total_pendapatan ?></td>
        </tr>
    </tbody>
</table>