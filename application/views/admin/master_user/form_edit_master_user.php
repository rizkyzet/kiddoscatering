<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= get_title() ?></h1>
        </div>

        <div class="section-body">
            <form action="<?= base_url('admin/master_user/edit/' . $editUser['id']) ?>" method="post">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" value="<?= set_value('nama', $editUser['nama']) ?>">
                                <?= form_error('nama', '<div class="text-danger text-small">', '</div>') ?>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" class="form-control" value="<?= set_value('email', $editUser['email']) ?>">
                                <?= form_error('email', '<div class="text-danger text-small">', '</div>') ?>
                            </div>
                            <div class="form-group">
                                <label for="no_hp">No. Handphone</label>
                                <input type="text" name="no_hp" id="no_hp" class="form-control" value="<?= set_value('no_hp', $editUser['no_hp']) ?>">
                                <?= form_error('no_hp', '<div class="text-danger text-small">', '</div>') ?>
                            </div>
                            <div class="form-group">
                                <label for="role_id">Role</label>
                                <select class="form-control" name="role_id" id="role_id">
                                    <option value=" ">Pilih Role</option>
                                    <?php foreach ($role as $r) : ?>
                                        <option value="<?= $r['id'] ?>" <?= $editUser['role_id'] == $r['id'] ? 'selected' : '' ?> <?= set_select('role_id', $r['id']) ?>><?= $r['role'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('role_id', '<div class="text-danger text-small">', '</div>') ?>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                                <div class="text-danger text-small"><em>*isi jika ingin diganti</em></div>
                                <?= form_error('password', '<div class="text-danger text-small">', '</div>') ?>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mt-3">Ubah</button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>