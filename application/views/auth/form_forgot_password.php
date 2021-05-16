<div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="login-brand">
                        <img src="<?= base_url('assets/stisla') ?>/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
                    </div>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Forgot Password</h4>
                        </div>
                        <span class="pl-4 pr-4">
                            <?= $this->session->flashdata('pesan') ?>
                        </span>
                        <div class="card-body">
                            <form action="<?= base_url('auth/forgot_password') ?>" method="POST">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="text" class="form-control" name="email" autofocus>
                                    <?= form_error('email', '<div class="text-small text-danger">', '</div>') ?>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        Forgot Password
                                    </button>
                                </div>
                            </form>

                        </div>
                        <div class=" text-center">
                            <a href="<?= base_url('auth') ?>">Kembali ke login</a>
                        </div>
                        <div class="text-center">
                            <a href="<?= base_url('auth/register') ?>">Buat akun</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>