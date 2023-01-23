<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4 ml-3">
        <h1 class="h3 mb-0 text-gray-800" style="font-size: 35px;"><?= $title ?></h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-6 mb-6">
            <div class="row mx-2">
                <div class="col-md-8 ml-10">
                    <div class="card card-primary ml-10">
                        <div class="card-header bg-primary">
                            <h5 class="card-heading" style="font-weight: 600; color:white;">Data Pegawai</h5>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover table-striped table-hover">
                                <tr>
                                    <td>Nama</td>
                                    <td><b><?php echo $pegawai['nama']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>NIP</td>
                                    <td><b><?php echo $pegawai['nik']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>Masuk Kerja</td>
                                    <td><b><?php echo date('j F Y', strtotime($pegawai['masuk_kerja'])); ?></b></td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td><?php
                                        if ($pegawai['jenis_kelamin'] == 'L') {
                                            echo '<b>Laki-Laki</b>';
                                        } else {
                                            echo '<b>Perempuan</b>';
                                        }
                                        ?>
                                    </td>

                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><b><?php echo $pegawai['email']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>Telepon</td>
                                    <td><b><?php echo $pegawai['telp']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>Jabatan</td>
                                    <td><b><?php echo $pegawai['jabatan']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>Golongan</td>
                                    <td>
                                        <div class="badge badge-secondary rounded"><b><?php echo $pegawai['golongan']; ?></b></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>
                                        <b><?php if ($pegawai['status'] == 'Aktif') {
                                                echo '<span class="badge text-ligth bg-success"><span style="font-size:15px;">Aktif</span></span>';
                                            } else if ($pegawai['status'] == 'Cuti') {
                                                echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Cuti</span></span>';
                                            } else {
                                                echo '<span class="badge bg-warning"><span style="font-size:15px;">Tidak Aktif</span></span>';
                                            }
                                            ?></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>
                                        <b style="font-size: 15px;"><?= $pegawai['alamat'] ?></b>
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-primary mr-10">
                        <div class="card-header bg-primary">
                            <h5 class="card-heading" style="font-weight: 600; color:white;">Foto Profil</h5>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover table-striped table-hover">
                                <tr class="text-center">
                                    <td><img class="border-right rounded-lg shadow img-thumbnail" src="<?= base_url('assets/data/karyawan/profil/' . $pegawai['foto']); ?>" alt="foto_peserta" style="width:150px; height:200px;"></td>
                                </tr>
                            </table>
                        </div>
                        <span></span>
                        <div class="card-header bg-primary">
                            <h5 class="card-heading" style="font-weight: 600; color:white;">Sisa Cuti</h5>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover table-striped table-hover">
                                <tr class="text-center">
                                    <td class="text-secondary" style="font-size: 40px; font-weight:700"><span><?= $pegawai['sisa_cuti'] ?></span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<!-- End of Main Content -->