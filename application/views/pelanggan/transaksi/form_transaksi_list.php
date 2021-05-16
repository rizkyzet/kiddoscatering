<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= get_title(); ?></h1>
        </div>

        <div class="section-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-sm table-hover table-bordered">
                            <thead>
                                <tr class="text-center border">
                                    <th class="border">Bulan</th>
                                    <th class="border">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bulan as $bln) : ?>
                                    <tr class="border">
                                        <td class="border" style="width: 1%;"><?= getMonthIndo($bln['bulan']) ?></td>
                                        <?php if ($bln['status'] == 'belum pesan') { ?>
                                            <td style="width: 1%;" class="text-center border">
                                                <a href="<?= base_url('pelanggan/transaksi/daftar/' . $bln['bulan']) ?>" class="btn btn-sm btn-success <?= $bln['bulan'] == date('F') ? '' : 'disabled' ?>" data-toggle="tooltip" data-placement="top" title="Detail pesanan">
                                                    <i class="fas fa-shopping-cart"></i><span> Pesan</span>
                                                </a>
                                            </td>
                                        <?php } else { ?>
                                            <td class=" text-center border">
                                                <a href="<?= base_url('pelanggan/transaksi/daftar/' . $bln['bulan']) ?>" class="btn btn-sm btn-danger disabled" data-toggle="tooltip" data-placement="top" title="Detail pesanan">
                                                    <i class="fas fa-shopping-cart"></i><span> Sudah Pesan</span>
                                                </a>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>