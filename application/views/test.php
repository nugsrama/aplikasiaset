<?php

$tinggi_awal = 200;  // tinggi awal
$hari = 5;         // jumlah hari

// Perulangan untuk menghitung tinggi selama 5 hari
$tinggi = $tinggi_awal;
for ($i = 1; $i <= $hari; $i++) {
    $tinggi += 0.05;  // Setiap hari bertambah 5 cm
    echo "Hari $i: Tinggi = " . $tinggi . " cm<br>";
}

echo "Tinggi akhir setelah $hari hari: " . $tinggi . " cm<br>";
