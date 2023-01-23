<!DOCTYPE html>

<head>
    <title>Surat Pernyataan</title>
    <meta charset="utf-8">
    <style>
        .judul {
            text-align: center;

        }

        .solid {
            margin-top: 20px;
            margin-bottom: 20px;
            border-top: 5px black solid;
            height: 0px;
            width: 570px;
            display: inline-block;
            padding-left: 30px;
            text-align: center;
        }

        .halaman {
            width: auto;
            height: auto;
            position: absolute;
            border: 1px solid;
            padding-top: 30px;
            padding-left: 30px;
            padding-right: 30px;
            padding-bottom: 80px;
        }

        .judul table {
            text-align: center;
            font-family: arial, sans-serif;
            width: 100%;

        }

        .judul img {
            width: 70px;
            text-align: center;
        }
    </style>

</head>

<body>
    <div class=halaman>
        <div class="judul">
            <table class="text-center">
                <tr>
                    <td>
                        <img src="<?= base_url() ?>assets/img/admin/pn.png">
                    </td>
                    <td>
                        <span style="font-size: 20px; font-weight:bold">Pengadilan Negeri Semarang Kelas I A Khusus</span>
                        <br> Siliwangi Nomor 512 Semarang 50148<br>Telepon 024-7616384, 7604066, 7618099 Faksimili 024-7604045 
						<br> Web: http://www.pn-semarangkota.go.id E-mail: pn.semarangkota@gmail.com
                    </td>
                </tr>
            </table>
        </div>
        <div class="solid"></div>
        <p>Saya yang bertanda tangan di bawah ini :</p>

        <table>
            <tr>
                <td style="width: 30%;">Nama</td>
                <td style="width: 5%;">:</td>
                <td style="width: 65%;"><?= $datacuti['nama'] ?></td>
            </tr>
            <tr>
                <td style="width: 30%;">NIP</td>
                <td style="width: 5%;">:</td>
                <td style="width: 65%;"><?= $datacuti['nik'] ?></td>
            </tr>
            <tr>
                <td style="width: 30%; vertical-align: top;">Alamat</td>
                <td style="width: 5%; vertical-align: top;">:</td>
                <td style="width: 65%;"><?= $datacuti['alamat'] ?></td>
            </tr>
            <tr>
                <td style="width: 30%;">Golongan</td>
                <td style="width: 5%;">:</td>
                <td style="width: 65%;"><?= $datacuti['golongan'] ?></td>
            </tr>
            <tr>
                <td style="width: 30%;">Jabatan</td>
                <td style="width: 5%;">:</td>
                <td style="width: 65%;"><?= $datacuti['jabatan'] ?></td>
            </tr>
            <tr>
                <td style="width: 30%;">Sisa Cuti</td>
                <td style="width: 5%;">:</td>
                <td style="width: 65%;"><?= $datacuti['sisa_cuti'] ?></td>
            </tr>
        </table>

        <p>Dengan ini mengajukan permohonan "<?= $datacuti['sisa_cuti'] ?>", Mulai tanggal <?= date('j F Y', strtotime($datacuti['tgl_cuti'])) ?> sampai <?= date('j F Y', strtotime($datacuti['tgl_masuk'])) ?> </p>

        <br><br>
        <div style="text-align: right; float: right;">Semarang, <?= $date ?></div><br><br><br><br>
        <div style="text-align: right; float: right;"><?= $ketua['nama'] ?></div><br>

    </div>
</body>

</html>
