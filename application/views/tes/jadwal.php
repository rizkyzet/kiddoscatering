<!-- Jumbotron -->
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <!-- <h1 class="display-4">Get work done <span>faster</span><br> and <span>better </span>with us</h1> -->
        <h1 class="display-4">Sehat Makan nya<br>Banyak Untungnya.</h1>
        <!-- <a href="" class="btn btn-primary tombol">Lihat Menu</a> -->
    </div>
</div>
<!-- Akhir Jumbotron -->


<!-- Container -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6">

            <h1>Jadwal</h1>

            <div class="form-group mt-3">
                <select name="kelas" id="kelas" class="form-control">
                    <option value="">Pilih Kelas</option>
                </select>
            </div>

            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Pesan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($siswa_order as $order) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $order['nis'] ?></td>
                            <td><?= $order['nama_siswa'] ?></td>
                            <td><?= $order['nama_kelas'] ?></td>
                            <td><?= $order['pesan']  ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>