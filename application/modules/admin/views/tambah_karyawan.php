<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-6">
            <div class="alert alert-success shadow" role="alert">
                <h4 class="alert-heading"><i class="icon fa fa-info"></i> Informasi !</h4>
                <p>User yang di daftarkan secara default memiliki Username dan Password sebagai berikut :</p>
                <hr>
                <p><strong>Username :</strong> <i>Email yang digunakan untuk pendaftaran</i><br>
                    <strong>Password :</strong> 12345
                </p>
                <p>Sarankan kepada karyawan agar segera mengganti password di akun masing-masing</p>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-xl-12 col-md-12 mb-6">
            <?php if ($this->session->flashdata('flash')) {
                echo '<p class="warning" style="margin: 10px 20px;">' . $this->session->flashdata('flash') . '</p>';
            } ?>
            <form class="row g-3" action="<?= base_url('admin/tambah_karyawan/'); ?>" method="POST">
                <div class="col-md-6">
                    <label for="nik" class="form-label">NIP</label>
                    <input type="nik" class="form-control" id="nik" name="nik" required>
                </div>
                <div class="col-md-6">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="nama" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="col-12">
                    <label for="masuk" class="form-label">Tanggal Masuk</label>
                    <input type="date" class="form-control" id="masuk" name="masuk" required>
                </div>
                <div class="col-md-6">
                    <label for="jeniskel" class="form-label">Jenis Kelamin</label>
                    <select id="jeniskel" name="jeniskel" class="form-select">
                        <option selected>- Pilih -</option>
                        <option value="L">Laki-Laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="telp" class="form-label">Telepon</label>
                    <input type="telp" class="form-control" id="telp" name="telp" required>
                </div>
                <div class="col-md-12">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                </div>
                <div class="col-md-12">
                    <label for="atasan" class="form-label">Atasan</label>
                    <select name="atasan" id="atasan" class="custom-select">
                        <option value="">- Pilih - </option>
                        <?php foreach ($atasan as $atasan) : ?>
                            <option value="<?= $atasan['kd_atasan']; ?>"><?= $atasan['nama']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <select name="jabatan" id="jabatan" class="custom-select" required>
                        <option value="">- Pilih - </option>
                        <?php foreach ($jabatan as $jb) : ?>
                            <option value="<?= $jb['jabatan']; ?>"><?= $jb['jabatan']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="golongan" class="form-label">Golongan</label>
                    <select name="golongan" id="golongan" class="custom-select" required>
                        <option value="">- Pilih - </option>
                        <?php foreach ($golongan as $gl) : ?>
                            <option value="<?= $gl['dept']; ?>"><?= $gl['dept']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="sisa" class="form-label">Sisa Cuti</label>
                    <input type="number" class="form-control" id="sisa" name="sisa" required>
                </div>
                <input type="hidden" name="foto" value="default.jpg">
                <input type="hidden" name="id_role" value="3">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Selesai</button>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->