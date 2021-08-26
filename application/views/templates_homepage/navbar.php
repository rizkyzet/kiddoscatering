<nav class="navbar navbar-expand-lg navbar-light ">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url() ?>">
            <span style="color:red">K</span>
            <span style="color:green">i</span>
            <span style="color:blue">d</span>
            <span style="color:orange">d</span>
            <span style="color:yellow">o</span>
            <span style="color:red">s </span>
            <span class="catering">Catering</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link active" href="<?= base_url('home') ?>">Home <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="<?= base_url('menu') ?>">Menu kita</a>
                <a class="nav-item nav-link" href="<?= base_url('jadwal') ?>">Jadwal</a>
                <!-- <a class="nav-item nav-link " href="#">Tentang Kami</a> -->
                <a href="<?= base_url('pesanan') ?>" class="nav-item nav-link">Pesanan</a>
                <?php if ($this->session->userdata('email') or $this->session->userdata('nis')) { ?>
                    <div class="dropdown mt-1">

                        <img style="width: 40px; height:40px;" src="<?= base_url('assets/upload/profile/') ?><?= $user['image'] ?>" class="figure-img img-fluid rounded-circle utama" alt="Testi 2 " data-toggle="dropdown">


                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <?php if ($this->session->userdata('role_id') == 1) { ?>
                                <a class="dropdown-item has-icon " href="http://localhost/kiddoscatering/admin/dashboard"><span>Dashboard</span></a>
                            <?php } elseif ($this->session->userdata('role_id') == 2) { ?>
                                <a class="dropdown-item has-icon " href="http://localhost/kiddoscatering/pelanggan/dashboard"><span>Dashboard</span></a>
                            <?php } elseif ($this->session->userdata('role_id') == 7) { ?>
                                <a class="dropdown-item has-icon " href="http://localhost/kiddoscatering/pemilik/dashboard"><span>Dashboard</span></a>
                            <?php } ?>
                            <div class="dropdown-divider"></div>
                            <a href="<?= base_url('auth/logout') ?>" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </div>
                <?php } else { ?>
                    <a class="nav-item nav-link " href="<?= base_url('auth') ?>">Login</a>
                <?php } ?>


            </div>
        </div>
    </div>
</nav>