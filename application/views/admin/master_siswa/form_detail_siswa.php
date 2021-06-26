<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= get_title() ?></h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col">
                    <div class="card author-box card-primary">
                        <div class="card-body">
                            <table class="table table-bordered table-sm ">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <td><?= $siswa['nama_siswa'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Alamat Siswa</th>
                                        <td><?= $siswa['alamat_siswa'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td><?= $siswa['jk'] ?></td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card author-box card-primary">
                        <div class="card-body">
                            <table class="table table-bordered table-sm ">
                                <thead>
                                    <tr>
                                        <th>Kelas</th>
                                        <td><?= $siswa['nama_kelas'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Wali Kelas</th>
                                        <td><?= $siswa['wali_kelas'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>No. Kontak Wali Kelas</th>
                                        <td><?= $siswa['kontak_wali_kelas'] ?></td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="card author-box card-primary">
                        <div class="card-body">
                            <table class="table table-bordered table-sm ">
                                <thead>
                                    <tr>
                                        <th>Sekolah</th>
                                        <td><?= $siswa['nama_sekolah'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Alamat Sekolah</th>
                                        <td><?= $siswa['alamat_sekolah'] ?></td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>