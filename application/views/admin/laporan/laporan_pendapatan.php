<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= get_title(); ?></h1>
        </div>

        <div class="section-body">
            <div class="container-fluid">
                <?= $this->session->flashdata('pesan') ?>
                <form action="<?= base_url('admin/laporan/cetak_lap_pendapatan') ?>" method="post">
                    <div class="form-row ">
                        <div class="form-group col-md-2">
                            <label>Tanggal Awal</label>
                            <input type="text" name="tanggal_awal" id="tanggal_awal" class="form-control datepicker " value="<?= $tanggal_awal ?>">
                        </div>

                        <div class="form-group col-md-2">
                            <label>Tanggal Akhir</label>
                            <input type="text" name="tanggal_akhir" id="tanggal_akhir" class="form-control datepicker" value="<?= $tanggal_akhir ?>">
                        </div>
                        <div class="form-group col-md-2 d-flex ">
                            <button type="submit" class="btn btn-primary align-self-end mb-1"><i class="fa fa-print"></i></button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive-sm overflow-auto laporan_pendapatan">
                    <table class="table table-sm datatables table_laporan_pendapatan">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Sekolah</th>
                                <th>NIS</th>
                                <th>Kelas</th>
                                <th>Nama</th>
                                <th>Tanggal Pembayaran</th>
                                <th>Keterangan</th>
                                <th>Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($pendapatan as $dapat) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $dapat['nama_sekolah'] ?></td>
                                    <td><?= $dapat['nis'] ?></td>
                                    <td><?= $dapat['nama_kelas'] ?></td>
                                    <td><?= $dapat['nama_siswa'] ?></td>
                                    <td><?= $dapat['tanggal_dibayar'] ?></td>
                                    <td><?= 'pembayaran catering bulan ' . getMonthIndo(date('F', strtotime($dapat['tanggal_mulai']))) . ' ' . date('Y', strtotime($dapat['tanggal_mulai'])) ?></td>
                                    <td><?= $dapat['total_bayar'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="border">Total Pendapatan</th>
                                <td class="border text-center" colspan="7" class="text-center"><?= $total_pendapatan ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- <div class="row">
                    <div class="col border ">
                        <button class="btn btn-primary float-right"><i class="fa fa-print"></i></button>
                    </div>
                </div> -->
            </div>
        </div>
</div>
</div>
</section>
</div>