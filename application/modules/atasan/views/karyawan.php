<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <!-- <div class="dropdown">
            <a href="<?= base_url('admin/laporan_karyawan/')  ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-download fa-sm text-white-50"></i> Cetak Laporan</a>
            <ul class="dropdown-menu">
                <?php foreach ($dept as $dp) : ?>
                    <li><a class="dropdown-item" href=""></a></li>
                <?php endforeach; ?>
            </ul>
        </div> -->
    </div>
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-6">
            <?php if ($this->session->flashdata('flash')) {
                echo '<p class="warning" style="margin: 10px 20px;">' . $this->session->flashdata('flash') . '</p>';
            } ?>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-users"></i> Data Karyawan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered datakar" id="datakar" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Jabatan</th>
                                    <th>Golongan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($karyawan as $karyawan) : ?>
                                    <tr>
                                        <td class="text-center"><a href="<?= base_url('atasan/detail_karyawan/' . $karyawan['id'])  ?>"><b><?= $karyawan['nik']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
                                        <td class="text-center"><b><?= $karyawan['nama']; ?></b></td>
                                        <td class="text-center"><b><?= $karyawan['email']; ?></b></td>
                                        <td class="text-center"><b><?= $karyawan['jabatan']; ?></b></td>
                                        <td class="text-center"><b><?= $karyawan['golongan'] ?></b></td>
                                        <td class="text-center"><b><?php if ($karyawan['status'] == 'Aktif') {
                                                                        echo '<span class="badge text-ligth bg-success"><span style="font-size:15px;">Aktif</span></span>';
                                                                    } else if ($karyawan['status'] == 'Cuti') {
                                                                        echo '<span class="badge text-light bg-warning"><span style="font-size:15px;">Cuti</span></span>';
                                                                    } else if ($karyawan['status'] == 'Proses') {
                                                                        echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Aktif</span></span>';
                                                                    } else {
                                                                        echo '<span class="badge bg-danger"><span style="font-size:15px;">Tidak Aktif</span></span>';
                                                                    }
                                                                    ?></b></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-users"></i> Data Karyawan Atasan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered datakaratas" id="datakaratas" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Jabatan</th>
                                    <th>Golongan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($karyawanatas as $karyawanatas) : ?>
                                    <tr>
                                        <td class="text-center"><a href="<?= base_url('atasan/detail_atasan/' . $karyawanatas['kd_atasan'])  ?>"><b><?= $karyawanatas['nik']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
                                        <td class="text-center"><b><?= $karyawanatas['nama']; ?></b></td>
                                        <td class="text-center"><b><?= $karyawanatas['email']; ?></b></td>
                                        <td class="text-center"><b><?= $karyawanatas['jabatan']; ?></b></td>
                                        <td class="text-center"><b><?= $karyawanatas['golongan'] ?></b></td>
                                        <td class="text-center"><b><?php if ($karyawanatas['status'] == 'Aktif') {
                                                                        echo '<span class="badge text-ligth bg-success"><span style="font-size:15px;">Aktif</span></span>';
                                                                    } else if ($karyawanatas['status'] == 'Cuti') {
                                                                        echo '<span class="badge text-light bg-warning"><span style="font-size:15px;">Cuti</span></span>';
                                                                    } else if ($karyawanatas['status'] == 'Proses') {
                                                                        echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Aktif</span></span>';
                                                                    } else {
                                                                        echo '<span class="badge bg-danger"><span style="font-size:15px;">Tidak Aktif</span></span>';
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