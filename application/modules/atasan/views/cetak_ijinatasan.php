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
            margin-left: 30px;
            font-size: 12px;
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
            border: 0px solid #131313;
        }

        .isi td {
            border: 0px solid #131313;
            text-align: left;
            padding: 5px;
        }

        #ttd table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 0px solid #131313;

        }

        #ttd td {
            border: 0px solid #131313;
            text-align: right;
            padding: 5px;
        }

        #ttd tr {
            border: 0px solid #131313;
            text-align: right;
            padding: 5px;
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
                        <span style="font-size: 12px; font-weight:bold">No : sik / <?= $dataijin['id_ijin'] ?> / <?= $date_id ?></span>
                    </td>
                </tr>
            </table>
            <table class="text-center">
                <tr>
                    <td>
                        <div class="subjudul">
                            <span>IZIN KELUAR KANTOR</span>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="isi" style="overflow-x:auto;">
            <table>
                <tr>
                    <td>Yang bertanda tangan di bawah ini</td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><?= $atasan['nama'] ?></td>
                </tr>
                <tr>
                    <td>NIP</td>
                    <td>:</td>
                    <td><?= $atasan['nik'] ?></td>
                </tr>
                <tr>
                    <td>Selaku</td>
                    <td>:</td>
                    <td><?= $atasan['jabatan'] ?> Kelas <?= $atasan['golongan'] ?></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td>Dengan ini memberikan izin,</td>

                </tr>
                <tr>
                    <td>Kepada</td>
                    <td>:</td>
                    <td><?= $dataijin['nama'] ?></td>
                </tr>
                <tr>
                    <td>NIP</td>
                    <td>:</td>
                    <td><?= $dataijin['nik'] ?></td>
                </tr>
                <tr>
                    <td>Untuk keluar kantor pada</td>
                    <td>:</td>
                    <td>Hari, <?php
                                if ($hari_data = 'Sunday') {
                                    echo 'Minggu';
                                } elseif ($hari_data = 'Monday') {
                                    echo 'Senin';
                                } elseif ($hari_data = 'Tuesday') {
                                    echo 'Selasa';
                                } elseif ($hari_data = 'Wednesday') {
                                    echo 'Rabu';
                                } elseif ($hari_data = 'Thursday') {
                                    echo 'Kamis';
                                } elseif ($hari_data = 'Friday') {
                                    echo 'Jumat';
                                } elseif ($hari_data = 'Saturday') {
                                    echo 'Sabtu';
                                }
                                ?>, Tanggal <?= $day_data ?></td>

                </tr>
                <tr>
                    <td>Waktu</td>
                    <td>:</td>
                    <td>Pukul <?= $pergi ?> - <?= $masuk ?> WIB</td>
                </tr>
                <tr>
                    <td>Untuk keperluan</td>
                    <td>:</td>
                    <td><?= $dataijin['keperluan'] ?></td>
                </tr>
            </table>
            <br>
            <table>
                <tr>
                    <td>Demikian izin ini diberikan kepada yang bersangkutan untuk digunakan sebagaimana mestinya</td>
                </tr>
            </table>
            <br>
            <table id="ttd">
                <tr>
                    <td>Semarang, <?= $date ?></td>
                </tr>
                <tr>
                    <td>PEJABAT YANG MEMBERIKAN IJIN</td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td style="text-decoration: underline;"><?= $atasan['nama'] ?></td>
                </tr>
                <tr>
                    <td>NIP. <?= $atasan['nik'] ?>
                </tr>
            </table>
        </div>

        <!-- <br><br>
        <div style="text-align: right; float: right;">Semarang, <?= $date ?></div><br><br><br><br>
        <div style="text-align: right; float: right;"><?= $ketua['nama'] ?></div><br> -->
    </div>
</body>

</html>