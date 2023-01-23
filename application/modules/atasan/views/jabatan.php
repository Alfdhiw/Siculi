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
            <a type="button" class="btn btn-primary rounded mb-4" data-toggle="modal" data-target="#penyeliaModal"><i class="fas fa-solid fa-plus"></i> Tambah Jabatan</a>
            <!-- Modal Penyelia-->
            <div class="modal fade" id="penyeliaModal" tabindex="-1" aria-labelledby="penyeliaModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="penyeliaModalLabel">Tambah Jabatan Baru</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('admin/tambah_jabatan') ?>" method="POST">
                            <div class="modal-body">
                                <div class="form-row md-2">
                                    <div class="col-12 form-group">
                                        <input type="text" class="form-control" placeholder="Nama Jabatan" id="jabatan" name="jabatan" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
                                    <th>#</th>
                                    <th>Jabatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($jabatan as $jabatan) : ?>
                                    <tr>
                                        <td class="text-center"><b>#</b></td>
                                        <td class="text-center"><b><?= $jabatan['jabatan']; ?></b></td>
                                        <td class="text-center">
                                            <span><a type="button" class="badge badge-success" href="" data-bs-toggle="modal" data-bs-target="#editModal<?= $jabatan['id'] ?>"><i class="fa-solid fa-pen-to-square"></i> <span style="font-size:15px;">Edit</span></a></span>

                                            <!-- Modal Edit Karyawan -->
                                            <div class="modal fade" id="editModal<?= $jabatan['id'] ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="editModalLabel">Edit Data</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body text-left">
                                                            <form action="<?= base_url('admin/edit_jabatan/') . $jabatan['id']; ?>" method="POST">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <label for="jabatan" class="form-label">Jabatan</label>
                                                                        <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= $jabatan['jabatan'] ?>">
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
                                            <span><a type="button" class="badge badge-danger" href="" data-toggle="modal" data-target="#hapusModal<?= $jabatan['id']; ?>"><i class="fa-solid fa-trash"></i> <span style="font-size:15px;">Hapus</span></a></span>

                                            <!-- Modal Hapus Karyawan -->
                                            <div class="modal fade" id="hapusModal<?= $jabatan['id'] ?>" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
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
                                                            <a type="button" class="btn btn-primary" href="<?= base_url('admin/delete_jabatan/' . $jabatan['id']) ?>">Iya, Saya Yakin</a>
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