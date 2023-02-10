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
                            <h5 class="card-heading" style="font-weight: 600; color:white;">Data Atasan</h5>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover table-striped table-hover">
                                <tr>
                                    <td>Nama</td>
                                    <td><b><?php echo $atasan['nama']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>NIP</td>
                                    <td><b><?php echo $atasan['nik']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td><?php
                                        if ($atasan['jeniskel'] == 'L') {
                                            echo '<b>Laki-Laki</b>';
                                        } else {
                                            echo '<b>Perempuan</b>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><b><?php echo $atasan['email']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>Atasan</td>
                                    <td><b><?php echo $atasan['nama_atasan']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>Jabatan</td>
                                    <td><b><?php echo $atasan['jabatan']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>Golongan</td>
                                    <td>
                                        <div class="badge badge-secondary rounded"><b><?php echo $atasan['golongan']; ?></b></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>
                                        <b><?php if ($atasan['status'] == 'Aktif') {
                                                echo '<span class="badge text-ligth bg-success"><span style="font-size:15px;">Aktif</span></span>';
                                            } else if ($atasan['status'] == 'Cuti') {
                                                echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Cuti</span></span>';
                                            } else {
                                                echo '<span class="badge bg-warning"><span style="font-size:15px;">Tidak Aktif</span></span>';
                                            }
                                            ?></b>
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
                                    <td><img class="border-right rounded-lg shadow img-thumbnail" src="<?= base_url('assets/data/atasan/profil/' . $atasan['foto']); ?>" alt="foto_peserta" style="width:150px; height:200px;"></td>
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