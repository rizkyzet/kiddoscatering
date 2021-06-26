<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= get_title() ?></h1>
        </div>

        <div class="section-body">
            <form action="<?= base_url('admin/master_siswa/edit_siswa/' . $siswa['nis']) ?>" method="post">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nis">NIS</label>
                                <input type="text" name="nis" id="nis" class="form-control" value="<?= $siswa['nis']; ?> ">
                                <?= form_error('nis', '<div class="text-danger text-small">', '</div>') ?>
                            </div>

                            <div class="form-group">
                                <label for="nama_siswa">Nama Siswa</label>
                                <input class="form-control" type="text" name="nama_siswa" id="nama_siswa" value="<?= set_value('nama_siswa', $siswa['nama_siswa']) ?>">
                                <?= form_error('nama_siswa', '<div class="text-danger text-small">', '</div>') ?>
                            </div>

                            <div class="form-group">
                                <label for="id_kelas">Kelas</label>
                                <select name="id_kelas" id="id_kelas" class="form-control">

                                    <option value="" disabled <?= $siswa['id_kelas'] == '' ? '' : 'selected' ?>>Pilih Kelas</option>
                                    <?php foreach ($combobox as $index => $combo) : ?>
                                        <optgroup label="<?= $combo['nama_sekolah'] ?>">
                                            <?php foreach ($combo['kelas'] as $kelas) : ?>
                                                <option value="<?= $kelas['id_kelas'] ?>" <?= set_select('id_kelas', $kelas['id_kelas']) ?> <?= $siswa['id_kelas'] == $kelas['id_kelas'] ? 'selected' : '' ?>><?= $kelas['nama_kelas'] ?></option>
                                            <?php endforeach; ?>
                                        </optgroup>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('id_kelas', '<div class="text-danger text-small mb-3">', '</div') ?>
                            </div>

                            <div class="form-group">
                                <label for="alamat_siswa">Alamat Siswa</label>
                                <input class="form-control" type="text" name="alamat_siswa" value="<?= $siswa['alamat_siswa'] ?>">
                                <?= form_error('alamat_siswa', '<div class="text-danger text-small mb-3">', '</div>') ?>
                            </div>
                            <div class="form-group">
                                <label for="pwd">Password</label>
                                <input type="password" name="pwd" id="pwd" class="form-control">
                                <div class="d-flex justify-content-<?= form_error('pwd') ? 'between' : 'end' ?>">
                                    <?= form_error('pwd', '<div class="text-danger text-small mb-3">', '</div>') ?>
                                    <div class="text-danger text-small"><em>isi jika ingin diganti !</em></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jk">Jenis Kelamin</label>
                                <select name="jk" id="jk" class="form-control" <?= $siswa['jk'] == '' ? 'selected' : '' ?>>
                                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                    <option value="laki-laki" <?= set_select('jk', 'laki-laki') ?> <?= $siswa['jk'] == 'laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                    <option value="perempuan" <?= set_select('jk', 'perempuan') ?> <?= $siswa['jk'] == 'perempuan' ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                                <?= form_error('jk', '<div class="text-danger text-small">', '</dv>') ?>
                            </div>
                            <input type="hidden" name="account_id" value="<?= $siswa['account_id'] ?>">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>