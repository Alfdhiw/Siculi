<!DOCTYPE html>

<head>
    <title>Surat Laporan</title>
    <meta charset="utf-8">
    <style>
        .judul {
            text-align: center;

        }

        .solid {
            margin-top: 20px;
            margin-bottom: 5px;
            border-top: 5px black solid;
            height: 0px;
            width: 570px;
            display: inline-block;
            padding-left: 30px;
            text-align: center;
        }

        .subjudul {
            margin-top: 20px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }

        .halaman {
            width: auto;
            height: auto;
            position: absolute;
            border: 1px solid;
            padding-top: 20px;
            padding-left: 20px;
            padding-right: 20px;
            margin-left: 20px;
            font-size: 11px;
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

        .isi table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #131313;
        }

        .isi td {
            border: 1px solid #131313;
            text-align: left;
            font-size: 11px;
            text-align: center;
            padding: 5px;
        }

        .isi th {
            border: 1px solid #131313;
            color: #dddddd;
            font-size: 12px;
            text-align: center;
            padding: 5px;
            background-color: #6C6C6C;
        }

        .isi tr:nth-child(even) {
            background-color: #dddddd;
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
            <table class="text-center">
                <tr>
                    <td>
                        <div class="solid"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span style="font-size: 12px; font-weight:bold">No : slp / <?= $date_id ?></span>
                    </td>
                </tr>
            </table>
            <table class="text-center" style="overflow-x:auto;">
                <tr>
                    <td>
                        <div class="subjudul">
                            <span>LAPORAN REKAP DATA CUTI</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><b>Periode : <?= $from ?> - <?= $to ?></b></td>
                </tr>
            </table>
        </div>
        <br>
        <div class="isi" style="overflow-x:auto;">
            <table>
                <tr>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Tanggal Cuti</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Upload</th>
                    <th>Keperluan</th>
                    <th>Jenis Cuti</th>
                    <th>Sisa Cuti</th>
                    <th>Status</th>
                </tr>

                <?php foreach ($datacuti as $datacuti) : ?>
                    <tr>

                        <td class="desc"><b><?= $datacuti['nik'] ?></b></td>
                        <td class="desc"><b><?= $datacuti['nama'] ?></b></td>
                        <td class="desc"><b><?= $datacuti['tgl_cuti'] ?></b></td>
                        <td class="desc"><b><?= $datacuti['tgl_masuk'] ?></b></td>
                        <td class="desc"><b><?= $datacuti['tgl_upload'] ?></b></td>
                        <td class="desc"><b><?= $datacuti['keperluan'] ?></b></td>
                        <td class="desc"><b><?= $datacuti['jenis_cuti'] ?></b></td>
                        <td class="desc"><b><?= $datacuti['jumlah_cuti'] ?></b></td>
                        <td class="desc"><b><?= $datacuti['status'] ?></b></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <br>
        </div>
    </div>
</body>

</html>