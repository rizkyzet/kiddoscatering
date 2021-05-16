<!-- Jumbotron -->
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <!-- <h1 class="display-4">Get work done <span>faster</span><br> and <span>better </span>with us</h1> -->
        <h1 class="display-4">Jadwal<br>Menu Makanan.</h1>
        <!-- <a href="" class="btn btn-primary tombol">Lihat Menu</a> -->
    </div>
</div>
<!-- Akhir Jumbotron -->


<!-- Container -->
<div class="container">
    <div class="row ">
        <div class="col text-center">
            <h2><?= getNamaBulanFromNumber(date('m')) ?></h2>
        </div>
    </div>

    <table class="table getCalendar">

        <?= $calendar ?>
    </table>