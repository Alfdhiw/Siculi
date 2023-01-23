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
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa-regular fa-pen-to-square"></i> Pengajuan Cuti Terbaru</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered dataproses" id="dataproses" width="100%" cellspacing="0">
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
                                <?php foreach ($datacuti as $datacuti) : ?>
                                    <tr>
                                        <td class="text-center"><a href="<?= base_url('kepegawaian/detail_karyawan/' . $datacuti['id_karyawan'])  ?>"><b><?= $datacuti['nik']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
                                        <td class="text-center"><b><?= $datacuti['nama']; ?></b></td>
                                        <td class="text-center"><b><?= date('j F Y', strtotime($datacuti['tgl_cuti'])) ?></b></td>
                                        <td class="text-center"><b><?= date('j F Y', strtotime($datacuti['tgl_masuk'])) ?></b></td>
                                        <td class="text-center"><b><?= $datacuti['jenis_cuti'] ?></b></td>
                                        <td class="text-center"><b><?= $datacuti['keperluan'] ?></b></td>
                                        <td class="text-center"><b><?php if ($datacuti['status'] == 'Approved') {
                                                                        echo '<span class="badge text-ligth bg-success"><span style="font-size:15px;">Approved</span></span>';
                                                                    } else if ($datacuti['status'] == 'Reject') {
                                                                        echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Reject</span></span>';
                                                                    } else {
                                                                        echo '<span class="badge bg-warning"><span style="font-size:15px;">Process</span></span>';
                                                                    }
                                                                    ?></b></td>
                                        <td class="text-center"><span><a type="button" class="badge badge-success" href="" data-toggle="modal" data-target="#editModal<?= $datacuti['id']; ?>" aria-hidden="true"><i class="fas fa-edit"></i> <span style="font-size:15px;">Edit</span></a></span></td>
                                        <!-- Modal Edit Cuti -->
                                        <div class="modal fade" id="editModal<?= $datacuti['id'] ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="editModalLabel">Edit Data</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body text-left">
                                                        <form action="<?= base_url('admin/edit_persetujuan/') . $datacuti['id']; ?>" method="POST">
                                                            <div class="row g-3">
                                                                <div class="col-md-6">
                                                                    <label for="nik" class="form-label">NIK</label>
                                                                    <input type="text" class="form-control" id="nik" name="nik" value="<?= $datacuti['nik'] ?>" readonly>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="nama" class="form-label">Nama</label>
                                                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $datacuti['nama'] ?>" readonly>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="email" class="form-label">Email</label>
                                                                    <input type="email" class="form-control" id="email" name="email" value="<?= $datacuti['email'] ?>" readonly>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="cuti" class="form-label">Tanggal Cuti</label>
                                                                    <input type="text" class="form-control" id="cuti" name="cuti" value="<?php echo date('j F Y', strtotime($datacuti['tgl_cuti'])); ?>" readonly>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="masuk" class="form-label">Tanggal Masuk</label>
                                                                    <input type="text" class="form-control" id="masuk" name="masuk" value="<?php echo date('j F Y', strtotime($datacuti['tgl_masuk'])); ?>" readonly>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="jumlah" class="form-label">Jumlah Cuti</label>
                                                                    <input type="jumlah" class="form-control" id="jumlah" name="jumlah" value="<?= $datacuti['jumlah_cuti'] ?>" readonly>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="jenis" class="form-label">Jenis Cuti</label>
                                                                    <input type="jenis" class="form-control" id="jenis" name="jenis" value="<?= $datacuti['jenis_cuti'] ?>" readonly>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="keperluan" class="form-label">Keperluan</label>
                                                                    <textarea class="form-control" id="keperluan" name="keperluan" readonly><?= $datacuti['keperluan'] ?></textarea>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="keperluan" class="form-label">Lampiran Cuti</label>
                                                                    <a type="button" class="form-control btn btn-info" href="<?= base_url('assets/data/karyawan/surat/' . $datacuti['surat']) ?>" target="_blank"><i class="fas fa-download"></i>Unduh lampiran</a>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="status" class="form-label">Status</label>
                                                                    <select name="status" id="status" class="custom-select">
                                                                        <option value="<?= $datacuti['status']; ?>"><?= $datacuti['status'] ?></option>
                                                                        <option value="Approved">Approved</option>
                                                                        <option value="Rejected">Rejected</option>
                                                                    </select>
                                                                </div>
                                                                <input type="hidden" name="status_profil" value="Cuti">
                                                                <input type="hidden" name="nik" value="<?= $datacuti['nik'] ?>">
                                                                <input type="hidden" name="tgl_masuk" value="<?= $datacuti['tgl_masuk'] ?>">
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