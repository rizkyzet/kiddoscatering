<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1> <?= get_title() ?></h1>
        </div>

        <div class="section-body">
            <div class="container-fluid">
                <?= $this->session->flashdata('pesan') ?>
                <a href="<?= base_url('admin/jadwal_menu/buat_jadwal') ?>" class="btn btn-primary btn-sm mb-3">Buat Jadwal</a>


                <table class="table mt-3 datatables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Jadwal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($jadwal as $jdwl) : ?>
                            <tr>
                                <td><?= $no++  ?></td>
                                <td>Jadwal Catering Bulan <?= getNamaBulanFromNumber($jdwl['bulan'])  ?> Tahun <?= $jdwl['tahun'] ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?= base_url('admin/jadwal_menu/tampil_jadwal/' . $jdwl['id_jadwal']) ?>" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Tampil Jadwal"><i class="fas fa-fw fa-eye"></i></a>
                                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="<?= base_url('admin/jadwal_menu/edit_jadwal/' . $jdwl['id_jadwal']) ?>"><i class="fas fa-fw fa-edit"></i> Edit </a>
                                            <a class="dropdown-item" href="<?= base_url('admin/jadwal_menu/hapus_jadwal/' . $jdwl['id_jadwal']) ?>" onclick="return confirm('Yakin Hapus ?')"><i class="fas fa-fw fa-trash"></i> Hapus </a>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </section>
</div>