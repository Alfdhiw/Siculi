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
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa-regular fa-pen-to-square"></i> Pengajuan Ijin Terbaru</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered dataproses" id="dataproses" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Atasan</th>
                                    <th>Waktu Pergi</th>
                                    <th>Waktu Pulang</th>
                                    <th>Keperluan</th>
                                    <th>Tanggal Ijin</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($datacuti as $datacuti) : ?>
                                    <tr>
                                        <td class="text-center"><a href="<?= base_url('kepegawaian/detail_karyawan/' . $datacuti['id_karyawan'])  ?>"><b><?= $datacuti['nik']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
                                        <td class="text-center"><b><?= $datacuti['nama']; ?></b></td>
                                        <td class="text-center"><b><?= $datacuti['atasan']; ?></b></td>
                                        <td class="text-center"><b><?= date('H:i:s', strtotime($datacuti['waktu_pergi'])) ?></b></td>
                                        <td class="text-center"><b><?= date('H:i:s', strtotime($datacuti['waktu_pulang'])) ?></b></td>
                                        <td class="text-center"><b><?= $datacuti['keperluan'] ?></b></td>
                                        <td class="text-center"><b><?= date('d F Y', strtotime($datacuti['tgl_ijin'])) ?></b></td>
                                        <td class="text-center"><b><?php if ($datacuti['status'] == 'Approved') {
                                                                        echo '<span class="badge text-ligth bg-success"><span style="font-size:15px;">Approved</span></span>';
                                                                    } else if ($datacuti['status'] == 'Rejected') {
                                                                        echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Reject</span></span>';
                                                                    } else {
                                                                        echo '<span class="badge bg-warning"><span style="font-size:15px;">Process</span></span>';
                                                                    }
                                                                    ?></b></td>
                                        <td class="text-center"><span><a type="button" class="badge badge-success" data-toggle="modal" data-target="#editModal<?= $datacuti['id'] ?>"><i class="fas fa-edit"></i> <span style="font-size:15px;">Edit</span></a></span></td>

                                        <!-- Modal Edit Cuti -->
                                        <div class="modal fade" id="editModal<?= $datacuti['id'] ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="editModalLabel">Edit Data</h1>
                                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body text-left">
                                                        <form action="<?= base_url('atasan/edit_ijin/') . $datacuti['id_karyawan'] ?>" method="POST">
                                                            <div class="row g-3">
                                                                <div class="col-md-6">
                                                                    <label for="nik" class="form-label">NIK</label>
                                                                    <input type="text" class="form-control" id="nik" name="nik" value="<?= $datacuti['nik'] ?>" readonly>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="nama" class="form-label">Nama</label>
                                                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $datacuti['nama'] ?>" readonly>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="cuti" class="form-label">Waktu Pergi</label>
                                                                    <input type="text" class="form-control" id="cuti" name="cuti" value="<?= date('H:i:s', strtotime($datacuti['waktu_pergi'])) ?>" readonly>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="masuk" class="form-label">Waktu Pulang</label>
                                                                    <input type="text" class="form-control" id="masuk" name="masuk" value="<?= date('H:i:s', strtotime($datacuti['waktu_pulang'])) ?>" readonly>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="tgl_ijin" class="form-label">Tanggal Ijin</label>
                                                                    <input type="text" class="form-control" id="tgl_ijin" name="tgl_ijin" value="<?= date('d F Y', strtotime($datacuti['tgl_ijin'])) ?>" readonly>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="keperluan" class="form-label">Keperluan</label>
                                                                    <textarea class="form-control" id="keperluan" name="keperluan" readonly><?= $datacuti['keperluan'] ?></textarea>
                                                                </div>
                                                                <input type="hidden" name="id_karyawan" value="<?= $datacuti['id'] ?>">
                                                                <div class="col-md-12">
                                                                    <label for="status" class="form-label">Status</label>
                                                                    <select name="status" id="status" class="custom-select">
                                                                        <option value="<?= $datacuti['status']; ?>"><?= $datacuti['status'] ?></option>
                                                                        <option value="Approved">Approved</option>
                                                                        <option value="Rejected">Rejected</option>
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