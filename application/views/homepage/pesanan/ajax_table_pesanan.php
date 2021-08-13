<table class="table table-sm table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Pesan</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;
        foreach ($siswa_order as $order) : ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $order['nis'] ?></td>
                <td><?= $order['nama_siswa'] ?></td>
                <td><?= $order['nama_kelas'] ?></td>
                <td><strong><?= $order['pesan'] ? $order['pesan'] : '-' ?></strong></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>