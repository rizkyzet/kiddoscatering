<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pesan Catering Harian</h1>
        </div>

        <div class="section-body">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <table class="table table-sm text-monospace">
                            <thead>
                                <tr>
                                    <td>Nama :</td>
                                    <td><?= $siswa['nama_siswa'] ?></td>
                                </tr>
                                <tr>
                                    <td>Sekolah :</td>
                                    <td><?= $sekolah['nama_sekolah'] ?></td>
                                </tr>
                                <tr>
                                    <td>Kelas :</td>
                                    <td><?= $kelas['nama_kelas'] ?></td>
                                </tr>
                            </thead>

                        </table>

                        <table class="table table-sm table-border text-monospace">
                            <thead>
                                <tr>
                                    <th>Tipe</th>
                                    <th>Tanggal Pesan</th>
                                    <th>Waktu Pesan</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Catering Harian</td>
                                    <td><?= $tanggal_pesan ?></td>
                                    <td><?= getFullTextWaktuPesanan($waktu_pesan) ?></td>
                                    <td>Rp. 15.000</td>
                                </tr>
                            </tbody>
                        </table>

                        <form id="form-payment-harian" action="<?= base_url('pelanggan/pemesanan/save_order_harian') ?>" method="POST">
                            <input type="hidden" value="<?= $siswa['nis'] ?>" name="nis">
                            <input type="hidden" value="<?= $tanggal_pesan ?>" name="tanggal_pesan">
                            <input type="hidden" value="<?= $waktu_pesan ?>" name="waktu_pesan">
                            <input type="hidden" name="result_type" id="result-type">
                            <input type="hidden" name="result_data" id="result-data">
                            <button type="submit" class="btn btn-sm btn-primary float-right tombol-bayar-harian">Bayar</button>
                        </form>
                    </div>
                </div>
            </div>
    </section>
</div>