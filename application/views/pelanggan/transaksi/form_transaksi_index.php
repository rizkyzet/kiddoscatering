<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= get_title(); ?></h1>
        </div>

        <div class="section-body">
            <div class="container-fluid">
                <table class="table table-hover table-bordered">
                    <thead>
                        <th>No</th>
                        <th>Info</th>
                        <th>Tanggal Pesan</th>
                        <th>Status Pembayaran</th>
                        <th>Action</th>
                    </thead>
                    <tr>
                        <td>1</td>
                        <td>Catering Bulan <b>Mei</b></td>
                        <td>2020-05-01</td>
                        <td>
                            <div class="badge badge-success">Settlement</div>
                        </td>
                        <td>
                            <a href="" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Detail pesanan"><i class="fas fa-eye"></i></a>
                            <a href="" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Edit pesanan"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Catering Bulan <b>Juni</b></td>
                        <td>2020-06-01</td>
                        <td>
                            <div class="badge badge-warning">Pending</div>
                        </td>
                        <td>
                            <a href="" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Detail pembayaran"><i class="fas fa-money-bill-alt"></i></a>

                            <a href="" class="btn btn-sm btn-danger" onclick="return confirm('Data akan dihapus?')" data-toggle="tooltip" data-placement="top" title="Batalkan Transaksi"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>