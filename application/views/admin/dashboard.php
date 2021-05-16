<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= get_title() ?></h1>
        </div>

        <div class="section-body">
            <div class="container-fluid">
                <!-- menu hari ini  -->
                <!-- <div class="d-flex flex-row mb-3 justify-content-end">

                    <div class="p-1"><button class="btn btn-primary"> <span id="jam"></span></button></div>
                    <div class="p-1">
                        <h4>:</h4>
                    </div>
                    <div class="p-1"> <button class="btn btn-primary" style="width: 43px;"> <span id="menit"></span></button></div>
                    <div class="p-1">
                        <h4>:</h4>
                    </div>

                    <div class="p-1"><button class="btn btn-primary" style="width: 43px;"> <span id="detik"></span></button></div>
                </div> -->

                <hr>
                <!-- jumlah pesanan pagi dan siang -->
                <h5 class="text-primary">Pesanan Hari ini</h5>
                <div class="row">

                    <div class="col">

                        <div class="card card-hero shadow">
                            <div class="card-header">
                                <div class="card-icon">
                                    <i class="fas fa-cloud-sun"></i>
                                </div>
                                <div class="card-description">Total Pagi</div>
                                <h4><?= $jumlah['pagi'] ?></h4>
                            </div>
                            <div class="card-body p-1">
                                <a href="#" class="ticket-item btn btn-primary btn-block ">
                                    View More
                                </a>

                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-hero shadow">
                            <div class="card-header">
                                <div class="card-icon">
                                    <i class="fas fa-sun"></i>
                                </div>
                                <div class="card-description">Total Siang</div>
                                <h4><?= $jumlah['siang'] ?></h4>
                            </div>
                            <div class="card-body p-1">
                                <a href="#" class="ticket-item btn btn-primary btn-block ">
                                    View More
                                </a>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="row ">
                    <div class="col-md-6 border shadow">
                        <div class="card">
                            <div class="card-header">
                                <h4>Statistik Pesanan</h4>
                                <div class="card-header-action">
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-primary">Bulanan</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="myChart" height="182"></canvas>

                                <div class="statistic-details mt-sm-4">
                                    <div class="statistic-details-item">
                                        <!-- <span class="text-muted"><span class="text-primary"></span>-</span> -->
                                        <div class="detail-value"><?= $jumlah['bulan_kemarin'] ?> Pesanan</div>
                                        <div class="detail-name">Pemesanan Bulan kemarin</div>
                                    </div>
                                    <div class="statistic-details-item">
                                        <?php if ($jumlah['bulan_kemarin']) { ?>
                                            <?php if ($jumlah['selisih'] < 0) { ?>
                                                <span class="text-muted"><span class="text-danger"><i class="fas fa-caret-down"></i> </span><?= abs($jumlah['selisih']) ?> pesanan</span>
                                            <?php } else { ?>
                                                <span class="text-muted"><span class="text-success"><i class="fas fa-caret-up"></i> </span><?= $jumlah['selisih'] ?> pesanan</span>
                                        <?php }
                                        } ?>
                                        <div class="detail-value"><?= $jumlah['bulan_sekarang'] ?> pesanan</div>
                                        <div class="detail-name">Pemesanan Bulan ini</div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 border shadow">

                        <div class="card">
                            <div class="card-header">
                                <h4>Statistik Pendapatan</h4>
                                <div class="card-header-action">
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-primary">Bulanan</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="chartPendapatan" height="182"></canvas>

                                <div class="statistic-details mt-4">
                                    <div class="statistic-details-item">
                                        <!-- <span class="text-muted"><span class="text-primary"></span>-</span> -->
                                        <div class="detail-value"><?= $detail_pendapatan['pendapatan_kemarin'] ?></div>
                                        <div class="detail-name">Pendapatan Bulan kemarin</div>
                                    </div>
                                    <div class="statistic-details-item">
                                        <?php if ($detail_pendapatan['pendapatan_kemarin'] !== null) { ?>
                                            <?php if ($detail_pendapatan['persentase_pendapatan'] < 0) { ?>
                                                <span class="text-muted"><span class="text-danger"><i class="fas fa-caret-down"></i> </span><?= abs($detail_pendapatan['persentase_pendapatan']) ?> %</span>
                                            <?php } else { ?>
                                                <span class="text-muted"><span class="text-success"><i class="fas fa-caret-up"></i> </span><?= $detail_pendapatan['persentase_pendapatan'] ?> %</span>
                                        <?php }
                                        } ?>
                                        <div class="detail-value"><?= $detail_pendapatan['pendapatan_sekarang'] ?></div>
                                        <div class="detail-name">Pendapatan Bulan ini</div>
                                    </div>

                                </div>
                            </div>
                        </div>




                    </div>

                </div>
                <!-- <div class="row">
                    <div class="col-md border shadow">
                        <div class="card">
                            <div class="card-header">
                                <h4>Statistik Jenis Pesanan</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="chartJenisPesanan"></canvas>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </section>
</div>