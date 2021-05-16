<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                        <div class="login-brand">
                            <img src="<?= base_url('assets/img/') ?>logo_kiddos.jpeg" alt="logo" width="150" class="shadow-light rounded-circle">
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Register</h4>
                            </div>

                            <div class="card-body">
                                <form method="POST" action="<?= base_url('auth/register') ?>">
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="nama">Nama anda</label>
                                            <input id="nama" type="text" class="form-control" name="nama" autofocus value="<?= set_value('nama') ?>">
                                            <?= form_error('nama', '<div class="text-small text-danger">', '</div>') ?>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="email">Email anda</label>
                                            <input id="email" type="text" class="form-control" name="email" value="<?= set_value('email') ?>">
                                            <?= form_error('email', '<div class="text-small text-danger">', '</div>') ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="no_hp">No. Handphone</label>
                                            <input id="no_hp" type="text" class="form-control phone-number" name="no_hp" value="<?= set_value('no_hp') ?>">
                                            <?= form_error('no_hp', '<div class="text-small text-danger">', '</div>') ?>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="nis">NIS anak anda</label>
                                            <input id="nis" type="text" class="form-control" name="nis" value="<?= set_value('nis') ?>">
                                            <?= form_error('nis', '<div class="text-small text-danger">', '</div>') ?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label>Password</label>
                                            <input type="password" name="password" class="form-control" value="<?= set_value('password') ?>">
                                            <?= form_error('password', '<div class="text-small text-danger">', '</div>') ?>
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Konfirmasi Password </label>
                                            <input type="password" name="password2" class="form-control" value="<?= form_error('password2') == false ? set_value('password2') : '' ?>">
                                            <?= form_error('password2', '<div class="text-small text-danger">', '</div>') ?>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            Daftar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class=" text-center">
                            <a href="<?= base_url('auth') ?>">Kembali ke login</a>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>