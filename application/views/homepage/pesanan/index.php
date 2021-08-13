<!-- Jumbotron -->
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <!-- <h1 class="display-4">Get work done <span>faster</span><br> and <span>better </span>with us</h1> -->
        <h1 class="display-4">Pesanan<br>Hari ini.</h1>
        <!-- <a href="" class="btn btn-primary tombol">Lihat Menu</a> -->
    </div>
</div>
<!-- Akhir Jumbotron -->


<!-- Container -->
<div class="container ">
    <div class="row justify-content-center row-pesanan-home ">
        <div class="col-6 col-pesanan-home px-5 py-5">
            <h3 class="text-center">Cek Pesanan Hari ini</h3>
            <div class="form-group mt-3">
                <select name="kelas" id="kelas" class="form-control select-kelas" id="select-kelas">
                    <option value="">Pilih Kelas</option>
                    <?php foreach ($kelas as $k) : ?>
                        <optgroup label="<?= $k['nama_sekolah'] ?>">
                            <?php foreach ($k['kelas'] as $kel) : ?>
                                <option value="<?= $kel['id_kelas'] ?>"><?= $kel['nama_kelas'] ?></option>
                            <?php endforeach; ?>
                        </optgroup>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="div-pesanan">

            </div>

        </div>

    </div>