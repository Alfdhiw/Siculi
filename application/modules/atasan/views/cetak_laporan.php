<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laporan Cuti</title>
    <link href="<?= base_url() ?>assets/css/admin/cetak_laporan.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <header class="clearfix">
            <div id="logo">
                <img src="<?= base_url() ?>assets/img/admin/pn.png">
            </div>
            <div class="kopsurat">
                <span style="font-size: 18px; font-weight:bold; text-align:center">Pengadilan Negeri Semarang Kelas I A Khusus</span>
                <span style="font-size: 15px; text-align:center">
                    <br>
                    Siliwangi Nomor 512 Semarang 50148<br>Telepon 024-7616384, 7604066, 7618099 Faksimili 024-7604045 
					<br> Web: http://www.pn-semarangkota.go.id E-mail: pn.semarangkota@gmail.com
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
                        <th class="desc">NIP</th>
                        <th class="desc">Sisa Cuti</th>
                        <th class="desc">Jenis Cuti</th>
                        <th class="desc">Tanggal Cuti</th>
                        <th class="desc">Tanggal Masuk</th>
                        <th class="desc">Keperluan</th>
                        <th class="desc">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cuti as $cuti) : ?>
                        <tr>

                            <td class="desc"><b><?= $cuti['nama'] ?></b></td>
                            <td class="desc"><b><?= $cuti['nik'] ?></b></td>
                            <td class="desc"><b><?= $cuti['jumlah_cuti'] ?></b></td>
                            <td class="desc"><b><?= $cuti['jenis_cuti'] ?></b></td>
                            <td class="desc"><b><?= $cuti['tgl_cuti'] ?></b></td>
                            <td class="desc"><b><?= $cuti['tgl_masuk'] ?></b></td>
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
