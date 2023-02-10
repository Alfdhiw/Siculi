<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-md-6 mb-6">
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                Selamat Datang <strong><?= $session ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-grey"><b>Data Ijin &ensp;<i class="fas fa-arrow-down"></i></b></h1>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Ijin</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $ijin ?> Data</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Disetujui</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $approved ?> Data</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas check fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Ditolak
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $reject ?> Data</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-xmark fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Diproses</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $process ?> Data</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12 col-md-12 mb-6">
                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa-regular fa-pen-to-square"></i> Pengajuan Ijin Karyawan Terbaru</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered dataproses" id="dataproses" width="100%" cellspacing="0">
                                            <thead class="thead-dark text-center">
                                                <tr>
                                                    <th>NIP</th>
                                                    <th>Nama</th>
                                                    <th>Waktu Pergi</th>
                                                    <th>Waktu Masuk</th>
                                                    <th>Tanggal Ijin</th>
                                                    <th>Jenis Ijin</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($dataijin as $dataijin) : ?>
                                                    <tr>
                                                        <td class="text-center"><a href="<?= base_url('atasan/detail_karyawan/' . $dataijin['id_karyawan'])  ?>"><b><?= $dataijin['nik']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
                                                        <td class="text-center"><b><?= $dataijin['nama']; ?></b></td>
                                                        <td class="text-center"><b><?= date('H:i:s', strtotime($dataijin['waktu_pergi'])) ?></b></td>
                                                        <td class="text-center"><b><?php
                                                                                    if ($dataijin['waktu_pulang'] == null) {
                                                                                        echo '<span class="badge text-bg-secondary">No data !</span>';
                                                                                    } else {
                                                                                        echo '' . date('H:i:s', strtotime($dataijin['waktu_pulang'])) . '';
                                                                                    }
                                                                                    ?></b></td>
                                                        <td class="text-center"><b><?= date('j F Y', strtotime($dataijin['tgl_ijin'])) ?></b></td>
                                                        <td class="text-center"><b><?php
                                                                                    if ($dataijin['jenis'] == 'Normal') {
                                                                                        echo '<span class="badge text-bg-primary">Normal</span>';
                                                                                    } else {
                                                                                        echo '<span class="badge text-bg-warning">Cepat</span>';
                                                                                    }
                                                                                    ?></b></td>
                                                        <td class="text-center"><b><?php if ($dataijin['status'] == 'Disetujui') {
                                                                                        echo '<span class="badge text-ligth bg-success"><span style="font-size:15px;">Disetujui</span></span>';
                                                                                    } else if ($dataijin['status'] == 'Ditolak') {
                                                                                        echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Ditolak</span></span>';
                                                                                    } else if ($dataijin['status'] == 'Proses Ketua') {
                                                                                        echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Disetujui</span></span>';
                                                                                    } else if ($dataijin['status'] == 'Ditangguhkan') {
                                                                                        echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Ditangguhkan</span></span>';
                                                                                    } else {
                                                                                        echo '<span class="badge bg-warning"><span style="font-size:15px;">Proses</span></span>';
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
                        <br>
                        <div class="col-xl-12 col-md-12 mb-6">
                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa-regular fa-pen-to-square"></i> Pengajuan Ijin Atasan Terbaru</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered dataproses" id="dataproses" width="100%" cellspacing="0">
                                            <thead class="thead-dark text-center">
                                                <tr>
                                                    <th>NIP</th>
                                                    <th>Nama</th>
                                                    <th>Waktu Pergi</th>
                                                    <th>Waktu Masuk</th>
                                                    <th>Tanggal Ijin</th>
                                                    <th>Jenis Ijin</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($dataijinatasan as $dataijinatasan) : ?>
                                                    <tr>
                                                        <td class="text-center"><a href="<?= base_url('atasan/detail_karyawan/' . $dataijinatasan['id_karyawan'])  ?>"><b><?= $dataijinatasan['nik']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
                                                        <td class="text-center"><b><?= $dataijinatasan['nama']; ?></b></td>
                                                        <td class="text-center"><b><?= date('H:i:s', strtotime($dataijinatasan['waktu_pergi'])) ?></b></td>
                                                        <td class="text-center"><b><?php
                                                                                    if ($dataijinatasan['waktu_pulang'] == null) {
                                                                                        echo '<span class="badge text-bg-secondary">No data !</span>';
                                                                                    } else {
                                                                                        echo '' . date('H:i:s', strtotime($dataijinatasan['waktu_pulang'])) . '';
                                                                                    }
                                                                                    ?></b></td>
                                                        <td class="text-center"><b><?= date('j F Y', strtotime($dataijinatasan['tgl_ijin'])) ?></b></td>
                                                        <td class="text-center"><b><?php
                                                                                    if ($dataijinatasan['jenis'] == 'Normal') {
                                                                                        echo '<span class="badge text-bg-primary">Normal</span>';
                                                                                    } else {
                                                                                        echo '<span class="badge text-bg-warning">Cepat</span>';
                                                                                    }
                                                                                    ?></b></td>
                                                        <td class="text-center"><b><?php if ($dataijinatasan['status'] == 'Disetujui') {
                                                                                        echo '<span class="badge text-ligth bg-success"><span style="font-size:15px;">Disetujui</span></span>';
                                                                                    } else if ($dataijinatasan['status'] == 'Ditolak') {
                                                                                        echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Ditolak</span></span>';
                                                                                    } else if ($dataijinatasan['status'] == 'Proses Ketua') {
                                                                                        echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Disetujui</span></span>';
                                                                                    } else if ($dataijinatasan['status'] == 'Ditangguhkan') {
                                                                                        echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Ditangguhkan</span></span>';
                                                                                    } else {
                                                                                        echo '<span class="badge bg-warning"><span style="font-size:15px;">Proses</span></span>';
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
                        <br>
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
                                                    <th>Waktu Masuk</th>
                                                    <th>Tanggal Ijin</th>
                                                    <th>Jenis Ijin</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($dataijindewe as $dataijindewe) : ?>
                                                    <tr>
                                                        <td class="text-center"><a href="<?= base_url('atasan/detail_karyawan/' . $dataijindewe['id_karyawan'])  ?>"><b><?= $dataijindewe['nik']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
                                                        <td class="text-center"><b><?= $dataijindewe['nama']; ?></b></td>
                                                        <td class="text-center"><b><?= date('H:i:s', strtotime($dataijindewe['waktu_pergi'])) ?></b></td>
                                                        <td class="text-center"><b><?php
                                                                                    if ($dataijindewe['waktu_pulang'] == null) {
                                                                                        echo '<span class="badge text-bg-secondary">No data !</span>';
                                                                                    } else {
                                                                                        echo '' . date('H:i:s', strtotime($dataijindewe['waktu_pulang'])) . '';
                                                                                    }
                                                                                    ?></b></td>
                                                        <td class="text-center"><b><?= date('j F Y', strtotime($dataijindewe['tgl_ijin'])) ?></b></td>
                                                        <td class="text-center"><b><?php
                                                                                    if ($dataijindewe['jenis'] == 'Normal') {
                                                                                        echo '<span class="badge text-bg-primary">Normal</span>';
                                                                                    } else {
                                                                                        echo '<span class="badge text-bg-warning">Cepat</span>';
                                                                                    }
                                                                                    ?></b></td>
                                                        <td class="text-center"><b><?php if ($dataijindewe['status'] == 'Disetujui') {
                                                                                        echo '<span class="badge text-ligth bg-success"><span style="font-size:15px;">Disetujui</span></span>';
                                                                                    } else if ($dataijindewe['status'] == 'Ditolak') {
                                                                                        echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Ditolak</span></span>';
                                                                                    } else if ($dataijindewe['status'] == 'Proses Ketua') {
                                                                                        echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Disetujui</span></span>';
                                                                                    } else if ($dataijindewe['status'] == 'Ditangguhkan') {
                                                                                        echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Ditangguhkan</span></span>';
                                                                                    } else {
                                                                                        echo '<span class="badge bg-warning"><span style="font-size:15px;">Proses</span></span>';
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
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-md-12 mb-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-primary"><b>Data Cuti &ensp;<i class="fas fa-arrow-down"></i></b></h1>
                    </div>

                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Cuti</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $cuti ?> Data</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Disetujui</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $approved_cuti ?> Data</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas check fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Ditolak
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $reject_cuti ?> Data</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-xmark fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Ditangguhkan</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $tangguh ?> Data</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12 col-md-12 mb-6">
                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa-regular fa-pen-to-square"></i> Pengajuan Cuti Terbaru Karyawan</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered datacutikar" id="datacutikar" width="100%" cellspacing="0">
                                            <thead class="thead-dark text-center">
                                                <tr>
                                                    <th>NIP</th>
                                                    <th>Nama</th>
                                                    <th>Tanggal Cuti</th>
                                                    <th>Tanggal Masuk</th>
                                                    <th>Jenis Cuti</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($datacuti as $datacuti) : ?>
                                                    <tr>
                                                        <td class="text-center"><a href="<?= base_url('atasan/detail_karyawan/' . $datacuti['id_karyawan'])  ?>"><b><?= $datacuti['nik']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
                                                        <td class="text-center"><b><?= $datacuti['nama']; ?></b></td>
                                                        <td class="text-center"><b><?= date('j F Y', strtotime($datacuti['tgl_cuti'])) ?></b></td>
                                                        <td class="text-center"><b><?= date('j F Y', strtotime($datacuti['tgl_masuk'])) ?></b></td>
                                                        <td class="text-center"><b><?= $datacuti['jenis_cuti'] ?></b></td>
                                                        <td class="text-center"><b><?php if ($datacuti['status'] == 'Disetujui') {
                                                                                        echo '<span class="badge text-ligth bg-success"><span style="font-size:15px;">Disetujui</span></span>';
                                                                                    } else if ($datacuti['status'] == 'Ditolak') {
                                                                                        echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Ditolak</span></span>';
                                                                                    } else if ($datacuti['status'] == 'Ditangguhkan') {
                                                                                        echo '<span class="badge text-light bg-secondary"><span style="font-size:15px;">Ditangguhkan</span></span>';
                                                                                    } else if ($datacuti['status'] == 'Proses Ketua') {
                                                                                        echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Disetujui</span></span>';
                                                                                    } else {
                                                                                        echo '<span class="badge bg-warning"><span style="font-size:15px;">Proses</span></span>';
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
                        <div class="col-xl-12 col-md-12 mb-6">
                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa-regular fa-pen-to-square"></i> Pengajuan Cuti Terbaru Atasan</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered datacutiatas" id="datacutiatas" width="100%" cellspacing="0">
                                            <thead class="thead-dark text-center">
                                                <tr>
                                                    <th>NIP</th>
                                                    <th>Nama</th>
                                                    <th>Tanggal Cuti</th>
                                                    <th>Tanggal Masuk</th>
                                                    <th>Jenis Cuti</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($datacutiatas as $datacutiatas) : ?>
                                                    <tr>
                                                        <td class="text-center"><a href="<?= base_url('atasan/detail_karyawan/' . $datacutiatas['id_karyawan'])  ?>"><b><?= $datacutiatas['nik']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
                                                        <td class="text-center"><b><?= $datacutiatas['nama']; ?></b></td>
                                                        <td class="text-center"><b><?= date('j F Y', strtotime($datacutiatas['tgl_cuti'])) ?></b></td>
                                                        <td class="text-center"><b><?= date('j F Y', strtotime($datacutiatas['tgl_masuk'])) ?></b></td>
                                                        <td class="text-center"><b><?= $datacutiatas['jenis_cuti'] ?></b></td>
                                                        <td class="text-center"><b><?php if ($datacutiatas['status'] == 'Disetujui') {
                                                                                        echo '<span class="badge text-ligth bg-success"><span style="font-size:15px;">Disetujui</span></span>';
                                                                                    } else if ($datacutiatas['status'] == 'Ditolak') {
                                                                                        echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Ditolak</span></span>';
                                                                                    } else if ($datacutiatas['status'] == 'Ditangguhkan') {
                                                                                        echo '<span class="badge text-light bg-secondary"><span style="font-size:15px;">Ditangguhkan</span></span>';
                                                                                    } else if ($datacutiatas['status'] == 'Proses Ketua') {
                                                                                        echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Disetujui</span></span>';
                                                                                    } else {
                                                                                        echo '<span class="badge bg-warning"><span style="font-size:15px;">Proses</span></span>';
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
                        <div class="col-xl-12 col-md-12 mb-6">
                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa-regular fa-pen-to-square"></i> Pengajuan Cuti Terbaru</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered datacutiatas" id="datacutiatas" width="100%" cellspacing="0">
                                            <thead class="thead-dark text-center">
                                                <tr>
                                                    <th>NIP</th>
                                                    <th>Nama</th>
                                                    <th>Tanggal Cuti</th>
                                                    <th>Tanggal Masuk</th>
                                                    <th>Jenis Cuti</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($datacutiatasdewe as $datacutiatasdewe) : ?>
                                                    <tr>
                                                        <td class="text-center"><a href="<?= base_url('atasan/detail_karyawan/' . $datacutiatasdewe['id_karyawan'])  ?>"><b><?= $datacutiatasdewe['nik']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
                                                        <td class="text-center"><b><?= $datacutiatasdewe['nama']; ?></b></td>
                                                        <td class="text-center"><b><?= date('j F Y', strtotime($datacutiatasdewe['tgl_cuti'])) ?></b></td>
                                                        <td class="text-center"><b><?= date('j F Y', strtotime($datacutiatasdewe['tgl_masuk'])) ?></b></td>
                                                        <td class="text-center"><b><?= $datacutiatasdewe['jenis_cuti'] ?></b></td>
                                                        <td class="text-center"><b><?php if ($datacutiatasdewe['status'] == 'Disetujui') {
                                                                                        echo '<span class="badge text-ligth bg-success"><span style="font-size:15px;">Disetujui</span></span>';
                                                                                    } else if ($datacutiatasdewe['status'] == 'Ditolak') {
                                                                                        echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Ditolak</span></span>';
                                                                                    } else if ($datacutiatasdewe['status'] == 'Ditangguhkan') {
                                                                                        echo '<span class="badge text-light bg-secondary"><span style="font-size:15px;">Ditangguhkan</span></span>';
                                                                                    } else if ($datacutiatasdewe['status'] == 'Proses Ketua') {
                                                                                        echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Disetujui</span></span>';
                                                                                    } else {
                                                                                        echo '<span class="badge bg-warning"><span style="font-size:15px;">Proses</span></span>';
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
            </div>
        </div>
    </div>
    <!-- Content Row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->