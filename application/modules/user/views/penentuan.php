<?php
date_default_timezone_set("Asia/Bangkok");
$date_now = date('y m d');
$tgl_masuk = date('y m d', strtotime($foto['tgl_masuk']));

if ($date_now  <  $tgl_masuk) {
    require_once('user_cuti.php');
} elseif ($date_now >= $tgl_masuk) {
    require_once('user_confirm.php');
}
