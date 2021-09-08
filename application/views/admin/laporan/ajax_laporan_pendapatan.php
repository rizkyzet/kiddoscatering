<table class="table table-sm datatables table_laporan_pendapatan">
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

    </tbody>
    <tfoot>
        <tr>
            <th class="border">Total Pendapatan</th>
            <td class="border text-center" colspan="7" class="text-center"><?= $total_pendapatan ?></td>
        </tr>
    </tfoot>
</table>