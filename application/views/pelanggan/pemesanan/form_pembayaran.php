<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pembayaran bulan <?= getMonthIndo(date('F', strtotime($tanggal_mulai))) ?></h1>
        </div>

        <div class="section-body">
            <div class="container-fluid">

                <div class="row ">
                    <div class="col-lg-8">
                        <div class="row mb-3">
                            <div class="col">
                                <strong>Data Siswa</strong>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-2">
                                <strong>NIS</strong>
                            </div>
                            <div class="col-3">
                                <?= $siswa['nis']; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <strong>Nama </strong>
                            </div>
                            <div class="col-3">
                                <?= $siswa['nama_siswa']; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <strong>Sekolah</strong>
                            </div>
                            <div class="col-3">
                                <?= $siswa['nama_sekolah'] ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <strong>Kelas</strong>
                            </div>
                            <div class="col-3">
                                <?= $siswa['nama_kelas'] ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <div class="col">
                                <strong>Detail Pemesanan bulan <?= getMonthIndo(date('F', strtotime($tanggal_mulai))) ?></strong>
                            </div>
                        </div>
                        <div class="row overflow-auto">
                            <div class="col">
                                <table class="table table-hover table-sm">
                                    <thead>

                                        <tr>
                                            <?php foreach ($tanggal_template as $tgl) : ?>
                                                <th scope="col"><?= date('j', strtotime($tgl)) ?></th>
                                            <?php endforeach; ?>
                                        </tr>
                                        <tr>
                                            <?php foreach ($hari_template as $hri) : ?>
                                                <?php if ($hri == 'Sab' or $hri == 'Min') { ?>
                                                    <th scope="col " class="bg-danger text-white"><?= $hri ?></th>
                                                <?php  } else { ?>
                                                    <th scope="col "><?= $hri ?></th>
                                                <?php } ?>
                                            <?php endforeach; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php for ($i = 1; $i < date('j', strtotime($tanggal_mulai)); $i++) { ?>
                                                <th scope="col bg-secondary"></th>
                                            <?php } ?>
                                            <?php foreach ($pesanan as $psn) { ?>
                                                <?php if ($psn['pesan'] == 'libur') { ?>
                                                    <td scope="col"></td>
                                                <?php } else { ?>
                                                    <td scope="col"><?= $psn['pesan'] ?></td>
                                                <?php } ?>
                                            <?php } ?>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                    <!-- detail pembayaran -->

                    <div class="col-lg-4 ">
                        <form id="payment-form" action="<?= base_url('pelanggan/pemesanan/save_order') ?>" method="post">
                            <input type="hidden" name="result_type" id="result-type" value="">
                            <input type="hidden" name="no_psn" value="<?= $no_psn ?>">
                            <input type="hidden" name="tanggal_mulai" value="<?= $tanggal_mulai ?>">
                            <input type="hidden" name="pesanan" value="<?= htmlspecialchars($pesanan_json) ?>">
                            <input type="hidden" name="result_data" id="result-data" value="">

                            <div class="row mb-3">
                                <div class="col">
                                    <strong>Detail Pembayaran</strong>
                                </div>

                            </div>
                            <hr>
                            <div class="row mt-3">
                                <div class="col">Bayar Pagi</div>
                                <div class="col">(Rp.12000 x <?= $detail_bayar['pagi'] ?>)</div>
                                <div class="col"><strong>Rp. <?= $detail_bayar['byr_pagi'] ?></strong></div>
                            </div>
                            <div class="row">
                                <div class="col">Bayar Siang</div>
                                <div class="col">(Rp.12000 x <?= $detail_bayar['siang'] ?>)</div>
                                <div class="col"><strong>Rp. <?= $detail_bayar['byr_siang'] ?></strong></div>
                            </div>
                            <hr>
                            <div class="row ">
                                <div class="col-8">
                                    <strong>Total Pembayaran</strong>
                                </div>
                                <div class="col-4">
                                    <p class="text-success ">
                                        <strong> Rp. <?= $detail_bayar['total_byr'] ?> </strong>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row ">
                                <div class="col">
                                    <button id="pay-button2" data-no_psn="<?= $no_psn ?>" data-total_byr="<?= $detail_bayar['total_byr'] ?>" data-mulai="<?= $tanggal_mulai ?>" class="btn btn-primary btn-block">Bayar</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>