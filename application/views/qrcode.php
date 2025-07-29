<?php
include 'phpqrcode/qrlib.php';
$kode = 2323232;
$path = 'image/';
$file = $path .  $kode . ".png";
$text = "test";
QRcode::png($text, $file);
