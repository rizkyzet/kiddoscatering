<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1> <?= get_title() ?></h1>
        </div>

        <div class="section-body">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col text-center">
                        <h2><?= getNamaBulanFromNumber($bulan) ?></h2>
                    </div>
                </div>
                <hr>
                <form action="<?= base_url('admin/jadwal_menu/save_jadwal') ?>" method="post">
                    <input type="hidden" name="bulan" value="<?= $bulan ?>">
                    <input type="hidden" name="tahun" value="<?= $tahun ?>">
                    <table class="table getCalendar">

                        <?= $calendar ?>
                    </table>
                    <button class="btn btn-primary float-right" type="submit">Simpan Jadwal</button>
                </form>
            </div>
        </div>
    </section>
</div>


<!-- Modal -->
<div class="modal fade" id="modal_buat_jadwal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Daftar Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row gutters-sm">

                </div>
            </div>

            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>