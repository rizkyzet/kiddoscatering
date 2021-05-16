<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Blank Page</h1>
        </div>



        <div class="section-body">
            <div class="container-fluid">
                <?= $this->session->flashdata('pesan') ?>
                <form action="<?= base_url('pelanggan/profile/set_ganti_menu') ?>" method="post">
                    <div class="row justify-content-center">
                        <div class="col-md-4">

                            <div class="form-group">
                                <input type="hidden" class="form-control" placeholder="Pilih menu yang tidak disukai" aria-label="" name="id_menu_tidak_suka">
                                <div class="input-group">
                                    <img src="<?= base_url('assets/upload/menu_makanan/no_image.jpg') ?>" alt="" class="img-thumbnail image-tidak-suka" style="height: 300px; width:550px;">
                                    <input type="text" class="form-control " placeholder="Pilih menu yang tidak disukai" aria-label="" name="menu_tidak_suka" autocomplete="off">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#modal_tidak_suka">Pilih </button>
                                    </div>
                                </div>
                                <?= form_error('menu_tidak_suka', '<div class="text-small text-danger">', '</div>') ?>
                            </div>
                        </div>

                        <div class="col-md-4">

                            <div class="form-group">
                                <input type="hidden" class="form-control" placeholder="Pilih menu yang tidak disukai" aria-label="" name="id_menu_pengganti">
                                <div class="input-group">

                                    <img src="<?= base_url('assets/upload/menu_makanan/no_image.jpg') ?>" alt="" class="img-thumbnail image-pengganti" style="height: 300px; width:550px;">

                                    <input type="text" class="form-control" placeholder="Pilih menu pengganti" aria-label="" name="menu_pengganti" autocomplete="off">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#modal_pengganti">Pilih</button>
                                    </div>

                                </div>
                                <?= form_error('menu_pengganti', '<div class="text-small text-danger">', '</div>') ?>
                            </div>

                        </div>


                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-2 text-center border">
                            <button class="btn btn-block btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
    </section>
</div>


<!-- Modal -->
<div class="modal fade" id="modal_tidak_suka" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Menu yang tidak disukai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row gutters-sm">
                    <?php foreach ($menu_tidak_suka as $tdk_suka) : ?>
                        <div class="col-6 col-sm-3">
                            <label class="imagecheck mb-4">
                                <h6 class="bg-primary text-white text-center"><?= $tdk_suka['nama_makanan'] ?></h6>
                                <input name="tidak_suka" type="radio" value="<?= $tdk_suka['id_makanan'] ?>" class="imagecheck-input check-tidak-suka" data-img_makanan="<?= base_url('assets/upload/menu_makanan/' . $tdk_suka['image_makanan']) ?>" data-nama-makanan="<?= $tdk_suka['nama_makanan'] ?>" />
                                <figure class="imagecheck-figure">
                                    <img style="height:150px; width:200px;" src="<?= base_url() ?>assets/upload/menu_makanan/<?= $tdk_suka['image_makanan'] ?>" class="imagecheck-image  rounded" data-toggle="tooltip" data-placement="bottom" title="Nama Menu : <?= $tdk_suka['nama_makanan'] ?> | Detail Menu : <?= $tdk_suka['deskripsi_makanan'] ?>">
                                </figure>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_pengganti" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Menu Pengganti</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row gutters-sm">
                    <?php foreach ($menu_pengganti as $pengganti) : ?>

                        <div class="col-6 col-sm-3">
                            <label class="imagecheck mb-4">
                                <h6 class="bg-primary text-white text-center"><?= $pengganti['nama_makanan'] ?></h6>
                                <input name="pengganti" type="radio" value="<?= $pengganti['id_makanan'] ?>" class="imagecheck-input check-pengganti" data-img_makanan="<?= base_url('assets/upload/menu_makanan/' . $pengganti['image_makanan']) ?>" data-nama-makanan="<?= $pengganti['nama_makanan'] ?>" />
                                <figure class=" imagecheck-figure">
                                    <img style="height:150px; width:200px;" src="<?= base_url() ?>assets/upload/menu_makanan/<?= $pengganti['image_makanan'] ?>" class="imagecheck-image" data-toggle="tooltip" data-placement="bottom" title="Nama Menu : <?= $pengganti['nama_makanan'] ?> | Detail Menu : <?= $pengganti['deskripsi_makanan'] ?>">

                                </figure>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>