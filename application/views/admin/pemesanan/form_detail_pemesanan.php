<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= get_title() ?></h1>
        </div>

        <div class="section-body">
            <div class="container-fluid">
                <?php if ($pemesanan['status_pemesanan'] == 'pending') : ?>
                    <div class="alert alert-warning alert-has-icon alert-dismissible fade show" role="alert">
                        <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
                        <div class="alert-body">
                            <div class="alert-title">Mohon Segera Dibayar !</div>

                            <ul>
                                <li>Untuk pembayaran dapat dibayar melalui nomor rekening / virtual account dibawah.</li>
                                <li>Untuk melihat batas waktu pembayaran dan tata cara pembayaran, klik tombol Lihat Instruksi </li>
                            </ul>


                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif ?>
                <div class="row">
                    <div class="col-md-4 ">
                        <table class="table table-md">
                            <thead>
                                <tr class="border">
                                    <th colspan="2">
                                        <h6><i class="fa fa-user-graduate pt-1"></i> Info Siswa</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border">
                                    <td style="width: 30%;" class="border">Nama Siswa</td>
                                    <td><?= $siswa['nama_siswa'] ?></td>
                                </tr>
                                <tr class="border">
                                    <td style="width: 25%;" class="border">Kelas</td>
                                    <td><?= $kelas['nama_kelas'] ?></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>

                <div class="row justify-content-between">
                    <div class="col-md">
                        <table class="table table-md">
                            <thead>
                                <tr class="border">
                                    <th colspan="3">
                                        <h6><i class="fa fa-shopping-cart pt-1"></i> Info Pemesanan</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border">
                                    <td style="width: 30%;" class="border">Deskripsi</td>
                                    <td>Catering Bulan <?= getNamaBulanFromNumber(date('m', strtotime($pemesanan['tanggal_mulai']))) . " " . date('Y', strtotime($pemesanan['tanggal_mulai'])) ?> </td>
                                    <td style="width: 1%;"><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#detail_pemesanan_modal"><i class="fa fa-eye"></i></button></td>
                                </tr>
                                <?php if ($pemesanan['status_pemesanan'] == 'settlement' || $pemesanan['status_pemesanan'] == 'pending') : ?>
                                    <tr class="border">
                                        <td style="width: 25%;" class="border">Pesanan Pagi</td>
                                        <td colspan="2"><?= $pesanan_pagi ?></td>
                                    </tr>
                                    <tr class="border">
                                        <td style="width: 25%;" class="border">Pesanan Siang</td>
                                        <td colspan="2"><?= $pesanan_siang ?></td>
                                    </tr>
                                    <tr class="border">
                                        <td style="width: 25%;" class="border">Pesanan Dobel</td>
                                        <td colspan="2"><?= $pesanan_dobel ?></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <br>
                        <table class="table table-md">
                            <thead>
                                <tr class="border">
                                    <th colspan="2">
                                        <h6><i class="fas fa-money-bill-wave"></i> Info Pembayaran</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border">
                                    <td style="width: 30%;" class="border">Status Pembayaran</td>
                                    <td>
                                        <?php if ($pemesanan['status_pemesanan'] == 'settlement') { ?>
                                            <span class="badge badge-pill badge-success">Selesai</span>
                                        <?php } elseif ($pemesanan['status_pemesanan'] == 'pending') { ?>
                                            <span class="badge badge-pill badge-warning">Menunggu Pembayaran</span>
                                        <?php } elseif ($pemesanan['status_pemesanan'] == 'cancel') { ?>
                                            <span class="badge badge-pill badge-danger">Dibatalkan</span>
                                        <?php } elseif ($pemesanan['status_pemesanan'] == 'expire') { ?>
                                            <span class="badge badge-pill badge-danger">Kadaluarsa</span>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr class="border">
                                    <td style="width: 30%;" class="border">VA Number / No. Rekening</td>
                                    <td><?= $pemesanan['va_number'] ?></td>
                                </tr>
                                <tr class="border">
                                    <td style="width: 30%;" class="border">Waktu Dibuat</td>
                                    <td><?= $pemesanan['tanggal_dibuat'] ?></td>
                                </tr>
                                <tr class="border">
                                    <td style="width: 30%;" class="border">Waktu Dibayar</td>
                                    <?php if ($pemesanan['status_pemesanan'] == 'settlement') : ?>
                                        <td><?= $pemesanan['tanggal_dibayar'] ?></td>
                                    <?php elseif ($pemesanan['status_pemesanan'] == 'pending') : ?>
                                        <td> - </td>
                                    <?php endif; ?>
                                </tr>
                                <tr class="border">
                                    <td style="width: 25%;" class="border">Jenis Pembayaran</td>
                                    <td><?= ucwords(str_replace('_', ' ', $pemesanan['jenis_pembayaran'])) ?></td>
                                </tr>
                                <tr class="border">
                                    <td style="width: 25%;" class="border">Nama Bank</td>
                                    <td><?= $pemesanan['bank'] ?></td>
                                </tr>
                                <tr class="border">
                                    <td style="width: 25%;" class="border">Total Bayar</td>
                                    <td><em>Rp. <?= number_format($pemesanan['total_bayar'], 0, ',', '.')  ?></em></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3 align-self-center">
                        <table class="table table-md">
                            <thead>
                                <tr class="border">
                                    <th>
                                        <h6><i class="fa fa-bank pt-1"></i> Bank</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border">
                                    <td class="text-center" style="width: 10%;">
                                        <img class="img-thumbnail" src="<?= base_url('assets/img/bank_img/' . $pemesanan['bank']) ?>.png" alt="">
                                        <hr>
                                        <?php if ($pemesanan['status_pemesanan'] == 'pending') : ?>
                                            <a target="_blank" rel="noopener noreferrer" href="<?= $pemesanan['instruksi'] ?>" class="btn  btn-primary btn-sm btn-block " role="button">Lihat Instruksi</a>
                                        <?php elseif ($pemesanan['status_pemesanan'] == 'settlement') : ?>
                                            <!-- <a target="_blank" rel="noopener noreferrer" href="<?= base_url('pelanggan/pemesanan/print') ?>" class="btn  btn-primary btn-sm btn-block " role="button"> Simpan Bukti Pembayaran</a> -->
                                            <a target="_blank" rel="noopener noreferrer" href="<?= $pemesanan['instruksi'] ?>" class="btn  btn-primary btn-sm btn-block disabled" role="button">Lihat Instruksi</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <?php if ($pemesanan['status_pemesanan'] == 'settlement' || $pemesanan['status_pemesanan'] == 'pending') : ?>
                    <div class="row">
                        <div class="col">
                            <table class="table table-sm table-border border">
                                <thead>
                                    <tr class="border">
                                        <th>
                                            Deskripsi
                                        </th>
                                        <th>
                                            Qty
                                        </th>
                                        <th>
                                            Harga
                                        </th>
                                        <th>
                                            Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Catering Pesan Pagi</td>
                                        <td><?= $detail_pembayaran['qty_pagi'] ?></td>
                                        <td>Rp. 12.000</td>
                                        <td>Rp. <?= number_format($detail_pembayaran['total_pagi'], 0, ',', '.')  ?></td>
                                    </tr>
                                    <tr>
                                        <td>Catering Pesan Siang</td>
                                        <td><?= $detail_pembayaran['qty_siang'] ?></td>
                                        <td>Rp. 12.000</td>
                                        <td>Rp. <?= number_format($detail_pembayaran['total_siang'], 0, ',', '.')  ?></td>
                                    </tr>
                                    <tr>
                                        <td>Catering Pesan Dobel</td>
                                        <td><?= $detail_pembayaran['qty_dobel'] ?></td>
                                        <td>Rp. 24.000</td>
                                        <td>Rp. <?= number_format($detail_pembayaran['total_dobel'], 0, ',', '.')  ?></td>
                                    </tr>
                                    <tr class="border">
                                        <th class='text-right' colspan='3'>Subtotal : </th>
                                        <td>Rp. <?= number_format($subtotal, 0, ',', '.')  ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>



<!-- Modal -->
<div class="modal fade" id="detail_pemesanan_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Pemesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table getCalendar">
                    <?= $calendar ?>

                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>