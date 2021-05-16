<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= get_title() ?></h1>
        </div>

        <div class="section-body">
            <form action="<?= base_url('admin/master_kelas/edit_kelas/' . $kelas['id_kelas']) ?>" method="post">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="combo_sekolah">Sekolah</label>
                                <select class="form-control" name="id_sekolah" id="combo_sekolah">
                                    <option value="" disabled selected>Pilih Sekolah</option>
                                    <?php foreach ($combobox as $cmb) : ?>
                                        <option value="<?= $cmb['id_sekolah'] ?>" <?= $kelas['id_sekolah'] == $cmb['id_sekolah'] ? 'selected' : '' ?>><?= $cmb['nama_sekolah'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('id_sekolah', '<div class="text-danger text-small">', '</div>') ?>
                            </div>

                            <div class="form-group">
                                <label for="nama_kelas">Nama Kelas</label>
                                <input class="form-control" type="text" name="nama_kelas" value="<?= $kelas['nama_kelas'] ?>">
                                <?= form_error('nama_kelas', '<div class="text-danger text-small">', '</div>') ?>
                            </div>

                            <div class="form-group">
                                <label for="wali_kelas">Wali Kelas</label>
                                <input class="form-control" type="text" name="wali_kelas" value="<?= $kelas['wali_kelas'] ?>">
                                <?= form_error('wali_kelas', '<div class="text-danger text-small">', '</div>') ?>
                            </div>

                            <div class="form-group">
                                <label for="kontak_wali_kelas">Kontak Wali Kelas</label>
                                <input type="text" name="kontak_wali_kelas" class="form-control" value="<?= $kelas['kontak_wali_kelas'] ?>">
                                <?= form_error('kontak_wali_kelas', '<div class="text-danger text-small">', '</div>') ?>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>