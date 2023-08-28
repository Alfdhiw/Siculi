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
                        <span style="font-size: 12px; font-weight:bold">No : sk / <?= $datacuti['id_cuti'] ?> / <?= $date_id ?></span>
                    </td>
                </tr>
            </table>
            <table class="text-center">
                <tr>
                    <td>
                        <div class="subjudul">
                            <span>FORMULIR PERMINTAAN DAN PEMBERIAN CUTI</span>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="isi" style="overflow-x:auto;">
            <table>
                <tr>
                    <td colspan="4">I. DATA PEGAWAI</td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td><?= $datacuti['nama'] ?></td>
                    <td>NIP</td>
                    <td><?= $datacuti['nik'] ?></td>
                </tr>
                <tr>
                    <td rowspan="1">Jabatan</td>
                    <td><?= $datacuti['jabatan'] ?></td>
                    <td>Masa Kerja</td>
                    <td><?= $hasil ?> Tahun <?= $hasilx ?> Bulan</td>
                </tr>
                <tr>
                    <td>Unit Kerja</td>
                    <td colspan="3"><?= $datacuti['golongan'] ?></td>
                </tr>
            </table>
            <br>
            <table>
                <tr>
                    <td colspan="4">II. JENIS CUTI YANG DIAMBIL</td>
                </tr>
                <tr>
                    <td colspan="4"><?= $datacuti['jenis_cuti'] ?></td>
                </tr>
            </table>
            <br>
            <table>
                <tr>
                    <td colspan="4">III. ALASAN CUTI</td>
                </tr>
                <tr>
                    <td colspan="4"><?= $datacuti['keperluan'] ?></td>
                </tr>
            </table>
            <br>
            <table>
                <tr>
                    <td colspan="6">IV. LAMANYA CUTI</td>
                </tr>
                <tr>
                    <td>Selama</td>
                    <td><?= $hasily ?> hari kerja</td>
                    <td>Mulai Tgl</td>
                    <td><?= date('j F Y', strtotime($datacuti['tgl_cuti'])) ?></td>
                    <td>s / d</td>
                    <td><?= date('j F Y', strtotime($datacuti['tgl_masuk'])) ?></td>
                </tr>
            </table>
            <br>
            <table>
                <tr>
                    <td colspan="3">V. CATATAN CUTI</td>
                </tr>
                <tr>
                    <td>Tahun</td>
                    <td>Sisa</td>
                    <td>Keterangan</td>
                </tr>
                <tr>
                    <td>2021</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>2022</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>2023</td>
                    <td><?= $datacuti['sisa_cuti'] ?></td>
                    <td><?= $datacuti['keterangan_sisa'] ?></td>
                </tr>

            </table>
            <br>
            <table>
                <tr>
                    <td colspan="4">VI. ALAMAT SELAMA MENJALANKAN CUTI</td>
                </tr>
                <tr>
                    <td rowspan="2"><?= $datacuti['alamat'] ?></td>
                    <td colspan="2">Telp</td>
                    <td><?= $datacuti['telp'] ?></td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center;">Hormat saya,<br><br><br><?= $datacuti['nama'] ?><br>NIP (<?= $datacuti['nik'] ?>)</td>
                </tr>
            </table>
            <br>
            <table>
                <tr>
                    <td colspan="3">VII. PERTIMBANGAN ATASAN LANGSUNG</td>
                </tr>
                <tr>
                    <td>Disetujui</td>
                    <td>Ditangguhkan</td>
                    <td>Tidak Disetujui</td>
                </tr>
                <tr>
                    <td style="text-align: center;"><?php
                                                    if ($datacuti['status'] == 'Disetujui') {
                                                        echo '<b>V</b>';
                                                    } else {
                                                        echo '';
                                                    }
                                                    ?></td>
                    <td style="text-align: center;"><?php
                                                    if ($datacuti['status'] == 'Ditangguhkan') {
                                                        echo '<b>V</b>';
                                                    } else {
                                                        echo '';
                                                    }
                                                    ?></td>
                    <td style="text-align: center;"><?php
                                                    if ($datacuti['status'] == 'Ditolak') {
                                                        echo '<b>V</b>';
                                                    } else {
                                                        echo '';
                                                    }
                                                    ?></td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center;">
                        Kepala Bagian <?= $datacuti['jabatan'] ?><br>Kelas <?= $datacuti['golongan'] ?><br><br><br><br><?= $datacuti['nama_atasan'] ?><br>NIP(<?= $datacuti['nik_atasan'] ?>)
                    </td>
                </tr>
            </table>
            <br>
            <table>
                <tr>
                    <td colspan="3">VIII. PERTIMBANGAN KETUA</td>
                </tr>
                <tr>
                    <td>Disetujui</td>
                    <td>Ditangguhkan</td>
                    <td>Tidak Disetujui</td>
                </tr>
                <tr>
                    <td style="text-align: center;"><?php
                                                    if ($datacuti['status'] == 'Disetujui') {
                                                        echo '<b>V</b>';
                                                    } else {
                                                        echo '';
                                                    }
                                                    ?></td>
                    <td style="text-align: center;"><?php
                                                    if ($datacuti['status'] == 'Ditangguhkan') {
                                                        echo '<b>V</b>';
                                                    } else {
                                                        echo '';
                                                    }
                                                    ?></td>
                    <td style="text-align: center;"><?php
                                                    if ($datacuti['status'] == 'Ditolak') {
                                                        echo '<b>V</b>';
                                                    } else {
                                                        echo '';
                                                    }
                                                    ?></td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center;">
                        <?= $ketua['jabatan'] ?> Pengadilan Negeri Semarang<br>Kelas <?= $ketua['golongan'] ?> Khusus<br><br><br><br><?= $ketua['nama'] ?><br>NIP(<?= $ketua['nik'] ?>)
                    </td>
                </tr>
            </table>
            <br>
        </div>

        <!-- <br><br>
        <div style="text-align: right; float: right;">Semarang, <?= $date ?></div><br><br><br><br>
        <div style="text-align: right; float: right;"><?= $ketua['nama'] ?></div><br> -->
    </div>
</body>

</html>