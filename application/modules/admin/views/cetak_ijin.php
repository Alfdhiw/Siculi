<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laporan Ijin Karyawan</title>
    <link href="<?= base_url() ?>assets/css/admin/cetak_custom.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <header class="clearfix">
            <div id="logo">
                <img src="<?= base_url() ?>assets/img/admin/pn.png">
            </div>
            <h1>Laporan Ijin Karyawan</h1>
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
                    <?php foreach ($ijin as $ijin) : ?>
                        <tr>

                            <td class="desc"><b><?= $ijin['nama'] ?></b></td>
                            <td class="desc"><b><?= $ijin['nik'] ?></b></td>
                            <td class="desc"><b><?= $ijin['waktu_pergi'] ?></b></td>
                            <td class="desc"><b><?= $ijin['waktu_pulang'] ?></b></td>
                            <td class="desc"><b><?= $ijin['keperluan'] ?></b></td>
                            <td class="desc"><b><?= $ijin['status'] ?></b></td>
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