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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($karyawan as $karyawan) : ?>
                                    <tr>
                                        <td class="text-center"><a href="<?= base_url('admin/detail_karyawan/' . $karyawan['id'])  ?>"><b><?= $karyawan['nik']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
                                        <td class="text-center"><b><?= $karyawan['nama']; ?></b></td>
                                        <td class="text-center"><b><?= $karyawan['email']; ?></b></td>
                                        <td class="text-center"><b><?= $karyawan['jabatan']; ?></b></td>
                                        <td class="text-center"><b><?= $karyawan['golongan'] ?></b></td>
                                        <td class="text-center"><b><?php if ($karyawan['status'] == 'Aktif') {
                                                                        echo '<span class="badge text-ligth bg-success"><span style="font-size:15px;">Aktif</span></span>';
                                                                    } else if ($karyawan['status'] == 'Cuti') {
                                                                        echo '<span class="badge text-light bg-warning"><span style="font-size:15px;">Cuti</span></span>';
                                                                    } else {
                                                                        echo '<span class="badge bg-danger"><span style="font-size:15px;">Tidak Aktif</span></span>';
                                                                    }
                                                                    ?></b></td>
                                        <td class="text-center">
                                            <span><a type="button" class="badge badge-success" href="" data-bs-toggle="modal" data-bs-target="#editModal<?= $karyawan['nik'] ?>"><i class="fa-solid fa-pen-to-square"></i> <span style="font-size:15px;">Edit</span></a></span>

                                            <!-- Modal Edit Karyawan -->
                                            <div class="modal fade" id="editModal<?= $karyawan['nik'] ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="editModalLabel">Edit Data</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body text-left">
                                                            <form action="<?= base_url('admin/edit_karyawan/') . $karyawan['id']; ?>" method="POST">
                                                                <div class="row g-3">
                                                                    <div class="col-md-6">
                                                                        <label for="nik" class="form-label">NIP</label>
                                                                        <input type="text" class="form-control" id="nik" name="nik" value="<?= $karyawan['nik'] ?>" readonly>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="nama" class="form-label">Nama</label>
                                                                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $karyawan['nama'] ?>" readonly>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="jabatan" class="form-label">Jabatan</label>
                                                                        <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= $karyawan['jabatan'] ?>" readonly>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="golongan" class="form-label">Golongan</label>
                                                                        <input type="text" class="form-control" id="golongan" name="golongan" value="<?= $karyawan['golongan'] ?>" readonly>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <label for="email" class="form-label">Email</label>
                                                                        <input type="email" class="form-control" id="email" name="email" value="<?= $karyawan['email'] ?>" readonly>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <label for="masuk" class="form-label">Masuk Kerja</label>
                                                                        <input type="text" class="form-control" id="masuk" name="masuk" value="<?php echo date('j F Y', strtotime($karyawan['masuk_kerja'])); ?>" readonly>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <label for="jeniskel" class="form-label">Jenis Kelamin</label>
                                                                        <input type="text" class="form-control" id="jeniskel" name="jeniskel" <?php
                                                                                                                                                if ($karyawan['jenis_kelamin'] == 'L') {
                                                                                                                                                    echo 'value="Laki-Laki"';
                                                                                                                                                } else if ($karyawan['jenis_kelamin'] == 'P') {
                                                                                                                                                    echo 'value="Perempuan"';
                                                                                                                                                }
                                                                                                                                                ?> readonly>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <label for="telepon" class="form-label">Telepon</label>
                                                                        <input type="telepon" class="form-control" id="telepon" name="telepon" value="<?= $karyawan['telp'] ?>" readonly>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <label for="alamat" class="form-label">Alamat</label>
                                                                        <textarea class="form-control" id="alamat" name="alamat" readonly><?= $karyawan['alamat'] ?></textarea>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="kepegawaian" class="form-label">Kepegawaian</label>
                                                                        <select name="kepegawaian" id="kepegawaian" class="custom-select">
                                                                            <option value="<?= $karyawan['kepegawaian']; ?>"><?= $karyawan['nama_kepegawaian'] ?></option>
                                                                            <?php foreach ($kepegawaian as $kp) : ?>
                                                                                <option value="<?= $kp['kd_kepegawaian']; ?>"><?= $kp['nama']; ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="atasan" class="form-label">Atasan</label>
                                                                        <select name="atasan" id="atasan" class="custom-select">
                                                                            <option value="<?= $karyawan['atasan']; ?>"><?= $karyawan['nama_atasan'] ?></option>
                                                                            <?php foreach ($atasan as $kp) : ?>
                                                                                <option value="<?= $kp['kd_atasan']; ?>"><?= $kp['nama']; ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="sisa" class="form-label">Sisa Cuti</label>
                                                                        <input type="number" class="form-control" id="sisa" name="sisa" value="<?= $karyawan['sisa_cuti'] ?>">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="status" class="form-label">Status</label>
                                                                        <select name="status" id="status" class="custom-select">
                                                                            <option value="<?= $karyawan['status']; ?>"><?= $karyawan['status'] ?></option>
                                                                            <option value="Aktif">Aktif</option>
                                                                            <option value="Cuti">Cuti</option>
                                                                            <option value="Tidak Aktif">Tidak Aktif</option>

                                                                        </select>
                                                                    </div>

                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <span><a type="button" class="badge badge-danger" href="" data-toggle="modal" data-target="#hapusModal<?= $karyawan['id']; ?>"><i class="fa-solid fa-trash"></i> <span style="font-size:15px;">Hapus</span></a></span>

                                            <!-- Modal Hapus Karyawan -->
                                            <div class="modal fade" id="hapusModal<?= $karyawan['id'] ?>" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="hapusModalLabel">Perhatian !</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-left">
                                                            Apakah Anda Yakin Ingin Menghapus Data Ini ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                            <a type="button" class="btn btn-primary" href="<?= base_url('admin/delete_karyawan/' . $karyawan['id']) ?>">Iya, Saya Yakin</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
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