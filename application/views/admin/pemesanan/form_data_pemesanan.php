<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= get_title() ?></h1>
        </div>

        <div class="section-body">
            <div class="container-fluid">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No. Pemesanan</th>
                            <th>NIS</th>
                            <th>Tanggal dibuat</th>
                            <th>Total Bayar</th>
                            <th>Status Pemesanan</th>
                            <th>Action</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($pemesanan_header as $pemesanan) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $pemesanan['no_pemesanan'] ?></td>
                                <td><?= $pemesanan['nis'] ?></td>
                                <td><?= $pemesanan['tanggal_dibuat'] ?></td>
                                <td><?= $pemesanan['total_bayar'] ?></td>
                                <td>
                                    <?php if ($pemesanan['status_pemesanan'] == 'settlement') { ?>
                                        <div class="badge badge-success">Selesai</div>
                                    <?php } elseif ($pemesanan['status_pemesanan'] == 'pending') { ?>
                                        <div class="badge badge-warning">Menunggu Pembayaran</div>
                                    <?php } elseif ($pemesanan['status_pemesanan'] == 'expired') { ?>
                                        <div class="badge badge-danger">Kadaluarsa</div>
                                    <?php } ?>
                                </td>
                                <td>

                                    <a href="<?= base_url('admin/pemesanan/detail/' . $pemesanan['no_pemesanan']) ?>" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Detail Pemesanan"><i class="fas fa-fw fa-eye"></i></a>


                                </td>
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