<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laporan Ijin Karyawan</title>
    <link href="<?= base_url() ?>assets/css/admin/cetak_laporan.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <header class="clearfix">
            <div id="logo">
                <img src="<?= base_url() ?>assets/img/admin/pn.png">
            </div>
            <div class="kopsurat">
                <span style="font-size: 18px; font-weight:bold; text-align:center">PEMERINTAH PENGADILAN NEGERI<br>KOTA SEMARANG</span>
                <span style="font-size: 15px; text-align:center">
                    <br>
                    Gedung Dinas Pengadilan Tinggi Negeri Semarang<br>Jl. Siliwangi No.512, Kota Semarang, Jawa Tengah
                </span>
            </div>
            <div id="project">
                <div><span>Tanggal Cetak</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $date; ?></div>
            </div>
        </header>
        <main>
            <table>
                <thead>
                    <tr>

                        <th class="desc">Nama</th>
                        <th class="desc">NIK</th>
                        <th class="desc">Waktu Pergi</th>
                        <th class="desc">Waktu Pulang</th>
                        <th class="desc">Keperluan</th>
                        <th class="desc">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cuti as $cuti) : ?>
                        <tr>

                            <td class="desc"><b><?= $cuti['nama'] ?></b></td>
                            <td class="desc"><b><?= $cuti['nik'] ?></b></td>
                            <td class="desc"><b><?= $cuti['waktu_pergi'] ?></b></td>
                            <td class="desc"><b><?= $cuti['waktu_pulang'] ?></b></td>
                            <td class="desc"><b><?= $cuti['keperluan'] ?></b></td>
                            <td class="desc"><b><?= $cuti['status'] ?></b></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <hr>
        </main>
        <footer>
            Created By <b>Siculi</b>
        </footer>
    </div>
</body>

</html>