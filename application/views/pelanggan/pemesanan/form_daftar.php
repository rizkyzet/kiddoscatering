<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Blank Page</h1>
        </div>

        <div class="section-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col text-center">
                        <h3>2020</h3>
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
                                    <td class="">
                                        <?php if ($bln['status'] == 'belum pesan') { ?>
                                            <a href="<?= base_url('pelanggan/pemesanan/buat/' . $bln['bulan']) ?>" class="btn btn-sm btn-success btn-block <?= $bln['bulan'] == date('F') ? '' : 'disabled' ?>">
                                                <i class="fas fa-shopping-cart"></i><span> Pesan</span>
                                            </a>
                                        <?php } else { ?>
                                            <a href="<?= base_url('pelanggan/pemesanan/buat/' . $bln['bulan']) ?>" class="btn btn-sm btn-danger btn-block disabled">
                                                <i class="fas fa-shopping-cart"></i><span> Sudah Pesan</span>
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