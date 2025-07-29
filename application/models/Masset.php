<?php

class Masset extends CI_Model
{

    public function CreateCode()
    {
        $this->db->select('RIGHT(as_msasset.kode_asset,5) as kode_asset', FALSE);
        $this->db->order_by('kode_asset', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('as_msasset');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode_asset) + 1;
        } else {
            $kode = 1;
        }
        $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);
        $kodetampil = "BR" . $batas;
        return $kodetampil;
    }

    public function generate_pr_code()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(kode_asset,3)) AS kd_max FROM as_msasset WHERE DATE(tgl_peroleh)=CURDATE()");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%03s", $tmp);
            }
        } else {
            $kd = "001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return date('dmy') . $kd;
    }
}
