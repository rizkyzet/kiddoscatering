<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= get_title() ?></h1>
        </div>
        <div class="row">
            <div class="col-5">
                <form action="<?= base_url('admin/master_kategori/edit/' . $kategori['id_kategori']) ?>" method="POST">
                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori</label>
                        <input class="form-control" type="text" name="nama_kategori" id="nama_kategori" value="<?= set_value('nama_kategori', $kategori['nama_kategori']) ?>">
                        <?= form_error('nama_kategori', '<small class="text-danger">', '</small>') ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </form>
            </div>
        </div>
    </section>
</div>