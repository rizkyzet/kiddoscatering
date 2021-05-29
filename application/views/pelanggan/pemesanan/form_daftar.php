<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pesan Catering</h1>
        </div>

        <div class="section-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col text-center">
                        <h3><?= date('Y') ?></h3>
                    </div>
                </div>
                <div class="row mt-3">
                    <?php foreach ($bulan as $bln) : ?>
                        <div class="col-2 mt-3 shadow border">
                            <table class="table table-sm mt-2 ">
                                <tr class="text-center">
                                    <th class=""><?= $bln['bulan'] ?></th>
                                </tr>
                                <tr>
                                    <!-- <?= $bln['bulan'] == date('F') ? '' : 'disabled' ?> -->
                                    <td class="">
                                        <?php if ($bln['status'] == 'belum pesan' || $bln['status'] == 'expire' || $bln['status'] == 'cancel') { ?>
                                            <a href="<?= base_url('pelanggan/pemesanan/buat/' . $bln['bulan']) ?>" class="btn btn-sm btn-primary btn-block">
                                                <i class="fas fa-shopping-cart"></i><span> Pesan</span>
                                            </a>
                                        <?php } elseif ($bln['status'] == 'pending') { ?>
                                            <a href="<?= base_url('pelanggan/pemesanan/buat/' . $bln['bulan']) ?>" class="btn btn-sm btn-warning btn-block disabled">
                                                <i class="fas fa-shopping-cart"></i><span> Menunggu Pembayaran</span>
                                            </a>
                                        <?php } elseif ($bln['status'] == 'settlement') { ?>
                                            <a href="<?= base_url('pelanggan/pemesanan/buat/' . $bln['bulan']) ?>" class="btn btn-sm btn-success btn-block disabled">
                                                <i class="fas fa-shopping-cart"></i><span> Sudah Pesan</span>
                                            </a>
                                        <?php } else { ?>
                                            <a href="<?= base_url('pelanggan/pemesanan/buat/' . $bln['bulan']) ?>" class="btn btn-sm btn-primary btn-block disabled">
                                                <i class="fas fa-shopping-cart"></i><span> Pesan</span>
                                            </a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </section>
</div>