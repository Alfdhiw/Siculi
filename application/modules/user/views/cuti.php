<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <div class="row">
        <div class="col-xl-12 col-md-12 mb-6">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa-regular fa-pen-to-square"></i> Pengajuan Cuti Terbaru</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered dataproses" id="dataproses" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Tanggal Cuti</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Keperluan</th>
                                    <th>Status</th>
                                    <th>Cetak Cuti</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($datacuti as $datacuti) : ?>
                                    <tr>
                                        <td class="text-center"><a href="<?= base_url('user/detail_karyawan/' . $datacuti['id_karyawan'])  ?>"><b><?= $datacuti['nik']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
                                        <td class="text-center"><b><?= $datacuti['nama']; ?></b></td>
                                        <td class="text-center"><b><?= date('j F Y', strtotime($datacuti['tgl_cuti'])) ?></b></td>
                                        <td class="text-center"><b><?= date('j F Y', strtotime($datacuti['tgl_masuk'])) ?></b></td>
                                        <td class="text-center"><b><?= $datacuti['keperluan'] ?></b></td>
                                        <td class="text-center"><b><?php if ($datacuti['status'] == 'Approved') {
                                                                        echo '<span class="badge text-ligth bg-success"><span style="font-size:15px;">Approved</span></span>';
                                                                    } else if ($datacuti['status'] == 'Reject') {
                                                                        echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Reject</span></span>';
                                                                    } else {
                                                                        echo '<span class="badge bg-warning"><span style="font-size:15px;">Process</span></span>';
                                                                    }
                                                                    ?></b></td>
                                        <?php
                                        if ($datacuti['status'] == 'Approved') {
                                            echo '<td class="text-center"><a href="' . base_url('user/cetak_cuti/') . $datacuti['id_karyawan'] . '" class="btn btn-info btn-sm" target="_blank"><b>Cetak</b></a></td>';
                                        } else {
                                            echo '<td class="text-center"><btn href="" class="btn btn-info btn-sm disabled"><b>Cetak</b></btn></td>';
                                        }
                                        ?>

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