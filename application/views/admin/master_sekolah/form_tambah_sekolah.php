<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= get_title() ?></h1>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="<?= base_url('admin/master_sekolah/tambah_sekolah') ?>" method="post">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Sekolah</label>
                                <input type="text" name="nama_sekolah" class="form-control">
                                <?= form_error('nama_sekolah', '<div class="text-small text-danger">', '</div>') ?>
                            </div>
                            <div class="form-group">
                                <label>Alamat Sekolah</label>
                                <input type="text" name="alamat_sekolah" class="form-control">
                                <?= form_error('alamat_sekolah', '<div class="text-small text-danger">', '</div>') ?>
                            </div>
                            <div class="form-group">
                                <label>Kontak Sekolah</label>
                                <input type="text" name="kontak_sekolah" class="form-control">
                                <?= form_error('kontak_sekolah', '<div class="text-small text-danger">', '</div>') ?>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4">Simpan</button>
                            <button type="reset" class="btn btn-danger mt-4">Reset</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>