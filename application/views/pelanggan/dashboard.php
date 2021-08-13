<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        <div class="section-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="card card-hero shadow">
                            <div class="card-header">
                                <div class="card-icon">
                                    <i class="fas <?= $today === null ? '' : ($today['pesan'] === 'p' ? 'fa-sun' : 'fa-cloud-sun') ?>"></i>
                                </div>
                                <div class="card-description">Pesanan Hari ini</div>
                                <h4><?= $today === null ? 'Tidak ada pesanan' : ($today['pesan'] === 'p' ? 'Pagi' : 'Siang') ?></h4>
                            </div>
                            <div class="card-body p-1">
                                <a href="<?= $today == null ? '' : base_url('pelanggan/pemesanan/detail/' . $today['no_pemesanan']) ?>" class="ticket-item btn btn-primary btn-block <?= $today == null ? 'disabled' : '' ?>">
                                    View More
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- success -->
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Transaksi Sukses</h4>
                                <div class="card-header-action">
                                    <a href="<?= base_url('pelanggan/pemesanan') ?>" class="btn btn-danger">View More <i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>ID Pemesanan</th>
                                            <th>Nama</th>
                                            <th>Status</th>
                                            <th>Tanggal Dibuat</th>
                                            <th>Action</th>
                                        </tr>
                                        <?php foreach ($settlement as $s) : ?>
                                            <tr>
                                                <td><?= $s['no_pemesanan'] ?></td>
                                                <td class="font-weight-600"><?= $user['nama_siswa'] ?></td>
                                                <td><span class="badge badge-success"><?= $s['status_pemesanan'] ?></span></td>
                                                <td><?= $s['tanggal_dibuat'] ?></td>
                                                <td><a href="<?= base_url('pelanggan/pemesanan/detail/' . $s['no_pemesanan']) ?>" class="btn btn-primary">Detail</a></td>
                                            </tr>
                                        <?php endforeach; ?>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- menunggu pembayaran -->
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Transaksi Pending</h4>
                                <div class="card-header-action">
                                    <a href="<?= base_url('pelanggan/pemesanan') ?>" class="btn btn-danger">View More <i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>ID Pemesanan</th>
                                            <th>Nama</th>
                                            <th>Status</th>
                                            <th>Tanggal Dibuat</th>
                                            <th>Action</th>
                                        </tr>
                                        <?php foreach ($pending as $p) : ?>
                                            <tr>
                                                <td><?= $p['no_pemesanan'] ?></td>
                                                <td class="font-weight-600"><?= $user['nama_siswa'] ?></td>
                                                <td><span class="badge badge-warning"><?= $p['status_pemesanan'] ?></span></td>
                                                <td><?= $p['tanggal_dibuat'] ?></td>
                                                <td><a href="<?= base_url('pelanggan/pemesanan/detail/' . $p['no_pemesanan']) ?>" class="btn btn-primary">Detail</a></td>
                                            </tr>
                                        <?php endforeach; ?>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="row">

                        <!-- success -->
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Transaksi dibatalkan</h4>
                                    <div class="card-header-action">
                                        <a href="<?= base_url('pelanggan/pemesanan') ?>" class="btn btn-danger">View More <i class="fas fa-chevron-right"></i></a>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive table-invoice">
                                        <table class="table table-striped">
                                            <tr>
                                                <th>ID Pemesanan</th>
                                                <th>Nama</th>
                                                <th>Status</th>
                                                <th>Tanggal Dibuat</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php foreach ($cancel as $c) : ?>
                                                <tr>
                                                    <td><?= $c['no_pemesanan'] ?></td>
                                                    <td class="font-weight-600"><?= $user['nama_siswa'] ?></td>
                                                    <td><span class="badge badge-danger"><?= $c['status_pemesanan'] ?></span></td>
                                                    <td><?= $c['tanggal_dibuat'] ?></td>
                                                    <td><a href="<?= base_url('pelanggan/pemesanan/detail/' . $c['no_pemesanan']) ?>" class="btn btn-primary">Detail</a></td>
                                                </tr>
                                            <?php endforeach; ?>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- menunggu pembayaran -->
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Transaksi Kadaluarsa</h4>
                                    <div class="card-header-action">
                                        <a href="<?= base_url('pelanggan/pemesanan') ?>" class="btn btn-danger">View More <i class="fas fa-chevron-right"></i></a>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive table-invoice">
                                        <table class="table table-striped">
                                            <tr>
                                                <th>ID Pemesanan</th>
                                                <th>Nama</th>
                                                <th>Status</th>
                                                <th>Tanggal Dibuat</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php foreach ($expire as $ex) : ?>
                                                <tr>
                                                    <td><?= $ex['no_pemesanan'] ?></td>
                                                    <td class="font-weight-600"><?= $user['nama_siswa'] ?></td>
                                                    <td><span class="badge badge-danger"><?= $ex['status_pemesanan'] ?></span></td>
                                                    <td><?= $ex['tanggal_dibuat'] ?></td>
                                                    <td><a href="<?= base_url('pelanggan/pemesanan/detail/' . $ex['no_pemesanan']) ?>" class="btn btn-primary">Detail</a></td>
                                                </tr>
                                            <?php endforeach; ?>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
    </section>
</div>