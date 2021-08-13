<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?= base_url('pelanggan/dashboard') ?>">Kiddos Catering</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">Kiddos</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Pelanggan</li>
            <li class="">
                <a class="nav-link" href="<?= base_url('pelanggan/dashboard') ?>"><i class="fas fa-fw fa-tachometer-alt"></i> <span>Dashboard</span></a>
            </li>


            <li class="menu-header">Profil</li>
            <li class="">
                <a class="nav-link" href="<?= base_url('pelanggan/profile') ?>"><i class="fas fa-user"></i> <span>Profil saya</span></a>
            </li>
            <li class="">
                <a class="nav-link" href="<?= base_url('pelanggan/profile/edit_profile') ?>"><i class="fas fa-fw fa-user-edit"></i> <span>Ubah Profil</span></a>
            </li>
            <li class="">
                <a class="nav-link" href="<?= base_url('pelanggan/profile/change_password') ?>"><i class="fas fa-gw fa-key"></i> <span>Ganti Password</span></a>
            </li>
            <li class="">
                <!-- <a class="nav-link" href=""><i class="fas fa-fw fa-user-graduate"></i> <span>Siswa saya</span></a>
                <a class="nav-link" href=""><i class="fas fa-fw fa-pencil-alt"></i> <span>Ubah Profil</span></a> -->
                <a class="nav-link" href="<?= base_url('pelanggan/profile/ganti_menu_makanan') ?>"><i class="fas fa-fw fa-drumstick-bite"></i> <span>Atur Menu</span></a>
            </li>



            <li class="menu-header">Pemesanan</li>
            <li class="">
                <a class="nav-link" href="<?= base_url('pelanggan/pemesanan') ?>"><i class="fas fa-fw fa-utensils"></i><span>Pesanan saya</span></a>
            </li>
            <li class="">
                <a class="nav-link" href="<?= base_url('pelanggan/pemesanan/daftar') ?>"><i class="fas fa-fw fa-utensils"></i><span>Pesan Bulanan</span></a>
            </li>
            <li class="">
                <a class="nav-link" href="<?= base_url('pelanggan/pemesanan/pesan_harian') ?>"><i class="fas fa-fw fa-utensils"></i><span>Pesan Harian</span></a>
            </li>



        </ul>

    </aside>
</div>