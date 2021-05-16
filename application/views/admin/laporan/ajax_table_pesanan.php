<thead>
    <tr>
        <th rowspan="2" class="border align-middle text-center">No</th>
        <th rowspan="2" class="border align-middle text-center">Nama</th>
        <th rowspan="2" class="border align-middle text-center">Kelas</th>

        <?php foreach ($col_tanggal as $col) : ?>
            <?php if (date('D', strtotime($col)) == 'Sun' or date('D', strtotime($col)) == 'Sat') { ?>
                <th class="bg-danger text-white border "><?= date('d', strtotime($col)) ?></th>
            <?php } else { ?>
                <th class="border"><?= date('d', strtotime($col)) ?></th>
            <?php } ?>
        <?php endforeach; ?>
    </tr>
    <tr>

        <?php foreach ($col_tanggal as $col) : ?>
            <?php if (date('D', strtotime($col)) == 'Sun' or date('D', strtotime($col)) == 'Sat') { ?>
                <th class="bg-danger text-white border text-small"><?= getDayIndo(date('D', strtotime($col))) ?></th>
            <?php } else { ?>
                <th class="border text-small"><?= getDayIndo(date('D', strtotime($col))) ?></th>
            <?php } ?>
        <?php endforeach; ?>
    </tr>
</thead>
<tbody>
    <?php $no = 1;
    foreach ($siswa as $index => $swa) : ?>
        <tr>
            <td class="border"><?= $no++ ?></td>
            <td class="border"><?= $swa['nama_siswa'] ?></td>
            <td class="border"><?= $kelas['nama_kelas'] ?></td>

            <?php foreach ($pemesanan[$index] as $psn) : ?>

                <td class="border"><em><?= $psn['pesan'] ?></em></td>

            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
    <tr>
        <th colspan="3" class="text-center border">Total Pagi</th>
        <?php foreach ($jumlah_pagi as $index => $pagi) : ?>
            <td class="border"><?= $pagi + $jumlah_dobel[$index] ?></td>
        <?php endforeach; ?>
    </tr>
    <tr>

        <th colspan="3" class="text-center border">Total Siang</th>
        <?php foreach ($jumlah_siang as $index => $siang) : ?>
            <td class="border"><?= $siang + $jumlah_dobel[$index] ?></td>
        <?php endforeach; ?>
    </tr>

</tbody>