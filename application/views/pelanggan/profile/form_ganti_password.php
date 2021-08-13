<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Ganti Password</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card author-box card-primary">
                        <div class="card-body">
                            <?= $this->session->flashdata('pesan') ?>
                            <form action="<?= base_url('pelanggan/profile/change_password') ?>" method="post">
                                <div class="row">
                                    <div class="form-group col-4">
                                        <label for="my_password">Password saat ini</label>
                                        <input type="password" class="form-control" id="my_password" name="my_password" value="<?= form_error('my_password') ? set_value('my_password') : '' ?>">
                                        <?= form_error('my_password', '<small class="text-danger text-small">', '</small>') ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-4">
                                        <label for="password">Password Baru</label>
                                        <input type="password" class="form-control" id="password" name="password" value="<?= set_value('password') ?>">
                                        <?= form_error('password', '<small class="text-danger text-small">', '</small>') ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-4 ">
                                        <label for="password2">Konfirmasi Password</label>
                                        <input type="password" class="form-control" id="password2" name="password2" value="<?= form_error('password2') == false ? set_value('password2') : '' ?>">
                                        <?= form_error('password2', '<small class="text-danger text-small">', '</small>') ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-4">
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