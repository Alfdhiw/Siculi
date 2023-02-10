<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle btn-sm rounded" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-plus"></i> Tambah Ijin
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?= base_url('user/tambah_ijin') ?>"><b>Ijin Keluar Kantor &ensp;<i class="fas fa-building"></i></b></a></li>
                <li><a class="dropdown-item" href="<?= base_url('user/tambah_ijincepat') ?>"><b>Ijin Keluar Cepat&ensp;&ensp;<i class="fas fa-clock"></i></b></a></li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-md-12 mb-6">
            <?php if ($this->session->flashdata('flash')) {
                echo '<p class="warning" style="margin: 10px 20px;">' . $this->session->flashdata('flash') . '</p>';
            } ?>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa-regular fa-pen-to-square"></i> Ijin Keluar Kantor Terbaru</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 mb-4">
                            <form action="" method="get">
                                <table>
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
                                    <th>Jenis Cuti</th>
                                    <th>Status</th>
                                    <th>Cetak Ijin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $id = $userid;
                                if (isset($_GET['from']) && isset($_GET['to'])) {
                                    // tampilkan data yang sesuai dengan range tanggal yang dicari 
                                    $data = mysqli_query($con, "SELECT k.id, k.nik, k.nama, i.waktu_pergi, i.waktu_pulang, i.keperluan, i.tgl_ijin, i.status, i.jenis, i.id_karyawan,i.id as id_ijin from tbl_karyawan k, tbl_ijin i, tbl_atasan a where k.id = i.id_karyawan and k.atasan = a.kd_atasan and i.id_karyawan = '$id' and i.tgl_ijin BETWEEN '" . $_GET['from'] . "' and '" . $_GET['to'] . "'");
                                } else {
                                    //jika tidak ada tanggal dari dan tanggal ke maka tampilkan seluruh data
                                    $data = mysqli_query($con, "SELECT k.id, k.nik, k.nama, i.waktu_pergi, i.waktu_pulang, i.keperluan, i.tgl_ijin, i.status, i.jenis, i.id_karyawan, i.id as id_ijin FROM  tbl_karyawan k, tbl_ijin i, tbl_atasan a WHERE  k.id = i.id_karyawan and k.atasan = a.kd_atasan and i.id_karyawan = '$id'");
                                }
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                                    <tr>
                                        <td class="text-center"><a href="<?= base_url('user/detail_karyawan/' . $d['id'])  ?>"><b><?= $d['nik']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
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
                                        <?php
                                        if ($d['status'] == 'Disetujui') {
                                            if ($d['jenis'] == 'Normal') {
                                                echo '<td class="text-center"><a href="' . base_url('user/cetak_ijin/') . $d['id_ijin'] . '" class="btn btn-info btn-sm" target="_blank"><b>Cetak</b></a></td>';
                                            } else {
                                                echo '<td class="text-center"><a href="' . base_url('user/cetak_cepat/') . $d['id_ijin'] . '" class="btn btn-info btn-sm" target="_blank"><b>Cetak</b></a></td>';
                                            }
                                        } else {
                                            echo '<td class="text-center"><a href="" class="btn btn-info btn-sm disabled"><b>Cetak</b></a></td>';
                                        }
                                        ?>
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