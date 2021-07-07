<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $sekolah['nama_sekolah'] ?></h1>
        </div>

        <div class="section-body">
            <div class="container-fluid">
                <?= $this->session->flashdata('pesan') ?>
                <form action="<?= base_url('pemilik/laporan/cetak_lap_pemesanan') ?>" method="post">
                    <input type="hidden" name="id_sekolah" value="<?= $id_sekolah ?>">
                    <div class="form-row ">
                        <div class="form-group col-md-2">
                            <label for="kelas">Kelas</label>
                            <select name="kelas" id="kelas" class="form-control">
                                <?php foreach ($kelas as $kls) : ?>
                                    <option value="<?= $kls['id_kelas'] ?>"><?= $kls['nama_kelas'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputState">Bulan</label>
                            <select name="bulan" id="bulan" class="form-control ">
                                <option <?= date('m') == '01' ? 'selected' : '' ?> value="01">Januari</option>
                                <option <?= date('m') == '02' ? 'selected' : '' ?> value="02">Februari</option>
                                <option <?= date('m') == '03' ? 'selected' : '' ?> value="03">Maret</option>
                                <option <?= date('m') == '04' ? 'selected' : '' ?> value="04">April</option>
                                <option <?= date('m') == '05' ? 'selected' : '' ?> value="05">Mei</option>
                                <option <?= date('m') == '06' ? 'selected' : '' ?> value="06">Juni</option>
                                <option <?= date('m') == '07' ? 'selected' : '' ?> value="07">Juli</option>
                                <option <?= date('m') == '08' ? 'selected' : '' ?> value="08">Agustus</option>
                                <option <?= date('m') == '09' ? 'selected' : '' ?> value="09">September</option>
                                <option <?= date('m') == '10' ? 'selected' : '' ?> value="10">Oktober</option>
                                <option <?= date('m') == '11' ? 'selected' : '' ?> value="11">November</option>
                                <option <?= date('m') == '12' ? 'selected' : '' ?> value="12">Desember</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputZip">Tahun</label>
                            <input type="number" name="tahun" class="form-control" id="tahun" value="<?= date('Y') ?>">

                        </div>
                        <div class="form-group col-md-2 d-flex ">
                            <button type="submit" class="btn btn-primary align-self-end mb-1" data-toggle="tooltip" data-placement="top" title="Cetak Data"><i class="fa fa-print"></i></button>

                        </div>
                    </div>
                </form>

                <div class="table-responsive-sm overflow-auto">
                    <table class="table table-sm  table_pesanan">
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
                                    <td class="border"><?= $kelas[0]['nama_kelas'] ?></td>

                                    <?php foreach ($pemesanan[$index] as $psn) : ?>

                                        <td class="border"><em><?= $psn['pesan'] ?></em></td>

                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <th colspan="3" class="text-center border">Total Pagi</th>
                                <?php foreach ($jumlah_pagi as $index => $pagi) : ?>
                                    <td class="border text-small"><?= $pagi + $jumlah_dobel[$index] ?></td>
                                <?php endforeach; ?>
                            </tr>
                            <tr>

                                <th colspan="3" class="text-center border">Total Siang</th>
                                <?php foreach ($jumlah_siang as $index => $siang) : ?>
                                    <td class="border text-small"><?= $siang + $jumlah_dobel[$index] ?></td>
                                <?php endforeach; ?>
                            </tr>

                            <tr>
                                <th colspan="3" class="text-center border">Total Order</th>
                                <td colspan="<?= $total_order['colspan'] ?>" class="text-center"><?= $total_order['pesan'] ?></td>
                            </tr>
                        </tbody>

                    </table>
                </div>

                <!-- <div class="row">
                    <div class="col border ">
                        <button class="btn btn-primary float-right"><i class="fa fa-print"></i></button>
                    </div>
                </div> -->
            </div>
        </div>
</div>
</div>
</section>
</div>