<?php

class User_model extends CI_Model


{
    public $kode_barang;
    private $_table = "user";

    public function insert($user)
    {
        if (!$user) {
            return;
        }

        return $this->db->insert($this->_table, $user);
    }
    public function generateKode()
    {
        // FORMAT SMA/TAHUN SEKARANG/0001
        // EX : SMA/2020/0001

        $this->db->select('RIGHT(kode_asset,4) as kodeAsset', false);
        $this->db->order_by("kodeAsset", "DESC");
        $this->db->limit(1);
        $query = $this->db->get('as_msasset');

        // SQL QUERY
        // SELECT RIGHT(kode, 4) AS kode FROM tb_siswa
        // ORDER BY kode
        // LIMIT 1

        // CEK JIKA DATA ADA
        if ($query->num_rows() <> 0) {
            $data       = $query->row(); // ambil satu baris data
            $kodeAsset  = intval($data->kodeAsset) + 1; // tambah 1
        } else {
            $kodeAsset = 1; // isi dengan 1
        }

        $lastKode = str_pad($kodeAsset, 4, "0", STR_PAD_LEFT);
        $tahun    = date("Ym");
        $SMA      = "SMA";

        $newKode  = $SMA  . $tahun . $lastKode;

        return $newKode;  // return kode baru
    }

    //menampilkan data
    public function tampil()
    {


        $data = $this->db->get('as_msasset');
        return $data->result();
    }
    public function getAsetKeluar()
    {
        $keluar = $this->db->get('as_assetkeluarheader');
        return $keluar->result();
    }
    public function getAsetMasuk()
    {
        $masuk = $this->db->get('as_assetmasukheader');
        return $masuk->result();
    }
    public function getAsetAdjust()
    {
        $data = $this->db->get('as_assetadjustmentheader');
        return $data->result();
    }
    public function getAsetWriteoff()
    {
        $data = $this->db->get('as_assetwriteoffheader1');
        return $data->result();
    }
    function input_data($data, $table)
    {
        $this->db->insert($table, $data);
    }
    function input_write($data, $table)
    {
        $this->db->insert($table, $data);
    }


    function edit_data($where, $table)
    {
        return $this->db->get_where($table, $where);
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

    function registrasi($data)
    {
        $this->db->insert('users', $data);
    }
    function getDataUser($username)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        return $query->row();
    }

    function getLoginUser($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('users');
        return $query->row();
    }
    function get_status($status)
    {
        $this->db->where('status_masuk', $status);

        $query = $this->db->get('as_assetmasukheader');
        return $query->row();
    }


    public function delete($id)
    {
        $result = $this->db->delete('as_msasset', array('id' => $id));
        return $result;
    }

    public function deletemasuk($id)
    {
        $result = $this->db->delete('as_assetmasukheader', array('id' => $id));
        return $result;
    }
    public function deletekeluar($id)
    {
        $result = $this->db->delete('as_assetkeluarheader', array('id' => $id));
        return $result;
    }
    public function deleteadjustment($id)
    {
        $result = $this->db->delete('as_assetadjusmentheader', array('id' => $id));
        return $result;
    }
    public function deletewriteoff($id)
    {
        $result = $this->db->delete('as_assetwriteoffheader', array('id' => $id));
        return $result;
    }

    function getkodeasset()
    {
        $tahun = date('Y');
        $gettable = $this->db->query("SELECT kode_asset FROM `as_msasset` where substr(kode_asset, 2,4)  = '$tahun' order by id desc limit 1 ")->result();

        if (empty($gettable)) {
            $new = 1;
            $next = sprintf("%05s", $new);
        } else {
            $new = substr($gettable[0]->kode_asset, -5);
            $format = (int)$new;
            $next = sprintf("%05s", $format + 1);
        }
        $code = 'A' . $tahun . '00' . 'XXXXXX' . $next;
        return $code;
    }

    function getDataMasterDetail($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('as_msasset');
        return $query->row();
    }

    function editMaster($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('as_msasset', $data);
    }


    function getDataMasukDetail($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('as_assetmasukheader');
        return $query->row();
    }

    function editMasuk($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('as_assetmasukheader', $data);
    }

    function editKeluar($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('as_assetkeluarheader', $data);
    }
    function getDataKeluarDetail($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('as_assetkeluarheader');
        return $query->row();
    }
    function editAdjustment($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('as_assetadjustmentheader', $data);
    }

    function getDataAdjustmentDetail($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('as_assetadjustmentheader');
        return $query->row();
    }
    function editWriteoff($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('as_assetwriteoffheader1', $data);
    }
    function getDataWriteoffDetail($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('as_assetwriteoffheader1');
        return $query->row();
    }





