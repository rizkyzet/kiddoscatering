<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= get_title() ?></h1>
        </div>
        <div class="section-body">
            <div class="container-fluid">


                <a href="<?= base_url('admin/master_kelas/tambah_kelas') ?>" class="btn btn-primary mb-3">Tambah Data</a>

                <?= $this->session->flashdata('pesan') ?>
                <table class="table table-hover table-striped table-bordered datatables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Sekolah</th>
                            <th>Nama Kelas</th>
                            <th>Wali Kelas</th>
                            <th>No. telp wali kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($kelas as $kls) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $kls['nama_sekolah'] ?></td>
                                <td><?= $kls['nama_kelas'] ?></td>
                                <td><?= $kls['wali_kelas'] ?></td>
                                <td><?= $kls['kontak_wali_kelas'] ?></td>

                                <td>

                                    <a href="" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>
                                    <a href="<?= base_url('admin/master_kelas/edit_kelas/' . $kls['id_kelas']) ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                    <a href="<?= base_url('admin/master_kelas/delete_kelas/' . $kls['id_kelas']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Data akan dihapus?')"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>