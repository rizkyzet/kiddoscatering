<!-- Jumbotron -->
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <!-- <h1 class="display-4">Get work done <span>faster</span><br> and <span>better </span>with us</h1> -->
        <h1 class="display-4">Selamat Datang di<br>Website Kiddos Catering.</h1>
        <!-- <a href="" class="btn btn-primary tombol">Lihat Menu</a> -->
    </div>
</div>
<!-- Akhir Jumbotron -->


<!-- Container -->
<div class="container">

    <!-- Info Panel -->
    <div class="row justify-content-center">
        <div class="col-12 info-panel">
            <h3 class="text-center mb-5 font-weight-bold">MENU BULAN INI</h3>
            <div class="row justify-content-center owl-carousel owl-theme">
                <?php foreach ($makanan as $mkn) : ?>
                    <div class="item">
                        <img class="img-responsive" src="<?= base_url('assets/upload/menu_makanan/' . $mkn['image_makanan']) ?>">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- Akhir Infor Panel -->

    <!-- Workingspace -->
    <div class="row workingspace working-1 ">
        <div class="col-lg-6  ">
            <img src="<?= base_url('assets/homepage/') ?>img/kiddos_catering.jpg" alt="Workingspace" class="img-fluid" style="height: 350px; width:500px;">
        </div>
        <div class="col-lg-5 ">
            <h3>Tentang <span>Kiddos</span> <span>Catering</span> </h3>
            <p>Kiddos Catering adalah penyedia jasa catering bulanan siap antar untuk anak sekolah setiap harinya pada waktu pagi dan siang.</p>

        </div>
    </div>

    <div class="row workingspace working-2">
        <div class="col-lg-6 order-lg-5  ">
            <img src="<?= base_url('assets/homepage/') ?>img/food_vector.jpg" alt="Workingspace" class="img-fluid" style="height: 350px; width:500px;">
        </div>
        <div class="col-lg-5 order-lg-1 ">
            <h3>Makanan <span>Sehat</span> dan <span>Bergizi</span> </h3>
            <p>Kiddos Catering menyediakan menu yang berbeda setiap harinya dengan memperhatikan nilai gizi dan nutrisi.</p>
            <a href="<?= base_url('menu') ?>" class="btn btn-primary tombol">Lihat Menu</a>
        </div>
    </div>

    <div class="row workingspace working-3">
        <div class="col-lg-6">
            <img src="<?= base_url('assets/homepage/') ?>img/deliver.jpg" alt="Workingspace" class="img-fluid" style="height: 350px; width:500px;">
        </div>
        <div class="col-lg-5">
            <h3>Makanan Siap <span>Antar</span></h3>
            <p>Catering akan dikirim oleh driver 30 menit sebelum waktu makan pada setiap tempat sekolah.</p>

        </div>
    </div>