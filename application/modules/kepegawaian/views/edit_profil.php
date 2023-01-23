<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="font-size: 40px;"><?= $title ?></h1>
    </div>

    <?php if ($this->session->flashdata('success')) : ?>

        <div class="alert alert-success" role="alert">

            <?php echo $this->session->flashdata('success'); ?>

        </div>

    <?php endif; ?>

    <?php if ($this->session->flashdata('error')) : ?>

        <div class="alert alert-danger" role="alert">

            <?php echo $this->session->flashdata('error'); ?>

        </div>

    <?php endif; ?>
    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 m-auto">
            <!-- Card Total Mahasiswa -->
            <div class="col-xl-12 col-md-12 mb-4">
                <form action="" method="post" enctype="multipart/form-data" class="mt-5">

                    <input type="hidden" name="kd_kepegawaian" value="<?php echo $profil['kd_kepegawaian'] ?>" />

                    <div class="form-group form-row mb-4">

                        <div class="col-3">

                            <div class="img">
                                <img class="border-right rounded-lg shadow img-thumbnail" name="foto" src="<?= base_url('assets/data/kepegawaian/profil/' . $profil['foto']); ?>" alt="" style="height: 200px; width: 170px">
                            </div>
                        </div>

                        <div class="col d-flex align-items-center">

                            <input class="form-control-file" type="file" name="foto" />

                            <input type="hidden" name="gambar_lama" value="<?= $profil['foto'] ?>" />

                        </div>
                    </div>

                    <div class="form-group form-row">

                        <div class="form-group col-md-12">

                            <label for="nik">NIK</label>

                            <input id="nik" class="form-control shadow" type="text" name="nik" value="<?= $profil['nik'] ?>" readonly />
                        </div>
						<div class="form-group col-md-12">

                            <label for="jabatan">Jabatan</label>

                            <input id="jabatan" class="form-control shadow" type="text" name="jabatan" value="<?= $profil['jabatan'] ?>" readonly />
                        </div>
						<div class="form-group col-md-12">

                            <label for="golongan">Golongan</label>

                            <input id="golongan" class="form-control shadow" type="text" name="golongan" value="<?= $profil['golongan'] ?>" readonly />
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">

                            <label for="nama">Nama</label>

                            <input id="nama" class="form-control shadow" type="text" name="nama" value="<?= $profil['nama'] ?>" required />

                        </div>

                        <div class="form-group col-md-6">

                            <label for="jeniskel">Jenis Kelamin</label>
                            <select id="jeniskel" class="form-control form-select shadow" name="jeniskel" required>
                                <option value="<?= $profil['jeniskel'] ?>"><?php if ($profil['jeniskel'] == 'L') {
                                                                                echo 'Laki-laki';
                                                                            } else if ($profil['jeniskel'] == 'P') {
                                                                                echo 'Perempuan';
                                                                            } else {
                                                                                echo 'Pilih Jenis Kelamin';
                                                                            } ?></option>
                                </option>
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>

                        </div>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">

                            <label for="email">Email</label>

                            <input id="email" class="form-control shadow" type="email" name="email" value="<?= $profil['email'] ?>" required />

                        </div>

                        <div class="form-group col-md-6">

                            <label for="password">Kata Sandi</label>

                            <input id="password" class="input-100 form-control shadow" type="password" name="password" value="<?= $profil['password'] ?>" required />

                        </div>
                    </div>


                    <input class="btn btn-success mt-3" data-toggle="modal" value="Update Biodata" data-target="#submitModal"></input>&ensp;&ensp;&ensp;&ensp;
                    <!-- Modal Submit -->
                    <div class="modal fade" id="submitModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="submitModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="submitModalLabel">Peringatan ! </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Apakah anda yakin dengan perubahan ini ? Jika iya anda akan langsung log out dan memulai login ulang
                                    untuk perubahan data
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                    <button type="submit" name="btn" id="submit" class="btn btn-primary">Setuju</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->
