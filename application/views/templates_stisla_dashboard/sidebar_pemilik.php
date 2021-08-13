<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href=<?= base_url('pemilik/dashboard') ?>>Kiddos Catering</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">Kiddos</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Pemilik</li>
            <li class="">
                <a class="nav-link" href="<?= base_url('pemilik/dashboard') ?>"><i class="fas fa-fw fa-tachometer-alt"></i> <span>Dashboard</span></a>
            </li>

            <li class="menu-header">Profil</li>
            <li class="">
                <a class="nav-link" href="<?= base_url('pemilik/profile') ?>"><i class="fas fa-user"></i> <span>Profil saya</span></a>
            </li>
            <li class="">
                <a class="nav-link" href="<?= base_url('pemilik/profile/edit') ?>"><i class="fas fa-fw fa-user-edit"></i> <span>Ubah Profil</span></a>
            </li>
            <li class="">
                <a class="nav-link" href="<?= base_url('pemilik/profile/change_password') ?>"><i class="fas fa-gw fa-key"></i> <span>Ganti Password</span></a>
            </li>

            <li class="menu-header">Laporan</li>
            <!-- <li class="">
                <a class="nav-link" href="<?= base_url('pemilik/laporan/siswa') ?>"><i class="fas fa-fw fa-tachometer-alt"></i> <span>Laporan Siswa</span></a>
            </li> -->
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i> <span>Laporan Pemesanan</span></a>
                <ul class="dropdown-menu">
                    <?php foreach ($this->db->get('sekolah')->result_array() as $sekolah) : ?>
                        <li><a class="nav-link" href="<?= base_url('pemilik/laporan/laporan_pemesanan/' . $sekolah['id_sekolah']) ?>"><?= $sekolah['nama_sekolah'] ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>

            <li class="dropdown">
                <a class="nav-link has-dropdown" href="#"><i class="fas fa-money-bill-wave"></i> <span>Laporan Pendapatan</span></a>
                <ul class="dropdown-menu">
                    <?php foreach ($this->db->get('sekolah')->result_array() as $sekolah) : ?>
                        <li><a class="nav-link" href="<?= base_url('pemilik/laporan/laporan_pendapatan/' . $sekolah['id_sekolah']) ?>"><?= $sekolah['nama_sekolah'] ?></a></li>
                    <?php endforeach; ?>
                </ul>

            </li>
        </ul>

    </aside>
</div>