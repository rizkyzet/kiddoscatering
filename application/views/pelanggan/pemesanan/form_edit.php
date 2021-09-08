<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Ubah Pesanan <?= ucfirst($pemesanan_header['tipe']) . ' ' . $bulanText . ' ' . $tahunText ?></h1>
        </div>

        <div class="section-body">
            <div class="container-fluid">
                <?= $this->session->flashdata('pesan') ?>
                <div class="alert alert-warning alert-has-icon alert-dismissible fade show" role="alert">
                    <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
                    <div class="alert-body">
                        <div class="alert-title">Perhatian</div>

                        <ul>
                            <li>Batas waktu perubahan pesanan sampai jam 08:00:00.</li>
                            <li>Untuk perubahan pesanan, hanya bisa dilakukan untuk pesanan pagi dan siang .</li>
                        </ul>


                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <table class="table getCalendar">
                    <?= $calendar ?>
                </table>

            </div>
        </div>
    </section>
</div>