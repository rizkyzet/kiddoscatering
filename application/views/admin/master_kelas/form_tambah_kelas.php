<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= get_title() ?></h1>
        </div>

        <div class="section-body">
            <form action="<?= base_url('admin/master_kelas/tambah_kelas') ?>" method="POST">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="combo_sekolah">Sekolah</label>
                                <select name="sekolah" id="combo_sekolah" class="form-control">
                                    <option value="" disabled selected>Pilih Sekolah</option>
                                    <?php foreach ($combobox as $cmb) : ?>
                                        <option value="<?= $cmb['id_sekolah'] ?>" <?= set_select('sekolah', $cmb['id_sekolah']); ?>><?= $cmb['nama_sekolah'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('sekolah', '<div class="text-small text-danger">', '</div>') ?>
                            </div>

                            <div class="form-group">
                                <label for="nama_kelas">Nama Kelas</label>
                                <input class="form-control" type="text" name="nama_kelas" id="nama_kelas">
                                <?= form_error('nama_kelas', '<div class="text-small text-danger">', '</div>') ?>
                            </div>

                            <div class="form-group">
                                <label for="wali_kelas">Wali Kelas</label>
                                <input class="form-control" type="text" name="wali_kelas" id="wali_kelas">
                                <?= form_error('wali_kelas', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>

                            <div class="form-group">
                                <label for="kontak_wali_kelas">Kontak Wali Kelas</label>
                                <input class="form-control" type="text" name="kontak_wali_kelas" id="kontak_wali_kelas">
                                <?= form_error('kontak_wali_kelas', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>