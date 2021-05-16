<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Kiddos Catering</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">Kiddos</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Admin</li>
            <li class="">
                <a class="nav-link" href="<?= base_url('admin/dashboard') ?>"><i class="fas fa-fw fa-tachometer-alt"></i> <span>Dashboard</span></a>
            </li>


            <li class="menu-header">Profil</li>
            <li class="">
                <a class="nav-link" href="<?= base_url('admin/profile') ?>"><i class="fas fa-user"></i> <span>Profil saya</span></a>
            </li>
            <li class="">
                <a class="nav-link" href="<?= base_url('admin/profile/edit_profile') ?>"><i class="fas fa-fw fa-user-edit"></i> <span>Ubah Profil</span></a>
            </li>
            <li class="">
                <a class="nav-link" href="<?= base_url('admin/profile/change_password') ?>"><i class="fas fa-gw fa-key"></i> <span>Ganti Password</span></a>
            </li>

            <li class="menu-header">Master</li>
            <li class="">
                <a class="nav-link" href="<?= base_url('admin/master_sekolah') ?>"><i class="fas fa-fw fa-school"></i> <span>Sekolah</span></a>
                <a class="nav-link" href="<?= base_url('admin/master_kelas') ?>"><i class="fas fa-fw fa-door-open"></i> <span>Kelas</span></a>
                <a class="nav-link" href="<?= base_url('admin/master_siswa') ?>"><i class="fas fa-fw fa-user-graduate"></i> <span>Siswa</span></a>
            </li>

            <li class="menu-header">Menu Makanan</li>
            <li class="">
                <a class="nav-link" href="<?= base_url('admin/master_makanan') ?>"><i class="fas fa-fw fa-utensils"></i> <span>Menu Makanan</span></a>
                <!-- <a class="nav-link" href="<?= base_url('admin/master_makanan/menu_pengganti') ?>"><i class="fas fa-fw fa-utensils"></i> <span>Menu Pengganti</span></a> -->
                <a class="nav-link" href="<?= base_url('admin/jadwal_menu/') ?>"><i class="fas fa-fw fa-calendar-alt"></i> <span>Jadwal Menu</span></a>
            </li>

            <li class="menu-header">Pemesanan</li>
            <li class="">
                <a class="nav-link" href="<?= base_url('admin/pemesanan/data_pemesanan') ?>"><i class="fas fa-fw fa-shopping-cart"></i> <span>Data Pemesanan</span></a>
            </li>

            <li class="menu-header">Pengiriman</li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-truck"></i></i> <span>Data Pengiriman</span></a>
                <ul class="dropdown-menu">
                    <?php foreach ($this->db->get('sekolah')->result_array() as $sekolah) : ?>
                        <li><a class="nav-link" href="<?= base_url('admin/pengiriman/data_pengiriman/' . $sekolah['id_sekolah']) ?>"><?= $sekolah['nama_sekolah'] ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>

            <li class="menu-header">Laporan</li>
            <li class="dropdown">
                <a class="nav-link has-dropdown" href="#"><i class="fas fa-money-bill-wave"></i> <span>Laporan Pendapatan</span></a>
                <ul class="dropdown-menu">
                    <?php foreach ($this->db->get('sekolah')->result_array() as $sekolah) : ?>
                        <li><a class="nav-link" href="<?= base_url('admin/laporan/laporan_pendapatan/' . $sekolah['id_sekolah']) ?>"><?= $sekolah['nama_sekolah'] ?></a></li>
                    <?php endforeach; ?>
                </ul>

            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i> <span>Laporan Pemesanan</span></a>
                <ul class="dropdown-menu">
                    <?php foreach ($this->db->get('sekolah')->result_array() as $sekolah) : ?>
                        <li><a class="nav-link" href="<?= base_url('admin/laporan/laporan_pemesanan/' . $sekolah['id_sekolah']) ?>"><?= $sekolah['nama_sekolah'] ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>
        </ul>

    </aside>
</div>