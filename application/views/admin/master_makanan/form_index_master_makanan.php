<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= get_title() ?></h1>
        </div>

        <div class="section-body">
            <div class="container-fluid">
                <a href="<?= base_url('admin/master_makanan/tambah_makanan') ?>" class="btn btn-primary mb-3">Tambah Menu Makanan</a>
                <?= $this->session->flashdata('pesan') ?>
                <div class="table-responsive">
                    <table class="table table-hovered">
                        <thead>
                            <tr>
                                <th style="width: 1px;">No</th>
                                <th style="width: 10%">Gambar</th>
                                <th>Nama Makanan</th>
                                <th>Deskripsi</th>
                                <th style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($makanan as $mkn) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><img src="<?= base_url('assets/upload/menu_makanan/' . $mkn['image_makanan']) ?>" alt="..." class="img-thumbnail"></td>

                                    <td><?= $mkn['nama_makanan'] ?></td>
                                    <td><?= $mkn['deskripsi_makanan'] ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Detail pembayaran"><i class="fas fa-fw fa-eye"></i></a>
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="<?= base_url('admin/master_makanan/edit_makanan/' . $mkn['id_makanan']) ?>"><i class="fas fa-fw fa-edit"></i> Edit </a>
                                                <a class="dropdown-item" href="<?= base_url('admin/master_makanan/hapus_makanan/' . $mkn['id_makanan']) ?>" onclick="return confirm('Yakin Hapus ?')"><i class="fas fa-fw fa-trash"></i> Hapus </a>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>