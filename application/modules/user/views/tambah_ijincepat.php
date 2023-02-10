<!-- Begin Page Content -->
<div class="container-fluid">


</div>
<!-- /.container-fluid -->
<div class="col-xl-12 col-md-6 mb-6">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-6">
            <?php if ($this->session->flashdata('flash')) {
                echo '<p class="warning" style="margin: 10px 20px;">' . $this->session->flashdata('flash') . '</p>';
            } ?>
            <form action="<?= base_url('user/pengajuan_ijincepat') ?>" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="waktu_pergi" class="form-label">Waktu Pergi</label>
                    <input type="time" class="form-control" id="waktu_pergi" name="waktu_pergi">
                </div>
                <div class="mb-3">
                    <label for="keperluan" class="form-label">Keperluan</label>
                    <textarea class="form-control" name="keperluan" id="keperluan" rows="3"></textarea>
                </div>
                <input type="hidden" name="nik" value="<?= $foto['nik'] ?>">
                <input type="hidden" name="nama" value="<?= $foto['nama'] ?>">
                <input type="hidden" name="id_peserta" value="<?= $foto['id'] ?>">
                <input type="hidden" name="tgl_ijin" value="<?php
                                                            date("Y-m-d");
                                                            echo date("Y-m-d");
                                                            ?>">
                <input type="hidden" name="atasan" value="<?= $atasan['atasan'] ?>">
                <input type="hidden" name="status" value="Proses">
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<!-- End of Main Content -->