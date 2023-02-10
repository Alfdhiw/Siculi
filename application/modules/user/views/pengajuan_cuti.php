<!-- Begin Page Content -->
<div class="container-fluid">


</div>
<!-- /.container-fluid -->
<?php

if ($foto['status'] == 'Aktif') {
    require_once('ijin_aktif.php');
} elseif ($foto['status'] == 'Cuti') {
    require_once('ijin_cuti.php');
} elseif ($foto['status'] == 'Proses') {
    require_once('ijin_proses.php');
}
?>

</div>
<!-- End of Main Content -->