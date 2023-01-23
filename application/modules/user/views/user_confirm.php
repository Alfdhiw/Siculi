<div class="col-md-12 mt-5">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
        </div>
        <div class="card-body">
            <div class="card text-center">
                <div class="card-body">
                    <h1 class="card-title mb-3" style="font-weight: bold; color: #5D6975;">Akses Telah Dibuka</h1>
                    <div class="col-auto">
                        <i class="fas fa-check text-success mb-3" style="font-size: 90px;"></i>
                    </div>
                    <p class="card-text">Silahkan pencet tombol dibawah ini untuk konfirmasi cuti telah berakhir</p>
                    <button type="button" class="btn btn-success mt-3" style="font-size: 20px;" data-bs-toggle="modal" data-bs-target="#confirmModal">konfirmasi Cuti</button><br><br>
                    <!-- Modal -->
                    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="<?= base_url('user/editconfirm') ?>" method="POST" enctype="multipart/form-data">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="confirmModalLabel">konfirmasi Cuti</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-left">
                                        <p>Apakah anda yakin telah menyelesaikan cuti?</p>
                                        <input type="hidden" name="status" value="Aktif">
                                        <input type="hidden" name="tgl_masuk" value="Null">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                        <button type="submit" class="btn btn-primary">Iya, Saya Yakin</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- <div class="card-footer text-muted">
                    <marquee style="margin-bottom: -5px;">SISTEM INFORMASI MAGANG DPRD JAWA TENGAH</marquee>
                </div> -->
            </div>
        </div>
    </div>
</div>