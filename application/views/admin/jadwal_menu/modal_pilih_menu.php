<?php foreach ($menu as $mnu) : ?>
    <div class="col-6 col-sm-3">

        <label class="imagecheck mb-4">
            <h6 class="bg-primary text-white text-center"><?= $mnu['nama_makanan'] ?></h6>
            <input name="<?= $tanggal ?>" type="radio" value="<?= $mnu['id_makanan'] ?>" class="imagecheck-input check" data-img_makanan="<?= base_url('assets/upload/menu_makanan/' . $mnu['image_makanan']) ?>">
            <figure class="imagecheck-figure">
                <img style="height:150px; width:200px;" src="<?= base_url() ?>assets/upload/menu_makanan/<?= $mnu['image_makanan'] ?>" class="imagecheck-image" data-toggle="tooltip" data-placement="bottom" title="Nama Menu : <?= $mnu['nama_makanan'] ?> | Detail Menu : <?= $mnu['deskripsi_makanan'] ?>">
            </figure>
        </label>
    </div>
<?php endforeach; ?>
<script type="text/javascript">
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>