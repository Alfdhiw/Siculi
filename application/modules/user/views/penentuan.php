<?php
date_default_timezone_set("Asia/Bangkok");
$date_now = date('d m y');
$tgl_masuk = date('d m y', strtotime($foto['tgl_masuk']));

if ($date_now  <  $tgl_masuk) {
    require_once('user_cuti.php');
} elseif ($date_now >= $tgl_masuk) {
    require_once('user_confirm.php');
}
