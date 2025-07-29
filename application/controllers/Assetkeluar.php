<?php

use PhpParser\Node\Expr\PostDec;

defined('BASEPATH') or exit('No direct script access allowed');

class Assetkeluar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Masset');
        $this->load->model('User_model');
        if (!$_SESSION['logged']) {
            // Redirect ke halaman login
            header('Location: login');
            exit;
        }
    }
    public function asetkeluar()
    {
        $data = $this->User_model->getAsetKeluar();
        $DATA = array('data' => $data);
        $this->load->view('assetkeluar.php', $DATA);
        $this->load->view('layouts/sidebar');
    }
    public function tambahassetkeluar()
    {
        $this->load->view('tambahassetkeluar.php');
        $this->load->view('layouts/sidebar');
    }
    public function tambahdatakeluar()
    {

        $tanggal = $this->input->post('tgl_keluar');
        $pengirim = $this->input->post('dept_pengirim');
        $penerima = $this->input->post('dept_penerima');
        $nomor = $this->input->post('no_po');
        // $totalqty = $this->input->post('total_qty');
        // $totalharga = $this->input->post('total_harga');
        $keterangan = $this->input->post('keterangan');
        // $status = $this->input->post('status_keluar');
        // $user_realisasi = $this->input->post('user_realisasi');
        // $tanggalrealisasi = $this->input->post('tgl_realisasi');

        $userinput = $this->session->userdata('id');
        $data = array(
            'kode_keluar' => $this->User_model->getkodekeluar(),
            'tgl_keluar' => $tanggal,
            'keterangan' => $keterangan,
            'dept_pengirim' =>  strtoupper($pengirim),
            'dept_penerima' =>  strtoupper($penerima),
            'no_po' =>  strtoupper($nomor),
            'user_input' => $userinput,
            'tgl_input' => date('Y-m-d H:i:s'),
            // 'total_qty' => $totalqty,
            // 'total_harga' => $totalharga,
            // 'keterangan' => $keterangan,
            // 'status_keluar' => $status,
            // 'user_realisasi' => $user_realisasi,
            // 'tgl_realisasi' => $tanggalrealisasi,
            // 'user_input' => $userinput,
            // 'tgl_input' => $tanggalinput,
        );
        $this->User_model->input_data($data, 'as_assetkeluarheader');
        redirect('assetkeluar/asetkeluar');
    }
    public function editKeluar($id)
    {
        $keluarDetail = $this->User_model->getDataKeluarDetail($id);
        $DATA = array('keluarDetail' => $keluarDetail);
        $this->load->view('editkeluar', $DATA);
        $this->load->view('layouts/sidebar');
    }

    function deletekeluar($kode_keluar)
    {
        $this->db->where('kode_keluar', $kode_keluar);
        $this->db->delete('as_assetkeluarheader');
        redirect('assetkeluar');
    }

    public function fungsiKeluar()
    {
        $id = $this->input->post('id');

        $tanggal = $this->input->post('tgl_keluar');
        $pengirim = $this->input->post('dept_pengirim');
        $penerima = $this->input->post('dept_penerima');
        $keterangan = $this->input->post('keterangan');
        $nopo = $this->input->post('no_po');
        $totalqty = $this->input->post('total_qty');



        $updateKeluar = array(
            'id' => $id,
            'total_Qty' => $totalqty,
            'tgl_keluar' => $tanggal,
            'keterangan' => $keterangan,
            'no_po' => $nopo,
            'dept_pengirim' => strtoupper($pengirim),
            'dept_penerima' => strtoupper($penerima),


        );
        $this->User_model->editKeluar($id, $updateKeluar);

        redirect(base_url('Assetkeluar/asetkeluar'));
    }



    public function detailassetkeluar()
    {
        $kode_keluar = $this->uri->segment(3);
        $data = $this->User_model->detailassetkeluar($kode_keluar);
        $DATA = array('data' => $data);
        $this->load->view('detailassetkeluar.php', $DATA);
        $this->load->view('layouts/sidebar');
    }
    public function editdetailkeluar($kode_keluar)
    {
        $keluarDetail = $this->User_model->getDataAssetKeluarDetail($kode_keluar);
        $DATA = array('keluarDetail' => $keluarDetail);
        $this->load->view('editdetailkeluar', $DATA);
        $this->load->view('layouts/sidebar');
    }

    public function tambahdetailkeluar()
    {
        $kode_keluar = $this->input->post('kode_keluar');
        $kode_asset = $this->input->post('kode_asset');

        $msasset = $this->User_model->get_data_cekstock($kode_asset);
        $nama_asset = $msasset[0]->nama_asset;

        $qty = $this->input->post('qty');
        $hargasatuan = $msasset[0]->harga_satuan;

        $this->db->where('kode_asset', $kode_asset);
        $this->db->where('kode_keluar', $kode_keluar);
        $query = $this->db->get('as_assetkeluardetail');

        if ($query->num_rows() > 0) {
            $detail = $query->result();
            $data = array(
                'qty' => $detail[0]->qty + $qty,
                'harga_total' => ($detail[0]->qty + $qty) * $hargasatuan,
            );
            $where = array(
                'kode_keluar' => $kode_keluar,
                'kode_asset' => $kode_asset,

            );
            // };
            $this->User_model->update('as_assetkeluardetail', $data, $where);
        } else {

            $data = array(
                'kode_keluar' => $kode_keluar,
                'kode_asset' => $kode_asset,
                'nama_asset' => $nama_asset,
                'qty' => $qty,

                'harga_satuan' => $hargasatuan,
                'harga_total' => $hargasatuan * $qty,
                'user_input' => $this->session->userdata('id'),
                'tgl_input' => date('Y-m-d H:i:s'),
            );
            $this->User_model->input_data($data, 'as_assetkeluardetail');
        }
        $sumdetail = $this->User_model->sumkeluardetail($kode_keluar);

        $data = array(
            'total_qty' => $sumdetail[0]->qty,
            'total_harga' => $sumdetail[0]->hargatotal,

        );
        $where = array(
            'kode_keluar' => $kode_keluar,

        );
        // };
        $this->User_model->update('as_assetkeluarheader', $data, $where);
        redirect('assetkeluar/detailassetkeluar/' . $kode_keluar);
    }
    public function tambahdetailassetkeluar()
    {
        $kode_keluar = $this->uri->segment(3);
        $data = $this->User_model->detailassetkeluar($kode_keluar);
        $this->load->view('tambahdetailkeluar.php', $data);
        $this->load->view('layouts/sidebar');
    }

    public function editdetailassetkeluar()
    {
        $kode = $this->input->post('kode_keluar');
        $kode_asset = $this->input->post('kode_asset');
        $nama_asset = $this->input->post('nama_asset');
        $qty = $this->input->post('qty');
        $hargasatuan = $this->input->post('harga_satuan');
        $hargatotal = $this->input->post('harga_total');
        $userinput = $this->input->post('user_input');
        $tanggal = $this->input->post('tgl_input');

        $data = array(
            'kode_keluar' => $kode,
            'kode_asset' => $kode_asset,
            'nama_asset' => $nama_asset,
            'qty' => $qty,
            'harga_satuan' => $hargasatuan,
            'harga_total' => $hargatotal,
            'user_input' => $userinput,
            'tgl_input' => $tanggal,
        );
        $this->User_model->editAssetKeluarDetail($kode, $data);
        $kode = $this->uri->segment(3);
        redirect('assetkeluar/detailassetkeluar/' . $kode);
    }

    function deletedetailassetkeluar($kode_keluar)
    {
        $this->db->where('kode_keluar', $kode_keluar);
        $this->db->delete('as_assetkeluardetail');
        redirect('detailassetkeluar');
    }
    public function editKeluarDetail($kode_keluar)
    {
        $DetailKeluar = $this->User_model->getDataAssetKeluarDetail($kode_keluar);
        $DATA = array('DetailKeluar' => $DetailKeluar);
        $this->load->view('editdetailkeluar', $DATA);
        $this->load->view('layouts/sidebar');
    }
    public function realisasikeluar($kode_asset)
    {
        $kode_keluar = $this->uri->segment(3);
        $data = array(

            'status_keluar' => 'Realisasi',
            'user_realisasi' => $this->session->userdata('id'),
            'tgl_realisasi' => date('Y-m-d H:i:s'),
        );
        $where = array(
            'kode_keluar' => $kode_keluar,

        );

        $detail = $this->db->query("SELECT kode_asset , nama_asset , qty, harga_satuan  FROM `as_assetkeluardetail` where kode_keluar = '$kode_keluar'")->result();
        $header = $this->db->query("SELECT dept_penerima , tgl_keluar , keterangan FROM `as_assetkeluarheader` where kode_keluar = '$kode_keluar'")->result();

        // $closing = $this->db->query("SELECT kode_asset, (SUM(sisa) + SUM(masuk) ) - SUM(keluar) AS sisastock  GROUP BY kode_asset from 'as_assetkeluardetail' ");

        $closing = $this->db->query("SELECT kode_asset, (SUM(masuk) + SUM(sisa)) - SUM(keluar) AS sisastock  FROM cekstock GROUP BY kode_asset ")->result();
        // $sisa = $this->db->query("SELECT kode_asset , (SUM(masuk) + SUM(sisa)) - SUM(keluar) as sisa FROM cekstock GROUP BY kode_asset  ")->result();

        foreach ($detail as $row) {

            // $kode = $this->User_model->getkodeassetdetailmasuk($kode_asset);

            $cekstock = array(

                'tgl_stock' => $header[0]->tgl_keluar,
                'kode_dept' => $header[0]->dept_penerima,
                'kode_asset' => $row->kode_asset,
                'nama_asset' => $row->nama_asset,
                'kode_transaksi' => $kode_keluar,
                'jenis_transaksi' => 'OUT',
                'keluar' => $row->qty,
                'harga_satuan' => $row->harga_satuan,
                'harga_total' => $row->harga_satuan * $row->qty,
                'keterangan' => $header[0]->keterangan,
                'user_input' => $this->session->userdata('id'),

            );
            $this->User_model->input_data($cekstock, 'cekstock');
        }

        $this->User_model->update('as_assetkeluarheader', $data, $where);

        redirect('assetkeluar');
    }
}
