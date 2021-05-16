<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= get_title() ?></h1>
        </div>

        <div class="section-body">
            <div class="container-fluid ">
                <div class="row justify-content-center">
                    <div class="col-6 mt-4">
                        <?= $this->session->flashdata('pesan') ?>
                        <form action="<?= base_url('admin/jadwal_menu/pilih_jadwal') ?>" method="post">
                            <div class="card-header">
                                <h6>Pilih Tanggal</h6>
                            </div>
                            <div class="card-body pb-0">
                                <div class="form-group">
                                    <label>Bulan</label>
                                    <select name="bulan" id="" class="form-control">
                                        <option value="01">Januari</option>
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tahun</label>
                                    <input class="form-control" type="number" name="tahun" id="" value="<?= date('Y') ?>">
                                </div>
                            </div>
                            <div class="card-footer ">
                                <div class="row justify-content-center">
                                    <div class="col-4 ">
                                        <button type="submit" class="btn btn-primary btn-block">Buat</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>




            </div>
        </div>
    </section>
</div>