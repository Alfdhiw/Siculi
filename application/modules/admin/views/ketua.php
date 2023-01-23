<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4 ml-3">

    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-6 mb-6">
            <div class="card mb-3 ml-1 shadow" style="max-width: fit; max-height: auto;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="<?= base_url('assets/data/ketua/profil/' . $ketua['foto']); ?>" class="img-fluid rounded-start" alt="<?= $ketua['foto'] ?>" style="height: 400px; width:300px;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">

                            <table class="table table-borderless">
                                <tr>
                                    <td>
                                        <h1 class="h3 mb-0 text-gray-800" class="card-title" style="font-weight: bold;">Profile Ketua</h1>
                                    </td>
                                </tr>
                                <tr class="h3 mb-0 text-gray-800">
                                    <td style="font-size: 23px; font-weight:700;">Nama</td>
                                    <td style="font-size: 23px; font-weight:700;">:</td>
                                    <td style="font-size: 23px; font-weight:700;"><?= $ketua['nama'] ?></td>
                                </tr>
                                <tr class="h3 mb-0 text-gray-800">
                                    <td style="font-size: 23px; font-weight:700;">NIP</td>
                                    <td style="font-size: 23px; font-weight:700;">:</td>
                                    <td style="font-size: 23px; font-weight:700;"><?= $ketua['nik'] ?></td>
                                </tr>
								<tr class="h3 mb-0 text-gray-800">
                                    <td style="font-size: 23px; font-weight:700;">Jabatan</td>
                                    <td style="font-size: 23px; font-weight:700;">:</td>
                                    <td style="font-size: 23px; font-weight:700;"><?= $ketua['jabatan'] ?></td>
                                </tr>
								<tr class="h3 mb-0 text-gray-800">
                                    <td style="font-size: 23px; font-weight:700;">Golongan</td>
                                    <td style="font-size: 23px; font-weight:700;">:</td>
                                    <td style="font-size: 23px; font-weight:700;"><?= $ketua['golongan'] ?></td>
                                </tr>
                                <tr class="h3 mb-0 text-gray-800">
                                    <td style="font-size: 23px; font-weight:700;">Email</td>
                                    <td style="font-size: 23px; font-weight:700;">:</td>
                                    <td style="font-size: 23px; font-weight:700;"><?= $ketua['email'] ?></td>
                                </tr>
                                <tr class="h3 mb-0 text-gray-800">
                                    <td style="font-size: 23px; font-weight:700;">Jenis Kelamin</td>
                                    <td style="font-size: 23px; font-weight:700;">:</td>
                                    <td style="font-size: 23px; font-weight:700;"><?php
                                                                                    if ($ketua['jeniskel'] == "L") {
                                                                                        echo 'Laki-Laki';
                                                                                    } else {
                                                                                        echo 'Perempuan';
                                                                                    } ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
