<!-- Begin Page Content -->
<div class="container-fluid">



</div>
<!-- /.container-fluid -->

<!-- Penentuan Cuti -->

<?php
// date_default_timezone_set("Asia/Bangkok");
// $date_now = date("j:m:Y");

if ($foto['status'] == 'Aktif') {
    require_once('user_aktif.php');
} elseif ($foto['status'] == 'Cuti') {
    require_once('penentuan.php');
} elseif ($foto['status'] == 'Proses') {
    require_once('user_aktif.php');
}
?>

<!-- End Penentuan Cuti -->

</div>
<!-- End of Main Content -->