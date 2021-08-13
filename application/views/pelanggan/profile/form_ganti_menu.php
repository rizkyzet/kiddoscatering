<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Ganti Menu Makanan</h1>
        </div>

        <div class="section-body">
            <div class="container-fluid">
                <a href="<?= base_url('pelanggan/profile/set_ganti_menu') ?>" class="btn btn-primary mb-3">Set Ganti Menu</a>
                <?= $this->session->flashdata('pesan') ?>
                <table class="table table-hover">
                    <thead>
                        <th>No</th>
                        <th>Menu yang tidak disukai</th>
                        <th>Menu pengganti</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($menu_pengganti as $menu) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $menu['menu_tidak_suka'] ?></td>
                                <td><?= $menu['menu_pengganti'] ?></td>
                                <td><a href="<?= base_url('pelanggan/profile/hapus_ganti_menu/' . $menu['id_ganti_menu']) ?>" class="btn btn-danger" onclick="return confirm('yakin hapus ?')"><i class="fa fa-times"></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>