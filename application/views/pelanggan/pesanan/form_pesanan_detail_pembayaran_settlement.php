<!-- Main Content -->
<div class="main-content ">
    <section class="section ">
        <div class="section-header">
            <h1><?= get_title(); ?></h1>
        </div>
        <div class="section-body ">
            <div class="container-fluid">
                <a class="btn btn-sm btn-primary mb-3" href="<?= base_url('pelanggan/pesanan') ?>"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                <div class="row mb-3">
                    <div class="col-lg">
                        <div class="card  mb-4">
                            <div class="card-body">

                                <!-- icon bento -->
                                <div class="row">
                                    <div class="col-sm-1">
                                        <div class="d-flex justify-content-center">
                                            <img class="rounded-lg" src="<?= base_url('assets/img/favicon_io/') ?>money_bag.png" alt="">

                                        </div>
                                    </div>

                                    <!-- catering bulan april -->
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col ">
                                                <span class="font-weight-bold">
                                                    Catering Bulan <b><?= getMonthIndo(date('F', strtotime($pesanan['tgl_pesan']))) ?></b> <b><?= date('Y', strtotime($pesanan['tgl_pesan'])) ?>
                                                </span>
                                                <span class="badge badge-pill badge-success"><?= $pesanan['status_pembayaran'] ?></span>

                                            </div>
                                        </div>

                                        <!-- total, tanggal pemesanan -->
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="d-flex flex-row ">
                                                    <div class="p-1  ">
                                                        <span class="text-monospace font-weight-bold">
                                                            Total :
                                                        </span>
                                                        <span class="font-italic text-success">
                                                            <?= "Rp. " . $pesanan['total_bayar'] ?>
                                                        </span>
                                                    </div>
                                                    <div class="p-1  ">
                                                        <span class="text-monospace font-weight-bold">
                                                            Tanggal Pemesanan :
                                                        </span>
                                                        <span class=" font-italic">
                                                            <?= $pesanan['tgl_pesan'] ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>

                                        <!-- no va, no pesanan -->
                                        <div class="row">
                                            <div class="col border">
                                                <div class="d-flex flex-column">
                                                    <div class="">
                                                        <span class="text-monospace font-weight-bold">
                                                            Tanggal Dibayar :
                                                        </span>
                                                        <span class=" font-italic ">
                                                            <?= $pesanan['tanggal_dibayar'] ?>
                                                        </span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <hr>
                                        <!-- detail pemesanan -->
                                        <div class="row" style=" overflow:auto;">
                                            <div class="col">
                                                <table class=" table table-hover table-sm">
                                                    <thead>

                                                        <tr>
                                                            <?php foreach ($template_tanggal as $tanggal) { ?>
                                                                <th scope="col"><?= date('d', strtotime($tanggal)) ?></th>
                                                            <?php } ?>
                                                        </tr>
                                                        <tr>
                                                            <?php foreach ($template_hari as $hari) { ?>
                                                                <?php if ($hari == 'Sab' or $hari == 'Min') { ?>
                                                                    <th scope="col " class="bg-danger text-white"><?= $hari ?></th>
                                                                <?php  } else { ?>
                                                                    <th scope="col "><?= $hari ?></th>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <?php foreach ($detail_pesanan_pending as $pesan) : ?>
                                                                <td><?= $pesan['pesan'] ?></td>
                                                            <?php endforeach; ?>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col text-center ">

                                        <img class="img-thumbnail" src="<?= base_url('assets/img/bank_img/' . $pesanan['bank']) ?>.png" alt="">

                                        <a target="_blank" rel="noopener noreferrer" href="<?= base_url('pelanggan/pesanan/print') ?>" class="btn  btn-primary btn-sm btn-block " role="button"> Cetak Bukti Pembayaran</a>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>