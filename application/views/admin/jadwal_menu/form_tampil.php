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

                <table class="table getCalendar">

                    <?= $calendar ?>
                </table>

            </div>
        </div>
    </section>
</div>