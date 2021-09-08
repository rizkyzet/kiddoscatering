<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= get_title() ?></h1>
        </div>

        <form class="form-inline mb-4" method="POST" action="<?= base_url('admin/master_kategori') ?>">
            <label class="sr-only" for="inlineFormInputGroupUsername2">Username</label>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Nama Kategori</div>
                </div>
                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="<?= set_value('nama_kategori') ?>">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Tambah</button>
        </form>

        <?= $this->session->flashdata('pesan') ?>
        <?= form_error('nama_kategori', '<div class="alert alert-danger" role="alert">', '</div>') ?>
        <table class="table table-hover table-striped table-bordered datatables">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php $i = 1;
                foreach ($kategori as $k) : ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $k['nama_kategori'] ?></td>
                        <td>
                            <a href="<?= base_url('admin/master_kategori/edit/' . $k['id_kategori']) ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                            <a href="<?= base_url('admin/master_kategori/delete/' . $k['id_kategori']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Data akan dihapus?')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</div>