<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= get_title() ?></h1>
        </div>
        <div class="section-body">
            <div class="container-fluid">
                <a href="<?= base_url('admin/master_siswa/tambah_siswa') ?>" class="btn btn-primary mb-3">Tambah Data</a>

                <?= $this->session->flashdata('pesan') ?>
                <table class="table table-hover table-striped table-bordered datatables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Sekolah</th>
                            <th>Nama Kelas</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Alamat Siswa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($siswa as $swa) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $swa['nama_sekolah'] ?></td>
                                <td><?= $swa['nama_kelas'] ?></td>
                                <td><?= $swa['nis'] ?></td>
                                <td><?= $swa['nama_siswa'] ?></td>
                                <td><?= $swa['alamat_siswa'] ?></td>

                                <td>

                                    <a href="<?= base_url('admin/master_siswa/detail/' . $swa['nis']) ?>" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>
                                    <a href="<?= base_url('admin/master_siswa/edit_siswa/' . $swa['nis']) ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                    <a href="<?= base_url('admin/master_siswa/delete_siswa/' . $swa['nis']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Data akan dihapus?')"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>