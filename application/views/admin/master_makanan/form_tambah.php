<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= get_title() ?></h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-8">

                    <?= $this->session->flashdata('pesan_upload') ?>
                    <div class="card author-box card-primary">
                        <div class="card-body">

                            <?= form_open_multipart(base_url('admin/master_makanan/tambah_makanan')); ?>
                            <div class="form-group row">
                                <label for="nama_makanan" class="col-sm-2 col-form-label">Nama Makanan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama_makanan" name="nama_makanan" value="<?= set_value('nama_makanan') ?>">
                                    <?= form_error('nama_makanan', '<div class="text-small text-danger">', '</div>') ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-10">
                                    <select name="kategori" id="" class="form-control">
                                        <option value="">Pilih Kategori</option>
                                        <?php foreach ($kategori as $ktgr) : ?>
                                            <option value="<?= $ktgr['id_kategori'] ?>"><?= ucwords($ktgr['nama_kategori']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('kategori', '<div class="text-small text-danger">', '</div>') ?>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi </label>
                                <div class="col-sm-10">
                                    <textarea class="my-textarea form-control" id="deskripsi" name="deskripsi" value="<?= set_value('deskripsi') ?>"> </textarea>
                                    <?= form_error('deskripsi', '<div class="text-small text-danger">', '</div>') ?>
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-sm-2">Picture</div>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <img class="img-preview img-thumbnail" src="<?= base_url('assets/upload/menu_makanan/no_image.jpg') ?>">
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="image" name="image" required>
                                                <label class="custom-file-label" for="image">Pilih Gambar</label>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
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