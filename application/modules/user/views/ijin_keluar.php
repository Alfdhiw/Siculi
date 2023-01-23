<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <a href="<?= base_url('user/tambah_ijin')  ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Ijin</a>
    </div>

    <div class="row">
        <div class="col-xl-12 col-md-12 mb-6">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa-regular fa-pen-to-square"></i> Ijin Keluar Kantor Terbaru</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered dataproses" id="dataproses" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Atasan</th>
                                    <th>Waktu Pergi</th>
                                    <th>Waktu Pulang</th>
                                    <th>Keperluan</th>
                                    <th>Tanggal Ijin</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($nik as $nik) : ?>
                                    <tr>
                                        <td class="text-center"><a href="<?= base_url('user/detail_karyawan/' . $nik['id'])  ?>"><b><?= $nik['nik']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
                                        <td class="text-center"><b><?= $nik['nama']; ?></b></td>
                                        <td class="text-center"><b><?= $nik['atasan'] ?></b></td>
                                        <td class="text-center"><b><?= date('H:i:s', strtotime($nik['waktu_pergi'])) ?></b></td>
                                        <td class="text-center"><b><?= date('H:i:s', strtotime($nik['waktu_pulang'])) ?></b></td>
                                        <td class="text-center"><b><?= $nik['keperluan'] ?></b></td>
                                        <td class="text-center"><b><?= $nik['tgl_ijin'] ?></b></td>
                                        <td class="text-center"><b><?php if ($nik['status'] == 'Approved') {
                                                                        echo '<span class="badge text-ligth bg-success"><span style="font-size:15px;">Approved</span></span>';
                                                                    } else if ($nik['status'] == 'Reject') {
                                                                        echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Reject</span></span>';
                                                                    } else {
                                                                        echo '<span class="badge bg-warning"><span style="font-size:15px;">Process</span></span>';
                                                                    }
                                                                    ?></b></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