    function detailmasuk($id, $data)
    {
        $this->db->where('id', $id);

        $this->db->get('as_assetmasukheader', $data);
    }


    function getidmasuk($kode_masuk)
    {


        $this->db->select('*');
        $this->db->from('as_assetmasukheader');
        if ($kode_masuk != null) {
            $this->db->where('$kode_masuk', $kode_masuk);
        }
        $query = $this->db->get();
        return $query;
    }

    function get_kode_asset($kode_asset)
    {
        $this->db->select('*');
        $this->db->from('as_msasset');
        if ($kode_asset != null) {
            $this->db->where('$kode_asset', $kode_asset);
        }
        $query = $this->db->get();
        return $query;
    }
    function query_validasi_username($username)
    {
        $result = $this->db->query("SELECT * FROM users WHERE username='$username'");
        return $result;
    }
    function cek_status($status)
    {
        $result = $this->db->query("SELECT * FROM as_closingbulananho WHERE status_masuk='$status'");
        return $result;
    }

    function query_validasi_password($password)
    {
        $result = $this->db->query("SELECT * FROM users WHERE password='$password'");
        return $result;
    }
    function getkodemasuk()
    {
        $tahun = date('ym');
        $gettable = $this->db->query("SELECT kode_masuk FROM `as_assetmasukheader` where substr(kode_masuk, 3,4)  = '$tahun'  order by id desc limit 1 ")->result();

        if (empty($gettable)) {

            $new = 1;

            $next = sprintf("%03s", $new);
        } else {
            $new = substr($gettable[0]->kode_masuk, -3);
            $format = (int)$new;

            $next = sprintf("%03s", $format + 1);
        }
        $code = 'IN' . $tahun . $next;
        return $code;
    }
    function getkodekeluar()
    {
        $tahun = date('ym');
        $gettable = $this->db->query("SELECT kode_keluar FROM `as_assetkeluarheader` where substr(kode_keluar, 3,4)  = '$tahun'  order by id desc limit 1 ")->result();

        if (empty($gettable)) {

            $new = 1;

            $next = sprintf("%03s", $new);
        } else {
            $new = substr($gettable[0]->kode_keluar, -3);
            $format = (int)$new;

            $next = sprintf("%03s", $format + 1);
        }
        $code = 'OT' . $tahun . $next;
        return $code;
    }


    function getkodeadjustment()
    {
        $tahun =  date('ym');
        $gettable = $this->db->query("SELECT kode_adjustment FROM `as_assetadjustmentheader` where substr(kode_adjustment, 3,4)  = '$tahun'  order by id desc limit 1 ")->result();

        if (empty($gettable)) {

            $new = 1;

            $next = sprintf("03s", $new);
        } else {
            $new = substr($gettable[0]->kode_adjustment, -3);
            $format = (int)$new;
            $next = sprintf("%03s", $format + 1);
        }
        $code =     'AD'  . $tahun  . $next;
        return $code;
    }
    function getkodewriteoff()
    {
        $tahun = date('ym');
        $gettable = $this->db->query("SELECT kode_writeoff FROM `as_assetwriteoffheader1` where substr(kode_writeoff, 3,4)  = '$tahun'  order by id desc limit 1 ")->result();

        if (empty($gettable)) {

            $new = 1;

            $next = sprintf("%03s", $new);
        } else {
            $new = substr($gettable[0]->kode_writeoff, -3);
            $format = (int)$new;

            $next = sprintf("%03s", $format + 1);
        }
        $code = 'WO' . $tahun . $next;
        return $code;
    }



    function editAssetMasukDetail($kode_masuk, $data)
    {
        $this->db->where('kode_masuk', $kode_masuk);
        $this->db->update('as_assetmasukdetail', $data);
    }
    function editAssetKeluarDetail($kode_keluar, $data)
    {
        $this->db->where('kode_keluar', $kode_keluar);
        $this->db->update('as_assetkeluardetail', $data);
    }
    function editAssetAdjustmentDetail($kode_adjustment, $data)
    {
        $this->db->where('kode_adjustment', $kode_adjustment);
        $this->db->update('as_assetadjustmentdetail', $data);
    }
    function editAssetWriteoffDetail($kode_writeoff, $data)
    {
        $this->db->where('kode_writeoff', $kode_writeoff);
        $this->db->update('as_assetwriteoffdetail', $data);
    }




