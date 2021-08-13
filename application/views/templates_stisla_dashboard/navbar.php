<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li class="nav-item mt-1"><a href="<?= base_url('home') ?>" class="nav-link" style="font-weight:bold;">HOME</a></li>


        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <?php $makanan = $this->db->get_where('detail_jadwal', ['tanggal_jadwal' => date('Y-m-d')])->row_array();
        if ($makanan) :
            $today_food = $this->db->get_where('menu_makanan', ['id_makanan' => $makanan['id_makanan']])->row_array();
        else :
            $today_food = '';
        endif;

        ?>
        <li class="nav-item">
            <a href="<?= base_url('jadwal') ?>" data-toggle="dropdown" class="nav-link nav-link-lg nav-link-user ">
                <i class="fas fa-fw fa-utensils"></i>
                <div class="d-sm-none d-lg-inline-block">
                    <?php if (date('l') == 'Sunday' or date('l') == 'Saturday') : ?>
                        Hari ini : Libur
                    <?php else : ?>
                        <?php if ($today_food) : ?>
                            Hari ini : <?= $today_food['nama_makanan'] ?>
                        <?php else : ?>
                            Hari ini : <?= $today_food ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </a>

        </li>
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="<?= base_url('assets/upload/profile/') ?><?= $user['image'] ?>" class="rounded-circle mr-1" style="width: 30px; height: 30px;">
                <div class="d-sm-none d-lg-inline-block">Hi, <?= $this->session->userdata('role_id') == 2 ? $user['nama_siswa'] : $user['nama'] ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <?php $roleName = strtolower($this->User_model->get_role_name($this->session->userdata('role_id'))) ?>
                <a href="<?= base_url($roleName . '/profile') ?>" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>

                <div class="dropdown-divider"></div>
                <a href="<?= base_url('auth/logout') ?>" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>

    </ul>
</nav>