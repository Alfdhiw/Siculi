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
            <form action="<?= base_url('user/pengajuan_cuti') ?>" method="POST" enctype="multipart/form-data" id="form1">
                <div class="mb-3">
                    <label for="jenis_cuti" class="form-label">Jenis Cuti</label>
                    <select name="jenis_cuti" id="jenis" class="form-select" onchange="jenis_cuti()">
                        <option selected disabled>- Pilih -</option>
                        <?php foreach ($jeniscuti as $jc) : ?>
                            <option value="<?= $jc['jenis']; ?>"><?= $jc['jenis']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="sisa_cuti" class="form-label">Sisa Cuti Tahun Ini</label>
                    <input type="number" class="form-control" id="sisa_cuti" name="sisa_cuti">
                </div>
                <div class="mb-3">
                    <label for="keterangan_sisa" class="form-label">Keterangan Sisa Cuti &ensp; <b>(Optional)</b></label>
                    <textarea class="form-control" id="keterangan_sisa" name="keterangan_sisa"></textarea>
                </div>
                <div class="mb-3">
                    <label for="tgl_cuti" class="form-label">Tanggal Cuti</label>
                    <input type="date" class="form-control" id="tgl_cuti" name="tgl_cuti">
                </div>
                <div class="mb-3">
                    <label for="tgl_masuk" class="form-label">Tanggal Masuk</label>
                    <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk">
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat Selama Menjalankan Cuti</label>
                    <textarea class="form-control" name="alamat" id="alamat" rows="2"></textarea>
                </div>
                <div class="mb-3">
                    <label for="keperluan" class="form-label">Keperluan</label>
                    <textarea class="form-control" name="keperluan" id="keperluan" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="surat" class="form-label">Lampiran Cuti</label>
                    <input class="form-control" type="file" id="surat" name="surat" onchange="validateFilePdf()">
                    <div class="form-text text-danger">Lampiran Hanya Untuk Cuti Sakit & Cuti Besar</div>
                </div>
                <input type="hidden" name="id_karyawan" value="<?= $userid ?>">
                <input type="hidden" name="atasan" value="<?= $user['atasan'] ?>">
                <input type="hidden" name="sisa" value="<?= $user['sisa_cuti'] ?>">
                <input type="hidden" name="proses" value="Proses">
                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                <input type="hidden" name="status" value="Proses">
                <input type="hidden" name="date" value="<?php
                                                        date("Y-m-d");
                                                        echo date("Y-m-d");
                                                        ?>">
                <?php
                if ($user['sisa_cuti'] == 0) {
                    echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#submitModal" >Submit</button>
                    <!-- Submit Modal -->
                <div class="modal fade" id="submitModal" tabindex="-1" aria-labelledby="submitModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="submitModalLabel">Perhatian !</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Sisa Cuti Anda Telah Habis Silahkan Hubungi Kepegawaian
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Oke</button>
                            </div>
                        </div>
                    </div>
                </div>';
                } else {
                    echo '<button type="submit" class="btn btn-primary">Submit</button>';
                }
                ?>
            </form>
        </div>
    </div>
</div>

<!-- <script>
    function say_hi() {
        var fname = document.getElementById('jenis').value;

        var html = fname;

        document.getElementById('jenis_cuti').innerHTML = html;
    }

    document.getElementById('jenis').addEventListener('change', say_hi);
</script> -->

<script>
    /* javascript function to validate file type */
    function validateFilePdf() {
        var inputElement = document.getElementById('surat');
        var files = inputElement.files;
        if (files.length > 0) {
            var filename = files[0].name;

            /* getting file extenstion eg- .jpg,.png, etc */
            var extension = filename.substr(filename.lastIndexOf("."));

            /* define allowed file types */
            var allowedExtensionsRegx = /(\.pdf)$/i;

            /* testing extension with regular expression */
            var isAllowed = allowedExtensionsRegx.test(extension);

            if (isAllowed) {

            } else {
                Swal.fire({
                    title: 'Invalid File',
                    text: "Gunakan Ekstensi PDF",
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonColor: '#57c077',
                    confirmButtonText: 'Oke'
                })
            }
        }
    }
</script>