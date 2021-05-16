<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= get_title() ?></h1>
        </div>
        <a href="<?= base_url('admin/master_sekolah/tambah_sekolah') ?>" class="btn btn-primary mb-3">Tambah Data</a>

        <?= $this->session->flashdata('pesan') ?>
        <table class="table table-hover table-striped table-bordered datatables">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Sekolah</th>
                    <th>Alamat Sekolah</th>
                    <th>Kontak Sekolah</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $no = 1;
                foreach ($sekolah as $skl) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $skl['nama_sekolah'] ?></td>
                        <td><?= $skl['alamat_sekolah'] ?></td>
                        <td><?= $skl['kontak_sekolah'] ?></td>

                        <td>

                            <a href="<?= base_url('admin/master_sekolah/edit_sekolah/' . $skl['id_sekolah']) ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                            <a href="<?= base_url('admin/master_sekolah/delete_sekolah/' . $skl['id_sekolah']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Data akan dihapus?')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</div>