    public function get_masuk_data($kode_masuk)
    {
        $this->db->from('as_assetmasukheader');
        $query = $this->db->query("SELECT * FROM as_assetmasukheader a JOIN as_assetmasukdetail b ON a.kode_masuk = b.kode_masuk WHERE a.kode_masuk = '$kode_masuk'");
        $this->db->where('as_assetmasukheader.kode_masuk', $kode_masuk);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        // $query = $this->db->query("SELECT * FROM as_assetmasukheader a JOIN as_assetmasukdetail b ON a.kode_masuk = b.kode_masuk WHERE a.kode_masuk = '$kode_masuk'");
        return $query->result();
    }
    public function get_keluar_data($kode_keluar)
    {
        $this->db->from('as_assetkeluarheader');
        $query = $this->db->query("SELECT * FROM as_assetkeluarheader a JOIN as_assetkeluardetail b ON a.kode_keluar = b.kode_keluar WHERE a.kode_keluar = '$kode_keluar'");
        $this->db->where('as_assetkeluarheader.kode_keluar', $kode_keluar);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        // $query = $this->db->query("SELECT * FROM as_assetmasukheader a JOIN as_assetmasukdetail b ON a.kode_masuk = b.kode_masuk WHERE a.kode_masuk = '$kode_masuk'");
        return $query->result();
    }
    public function get_adjustment_data($kode_adjustment)
    {
        $this->db->from('as_assetadjustmentheader');
        $query = $this->db->query("SELECT * FROM as_assetadjustmentheader a JOIN as_assetadjustmentdetail b ON a.kode_adjustment = b.kode_adjustment WHERE a.kode_adjustment = '$kode_adjustment'");
        $this->db->where('as_assetadjustmentheader.kode_adjustment', $kode_adjustment);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        // $query = $this->db->query("SELECT * FROM as_assetmasukheader a JOIN as_assetmasukdetail b ON a.kode_masuk = b.kode_masuk WHERE a.kode_masuk = '$kode_masuk'");
        return $query->result();
    }
    public function get_writeoff_data($kode_writeoff)
    {
        $this->db->from('as_assetwriteoffheader');
        $query = $this->db->query("SELECT * FROM as_assetwriteoffheader a JOIN as_assetwriteoffdetail b ON a.kode_writeoff = b.kode_writeoff WHERE a.kode_writeoff = '$kode_writeoff'");
        $this->db->where('as_assetwriteoffheader.kode_writeoff', $kode_writeoff);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        // $query = $this->db->query("SELECT * FROM as_assetmasukheader a JOIN as_assetmasukdetail b ON a.kode_masuk = b.kode_masuk WHERE a.kode_masuk = '$kode_masuk'");
        return $query->result();
    }
    public function cekstock()
    {
        // $this->db->from('as_msasset');
        // $query = $this->db->query("SELECT * FROM as_msasset a  JOIN  cekstock b ON a.kode_asset = b.kode_asset  WHERE a.kode_asset = '$kode_asset'");
        // $this->db->where('as_msasset.kode_asset', $kode_asset);
        // $this->db->order_by('id', 'desc');
        $query = $this->db->get('cekstock');
        // $query = $this->db->query("SELECT * FROM as_assetmasukheader a JOIN as_assetmasukdetail b ON a.kode_masuk = b.kode_masuk WHERE a.kode_masuk = '$kode_masuk'");
        return $query->result();
    }

    public function closing()
    {
        $query = $this->db->get('as_closingbulananho');
        return $query->result();
    }





    function getDataAssetMasukDetail($kode_masuk)
    {
        $this->db->where('kode_masuk', $kode_masuk);
        $query = $this->db->get('as_assetmasukdetail');
        return $query->row();
    }
    function getDataAssetKeluarDetail($kode_keluar)
    {
        $this->db->where('kode_keluar', $kode_keluar);
        $query = $this->db->get('as_assetkeluardetail');
        return $query->row();
    }
    function getDataAssetAdjustmentDetail($kode_adjustment)
    {
        $this->db->where('kode_adjustment', $kode_adjustment);
        $query = $this->db->get('as_assetadjustmentdetail');
        return $query->row();
    }
    function getDataAssetWriteoffDetail($kode_writeoff)
    {
        $this->db->where('kode_writeoff', $kode_writeoff);
        $query = $this->db->get('as_assetwriteoffdetail');
        return $query->row();
    }


    function qr($kodeqr)
    {
        if ($kodeqr) {
            $filename = 'qr/' . $kodeqr;
            if (!file_exists($filename)) {
                $this->load->library('ciqrcode');
                $params['data'] = $kodeqr;
                $params['level'] = 'H';
                $params['size'] = 10;
                $params['savename'] = FCPATH . 'qr/' . $kodeqr . ".png";
                return  $this->ciqrcode->generate($params);
            }
        }
    }

