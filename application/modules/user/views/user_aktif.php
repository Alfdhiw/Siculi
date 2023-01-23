<div class="col-xl-12 col-md-6 mb-6">
    <div class="row">
        <div class="col-xl-12 col-md-6 mb-6">
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                Selamat Datang <strong><?= $session ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Sisa Cuti</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $cuti['sisa_cuti'] ?> Cuti</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Disetujui</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $approved ?> Data</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Ditolak
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $reject ?> Data</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Diproses</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $process ?> Data</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-md-12 mb-6">
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
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Tanggal Cuti</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Jenis Cuti</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($datacuti as $datacuti) : ?>
                                    <tr>
                                        <td class="text-center"><a href="<?= base_url('user/detail_karyawan/' . $datacuti['id_karyawan'])  ?>"><b><?= $datacuti['nik']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
                                        <td class="text-center"><b><?= $datacuti['nama']; ?></b></td>
                                        <td class="text-center"><b><?= date('j F Y', strtotime($datacuti['tgl_cuti'])) ?></b></td>
                                        <td class="text-center"><b><?= date('j F Y', strtotime($datacuti['tgl_masuk'])) ?></b></td>
                                        <td class="text-center"><b><?= $datacuti['jenis_cuti'] ?></b></td>
                                        <td class="text-center"><b><?php if ($datacuti['status'] == 'Approved') {
                                                                        echo '<span class="badge text-ligth bg-success"><span style="font-size:15px;">Approved</span></span>';
                                                                    } else if ($datacuti['status'] == 'Reject') {
                                                                        echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Reject</span></span>';
                                                                    } else {
                                                                        echo '<span class="badge bg-warning"><span style="font-size:15px;">Process</span></span>';
                                                                    }
                                                                    ?></b></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h1 class="h3 mb-0 text-gray-800">Syarat Cuti</h1>
    <br>
    <div class="row">
        <div class="col-sm-6">
            <div class="card ">
                <div class="card-header">
                    Cuti Tahunan
                </div>
                <div class="card-body">

                    <p class="card-text">Karyawan yang telah berkerja paling kurang 1 tahun secara terus menerus berhak mendapatkan cuti tahunan. Lamanya hak atas cuti tahunan adalah 12 hari kerja.</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    Cuti Besar
                </div>
                <div class="card-body">

                    <p class="card-text">Karyawan yang telah berkerja paling singkat 5 tahun secara terus menerus berhak atas cuti besar(terhitung mulai tanggal diangkat menjadi CPNS). Cuti besar paling lama 3 bulan.</p>
                </div>
            </div>
        </div>

    </div>
    <br>
    <div class="row">
        <div class="col-sm-6">
            <div class="card ">
                <div class="card-header">
                    Cuti Sakit
                </div>
                <div class="card-body">

                    <p class="card-text">Karyawan yang menderita sakit berhak atas cuti sakit, keryawan yang mengalami gugur kandungan berhak atas cuti sakit paling lama 1 1/2 (satu setengah) bulan.</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    Cuti Melahirkan
                </div>
                <div class="card-body">

                    <p class="card-text">Karyawan berhak atas cuti melahirkan untuk kelahiran pertama, kedua dan ketiga, Lamanya cuti melahirkan adalah 3 bulan.
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    Cuti Alasan Penting
                </div>
                <div class="card-body">

                    <p class="card-text">Cuti alasan penting ini diberikan ketika ibu, bapak, istri,
                        suami, anak, adik, kakak, mertua, atau menantu yang sedang sakit keras atau meninggal
                        dunia. lamanya cuti karena alasan penting ditentukan oleh pejabat yang berwenang memberikan cuti paling lama adalah 1 bulan.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    Cuti Bersama
                </div>
                <div class="card-body">
                    <h5 class="card-title">Cuti Bersama</h5>
                    <p class="card-text">Cuti bersama yang ditetapkan dengan keputusan Presiden maka tidak mengurangi hak cuti tahunan.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <br>
    <div class="card">
        <div class="card-header">
            Cuti di Luar Tanggungan Negara
        </div>
        <div class="card-body">
            <h5 class="card-title">Cuti di Luar Tanggungan Negara</h5>
            <p class="card-text">Karyawan yang telah berkerja paling singkat 5 tahun secara terus menerus karena alasan pribadi dan mendesak dapat diberikan cuti di luar tanggungan negara. Cuti di luar tanggungan negara dapat diberikan untuk paling lama 3 tahun dan dapat diperpanjang paling lama 1 tahun apabila ada alasan-alasan yang penting untuk memperpanjangnya.
            </p>
        </div>
    </div>
    <br>
</div>