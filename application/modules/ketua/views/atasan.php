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
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-users"></i> Data Atasan</h6>
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
                                <?php foreach ($atasan as $atasan) : ?>
                                    <tr>
                                        <td class="text-center"><a href="<?= base_url('ketua/detail_atasan/' . $atasan['kd_atasan'])  ?>"><b><?= $atasan['nik']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
                                        <td class="text-center"><b><?= $atasan['nama']; ?></b></td>
                                        <td class="text-center"><b><?= $atasan['email']; ?></b></td>
                                        <td class="text-center"><b><?= $atasan['jabatan']; ?></b></td>
                                        <td class="text-center"><b><?= $atasan['golongan'] ?></b></td>
                                        <td class="text-center"><b><?php if ($atasan['status'] == 'Aktif') {
                                                                        echo '<span class="badge text-ligth bg-success"><span style="font-size:15px;">Aktif</span></span>';
                                                                    } else if ($atasan['status'] == 'Cuti') {
                                                                        echo '<span class="badge text-light bg-warning"><span style="font-size:15px;">Cuti</span></span>';
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