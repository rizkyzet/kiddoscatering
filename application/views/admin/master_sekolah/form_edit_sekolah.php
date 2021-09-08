<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= get_title() ?></h1>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="<?= base_url('admin/master_sekolah/edit_sekolah/' . $sekolah['id_sekolah']) ?>" method="post">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Sekolah</label>
                                <input type="text" name="nama_sekolah" class="form-control" value="<?= form_error('nama_sekolah') == false ? $sekolah['nama_sekolah'] : set_value('nama_sekolah') ?>">
                                <?= form_error('nama_sekolah', '<div class="text-small text-danger">', '</div>') ?>
                            </div>
                            <div class="form-group">
                                <label>Alamat Sekolah</label>
                                <input type="text" name="alamat_sekolah" class="form-control" value="<?= form_error('alamat_sekolah') == false ? $sekolah['alamat_sekolah'] : set_value('alamat_sekolah') ?>">
                                <?= form_error('alamat_sekolah', '<div class="text-small text-danger">', '</div>') ?>
                            </div>
                            <div class="form-group">
                                <label>Kontak Sekolah</label>
                                <input type="text" name="kontak_sekolah" class="form-control" value="<?= form_error('kontak_sekolah') == false ? $sekolah['kontak_sekolah'] : set_value('kontak_sekolah') ?>">
                                <?= form_error('kontak_sekolah', '<div class="text-small text-danger">', '</div>') ?>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4">Simpan</button>


                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>