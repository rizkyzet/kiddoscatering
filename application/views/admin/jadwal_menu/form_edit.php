<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1> <?= get_title() ?></h1>
        </div>

        <div class="section-body">
            <div class="container-fluid">

                <div class="row ">
                    <div class="col text-center">
                        <h2><?= getNamaBulanFromNumber($bulan) ?></h2>
                    </div>
                </div>
                <hr>
                <?= $this->session->flashdata('pesan') ?>
                <form action="<?= base_url('admin/jadwal_menu/edit_menu/' . $id_jadwal) ?>">
                    <table class="table getCalendar">

                        <?= $calendar ?>
                    </table>
                </form>

            </div>
        </div>
    </section>
</div>


<!-- Modal -->
<div class="modal fade" id="modal_edit_jadwal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Daftar Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="form_edit_jadwal" action="<?= base_url('admin/jadwal_menu/save_edit_jadwal') ?>" method="post">
                    <input type="hidden" name="id_detail_jadwal" value="">
                    <input type="hidden" name="id_jadwal" value="<?= $id_jadwal ?>">
                    <input type="hidden" name="tanggal" value="">

                    <div class="row gutters-sm">
                        <?php foreach ($menu as $mnu) : ?>
                            <div class="col-6 col-sm-3">
                                <label class="imagecheck mb-4">
                                    <h6 class="bg-primary text-white text-center"><?= $mnu['nama_makanan'] ?></h6>
                                    <input name="id_makanan" type="radio" value="<?= $mnu['id_makanan'] ?>" class="imagecheck-input check-edit" data-img_makanan="<?= base_url('assets/upload/menu_makanan/' . $mnu['image_makanan']) ?>" />
                                    <figure class="imagecheck-figure" data-toggle="tooltip" data-placement="top" title="Nama Menu : <?= $mnu['nama_makanan'] ?> | Detail Menu : <?= $mnu['deskripsi_makanan'] ?>">
                                        <img style="height:150px; width:200px;" src="<?= base_url() ?>assets/upload/menu_makanan/<?= $mnu['image_makanan'] ?>" alt="}" class="imagecheck-image">
                                    </figure>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </form>
            </div>

            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>