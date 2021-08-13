<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Ubah Profil</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card author-box card-primary">
                        <div class="card-body">

                            <?= form_open_multipart('pelanggan/profile/edit_profile'); ?>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">NIS</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nis" name="nis" value="<?= $user['nis'] ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama_siswa" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?= $user['nama_siswa'] ?>">
                                    <?= form_error('nama_siswa', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id_kelas" class="col-sm-2 col-form-label">Kelas</label>
                                <div class="col-sm-10">
                                    <select name="id_kelas" id="id_kelas" class="form-control">
                                        <?php foreach ($kelas as $index => $s) : ?>
                                            <optgroup label="<?= $index ?>">
                                                <?php foreach ($s as $k) : ?>
                                                    <option value="<?= $k['id_kelas'] ?>" <?= $k['id_kelas'] == $user['id_kelas'] ? 'selected' : '' ?>><?= $k['nama_kelas'] ?></option>
                                                <?php endforeach; ?>
                                            </optgroup>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('id_kelas', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamat_siswa" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="alamat_siswa" name="alamat_siswa" value="<?= $user['alamat_siswa'] ?>">
                                    <?= form_error('alamat_siswa', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <select name="jk" id="jk" class="form-control">
                                        <option value="">Pilih</option>
                                        <option value="laki-laki" <?= $user['jk'] == 'laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                        <option value="perempuan" <?= $user['jk'] == 'perempuan' ? 'selected' : '' ?>>Perempuan</option>
                                    </select>
                                    <?= form_error('jk', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">Picture</div>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <img class="img-preview img-thumbnail" src="<?= base_url('assets/upload/profile/') . $user['image'] ?>">
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="image" name="image">
                                                <label class="custom-file-label" for="image">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary float-right">Ubah</button>
                                </div>
                            </div>
                            </form>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>