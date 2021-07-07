<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Laporan Siswa</h1>
        </div>

        <div class="section-body">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <select name="" id="" class="form-control">
                                <option value="semua" selected>Semua</option>
                                <?php foreach ($sekolah as $s) : ?>
                                    <optgroup label="<?= $s['nama_sekolah'] ?>">
                                        <?php foreach ($this->db->get_where('kelas', ['id_sekolah' => $s['id_sekolah']])->result_array() as $kelas) : ?>
                                            <option value="<?= $kelas['id_kelas'] ?>"><?= $kelas['nama_kelas'] ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <table class="table table-md table-hovered table-stripped datatables">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </section>
</div>