    function detailassetmasuk($kode_masuk)
    {

        $data = $this->db->query(" SELECT * FROM as_assetmasukdetail WHERE kode_masuk = '$kode_masuk'");
        return $data->result();
    }
    function detailassetkeluar($kode_keluar)
    {
        $data = $this->db->query(" SELECT * FROM as_assetkeluardetail WHERE kode_keluar = '$kode_keluar'");
        return $data->result();
    }
    function detailadjustment($kode_adjustment)
    {
        $data = $this->db->query(" SELECT * FROM as_assetadjustmentdetail WHERE kode_adjustment = '$kode_adjustment'");
        return $data->result();
    }
    function detailwriteoff($kode_writeoff)
    {
        $data = $this->db->query(" SELECT * FROM as_assetwriteoffdetail WHERE kode_writeoff = '$kode_writeoff'");
        return $data->result();
    }

    public function JumlahMasuk()
    {
        $query = $this->db->get('as_assetmasukheader');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
    public function JumlahKeluar()
    {
        $query = $this->db->get('as_assetkeluarheader');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }


    function get_data_master_by_code($kode_asset)
    {
        return $this->db->query("SELECT  nama_asset  , hrg_peroleh  FROM `as_msasset`WHERE kode_asset = '$kode_asset'")->result();
        // $this->db->select('kode_asset, (SUM(sisa) + SUM(masuk) - SUM(keluar)) AS sisastock');
        // $this->db->from('cekstock');
        // $this->db->where('kode_asset', $kode_asset);
        // $this->db->group_by('kode_asset');
        // $this->db->get();
    }

    function get_data_cekstock($kode_asset)
    {
        return $this->db->query("SELECT nama_asset , harga_satuan ,sisa FROM cekstock WHERE kode_asset = '$kode_asset'")->result();
    }

    function get_data_detail_masuk($dept_penerima)
    {
        return $this->db->query("SELECT  dept_penerima FROM `as_assetmasukheader` WHERE dept_penerima  ='$dept_penerima' ")->result();
    }
    function get_data_kode_masuk($kode_masuk)
    {
        return $this->db->query("SELECT  kode_masuk FROM `as_assetmasukdetail` WHERE kode_masuk  ='$kode_masuk' ")->result();
    }



    function update($table, $data, $where)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function getkodeassetdetailmasuk($kode_asset)
    {
        $this->db->where('kode_asset', $kode_asset);
        $query = $this->db->get('as_assetmasukdetail');
        return $query->row();
    }

    function summasukdetail($kode_masuk)
    {
        $query = $this->db->query("SELECT SUM(qty) AS qty , SUM(harga_total) AS hargatotal from as_assetmasukdetail WHERE kode_masuk = '$kode_masuk' ");
        return  $query->result();
    }
    function sumkeluardetail($kode_keluar)
    {
        $query = $this->db->query("SELECT SUM(qty) AS qty , SUM(harga_total) AS hargatotal from as_assetkeluardetail WHERE kode_keluar = '$kode_keluar' ");

        // $this->db->select('(SUM(sisa) + SUM(masuk) - SUM(keluar)) AS sisastock');
        // $this->db->from('cekstock');
        // $this->db->where('kode_asset', $kode_asset);
        // $this->db->group_by('kode_asset');
        // $query = $this->db->get();
        return  $query->result();
    }
    function sumadjustmentdetail($kode_adjustment)

    {
        $query = $this->db->query("SELECT SUM(qty) AS qty , SUM(harga_total) AS hargatotal from as_assetadjustmentdetail WHERE kode_adjustment = '$kode_adjustment' ");
        return  $query->result();
    }

    function sumwriteoffdetail($kode_writeoff)
    {
        $query = $this->db->query("SELECT SUM(qty) AS qty , SUM(harga_total) AS hargatotal from as_assetwriteoffdetail WHERE kode_writeoff = '$kode_writeoff' ");
        return  $query->result();
    }
    function sumcekstock()
    {
        $query = $this->db->query("SELECT kode_asset, (SUM(sisa) + SUM(masuk)) - SUM(keluar)  AS sisastock  from cekstock GROUP BY kode_asset ");
        return $query->result();
    }


    public function get_asset_stock()
    {
        $this->db->select('kode_asset, (SUM(masuk) + SUM(sisa)) - SUM(keluar) as sisastock');
        $this->db->from('cekstock');
        $this->db->group_by('kode_asset');
        $query = $this->db->get();
        return $query->result(); // Mengembalikan hasil query sebagai array objek
    }
    public function getstatus()
    {
        $this->db->query("DELETE FROM cekstock WHERE jenis_transaksi='AWL'");
    }

    public function periodenext()
    {
        $periodenext = date('Y-m-01', strtotime(' + 1 months'));
        $this->db->query("DELETE FROM cekstock WHERE tgl_stock >= $periodenext");
    }
    public function status($status)
    {
        $this->db->where('status_masuk', $status);
        $query = $this->db->get('as_closingbulananho');
        return $query->row();
    }
}
