<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <div class="row">
        <div class="col-xl-6 col-md-6 mb-4">
            <btn href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#cutiModal"><i class="fas fa-download fa-sm text-white-50"></i> Cetak Report</btn>
            <!-- Modal -->
            <div class="modal fade" id="cutiModal" tabindex="-1" aria-labelledby="cutiModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="cutiModalLabel">Cetak Report Cuti</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="<?= base_url('ketua/cetak_ijin') ?>" method="post" id="tes2">
                            <div class="modal-body">
                                <table>
                                    <tr>
                                        <td><b>Periode</b></td>
                                        <td>:</td>
                                        <td></td>
                                        <td><input class="form-control" type="date" name="from" id="from"></td>
                                        <td><b>-</b></td>
                                        <td><input class="form-control" type="date" name="to" id="to"></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <a class="btn btn-primary" type="button" target="_blank" onclick="myFunctionx()">Cetak</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="col-xl-12 col-md-12 mb-6">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa-regular fa-pen-to-square"></i> Pengajuan Ijin Terbaru</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 mb-4">
                            <form action="" method="get">
                                <table>
                                    <tr>
                                        <td><b>Periode :&ensp;</b></td>
                                        <td><input type="date" name="from" class="form-control" required></td>
                                        <td><b>-</b></td>
                                        <td><input type="date" name="to" class="form-control" required></td>
                                        <td>&ensp;<button class="btn btn-primary" type="submit"><i class="fas fa-magnifying-glass"></i></button></td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered dataijin" id="dataijin" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Waktu Pergi</th>
                                    <th>Waktu Pulang</th>
                                    <th>Keperluan</th>
                                    <th>Jenis Ijin</th>
                                    <th>Status</th>
                                    <th>Cetak</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $id = $userid;
                                if (isset($_GET['from']) && isset($_GET['to'])) {
                                    // tampilkan data yang sesuai dengan range tanggal yang dicari 
                                    $data = mysqli_query($con, "SELECT k.nama, k.nik, i.* FROM tbl_karyawan k, tbl_ijin i WHERE k.id = i.id_karyawan and i.tgl_ijin BETWEEN '" . $_GET['from'] . "' and '" . $_GET['to'] . "'");
                                } else {
                                    //jika tidak ada tanggal dari dan tanggal ke maka tampilkan seluruh data
                                    $data = mysqli_query($con, "SELECT k.nama, k.nik, i.* FROM tbl_karyawan k, tbl_ijin i WHERE k.id = i.id_karyawan");
                                }
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                                    <tr>
                                        <td class="text-center"><a href="<?= base_url('kepegawaian/detail_karyawan/' . $d['id_karyawan'])  ?>"><b><?= $d['nik']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
                                        <td class="text-center"><b><?= $d['nama']; ?></b></td>
                                        <td class="text-center"><b><?= date('H:i:s', strtotime($d['waktu_pergi'])) ?></b></td>
                                        <td class="text-center"><b><?= date('H:i:s', strtotime($d['waktu_pulang'])) ?></b></td>
                                        <td class="text-center"><b><?= $d['keperluan'] ?></b></td>
                                        <td class="text-center"><b><?php
                                                                    if ($d['jenis'] == 'Normal') {
                                                                        echo '<span class="badge text-bg-primary">Normal</span>';
                                                                    } else {
                                                                        echo '<span class="badge text-bg-warning">Cepat</span>';
                                                                    }
                                                                    ?></b></td>
                                        <td class="text-center"><b><?php if ($d['status'] == 'Disetujui') {
                                                                        echo '<span class="badge text-ligth bg-success"><span style="font-size:15px;">Disetujui</span></span>';
                                                                    } else if ($d['status'] == 'Ditolak') {
                                                                        echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Ditolak</span></span>';
                                                                    } else if ($d['status'] == 'Ditangguhkan') {
                                                                        echo '<span class="badge text-light bg-secondary"><span style="font-size:15px;">Ditangguhkan</span></span>';
                                                                    } else {
                                                                        echo '<span class="badge bg-warning"><span style="font-size:15px;">Proses</span></span>';
                                                                    }
                                                                    ?></b></td>
                                        <?php
                                        if ($d['status'] == 'Disetujui') {
                                            if ($d['jenis'] == 'Normal') {
                                                echo '<td class="text-center"><a href="' . base_url('user/cetak_ijin/') . $d['id'] . '" class="btn btn-info btn-sm" target="_blank"><b>Cetak</b></a></td>';
                                            } else {
                                                echo '<td class="text-center"><a href="' . base_url('user/cetak_cepat/') . $d['id'] . '" class="btn btn-info btn-sm" target="_blank"><b>Cetak</b></a></td>';
                                            }
                                        } else {
                                            echo '<td class="text-center"><a href="" class="btn btn-info btn-sm disabled"><b>Cetak</b></a></td>';
                                        }
                                        ?>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="col-xl-6 col-md-6 mb-4">
            <btn href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#ijinatasModal"><i class="fas fa-download fa-sm text-white-50"></i> Cetak Report</btn>
            <!-- Modal -->
            <div class="modal fade" id="ijinatasModal" tabindex="-1" aria-labelledby="ijinatasModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="ijinatasModalLabel">Cetak Report Cuti</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="<?= base_url('ketua/cetak_ijinatasan') ?>" method="post" id="tes7">
                            <div class="modal-body">
                                <table>
                                    <tr>
                                        <td><b>Periode</b></td>
                                        <td>:</td>
                                        <td></td>
                                        <td><input class="form-control" type="date" name="from" id="from"></td>
                                        <td><b>-</b></td>
                                        <td><input class="form-control" type="date" name="to" id="to"></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <a class="btn btn-primary" type="button" target="_blank" onclick="myFunctiony()">Cetak</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="col-xl-12 col-md-12 mb-6">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa-regular fa-pen-to-square"></i> Pengajuan Ijin Terbaru</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 mb-4">
                            <form action="" method="get">
                                <table>
                                    <tr>
                                        <td><b>Periode :&ensp;</b></td>
                                        <td><input type="date" name="from" class="form-control" required></td>
                                        <td><b>-</b></td>
                                        <td><input type="date" name="to" class="form-control" required></td>
                                        <td>&ensp;<button class="btn btn-primary" type="submit"><i class="fas fa-magnifying-glass"></i></button></td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered dataijin" id="dataijin" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Waktu Pergi</th>
                                    <th>Waktu Pulang</th>
                                    <th>Keperluan</th>
                                    <th>Jenis Ijin</th>
                                    <th>Status</th>
                                    <th>Cetak</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $id = $userid;
                                if (isset($_GET['from']) && isset($_GET['to'])) {
                                    // tampilkan data yang sesuai dengan range tanggal yang dicari 
                                    $data = mysqli_query($con, "SELECT k.nama, k.nik, i.* FROM tbl_atasan k, tbl_ijin i WHERE k.kd_atasan = i.id_karyawan and i.tgl_ijin BETWEEN '" . $_GET['from'] . "' and '" . $_GET['to'] . "'");
                                } else {
                                    //jika tidak ada tanggal dari dan tanggal ke maka tampilkan seluruh data
                                    $data = mysqli_query($con, "SELECT k.nama, k.nik, i.* FROM tbl_atasan k, tbl_ijin i WHERE k.kd_atasan = i.id_karyawan");
                                }
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                                    <tr>
                                        <td class="text-center"><a href="<?= base_url('kepegawaian/detail_karyawan/' . $d['id_karyawan'])  ?>"><b><?= $d['nik']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
                                        <td class="text-center"><b><?= $d['nama']; ?></b></td>
                                        <td class="text-center"><b><?= date('H:i:s', strtotime($d['waktu_pergi'])) ?></b></td>
                                        <td class="text-center"><b><?= date('H:i:s', strtotime($d['waktu_pulang'])) ?></b></td>
                                        <td class="text-center"><b><?= $d['keperluan'] ?></b></td>
                                        <td class="text-center"><b><?php
                                                                    if ($d['jenis'] == 'Normal') {
                                                                        echo '<span class="badge text-bg-primary">Normal</span>';
                                                                    } else {
                                                                        echo '<span class="badge text-bg-warning">Cepat</span>';
                                                                    }
                                                                    ?></b></td>
                                        <td class="text-center"><b><?php if ($d['status'] == 'Disetujui') {
                                                                        echo '<span class="badge text-ligth bg-success"><span style="font-size:15px;">Disetujui</span></span>';
                                                                    } else if ($d['status'] == 'Ditolak') {
                                                                        echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Ditolak</span></span>';
                                                                    } else if ($d['status'] == 'Ditangguhkan') {
                                                                        echo '<span class="badge text-light bg-secondary"><span style="font-size:15px;">Ditangguhkan</span></span>';
                                                                    } else {
                                                                        echo '<span class="badge bg-warning"><span style="font-size:15px;">Proses</span></span>';
                                                                    }
                                                                    ?></b></td>
                                        <?php
                                        if ($d['status'] == 'Disetujui') {
                                            if ($d['jenis'] == 'Normal') {
                                                echo '<td class="text-center"><a href="' . base_url('atasan/cetak_suratatasan/') . $d['id'] . '" class="btn btn-info btn-sm" target="_blank"><b>Cetak</b></a></td>';
                                            } else {
                                                echo '<td class="text-center"><a href="' . base_url('atasan/cetak_cepatatasan/') . $d['id'] . '" class="btn btn-info btn-sm" target="_blank"><b>Cetak</b></a></td>';
                                            }
                                        } else {
                                            echo '<td class="text-center"><a href="" class="btn btn-info btn-sm disabled"><b>Cetak</b></a></td>';
                                        }
                                        ?>
                                    </tr>
                                <?php } ?>
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