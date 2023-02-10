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
                        <form action="<?= base_url('atasan/cetak_laporan') ?>" method="post" id="tes1">
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
                                <a class="btn btn-primary" type="button" target="_blank" onclick="myFunction()">Cetak</a>
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
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa-regular fa-pen-to-square"></i> Data Cuti Terbaru Karyawan</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 mb-4">
                            <form action="" method="get">
                                <table class="text-right">
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
                        <table class="table table-hover table-bordered dataisi" id="dataisi" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Tanggal Cuti</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Jenis Cuti</th>
                                    <th>Keperluan</th>
                                    <th>Status</th>
                                    <th>Cetak Cuti</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $id = $userid;
                                if (isset($_GET['from']) && isset($_GET['to'])) {
                                    // tampilkan data yang sesuai dengan range tanggal yang dicari 
                                    $data = mysqli_query($con, "SELECT k.nama, k.nik, c.* FROM tbl_karyawan k, tbl_cuti c WHERE k.id = c.id_karyawan and c.atasan = '$id' and c.tgl_upload BETWEEN '" . $_GET['from'] . "' and '" . $_GET['to'] . "'");
                                } else {
                                    //jika tidak ada tanggal dari dan tanggal ke maka tampilkan seluruh data
                                    $data = mysqli_query($con, "SELECT k.nama, k.nik, c.* FROM tbl_karyawan k, tbl_cuti c WHERE k.id = c.id_karyawan and c.atasan = '$id'");
                                }
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                                    <tr>
                                        <td class="text-center"><a href="<?= base_url('atasan/detail_karyawan/' . $d['id_karyawan'])  ?>"><b><?= $d['nik']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
                                        <td class="text-center"><b><?= $d['nama']; ?></b></td>
                                        <td class="text-center"><b><?= date('j F Y', strtotime($d['tgl_cuti'])) ?></b></td>
                                        <td class="text-center"><b><?= date('j F Y', strtotime($d['tgl_masuk'])) ?></b></td>
                                        <td class="text-center"><b><?= $d['jenis_cuti'] ?></b></td>
                                        <td class="text-center"><b><?= $d['keperluan'] ?></b></td>
                                        <td class="text-center"><b><?php if ($d['status'] == 'Disetujui') {
                                                                        echo '<span class="badge text-ligth bg-success"><span style="font-size:15px;">Disetujui</span></span>';
                                                                    } else if ($d['status'] == 'Ditolak') {
                                                                        echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Ditolak</span></span>';
                                                                    } else if ($d['status'] == 'Ditangguhkan') {
                                                                        echo '<span class="badge text-light bg-secondary"><span style="font-size:15px;">Ditangguhkan</span></span>';
                                                                    } else if ($d['status'] == 'Proses Ketua') {
                                                                        echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Disetujui</span></span>';
                                                                    } else {
                                                                        echo '<span class="badge bg-warning"><span style="font-size:15px;">Process</span></span>';
                                                                    }
                                                                    ?></b></td>
                                        <td class="text-center"><a href="<?= base_url('user/cetak_cuti/') . $d['id'] ?>" class="btn btn-info btn-sm" target="_blank"><b>Cetak</b></a></td>
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
            <btn href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#cutiatasanModal"><i class="fas fa-download fa-sm text-white-50"></i> Cetak Report</btn>
            <!-- Modal -->
            <div class="modal fade" id="cutiatasanModal" tabindex="-1" aria-labelledby="cutiatasanModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="cutiatasanModalLabel">Cetak Report Cuti</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="<?= base_url('atasan/cetak_laporanatasan') ?>" method="post" id="tes3">
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
                                <a class="btn btn-primary" type="button" target="_blank" onclick="myFunctionAtasan()">Cetak</a>
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
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa-regular fa-pen-to-square"></i> Data Cuti Terbaru Atasan</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 mb-4">
                            <form action="" method="get">
                                <table class="text-right">
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
                        <table class="table table-hover table-bordered dataisi" id="dataisi" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Tanggal Cuti</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Jenis Cuti</th>
                                    <th>Keperluan</th>
                                    <th>Status</th>
                                    <th>Cetak Cuti</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $id = $userid;
                                if (isset($_GET['from']) && isset($_GET['to'])) {
                                    // tampilkan data yang sesuai dengan range tanggal yang dicari 
                                    $data = mysqli_query($con, "SELECT a.nama, a.nik, c.* FROM tbl_atasan a, tbl_cuti c WHERE a.kd_atasan = c.id_karyawan and c.atasan = '$id' and c.tgl_upload BETWEEN '" . $_GET['from'] . "' and '" . $_GET['to'] . "'");
                                } else {
                                    //jika tidak ada tanggal dari dan tanggal ke maka tampilkan seluruh data
                                    $data = mysqli_query($con, "SELECT a.nama, a.nik, c.* FROM tbl_atasan a, tbl_cuti c WHERE a.kd_atasan = c.id_karyawan and c.atasan = '$id'");
                                }
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                                    <tr>
                                        <td class="text-center"><a href="<?= base_url('atasan/detail_atasan/' . $d['id_karyawan'])  ?>"><b><?= $d['nik']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
                                        <td class="text-center"><b><?= $d['nama']; ?></b></td>
                                        <td class="text-center"><b><?= date('j F Y', strtotime($d['tgl_cuti'])) ?></b></td>
                                        <td class="text-center"><b><?= date('j F Y', strtotime($d['tgl_masuk'])) ?></b></td>
                                        <td class="text-center"><b><?= $d['jenis_cuti'] ?></b></td>
                                        <td class="text-center"><b><?= $d['keperluan'] ?></b></td>
                                        <td class="text-center"><b><?php if ($d['status'] == 'Disetujui') {
                                                                        echo '<span class="badge text-ligth bg-success"><span style="font-size:15px;">Disetujui</span></span>';
                                                                    } else if ($d['status'] == 'Ditolak') {
                                                                        echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Ditolak</span></span>';
                                                                    } else if ($d['status'] == 'Ditangguhkan') {
                                                                        echo '<span class="badge text-light bg-secondary"><span style="font-size:15px;">Ditangguhkan</span></span>';
                                                                    } else if ($d['status'] == 'Proses Ketua') {
                                                                        echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Diterima</span></span>';
                                                                    } else {
                                                                        echo '<span class="badge bg-warning"><span style="font-size:15px;">Process</span></span>';
                                                                    }
                                                                    ?></b></td>
                                        <td class="text-center"><a href="<?= base_url('atasan/cetak_cuti/') . $d['id'] ?>" class="btn btn-info btn-sm" target="_blank"><b>Cetak</b></a></td>
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
            <btn href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#cutideweModal"><i class="fas fa-download fa-sm text-white-50"></i> Cetak Report</btn>
            <!-- Modal -->
            <div class="modal fade" id="cutideweModal" tabindex="-1" aria-labelledby="cutideweModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="cutideweModalLabel">Cetak Report Cuti</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="<?= base_url('atasan/cetak_laporandewe') ?>" method="post" id="tes4">
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
                                <a class="btn btn-primary" type="button" target="_blank" onclick="myFunctionAtasanDewe()">Cetak</a>
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
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa-regular fa-pen-to-square"></i> Data Cuti Terbaru</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 mb-4">
                            <form action="" method="get">
                                <table class="text-right">
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
                        <table class="table table-hover table-bordered dataisi" id="dataisi" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Tanggal Cuti</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Jenis Cuti</th>
                                    <th>Keperluan</th>
                                    <th>Status</th>
                                    <th>Cetak Cuti</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $id = $userid;
                                if (isset($_GET['from']) && isset($_GET['to'])) {
                                    // tampilkan data yang sesuai dengan range tanggal yang dicari 
                                    $data = mysqli_query($con, "SELECT a.nama, a.nik, c.* FROM tbl_atasan a, tbl_cuti c WHERE a.kd_atasan = c.id_karyawan and c.id_karyawan = '$id' and c.tgl_upload BETWEEN '" . $_GET['from'] . "' and '" . $_GET['to'] . "'");
                                } else {
                                    //jika tidak ada tanggal dari dan tanggal ke maka tampilkan seluruh data
                                    $data = mysqli_query($con, "SELECT a.nama, a.nik, c.* FROM tbl_atasan a, tbl_cuti c WHERE a.kd_atasan = c.id_karyawan and c.id_karyawan = '$id'");
                                }
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                                    <tr>
                                        <td class="text-center"><a href="<?= base_url('atasan/detail_atasan/' . $d['id_karyawan'])  ?>"><b><?= $d['nik']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
                                        <td class="text-center"><b><?= $d['nama']; ?></b></td>
                                        <td class="text-center"><b><?= date('j F Y', strtotime($d['tgl_cuti'])) ?></b></td>
                                        <td class="text-center"><b><?= date('j F Y', strtotime($d['tgl_masuk'])) ?></b></td>
                                        <td class="text-center"><b><?= $d['jenis_cuti'] ?></b></td>
                                        <td class="text-center"><b><?= $d['keperluan'] ?></b></td>
                                        <td class="text-center"><b><?php if ($d['status'] == 'Disetujui') {
                                                                        echo '<span class="badge text-ligth bg-success"><span style="font-size:15px;">Disetujui</span></span>';
                                                                    } else if ($d['status'] == 'Ditolak') {
                                                                        echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Ditolak</span></span>';
                                                                    } else if ($d['status'] == 'Ditangguhkan') {
                                                                        echo '<span class="badge text-light bg-secondary"><span style="font-size:15px;">Ditangguhkan</span></span>';
                                                                    } else if ($d['status'] == 'Proses Ketua') {
                                                                        echo '<span class="badge text-light bg-warning"><span style="font-size:15px;">Proses</span></span>';
                                                                    } else {
                                                                        echo '<span class="badge bg-warning"><span style="font-size:15px;">Process</span></span>';
                                                                    }
                                                                    ?></b></td>
                                        <td class="text-center"><a href="<?= base_url('atasan/cetak_cuti/') . $d['id'] ?>" class="btn btn-info btn-sm" target="_blank"><b>Cetak</b></a></td>
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