
<?php

function kodeOtomatis()
{
    $ci = get_instance();
    $query = "SELECT max(kode_asset) as maxKode FROM as_msasset ";
    $data = $ci->db->query($query)->row_array();
    $kode = $data['maxKode'];
    $noUrut = (int) substr($kode, 4, 5);
    $noUrut++;
    $char = "INVF";
    $kodeBaru = $char . sprintf("%05s", $noUrut);
    return $kodeBaru;
}
