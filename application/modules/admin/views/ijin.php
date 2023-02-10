<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <!-- <a href="<?= base_url('admin/cetak_ijin/') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" target="_blank"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <div class="row">
        <div class="col-xl-12 col-md-12 mb-6">
            <?php if ($this->session->flashdata('flash')) {
                echo '<p class="warning" style="margin: 10px 20px;">' . $this->session->flashdata('flash') . '</p>';
            } ?>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa-regular fa-pen-to-square"></i> Pengajuan Ijin Terbaru</h6>
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
                        <table class="table table-hover table-bordered dataijin" id="dataijin" width="100%" cellspacing="0">
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
                                if (isset($_GET['from']) && isset($_GET['to'])) {
                                    // tampilkan data yang sesuai dengan range tanggal yang dicari 
                                    $data = mysqli_query($con, "SELECT k.nama, k.nik, c.* FROM tbl_karyawan k, tbl_ijin c WHERE k.id = c.id_karyawan and c.tgl_ijin BETWEEN '" . $_GET['from'] . "' and '" . $_GET['to'] . "'");
                                } else {
                                    //jika tidak ada tanggal dari dan tanggal ke maka tampilkan seluruh data
                                    $data = mysqli_query($con, "SELECT k.nama, k.nik, c.* FROM tbl_karyawan k, tbl_ijin c WHERE k.id = c.id_karyawan");
                                }
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                                    <tr>
                                        <td class="text-center"><a href="<?= base_url('admin/detail_karyawan/' . $d['id'])  ?>"><b><?= $d['nik']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
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
                                        <td class="text-center"><b><?= date('j F Y', strtotime($d['tgl_ijin'])) ?></b></td>
                                        <td class="text-center"><b><?php
                                                                    if ($d['jenis'] == 'Normal') {
                                                                        echo '<span class="badge text-bg-primary">Normal</span>';
                                                                    } else {
                                                                        echo '<span class="badge text-bg-warning">Cepat</span>';
                                                                    }
                                                                    ?></b></td>
                                        <td class="text-center"><b><?php if ($d['status'] == 'Disetujui') {
                                                                        echo '<span class="badge text-ligth bg-success"><span style="font-size:15px;">Disetujui</span></span>';
                                                                    } else if ($d['status'] == 'Ditolak') {
                                                                        echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Ditolak</span></span>';
                                                                    } else {
                                                                        echo '<span class="badge bg-warning"><span style="font-size:15px;">Proses</span></span>';
                                                                    }
                                                                    ?></b></td>
                                        <td class="text-center"><span><a type="button" class="badge badge-danger" href="" data-toggle="modal" data-target="#hapusModal<?= $d['id']; ?>"><i class="fa-solid fa-trash"></i> <span style="font-size:15px;">Hapus</span></a></span></td>
                                        <!-- Modal Hapus Karyawan -->
                                        <div class="modal fade" id="hapusModal<?= $d['id'] ?>" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
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
                                                        <a type="button" class="btn btn-primary" href="<?= base_url('admin/delete_ijin/' . $d['id']) ?>">Iya, Saya Yakin</a>
                                                    </div>
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