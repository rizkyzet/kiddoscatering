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
                            <h4>Reset Password</h4>
                        </div>

                        <div class="card-body">

                            <form action="<?= base_url('auth/reset_password') ?>" method="POST">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="text" class="form-control " name="email" value="<?= $email ?>" readonly autofocus>
                                </div>

                                <div class="form-group ">
                                    <label for="password">New Password</label>
                                    <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" value="<?= set_value('password') ?>">
                                    <?= form_error('password', '<div class="text-small text-danger mb-3">', '</div') ?>
                                </div>

                                <div class="form-group">
                                    <label for="password2">Konfirmasi Password</label>
                                    <input id="password2" type="password" class="form-control" name="password2">
                                    <?= form_error('password2', '<div class="text-small text-danger mb-3">', '</div>') ?>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Reset Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="simple-footer">
                        Copyright &copy; Stisla 2018
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>