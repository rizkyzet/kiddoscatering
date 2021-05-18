<div id="app">
    <section class="section">
        <div class="container mt-4">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="login-brand">
                        <img src="<?= base_url('assets/img/') ?>logo_kiddos.jpeg" alt="logo" width="150" class="shadow-light rounded-circle px-2">
                    </div>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Login</h4>
                        </div>
                        <span class="pl-3 pr-3"><?= $this->session->flashdata('pesan') ?></span>
                        <div class="card-body">
                            <form method="POST" action="<?= base_url('auth') ?>">
                                <div class="form-group">
                                    <label for="email">ID</label>
                                    <input id="email" type="text" class="form-control" name="id" value="<?= set_value('email') ?>" autofocus>
                                    <?= form_error('email', '<div class="text-danger text-small">', '</div>') ?>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" type="password" class="form-control" name="password">
                                    <?= form_error('password', '<div class="text-danger text-small">', '</div') ?>
                                </div>
                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="text-muted text-center">
                        Belum punya akun? <a href="<?= base_url('auth/register') ?>">Daftar!</a>
                    </div>
                    <div class="text-center">
                        <a href="<?= base_url('auth/forgot_password') ?>">Lupa password</a>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>