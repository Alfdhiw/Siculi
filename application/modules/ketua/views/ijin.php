<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <a href="<?= base_url('admin/cetak_laporan/') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" target="_blank"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <div class="row">
        <div class="col-xl-12 col-md-12 mb-6">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa-regular fa-pen-to-square"></i> Pengajuan Ijin Terbaru</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered dataproses" id="dataproses" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Waktu Pergi</th>
                                    <th>Waktu Pulang</th>
                                    <th>Keperluan</th>
                                    <th>Tanggal Ijin</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dataijin as $dataijin) : ?>
                                    <tr>
                                        <td class="text-center"><a href="<?= base_url('kepegawaian/detail_karyawan/' . $dataijin['id_karyawan'])  ?>"><b><?= $dataijin['nik']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
                                        <td class="text-center"><b><?= $dataijin['nama']; ?></b></td>
                                        <td class="text-center"><b><?= date('H:i:s', strtotime($dataijin['waktu_pergi'])) ?></b></td>
                                        <td class="text-center"><b><?= date('H:i:s', strtotime($dataijin['waktu_pulang'])) ?></b></td>
                                        <td class="text-center"><b><?= $dataijin['keperluan'] ?></b></td>
                                        <td class="text-center"><b><?= date('j F Y', strtotime($dataijin['tgl_ijin'])) ?></b></td>
                                        <td class="text-center"><b><?php if ($dataijin['status'] == 'Approved') {
                                                                        echo '<span class="badge text-ligth bg-success"><span style="font-size:15px;">Approved</span></span>';
                                                                    } else if ($dataijin['status'] == 'Reject') {
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