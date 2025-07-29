<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Writeoff extends CI_Controller
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
    public function assetwriteoff()

    {
        $data = $this->User_model->getAsetWriteoff();
        $DATA = array('data' => $data);
        $this->load->view('assetwriteoff.php', $DATA);
        $this->load->view('layouts/sidebar');
    }
    public function tambahassetwriteoff()
    {
        $this->load->view('tambahassetwriteoff.php');
        $this->load->view('layouts/sidebar');
    }
    public function tambahdatawriteoff()
    {

        $totalqty = $this->input->post('total_qty');

        $keterangan = $this->input->post('keterangan');
        $userinput = $this->session->userdata('id');
        $data = array(
            'kode_writeoff' => $this->User_model->getkodewriteoff(),
            'tgl_writeoff' => date('Y-m-d H:i:s'),
            'total_qty' => $totalqty,

            'keterangan' => $keterangan,
            'user_input' => $userinput,
            'tgl_input' => date('Y-m-d H:i:s'),



        );
        $this->User_model->input_write($data, 'as_assetwriteoffheader1');
        redirect('writeoff/assetwriteoff');
    }
    public function editWriteoff($id)
    {
        $writeoffDetail = $this->User_model->getDataWriteoffDetail($id);
        $DATA = array('writeoffDetail' => $writeoffDetail);
        $this->load->view('editwriteoff', $DATA);
        $this->load->view('layouts/sidebar');
    }
    public function fungsiWriteoff()
    {
        $kode = $this->input->post('kode_writeoff');
        $tanggal = $this->input->post('tgl_writeoff');
        $totalqty = $this->input->post('total_qty');
        $totalharga = $this->input->post('total_harga');
        $keterangan = $this->input->post('keterangan');
        $status = $this->input->post('status_writeoff');
        $userrealisasi = $this->input->post('user_realisasi');
        $tanggalrealisasi = $this->input->post('tgl_realisasi');
        $userinput = $this->input->post('user_input');
        $tanggalinput = $this->input->post('tgl_input');


        $updateWriteoff = array(
            'kode_writeoff' => $kode,
            'tgl_writeoff' => $tanggal,
            'total_qty' => $totalqty,
            'total_harga' => $totalharga,
            'keterangan' => $keterangan,
            'status_writeoff' => $status,
            'user_realisasi' => $userrealisasi,
            'tgl_realisasi' => $tanggalrealisasi,
            'user_input' => $userinput,
            'tgl_input' => $tanggalinput,

        );
        $this->User_model->editWriteoff($id, $updateWriteoff);
        redirect(base_url('writeoff/assetwriteoff'));
    }

    function deletewriteoff($kode_writeoff)
    {
        $this->db->where('kode_writeoff', $kode_writeoff);
        $this->db->delete('as_assetwriteoffheader1');
        redirect('assetwriteoff');
    }
    public function detailassetwriteoff()
    {
        $kode_writeoff = $this->uri->segment(3);
        $data = $this->User_model->detailwriteoff($kode_writeoff);
        $DATA = array('data' => $data);
        $this->load->view('detailwriteoff', $DATA);
        $this->load->view('layouts/sidebar');
    }
    public function tambahdetailassetwriteoff()
    {
        $this->load->view('tambahdetailwriteoff.php');
        $this->load->view('layouts/sidebar');
    }
    public function tambahdetailwriteoff()
    {


        $kode_writeoff = $this->input->post('kode_writeoff');
        $kode_asset = $this->input->post('kode_asset');
        $qty = $this->input->post('qty');
        $msasset = $this->User_model->get_data_master_by_code($kode_asset);
        $nama_asset = $msasset[0]->nama_asset;
        $qty = $this->input->post('qty');
        $hargasatuan = $msasset[0]->hrg_peroleh;


        $this->db->where('kode_asset', $kode_asset);
        $this->db->where('kode_writeoff', $kode_writeoff);
        $query = $this->db->get('as_assetwriteoffdetail');

        if ($query->num_rows() > 0) {
            $detail = $query->result();
            $data = array(
                'qty' => $detail[0]->qty + $qty,
                'harga_total' => ($detail[0]->qty + $qty) * $hargasatuan,
            );
            $where = array(
                'kode_writeoff' => $kode_writeoff,
                'kode_asset' => $kode_asset,

            );
            // };
            $this->User_model->update('as_assetwriteoffdetail', $data, $where);
        } else {

            $data = array(
                'kode_writeoff' => $kode_writeoff,
                'kode_asset' => $kode_asset,
                'nama_asset' => $nama_asset,
                'qty' => $qty,
                'harga_satuan' => $hargasatuan,
                'harga_total' => $qty * $hargasatuan,
                'user_input' => $this->session->userdata('id'),
                'tgl_input' => date('Y-m-d H:i:s'),
            );
            $this->User_model->input_data($data, 'as_assetwriteoffdetail');
        }
        $sumdetail = $this->User_model->sumwriteoffdetail($kode_writeoff);

        $data = array(
            'total_qty' => $sumdetail[0]->qty,
            'total_harga' => $sumdetail[0]->hargatotal,

        );
        $where = array(
            'kode_writeoff' => $kode_writeoff,

        );
        $this->User_model->update('as_assetwriteoffheader1', $data, $where);
        redirect('writeoff/detailassetwriteoff/' . $kode_writeoff);
    }

    public function editdetailwriteoff()
    {
        $kode = $this->input->post('kode_writeoff');
        $kode_asset = $this->input->post('kode_asset');
        $nama_asset = $this->input->post('nama_asset');
        $qty = $this->input->post('qty');
        $hargasatuan = $this->input->post('harga_satuan');
        $hargatotal = $this->input->post('harga_total');
        $userinput = $this->input->post('user_input');
        $tanggal = $this->input->post('tgl_input');

        $data = array(
            'kode_writeoff' => $kode,
            'kode_asset' => $kode_asset,
            'nama_asset' => $nama_asset,
            'qty' => $qty,
            'harga_satuan' => $hargasatuan,
            'harga_total' => $hargatotal,
            'user_input' => $userinput,
            'tgl_input' => $tanggal,
        );
        $this->User_model->editAssetWriteoffDetail($kode, $data);
        $kode = $this->uri->segment(3);
        redirect('writeoff/detailassetwriteoff/' . $kode);
    }
    public function editWriteoffDetail($kode_writeoff)
    {
        $DetailWriteoff = $this->User_model->getDataAssetWRiteoffDetail($kode_writeoff);
        $DATA = array('DetailWriteoff' => $DetailWriteoff);
        $this->load->view('editdetailwriteoff', $DATA);
        $this->load->view('layouts/sidebar');
    }
    function deletedetailassetwriteoff($kode_writeoff)
    {
        $this->db->where('kode_writeoff', $kode_writeoff);
        $this->db->delete('as_assetwriteoffdetail');
        redirect('detailassetwriteoff');
    }
    public function realisasiwriteoff()
    {
        $kode_writeoff = $this->uri->segment(3);
        $data = array(

            'status_writeoff' => 'Realisasi',
            'user_realisasi' => $this->session->userdata('id'),
            'tgl_realisasi' => date('Y-m-d H:i:s'),
        );
        $where = array(
            'kode_writeoff' => $kode_writeoff,

        );

        // $kode = $this->input->post('kode_asset');
        // $nama = $this->input->post('nama_asset');
        // $masuk = $this->input->post('masuk');
        $detail = $this->db->query("SELECT kode_asset , nama_asset , qty, harga_satuan  FROM `as_assetwriteoffdetail` where kode_writeoff = '$kode_writeoff'")->result();
        $header = $this->db->query("SELECT  tgl_writeoff , keterangan FROM `as_assetwriteoffheader1` where kode_writeoff = '$kode_writeoff'")->result();

        foreach ($detail as $row) {

            // $kode = $this->User_model->getkodeassetdetailmasuk($kode_asset);
            $cekstock = array(
                'tgl_stock' => $header[0]->tgl_writeoff,
                // 'kode_dept' => $header[0]->dept_penerima,
                'kode_asset' => $row->kode_asset,
                'nama_asset' => $row->nama_asset,
                'kode_transaksi' => $kode_writeoff,
                'jenis_transaksi' => 'OUT',
                'keluar' => $row->qty,
                'harga_satuan' => $row->harga_satuan,
                'harga_total' => $row->harga_satuan * $row->qty,
                'keterangan' => $header[0]->keterangan,
                'user_input' => $this->session->userdata('id'),
            );
            $this->User_model->input_data($cekstock, 'cekstock');
        }
        $this->User_model->update('as_assetwriteoffheader1', $data, $where);
        redirect('writeoff/assetwriteoff');
    }
}
