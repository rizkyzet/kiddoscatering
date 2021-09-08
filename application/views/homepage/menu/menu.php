<!-- Jumbotron -->
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <!-- <h1 class="display-4">Get work done <span>faster</span><br> and <span>better </span>with us</h1> -->
        <h1 class="display-4">Menu<br>Makanan.</h1>
        <!-- <a href="" class="btn btn-primary tombol">Lihat Menu</a> -->
    </div>
</div>
<!-- Akhir Jumbotron -->


<!-- Container -->
<div class="container">
    <a href="#" id="scroll" style="display: none;"><span></span></a>
    <!-- Info Panel -->
    <div class="row justify-content-center">
        <div class="col-12 info-panel">
            <div class="row justify-content-center">


                <div class="col-lg-2 text-center" id="kategori-panel">
                    <h4>Menu Snack</h4>
                    <a href="<?= base_url('home/menu/') ?>#snack" class="btn btn-sm btn-light shadow tombol ">
                        <img src="<?= base_url('assets/upload/') ?>icon_kategori/fast-food.png" alt="Employee" class="image-thumbnail">
                    </a>
                </div>
                <div class="col-lg-2 text-center " id="kategori-panel">

                    <h4>Menu Seafood</h4>
                    <a href="<?= base_url('home/menu') ?>#seafood" class="btn btn-sm btn-light shadow tombol"> <img src="<?= base_url('assets/upload/') ?>icon_kategori/seafood.png" alt="Hires">
                    </a>
                </div>
                <div class="col-lg-2 text-center " id="kategori-panel">

                    <h4>Menu Ayam</h4>
                    <a href="<?= base_url('home/menu/') ?>#ayam" class="btn btn-sm btn-light shadow tombol"><img src="<?= base_url('assets/upload/') ?>icon_kategori/chicken.png" alt="Security">
                    </a>
                </div>
                <div class="col-lg-2 text-center " id="kategori-panel">

                    <h4>Menu Sapi</h4>
                    <a href="<?= base_url('home/menu/') ?>#sapi" class="btn btn-sm btn-light shadow tombol "> <img src="<?= base_url('assets/upload/') ?>icon_kategori/cow.png" alt="Security">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Akhir Infor Panel -->

    <!-- Menu Makanan -->

    <!-- section-1 -->

    <div class="alert alert-success my-5 ">
        <strong>Seluruh Harga Menu Rp. 12.000 jika memesan paket bulanan</strong><br>
        <hr>
        <strong>Seluruh Harga Menu Rp. 15.000 jika memesan paket harian</strong>
    </div>
    <?php foreach ($menu_makanan as $index => $menu) : ?>

        <div class="row mt-5" id="<?= $menu['nama_kategori'] ?>">
            <div class="col-sm-2">
                <h4 class="text-kategori"><?= strtoupper($menu['nama_kategori']) ?></h4>
            </div>
            <div class="col-sm">
                <div class="row">
                    <?php foreach ($menu['menu_makanan'] as $mnu) : ?>
                        <div class="col-sm-3">
                            <div class="card mt-3">
                                <img src="<?= base_url('assets/upload/menu_makanan/' . $mnu['image_makanan']) ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $mnu['nama_makanan'] ?></h5>
                                    <hr>
                                    <p class="card-text"><?= $mnu['deskripsi_makanan'] ?></p>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- akhir section-1 -->
    <!-- Akhir Menu Makanan -->