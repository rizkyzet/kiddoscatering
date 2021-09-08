<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= get_title() ?></h1>
        </div>

        <div class="section-body">
            <div class="container-fluid ">
                <form action="<?= base_url('admin/pengiriman/print') ?>" method="post" target="_blank">
                    <input type="hidden" name="id_sekolah" value="<?= $id_sekolah ?>">
                    <div class="form-row ">

                        <div class="form-group col-md-2">
                            <label>Tanggal</label>
                            <input type="text" name="tanggal" id="datepicker" class="form-control datepicker tanggal-pengiriman" data-id_sekolah=<?= $id_sekolah ?>>
                        </div>
                        <div class="form-group col-md-2 d-flex ">
                            <button <?= $holiday ? 'disabled' : '' ?> type="submit" class="btn btn-primary align-self-end mb-1" id="btn-print"><i class="fa fa-print"></i></button>
                        </div>

                    </div>
                </form>

                <?php if ($holiday) : ?>
                    <div class="div-pengiriman">
                        <div class="row">
                            <div class="col">
                                <h1>libur</h1>
                            </div>
                        </div>
                    </div>

                <?php elseif ($menuTidakDitemukan) : ?>
                    <div class="div-pengiriman">
                        <div class="row">
                            <div class="col">
                                <h1>Menu Bulan ini belum dibuat, Segera Buat Menu Bulan Ini!</h1>
                            </div>
                        </div>
                    </div>
                <?php else : ?>

                    <div class="div-pengiriman">
                        <div class="row">
                            <div class="col-md-4 ">
                                <table class="table table-md">
                                    <thead>
                                        <tr class="border">
                                            <th colspan="2">
                                                <h6> Info Pengiriman</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border">
                                            <td style="width: 30%;" class="border">Tanggal</td>
                                            <td><?= $tanggal ?></td>
                                        </tr>
                                        <tr class="border">
                                            <td style="width: 25%;" class="border">Menu</td>
                                            <td><?= $nama_makanan_hari_ini ? $nama_makanan_hari_ini['nama_makanan'] : 'belum ditentukan' ?></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>




                        <?php foreach ($pengiriman as $data) : ?>
                            <div class="row ">
                                <div class="col">
                                    <table class="table table-sm data-pengiriman">
                                        <thead>
                                            <tr>
                                                <th colspan="3" class="bg-secondary text-center"><?= $data['nama_kelas'] ?></th>
                                            </tr>
                                            <tr class=" border">

                                                <th style="width: 50px;">Waktu</>
                                                <th style="width: 50px;">Jumlah</th>
                                                <th>Catatan</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="border ">
                                                <td class="border ">Pagi</td>
                                                <td class="border "><?= $data['pagi'] ?></td>
                                                <td class="border ">
                                                    <ul>
                                                        <?php foreach ($data['catatan_pagi'] as $pagi) : ?>
                                                            <li class="text-small"><?= $pagi['nama_siswa'] . " ganti menu " . $pagi['menu_pengganti'] ?></li>
                                                        <?php endforeach; ?>
                                                    </ul>

                                                </td>
                                            </tr>
                                            <tr class="border ">
                                                <td class="border ">Siang</td>
                                                <td class="border "><?= $data['siang'] ?></td>
                                                <td class="border ">
                                                    <ul>

                                                        <?php foreach ($data['catatan_siang'] as $pagi) : ?>
                                                            <li class="text-small"><?= $pagi['nama_siswa'] . " ganti menu " . $pagi['menu_pengganti'] ?></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>