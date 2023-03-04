<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <div class="row">
        <div class="col-xl-12 col-md-12 mb-6">
            <?php if ($this->session->flashdata('flash')) {
                echo '<p class="warning" style="margin: 10px 20px;">' . $this->session->flashdata('flash') . '</p>';
            } ?>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa-regular fa-pen-to-square"></i> Pengajuan Cuti Terbaru Karyawan</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 mb-4">
                            <form action="" method="get">
                                <table class="text-right">
                                    <tr>
                                        <td><b>Periode :&ensp;</b></td>
                                        <td><input type="date" name="from" class="form-control" required></td>
                                        <td><b>-</b></td>
                                        <td><input type="date" name="to" class="form-control" required></td>
                                        <td>&ensp;<button class="btn btn-primary" type="submit"><i class="fas fa-magnifying-glass"></i></button></td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered datacutix" id="datacutix" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Tanggal Cuti</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Jenis Cuti</th>
                                    <th>Keperluan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $id = $userid;
                                if (isset($_GET['from']) && isset($_GET['to'])) {
                                    // tampilkan data yang sesuai dengan range tanggal yang dicari 
                                    $data = mysqli_query($con, "SELECT k.nama, k.email, k.alamat, k.nik, c.* FROM tbl_karyawan k, tbl_cuti c WHERE k.id = c.id_karyawan and c.atasan = '$id' and c.status = 'Proses' and c.tgl_upload BETWEEN '" . $_GET['from'] . "' and '" . $_GET['to'] . "'");
                                } else {
                                    //jika tidak ada tanggal dari dan tanggal ke maka tampilkan seluruh data
                                    $data = mysqli_query($con, "SELECT k.nama, k.alamat, k.email, k.nik, c.* FROM tbl_karyawan k, tbl_cuti c WHERE k.id = c.id_karyawan and c.atasan = '$id' and c.status = 'Proses'");
                                }
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                                    <tr>
                                        <td class="text-center"><a href="<?= base_url('atasan/detail_karyawan/' . $d['id_karyawan'])  ?>"><b><?= $d['nik']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
                                        <td class="text-center"><b><?= $d['nama']; ?></b></td>
                                        <td class="text-center"><b><?= date('j F Y', strtotime($d['tgl_cuti'])) ?></b></td>
                                        <td class="text-center"><b><?= date('j F Y', strtotime($d['tgl_masuk'])) ?></b></td>
                                        <td class="text-center"><b><?= $d['jenis_cuti'] ?></b></td>
                                        <td class="text-center"><b><?= $d['keperluan'] ?></b></td>
                                        <td class="text-center"><b><?php if ($d['status'] == 'Disetujui') {
                                                                        echo '<span class="badge text-ligth bg-success"><span style="font-size:15px;">Disetujui</span></span>';
                                                                    } else if ($d['status'] == 'Ditolak') {
                                                                        echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Ditolak</span></span>';
                                                                    } else if ($d['status'] == 'Ditangguhkan') {
                                                                        echo '<span class="badge text-light bg-secondary"><span style="font-size:15px;">Ditangguhkan</span></span>';
                                                                    } else if ($d['status'] == 'Prses Ketua') {
                                                                        echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Disetujui</span></span>';
                                                                    } else {
                                                                        echo '<span class="badge bg-warning"><span style="font-size:15px;">Proses</span></span>';
                                                                    }
                                                                    ?></b></td>
                                        <td class="text-center"><span><a type="button" class="badge badge-success" href="" data-toggle="modal" data-target="#editModal<?= $d['id']; ?>" aria-hidden="true"><i class="fas fa-edit"></i> <span style="font-size:15px;">Edit</span></a></span></td>
                                        <!-- Modal Edit Cuti -->
                                        <div class="modal fade" id="editModal<?= $d['id'] ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="editModalLabel">Edit Data</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body text-left">
                                                        <form action="<?= base_url('atasan/edit_persetujuan/') . $d['id']; ?>" method="POST" id="form1">
                                                            <div class="row g-3">
                                                                <div class="col-md-6">
                                                                    <label for="nik" class="form-label">NIK</label>
                                                                    <input type="text" class="form-control" id="nik" name="nik" value="<?= $d['nik'] ?>" readonly>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="nama" class="form-label">Nama</label>
                                                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $d['nama'] ?>" readonly>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="email" class="form-label">Email</label>
                                                                    <input type="email" class="form-control" id="email" name="email" value="<?= $d['email'] ?>" readonly>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="cuti" class="form-label">Tanggal Cuti</label>
                                                                    <input type="date" class="form-control" id="cuti" name="cuti" value="<?php echo date($d['tgl_cuti']); ?>" readonly>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="masuk" class="form-label">Tanggal Masuk</label>
                                                                    <input type="date" class="form-control" id="masuk" name="masuk" value="<?php echo date($d['tgl_masuk']); ?>" readonly>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="jumlah" class="form-label">Jumlah Cuti</label>
                                                                    <input type="jumlah" class="form-control" id="jumlah" name="jumlah" value="<?= $d['jumlah_cuti'] ?>" readonly>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="jenis" class="form-label">Jenis Cuti</label>
                                                                    <input type="jenis" class="form-control" id="jenis" name="jenis" value="<?= $d['jenis_cuti'] ?>" readonly>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="keperluan" class="form-label">Keperluan</label>
                                                                    <textarea class="form-control" id="keperluan" name="keperluan" readonly><?= $d['keperluan'] ?></textarea>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="keperluan" class="form-label">Lampiran Cuti</label>
                                                                    <?php
                                                                    if ($d['surat'] == null) {
                                                                        echo ' <a type="button" class="form-control btn btn-info disabled" href="" target="_blank"><i class="fas fa-download"></i>Unduh lampiran</a>';
                                                                    } else {
                                                                        echo ' <a type="button" class="form-control btn btn-info" href="' . base_url('assets/data/karyawan/surat/' . $d['surat']) . '" target="_blank"><i class="fas fa-download"></i>Unduh lampiran</a>';
                                                                    }
                                                                    ?>

                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="status" class="form-label">Status</label>
                                                                    <select name="status" id="status" class="custom-select">
                                                                        <option value="">-- Pilih --</option>
                                                                        <option value="Proses Ketua">Disetujui</option>
                                                                        <option value="Ditolak">Ditolak</option>
                                                                        <option value="Ditangguhkan">Ditangguhkan</option>
                                                                    </select>
                                                                </div>
                                                                <input type="text" name="status_profil" value="Cuti" id="status_profil">
                                                                <input type="text" name="status_profil" value="Aktif" id="status_profily">
                                                                <input type="hidden" name="nik" value="<?= $d['nik'] ?>">
                                                                <input type="hidden" name="sisa" value="<?= $d['jumlah_cuti'] - 1 ?>" id="sisax">
                                                                <input type="hidden" name="sisa" value="<?= $d['jumlah_cuti'] ?>" id="sisay">
                                                                <input type="hidden" name="tgl_masuk" value="<?= $d['tgl_masuk'] ?>">
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa-regular fa-pen-to-square"></i> Pengajuan Cuti Terbaru Atasan</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 mb-4">
                            <form action="" method="get">
                                <table class="text-right">
                                    <tr>
                                        <td><b>Periode :&ensp;</b></td>
                                        <td><input type="date" name="from" class="form-control" required></td>
                                        <td><b>-</b></td>
                                        <td><input type="date" name="to" class="form-control" required></td>
                                        <td>&ensp;<button class="btn btn-primary" type="submit"><i class="fas fa-magnifying-glass"></i></button></td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered datacutiy" id="datacutiy" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Tanggal Cuti</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Jenis Cuti</th>
                                    <th>Keperluan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $id = $userid;
                                if (isset($_GET['from']) && isset($_GET['to'])) {
                                    // tampilkan data yang sesuai dengan range tanggal yang dicari 
                                    $data = mysqli_query($con, "SELECT a.nama, a.email, a.nik, c.* FROM tbl_atasan a, tbl_cuti c WHERE a.kd_atasan = c.id_karyawan and c.atasan = '$id' and c.status = 'Proses' and c.tgl_upload BETWEEN '" . $_GET['from'] . "' and '" . $_GET['to'] . "'");
                                } else {
                                    //jika tidak ada tanggal dari dan tanggal ke maka tampilkan seluruh data
                                    $data = mysqli_query($con, "SELECT a.nama, a.email, a.nik, c.* FROM tbl_atasan a, tbl_cuti c WHERE a.kd_atasan = c.id_karyawan and c.atasan = '$id' and c.status = 'Proses'");
                                }
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                                    <tr>
                                        <td class="text-center"><a href="<?= base_url('atasan/detail_atasan/' . $d['id_karyawan'])  ?>"><b><?= $d['nik']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
                                        <td class="text-center"><b><?= $d['nama']; ?></b></td>
                                        <td class="text-center"><b><?= date('j F Y', strtotime($d['tgl_cuti'])) ?></b></td>
                                        <td class="text-center"><b><?= date('j F Y', strtotime($d['tgl_masuk'])) ?></b></td>
                                        <td class="text-center"><b><?= $d['jenis_cuti'] ?></b></td>
                                        <td class="text-center"><b><?= $d['keperluan'] ?></b></td>
                                        <td class="text-center"><b><?php if ($d['status'] == 'Disetujui') {
                                                                        echo '<span class="badge text-ligth bg-success"><span style="font-size:15px;">Disetujui</span></span>';
                                                                    } else if ($d['status'] == 'Ditolak') {
                                                                        echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Ditolak</span></span>';
                                                                    } else if ($d['status'] == 'Ditangguhkan') {
                                                                        echo '<span class="badge text-light bg-secondary"><span style="font-size:15px;">Ditangguhkan</span></span>';
                                                                    } else if ($d['status'] == 'Prses Ketua') {
                                                                        echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Disetujui</span></span>';
                                                                    } else {
                                                                        echo '<span class="badge bg-warning"><span style="font-size:15px;">Proses</span></span>';
                                                                    }
                                                                    ?></b></td>
                                        <td class="text-center"><span><a type="button" class="badge badge-success" href="" data-toggle="modal" data-target="#editModal<?= $d['id']; ?>" aria-hidden="true"><i class="fas fa-edit"></i> <span style="font-size:15px;">Edit</span></a></span></td>
                                        <!-- Modal Edit Cuti -->
                                        <div class="modal fade" id="editModal<?= $d['id'] ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="editModalLabel">Edit Data</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body text-left">
                                                        <form action="<?= base_url('atasan/edit_persetujuanatas/') . $d['id']; ?>" method="POST" id="form2">
                                                            <div class="row g-3">
                                                                <div class="col-md-6">
                                                                    <label for="nik" class="form-label">NIK</label>
                                                                    <input type="text" class="form-control" id="nik" name="nikatas" value="<?= $d['nik'] ?>" readonly>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="nama" class="form-label">Nama</label>
                                                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $d['nama'] ?>" readonly>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="email" class="form-label">Email</label>
                                                                    <input type="email" class="form-control" id="email" name="email" value="<?= $d['email'] ?>" readonly>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="cuti" class="form-label">Tanggal Cuti</label>
                                                                    <input type="date" class="form-control" id="cuti" name="cuti" value="<?php echo date($d['tgl_cuti']); ?>" readonly>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="masuk" class="form-label">Tanggal Masuk</label>
                                                                    <input type="date" class="form-control" id="masukatas" name="masuk" value="<?php echo date($d['tgl_masuk']); ?>" readonly>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="jumlah" class="form-label">Jumlah Cuti</label>
                                                                    <input type="jumlah" class="form-control" id="jumlah" name="jumlah" value="<?= $d['jumlah_cuti'] ?>" readonly>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="jenis" class="form-label">Jenis Cuti</label>
                                                                    <input type="jenis" class="form-control" id="jenis" name="jenis" value="<?= $d['jenis_cuti'] ?>" readonly>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="keperluan" class="form-label">Keperluan</label>
                                                                    <textarea class="form-control" id="keperluan" name="keperluan" readonly><?= $d['keperluan'] ?></textarea>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="keperluan" class="form-label">Lampiran Cuti</label>
                                                                    <?php
                                                                    if ($d['surat'] == null) {
                                                                        echo ' <a type="button" class="form-control btn btn-info disabled" href="" target="_blank"><i class="fas fa-download"></i>Unduh lampiran</a>';
                                                                    } else {
                                                                        echo ' <a type="button" class="form-control btn btn-info" href="' . base_url('assets/data/atasan/surat/' . $d['surat']) . '" target="_blank"><i class="fas fa-download"></i>Unduh lampiran</a>';
                                                                    }
                                                                    ?>

                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="status" class="form-label">Status</label>
                                                                    <select name="statusx" id="statusx" class="custom-select">
                                                                        <option value="">-- Pilih --</option>
                                                                        <option value="Proses Ketua">Disetujui</option>
                                                                        <option value="Ditolak">Ditolak</option>
                                                                        <option value="Ditangguhkan">Ditangguhkan</option>
                                                                    </select>
                                                                </div>
                                                                <input type="hidden" name="status_profilatas" value="Cuti" id="status_profilatas">
                                                                <input type="hidden" name="status_profilatas" value="Aktif" id="status_profilyatas">
                                                                <input type="hidden" name="nikatas" value="<?= $d['nik'] ?>">
                                                                <input type="hidden" name="sisaatas" value="<?= $d['jumlah_cuti'] - 1 ?>" id="sisax">
                                                                <input type="hidden" name="sisaatas" value="<?= $d['jumlah_cuti'] ?>" id="sisay">
                                                                <input type="hidden" name="tgl_masukatas" value="<?= $d['tgl_masuk'] ?>">
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                <?php } ?>
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