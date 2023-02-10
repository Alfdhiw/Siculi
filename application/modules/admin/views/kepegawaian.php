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
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-users"></i> Data Kepegawaian</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered datapeg" id="datapeg" width="100%" cellspacing="0">
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
                                <?php foreach ($kepegawaian as $kepegawaian) : ?>
                                    <tr>
                                        <td class="text-center"><a href="<?= base_url('admin/detail_kepegawaian/' . $kepegawaian['kd_kepegawaian'])  ?>"><b><?= $kepegawaian['nik']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
                                        <td class="text-center"><b><?= $kepegawaian['nama']; ?></b></td>
                                        <td class="text-center"><b><?= $kepegawaian['email']; ?></b></td>
                                        <td class="text-center"><b><?= $kepegawaian['jabatan']; ?></b></td>
                                        <td class="text-center"><b><?= $kepegawaian['golongan'] ?></b></td>
                                        <td class="text-center"><b><?php if ($kepegawaian['status'] == 'Aktif') {
                                                                        echo '<span class="badge text-ligth bg-success"><span style="font-size:15px;">Aktif</span></span>';
                                                                    } else if ($kepegawaian['status'] == 'Cuti') {
                                                                        echo '<span class="badge text-light bg-warning"><span style="font-size:15px;">Cuti</span></span>';
                                                                    } else {
                                                                        echo '<span class="badge bg-danger"><span style="font-size:15px;">Tidak Aktif</span></span>';
                                                                    }
                                                                    ?></b></td>
                                        <td class="text-center">
                                            <span><a type="button" class="badge badge-success" href="" data-bs-toggle="modal" data-bs-target="#editModal<?= $kepegawaian['kd_kepegawaian'] ?>"><i class="fa-solid fa-pen-to-square"></i> <span style="font-size:15px;">Edit</span></a></span>

                                            <!-- Modal Edit kepegawaian -->
                                            <div class="modal fade" id="editModal<?= $kepegawaian['kd_kepegawaian'] ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="editModalLabel">Edit Data</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body text-left">
                                                            <form action="<?= base_url('admin/edit_kepegawaian/') . $kepegawaian['kd_kepegawaian']; ?>" method="POST">
                                                                <div class="row g-3">
                                                                    <div class="col-md-6">
                                                                        <label for="nik" class="form-label">NIP</label>
                                                                        <input type="text" class="form-control" id="nik" name="nik" value="<?= $kepegawaian['nik'] ?>" readonly>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="nama" class="form-label">Nama</label>
                                                                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $kepegawaian['nama'] ?>" readonly>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <label for="email" class="form-label">Email</label>
                                                                        <input type="email" class="form-control" id="email" name="email" value="<?= $kepegawaian['email'] ?>" readonly>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <label for="jeniskel" class="form-label">Jenis Kelamin</label>
                                                                        <input type="text" class="form-control" id="jeniskel" name="jeniskel" <?php
                                                                                                                                                if ($kepegawaian['jeniskel'] == 'L') {
                                                                                                                                                    echo 'value="Laki-Laki"';
                                                                                                                                                } else if ($kepegawaian['jeniskel'] == 'P') {
                                                                                                                                                    echo 'value="Perempuan"';
                                                                                                                                                }
                                                                                                                                                ?> readonly>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="jabatan" class="form-label">Jabatan</label>
                                                                        <select name="jabatan" id="jabatan" class="custom-select">
                                                                            <option value="<?= $kepegawaian['jabatan']; ?>"><?= $kepegawaian['jabatan'] ?></option>
                                                                            <?php foreach ($jabatan as $jb) : ?>
                                                                                <option value="<?= $jb['jabatan']; ?>"><?= $jb['jabatan']; ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="departement" class="form-label">Golongan</label>
                                                                        <select name="departement" id="departement" class="custom-select">
                                                                            <option value="<?= $kepegawaian['golongan']; ?>"><?= $kepegawaian['golongan'] ?></option>
                                                                            <?php foreach ($dept as $dp) : ?>
                                                                                <option value="<?= $dp['dept']; ?>"><?= $dp['dept']; ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="status" class="form-label">Status</label>
                                                                        <select name="status" id="status" class="custom-select">
                                                                            <option value="<?= $kepegawaian['status']; ?>"><?= $kepegawaian['status'] ?></option>
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
                                            <span><a type="button" class="badge badge-danger" href="" data-toggle="modal" data-target="#hapusModal<?= $kepegawaian['kd_kepegawaian']; ?>"><i class="fa-solid fa-trash"></i> <span style="font-size:15px;">Hapus</span></a></span>

                                            <!-- Modal Hapus kepegawaian -->
                                            <div class="modal fade" id="hapusModal<?= $kepegawaian['kd_kepegawaian'] ?>" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
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
                                                            <a type="button" class="btn btn-primary" href="<?= base_url('admin/delete_kepegawaian/' . $kepegawaian['kd_kepegawaian']) ?>">Iya, Saya Yakin</a>
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