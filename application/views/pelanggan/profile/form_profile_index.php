<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Profil</h1>
        </div>

        <div class="section-body">
            <?= $this->session->flashdata('pesan_upload') ?>
            <?= $this->session->flashdata('pesan') ?>
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-7">
                    <div class="card author-box card-primary">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5 ">
                                    <div class="author-box-left">
                                        <img alt="image" src="<?= base_url('assets/upload/profile/' . $user['image']) ?>" class="w-75 author-box-picture">
                                        <div class="clearfix"></div>
                                        <a href="<?= base_url('pelanggan/profile/edit_profile') ?>" class="badge badge-primary mt-3 btn-sm">Ubah Profil</a>
                                    </div>
                                </div>
                                <div class="col-6 ">

                                    <div class="author-box-name">
                                        <a href="#"><?= $user['nama_siswa'] ?></a>
                                    </div>

                                    <div class="author-box-description">
                                        <p><strong>NIS : </strong> <?= $user['nis'] ?>
                                            <br />
                                            <strong>Kelas : </strong> <?= $kelas['nama_kelas'] ?>
                                            <br />
                                            <strong>Alamat : </strong> <?= $user['alamat_siswa'] ?>
                                            <br />
                                            <strong>Jenis Kelamin : </strong> <?= $user['jk'] ?>
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>