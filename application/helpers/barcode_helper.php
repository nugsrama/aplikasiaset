<?php

// Load barcode library
require_once(APPPATH . 'third_party/php-barcode-generator/BarcodeGenerator.php');
require_once(APPPATH . 'third_party/php-barcode-generator/BarcodeGeneratorPNG.php');

// Fungsi untuk menghasilkan barcode PNG
function generate_barcode($code)
{
    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
    return base64_encode($generator->getBarcode($code, $generator::TYPE_CODE_128)); // Menggunakan barcode tipe CODE 128
}
