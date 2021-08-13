<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pesan Catering Harian</h1>
        </div>

        <div class="section-body">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-6 ">
                        <form action="<?= base_url('pelanggan/pemesanan/pesan_harian') ?>" method="post">

                            <!-- nama_siswa -->
                            <div class="form-group ">
                                <label for="nama_siswa">Nama Siswa</label>
                                <input class="form-control" type="text" name="nama_siswa" id="nama_siswa" value="<?= $siswa['nama_siswa'] ?>" readonly>
                            </div>

                            <!-- id_kelas -->
                            <div class="form-group">
                                <label for="">Kelas</label>
                                <select name="id_kelas" id="" class="form-control" disabled>

                                    <?php foreach ($combo_kelas as $combo) : ?>
                                        <optgroup label='<?= $combo['nama_sekolah'] ?>'>
                                            <?php foreach ($combo['kelas'] as $kelas) : ?>
                                                <option value="<?= $kelas['id_kelas'] ?>" <?= $kelas['id_kelas'] == $siswa['id_kelas'] ? 'selected' : '' ?> <?= $kelas['id_kelas'] == $siswa['id_kelas'] ? '' : 'disabled' ?>><?= $kelas['nama_kelas'] ?></option>
                                            <?php endforeach; ?>
                                        </optgroup>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- tanggal_mulai -->
                            <div class="form-group">
                                <label for="tanggal_pesan">Tanggal Pesan</label>
                                <input class="form-control" type="date" name="tanggal_pesan" id="tanggal_pesan" value="<?= set_value('tanggal_pesan') ?>">
                                <?= form_error('tanggal_pesan', '<small class="text-danger">', '</small>') ?>
                            </div>

                            <!-- waktu pesan -->
                            <div class="form-group row">
                                <label class="form-label pt-2 col-4">Waktu Pesan</label>
                                <div class="col">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="waktu_pesan" value="p" class="selectgroup-input" checked="">
                                            <span class="selectgroup-button">Pagi</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="waktu_pesan" value="s" class="selectgroup-input">
                                            <span class="selectgroup-button">Siang</span>
                                        </label>
                                        <!-- <label class="selectgroup-item">
                                            <input type="radio" name="senin" value="ps" class="selectgroup-input">
                                            <span class="selectgroup-button">Dobel</span>
                                        </label> -->
                                    </div>
                                </div>
                            </div>



                            <div class="row justify-content-center ">
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-outline-primary btn-block mt-4">Pesan</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
    </section>
</div>