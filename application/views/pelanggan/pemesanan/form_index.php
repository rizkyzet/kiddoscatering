<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= get_title(); ?></h1>
        </div>

        <div class="section-body">
            <div class="container-fluid">
                <?= $this->session->flashdata('pesan') ?>
                <table class="table table-striped table-bordered">
                    <thead>
                        <th>No</th>
                        <th>No. Pemesanan</th>
                        <th>Info</th>
                        <th>Tanggal Pesan</th>
                        <th>Status Pemesanan</th>
                        <th>Action</th>
                    </thead>
                    <?php $no = 1;
                    foreach ($pemesanan as $psn) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $psn['no_pemesanan'] ?></td>
                            <td>Catering Bulan <b><?= getMonthIndo(date('F', strtotime($psn['tanggal_mulai']))) ?></b> <b><?= date('Y', strtotime($psn['tanggal_mulai'])) ?><b></td>
                            <td><?= $psn['tanggal_dibuat'] ?></td>
                            <td>
                                <?php if ($psn['status_pemesanan'] == 'settlement') { ?>
                                    <div class="badge badge-success">Selesai</div>
                                <?php } elseif ($psn['status_pemesanan'] == 'pending') { ?>
                                    <div class="badge badge-warning">Menunggu Pembayaran</div>
                                <?php } elseif ($psn['status_pemesanan'] == 'expire') { ?>
                                    <div class="badge badge-danger">Kadaluarsa</div>
                                <?php } elseif ($psn['status_pemesanan'] == 'cancel') { ?>
                                    <div class="badge badge-danger">Dibatalkan</div>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if ($psn['status_pemesanan'] == 'settlement') { ?>
                                    <div class="btn-group">
                                        <a href="<?= base_url('pelanggan/pemesanan/detail/' . $psn['no_pemesanan']) ?>" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Detail Pemesanan"><i class="fas fa-fw fa-eye"></i></a>
                                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="<?= base_url('pelanggan/pemesanan/edit/' . $psn['no_pemesanan']) ?>"><i class="fas fa-fw fa-edit"></i>Ubah pesanan</a>
                                        </div>
                                    </div>
                                <?php } elseif ($psn['status_pemesanan'] == 'pending') { ?>

                                    <div class="btn-group">
                                        <a href="<?= base_url('pelanggan/pemesanan/detail/' . $psn['no_pemesanan']) ?>" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Detail Pemesanan"><i class="fas fa-fw fa-eye"></i></a>
                                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="<?= base_url('pelanggan/pemesanan/verify_pembayaran/' . $psn['no_pemesanan']) ?>"><i class="fas fa-fw fa-check"></i> Cek Pembayaran</a>
                                            <a class="dropdown-item" href="<?= base_url('pelanggan/pemesanan/batalkan_transaksi/' . $psn['no_pemesanan']) ?>" onclick="return confirm('Data akan dihapus?')"><i class="fas fa-fw fa-times"></i> Batalkan Transaksi</a>

                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="btn-group">
                                        <a href="<?= base_url('pelanggan/pemesanan/detail/' . $psn['no_pemesanan']) ?>" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Detail Pemesanan"><i class="fas fa-fw fa-eye"></i></a>


                                    </div>
                                <?php } ?>
                        </tr>
                    <?php endforeach; ?>


                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table getCalendar">



                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>