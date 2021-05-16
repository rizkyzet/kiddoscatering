<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= get_title() ?></h1>
        </div>

        <div class="section-body">
            <div class="container-fluid">
                <div class="form-row ">
                    <div class="form-group col-md-2">
                        <label for="kelas">Kelas</label>
                        <select name="kelas" id="kelas" class="form-control">
                            <?php foreach ($kelas as $kls) : ?>
                                <option value="<?= $kls['id_kelas'] ?>"><?= $kls['nama_kelas'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Date Picker</label>
                        <input type="text" class="form-control datepicker">
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-4">
                        <table class="table table-sm data-pengiriman">
                            <thead>
                                <tr>
                                    <th colspan="3" class="bg-secondary text-center">1 Abu Bakar</th>
                                </tr>
                                <tr class=" border">

                                    <th>Waktu</>
                                    <th>Jumlah</th>
                                    <th>Catatan</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border ">
                                    <td class="border ">Pagi</td>
                                    <td class="border "><?= $jum_pagi ?></td>
                                    <td class="border "><?= $catatan_pagi ?></td>
                                </tr>
                                <tr class="border ">
                                    <td class="border ">Siang</td>
                                    <td class="border "><?= $jum_siang ?></td>
                                    <td class="border "><?= $catatan_siang ?></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>