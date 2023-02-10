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
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa-regular fa-pen-to-square"></i> Pengajuan Ijin Karyawan</h6>
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
                        <table class="table table-hover table-bordered datasetuju" id="datasetuju" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Waktu Pergi</th>
                                    <th>Waktu Pulang</th>
                                    <th>Keperluan</th>
                                    <th>Tanggal Ijin</th>
                                    <th>Jenis</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $id = $userid;
                                if (isset($_GET['from']) && isset($_GET['to'])) {
                                    // tampilkan data yang sesuai dengan range tanggal yang dicari 
                                    $data = mysqli_query($con, "SELECT k.nama, k.nik, i.* FROM tbl_karyawan k, tbl_ijin i WHERE k.id = i.id_karyawan and i.atasan = '$id' and i.status = 'Proses' and i.tgl_ijin BETWEEN '" . $_GET['from'] . "' and '" . $_GET['to'] . "'");
                                } else {
                                    //jika tidak ada tanggal dari dan tanggal ke maka tampilkan seluruh data
                                    $data = mysqli_query($con, "SELECT k.nama, k.nik, i.* FROM tbl_karyawan k, tbl_ijin i WHERE k.id = i.id_karyawan and i.atasan = '$id' and i.status = 'Proses'");
                                }
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                                    <tr>
                                        <td class="text-center"><a href="<?= base_url('atasan/detail_karyawan/' . $d['id_karyawan'])  ?>"><b><?= $d['nik']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
                                        <td class="text-center"><b><?= $d['nama']; ?></b></td>
                                        <td class="text-center"><b><?= date('H:i:s', strtotime($d['waktu_pergi'])) ?></b></td>
                                        <td class="text-center"><b><?php
                                                                    if ($d['waktu_pulang'] == null) {
                                                                        echo '<span class="badge text-bg-secondary">No data !</span>';
                                                                    } else {
                                                                        echo '' . date('H:i:s', strtotime($d['waktu_pulang'])) . '';
                                                                    }
                                                                    ?></b></td>
                                        <td class="text-center"><b><?= $d['keperluan'] ?></b></td>
                                        <td class="text-center"><b><?= date('d F Y', strtotime($d['tgl_ijin'])) ?></b></td>
                                        <td class="text-center"><b><?php
                                                                    if ($d['jenis'] == 'Normal') {
                                                                        echo '<span class="badge text-bg-primary">Normal</span>';
                                                                    } else {
                                                                        echo '<span class="badge text-bg-warning">Cepat</span>';
                                                                    }
                                                                    ?></b></td>
                                        <td class="text-center"><b><?php if ($d['status'] == 'Diterima') {
                                                                        echo '<span class="badge text-ligth bg-success"><span style="font-size:15px;">Diterima</span></span>';
                                                                    } else if ($d['status'] == 'Ditolak') {
                                                                        echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Ditolak</span></span>';
                                                                    } else if ($d['status'] == 'Proses Ketua') {
                                                                        echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Disetujui</span></span>';
                                                                    } else if ($d['status'] == 'Ditangguhkan') {
                                                                        echo '<span class="badge text-light bg-secondary"><span style="font-size:15px;">Ditangguhkan</span></span>';
                                                                    } else {
                                                                        echo '<span class="badge bg-warning"><span style="font-size:15px;">Proses</span></span>';
                                                                    }
                                                                    ?></b></td>
                                        <td class="text-center"><span><a type="button" class="badge badge-success" data-toggle="modal" data-target="#editModal<?= $d['id'] ?>"><i class="fas fa-edit"></i> <span style="font-size:15px;">Edit</span></a></span></td>

                                        <!-- Modal Edit Cuti -->
                                        <div class="modal fade" id="editModal<?= $d['id'] ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="editModalLabel">Edit Data</h1>
                                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body text-left">
                                                        <form action="<?= base_url('atasan/edit_ijin/') . $d['id'] ?>" method="POST">
                                                            <div class="row g-3">
                                                                <div class="col-md-6">
                                                                    <label for="nik" class="form-label">NIK</label>
                                                                    <input type="text" class="form-control" id="nik" name="nik" value="<?= $d['nik'] ?>" readonly>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="nama" class="form-label">Nama</label>
                                                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $d['nama'] ?>" readonly>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="cuti" class="form-label">Waktu Pergi</label>
                                                                    <input type="text" class="form-control" id="cuti" name="cuti" value="<?= date('H:i:s', strtotime($d['waktu_pergi'])) ?>" readonly>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="masuk" class="form-label">Waktu Pulang</label>
                                                                    <?php
                                                                    if ($d['waktu_pulang'] == null) {
                                                                        echo '<input type="text" class="form-control" id="masuk" name="masuk" value="No Data !" readonly>';
                                                                    } else {
                                                                        echo ' <input type="text" class="form-control" id="masuk" name="masuk" value="' . date('H:i:s', strtotime($d['waktu_pulang'])) . '" readonly>';
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="tgl_ijin" class="form-label">Tanggal Ijin</label>
                                                                    <input type="text" class="form-control" id="tgl_ijin" name="tgl_ijin" value="<?= date('d F Y', strtotime($d['tgl_ijin'])) ?>" readonly>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="keperluan" class="form-label">Keperluan</label>
                                                                    <textarea class="form-control" id="keperluan" name="keperluan" readonly><?= $d['keperluan'] ?></textarea>
                                                                </div>
                                                                <input type="hidden" name="id_karyawan" value="<?= $d['id'] ?>">
                                                                <div class="col-md-12">
                                                                    <label for="status" class="form-label">Status</label>
                                                                    <select name="status" id="status" class="custom-select">
                                                                        <option value="<?= $d['status']; ?>"><?= $d['status'] ?></option>
                                                                        <option value="Disetujui">Disetujui</option>
                                                                        <option value="Ditolak">Ditolak</option>
                                                                    </select>
                                                                </div>
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
        <br>
        <div class="col-xl-12 col-md-12 mb-6">
            <?php if ($this->session->flashdata('flash')) {
                echo '<p class="warning" style="margin: 10px 20px;">' . $this->session->flashdata('flash') . '</p>';
            } ?>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa-regular fa-pen-to-square"></i> Pengajuan Ijin Atasan</h6>
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
                        <table class="table table-hover table-bordered datasetuju" id="datasetuju" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Waktu Pergi</th>
                                    <th>Waktu Pulang</th>
                                    <th>Keperluan</th>
                                    <th>Tanggal Ijin</th>
                                    <th>Jenis</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $id = $userid;
                                if (isset($_GET['from']) && isset($_GET['to'])) {
                                    // tampilkan data yang sesuai dengan range tanggal yang dicari 
                                    $data = mysqli_query($con, "SELECT k.nama, k.nik, i.* FROM tbl_atasan k, tbl_ijin i WHERE k.kd_atasan = i.id_karyawan and i.atasan = '$id' and i.status = 'Proses' and i.tgl_ijin BETWEEN '" . $_GET['from'] . "' and '" . $_GET['to'] . "'");
                                } else {
                                    //jika tidak ada tanggal dari dan tanggal ke maka tampilkan seluruh data
                                    $data = mysqli_query($con, "SELECT k.nama, k.nik, i.* FROM tbl_atasan k, tbl_ijin i WHERE k.kd_atasan = i.id_karyawan and i.atasan = '$id' and i.status = 'Proses'");
                                }
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                                    <tr>
                                        <td class="text-center"><a href="<?= base_url('atasan/detail_atasan/' . $d['id_karyawan'])  ?>"><b><?= $d['nik']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
                                        <td class="text-center"><b><?= $d['nama']; ?></b></td>
                                        <td class="text-center"><b><?= date('H:i:s', strtotime($d['waktu_pergi'])) ?></b></td>
                                        <td class="text-center"><b><?php
                                                                    if ($d['waktu_pulang'] == null) {
                                                                        echo '<span class="badge text-bg-secondary">No data !</span>';
                                                                    } else {
                                                                        echo '' . date('H:i:s', strtotime($d['waktu_pulang'])) . '';
                                                                    }
                                                                    ?></b></td>
                                        <td class="text-center"><b><?= $d['keperluan'] ?></b></td>
                                        <td class="text-center"><b><?= date('d F Y', strtotime($d['tgl_ijin'])) ?></b></td>
                                        <td class="text-center"><b><?php
                                                                    if ($d['jenis'] == 'Normal') {
                                                                        echo '<span class="badge text-bg-primary">Normal</span>';
                                                                    } else {
                                                                        echo '<span class="badge text-bg-warning">Cepat</span>';
                                                                    }
                                                                    ?></b></td>
                                        <td class="text-center"><b><?php if ($d['status'] == 'Diterima') {
                                                                        echo '<span class="badge text-ligth bg-success"><span style="font-size:15px;">Diterima</span></span>';
                                                                    } else if ($d['status'] == 'Ditolak') {
                                                                        echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Ditolak</span></span>';
                                                                    } else if ($d['status'] == 'Proses Ketua') {
                                                                        echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Disetujui</span></span>';
                                                                    } else if ($d['status'] == 'Ditangguhkan') {
                                                                        echo '<span class="badge text-light bg-secondary"><span style="font-size:15px;">Ditangguhkan</span></span>';
                                                                    } else {
                                                                        echo '<span class="badge bg-warning"><span style="font-size:15px;">Proses</span></span>';
                                                                    }
                                                                    ?></b></td>
                                        <td class="text-center"><span><a type="button" class="badge badge-success" data-toggle="modal" data-target="#editModal<?= $d['id'] ?>"><i class="fas fa-edit"></i> <span style="font-size:15px;">Edit</span></a></span></td>

                                        <!-- Modal Edit Cuti -->
                                        <div class="modal fade" id="editModal<?= $d['id'] ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="editModalLabel">Edit Data</h1>
                                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body text-left">
                                                        <form action="<?= base_url('atasan/edit_ijin/') . $d['id'] ?>" method="POST">
                                                            <div class="row g-3">
                                                                <div class="col-md-6">
                                                                    <label for="nik" class="form-label">NIK</label>
                                                                    <input type="text" class="form-control" id="nik" name="nik" value="<?= $d['nik'] ?>" readonly>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="nama" class="form-label">Nama</label>
                                                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $d['nama'] ?>" readonly>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="cuti" class="form-label">Waktu Pergi</label>
                                                                    <input type="text" class="form-control" id="cuti" name="cuti" value="<?= date('H:i:s', strtotime($d['waktu_pergi'])) ?>" readonly>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="masuk" class="form-label">Waktu Pulang</label>
                                                                    <?php
                                                                    if ($d['waktu_pulang'] == null) {
                                                                        echo '<input type="text" class="form-control" id="masuk" name="masuk" value="No Data !" readonly>';
                                                                    } else {
                                                                        echo ' <input type="text" class="form-control" id="masuk" name="masuk" value="' . date('H:i:s', strtotime($d['waktu_pulang'])) . '" readonly>';
                                                                    }
                                                                    ?>

                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="tgl_ijin" class="form-label">Tanggal Ijin</label>
                                                                    <input type="text" class="form-control" id="tgl_ijin" name="tgl_ijin" value="<?= date('d F Y', strtotime($d['tgl_ijin'])) ?>" readonly>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="keperluan" class="form-label">Keperluan</label>
                                                                    <textarea class="form-control" id="keperluan" name="keperluan" readonly><?= $d['keperluan'] ?></textarea>
                                                                </div>
                                                                <input type="hidden" name="id_karyawan" value="<?= $d['id'] ?>">
                                                                <div class="col-md-12">
                                                                    <label for="status" class="form-label">Status</label>
                                                                    <select name="status" id="status" class="custom-select">
                                                                        <option value="<?= $d['status']; ?>"><?= $d['status'] ?></option>
                                                                        <option value="Disetujui">Disetujui</option>
                                                                        <option value="Ditolak">Ditolak</option>
                                                                    </select>
                                                                </div>
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
        <br>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->