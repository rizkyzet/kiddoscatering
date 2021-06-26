<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= get_title() ?></h1>
        </div>
        <div class="section-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-12 col-lg-7">
                        <div class="card author-box card-primary">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5 ">
                                        <div class="author-box-left">
                                            <img alt="image" src="<?= base_url('assets/upload/profile/' . $masterUser['image']) ?>" class="w-75 author-box-picture">
                                            <div class="clearfix"></div>

                                        </div>
                                    </div>
                                    <div class="col-6 ">

                                        <div class="author-box-name">
                                            <a href="#"><?= $masterUser['nama'] ?></a>
                                        </div>
                                        <div class="author-box-job">Member sejak <?= date('d-m-Y', $masterUser['tgl_dibuat']) ?></div>
                                        <div class="author-box-description">
                                            <p><i class="fas fa-envelope"></i> <?= $masterUser['email'] ?>
                                                <br />
                                                <i class="fas fa-phone"></i> <?= $masterUser['no_hp'] ?>
                                                <br />
                                                <i class="fas fa-gift"></i> June 02, 1988
                                            </p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>