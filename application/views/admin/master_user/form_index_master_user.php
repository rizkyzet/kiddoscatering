<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= get_title() ?></h1>
        </div>
        <div class="section-body">
            <div class="container-fluid">
                <a href="<?= base_url('admin/master_user/tambah') ?>" class="btn btn-primary mb-3">Tambah Data</a>

                <?= $this->session->flashdata('pesan') ?>
                <table class="table table-hover table-striped table-bordered datatables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 1;
                        foreach ($users as $user) : ?>
                            <tr>
                                <th><?= $i++ ?></th>
                                <th><?= $user['nama'] ?></th>
                                <th><?= $user['email'] ?></th>
                                <th><?= $user['role'] ?></th>
                                <th>
                                    <a href="<?= base_url('admin/master_user/detail/' . $user['id_user']) ?>" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>
                                    <a href="<?= base_url('admin/master_user/edit/' . $user['id_user']) ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                    <a href="<?= base_url('admin/master_user/hapus/' . $user['id_user']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Data akan dihapus?')"><i class="fas fa-trash"></i></a>
                                </th>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>