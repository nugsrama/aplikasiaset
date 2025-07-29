<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Adjustment extends CI_Controller
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
    public function assetadjustment()
    {
        $data = $this->User_model->getAsetAdjust();
        $DATA = array('data' => $data);
        $this->load->view('assetadjustment.php', $DATA);
        $this->load->view('layouts/sidebar');
    }
    public function tambahassetadjustment()
    {
        $this->load->view('tambahassetadjustment.php');
        $this->load->view('layouts/sidebar');
    }
    public function tambahdataadjustment()
    {
        $kode = $this->input->post('kode_adjustment');
        $tanggal = $this->input->post('tgl_adjustment');
        $totalqty = $this->input->post('total_qty');
        $keterangan = $this->input->post('keterangan');
        $userinput = $this->session->userdata('id');

        $data = array(
            'kode_adjustment' =>  $this->User_model->getkodeadjustment(),
            'tgl_adjustment' => $tanggal,
            'total_qty' => $totalqty,

            'keterangan' => $keterangan,
            'user_input' => $userinput,
            'tgl_input' => date('Y-m-d H:i:s'),


        );
        $this->User_model->input_data($data, 'as_assetadjustmentheader');
        redirect('adjustment/assetadjustment');
    }
    public function editAdjustment($id)
    {
        $adjustmentDetail = $this->User_model->getDataAdjustmentDetail($id);
        $DATA = array('adjustmentDetail' => $adjustmentDetail);
        $this->load->view('editadjustment', $DATA);
        $this->load->view('layouts/sidebar');
    }
    public function fungsiAdjustment()
    {
        $id = $this->input->post('id');
        $kode = $this->input->post('kode_adjustment');
        $tanggal = $this->input->post('tgl_adjustment');
        $totalqty = $this->input->post('total_qty');
        $totalharga = $this->input->post('total_harga');
        $keterangan = $this->input->post('keterangan');
        $userrealisasi = $this->input->post('user_realisasi');
        $tanggalrealisasi = $this->input->post('tgl_realisasi');




        $userinput = $this->session->userdata('id');

        $updateAdjustment = array(
            'id' => $id,
            'kode_adjustment' => $kode,
            'tgl_adjustment' => $tanggal,
            'total_qty' => $totalqty,
            'total_harga' => $totalharga,
            'keterangan' => $keterangan,
            'user_realisasi' => $userrealisasi,
            'tgl_realisasi' => $tanggalrealisasi,
            'user_input' => $userinput,
            'tgl_input' => date('Y-m-d H:i:s'),

        );
        $this->User_model->editAdjustment($id, $updateAdjustment);
        redirect(base_url('adjustment/assetadjustment'));
    }


    function deleteadjustment($kode_adjustment)
    {
        $this->db->where('kode_adjustment', $kode_adjustment);
        $this->db->delete('as_assetadjustmentheader');
        redirect('assetadjustment');
    }

    public function detailassetadjustment()
    {
        $kode_adjustment = $this->uri->segment(3);
        $data = $this->User_model->detailadjustment($kode_adjustment);
        $DATA = array('data' => $data);
        $this->load->view('detailadjustment', $DATA);
        $this->load->view('layouts/sidebar');
    }
    public function tambahdetailassetadjustment()
    {
        $this->load->view('tambahdetailadjustment.php');
        $this->load->view('layouts/sidebar');
    }
    public function tambahdetailadjustment()
    {


        $kode_adjustment = $this->input->post('kode_adjustment');
        $kode_asset = $this->input->post('kode_asset');

        $msasset = $this->User_model->get_data_master_by_code($kode_asset);
        $nama_asset = $msasset[0]->nama_asset;
        $qty = $this->input->post('qty');
        $hargasatuan = $msasset[0]->hrg_peroleh;

        $this->db->where('kode_asset', $kode_asset);
        $this->db->where('kode_adjustment', $kode_adjustment);
        $query = $this->db->get('as_assetadjustmentdetail');

        if ($query->num_rows() > 0) {
            $detail = $query->result();
            $data = array(
                'qty' => $detail[0]->qty + $qty,
                'harga_total' => ($detail[0]->qty + $qty) * $hargasatuan,
            );
            $where = array(
                'kode_adjustment' => $kode_adjustment,
                'kode_asset' => $kode_asset,

            );
            // };
            $this->User_model->update('as_assetadjustmentdetail', $data, $where);
        } else {
            $data = array(
                'kode_adjustment' => $kode_adjustment,
                'kode_asset' => $kode_asset,
                'nama_asset' => $nama_asset,
                'qty' => $qty,
                'harga_satuan' => $hargasatuan,
                'harga_total' => $hargasatuan * $qty,
                'user_input' => $this->session->userdata('id'),
                'tgl_input' => date('Y-m-d H:i:s'),

            );
            $this->User_model->input_data($data, 'as_assetadjustmentdetail');
        }
        $sumdetail = $this->User_model->sumadjustmentdetail($kode_adjustment);

        $data = array(
            'total_qty' => $sumdetail[0]->qty,
            'total_harga' => $sumdetail[0]->hargatotal,

        );
        $where = array(
            'kode_adjustment' => $kode_adjustment,

        );
        $this->User_model->update('as_assetadjustmentheader', $data, $where);
        redirect('adjustment/detailassetadjustment/' . $kode_adjustment);
    }
    public function editAdjustmentDetail($kode_adjustment)
    {
        $DetailAdjustment = $this->User_model->getDataAssetAdjustmentDetail($kode_adjustment);
        $DATA = array('DetailAdjustment' => $DetailAdjustment);
        $this->load->view('editdetailadjustment', $DATA);
        $this->load->view('layouts/sidebar');
    }
    public function editdetailadjustment()
    {
        $kode = $this->input->post('kode_adjustment');
        $kode_asset = $this->input->post('kode_asset');
        $nama_asset = $this->input->post('nama_asset');
        $qty = $this->input->post('qty');
        $hargasatuan = $this->input->post('harga_satuan');
        $hargatotal = $this->input->post('harga_total');
        $userinput = $this->input->post('user_input');
        $tanggal = $this->input->post('tgl_input');

        $data = array(
            'kode_adjustment' => $kode,
            'kode_asset' => $kode_asset,
            'nama_asset' => $nama_asset,
            'qty' => $qty,
            'harga_satuan' => $hargasatuan,
            'harga_total' => $hargatotal,
            'user_input' => $userinput,
            'tgl_input' => $tanggal,
        );
        $this->User_model->editAssetAdjustmentDetail($kode, $data);
        $kode = $this->uri->segment(3);
        redirect('adjustment/detailassetadjustment/' . $kode);
    }
    function deletedetailassetadjustment($kode_adjustment)
    {
        $this->db->where('kode_adjustment', $kode_adjustment);
        $this->db->delete('as_assetadjustmentdetail');
        redirect('detailassetadjustment');
    }
    public function realisasiadjustment()
    {
        $kode_adjustment = $this->uri->segment(3);
        $data = array(

            'status_Adjustment' => 'Realisasi',
            'user_realisasi' => $this->session->userdata('id'),
            'tgl_realisasi' => date('Y-m-d H:i:s'),
        );
        $where = array(
            'kode_adjustment' => $kode_adjustment,

        );
        // $kode = $this->input->post('kode_asset');
        // $nama = $this->input->post('nama_asset');
        // $masuk = $this->input->post('masuk');

        $detail = $this->db->query("SELECT kode_asset , nama_asset , qty, harga_satuan  FROM `as_assetadjustmentdetail` where kode_adjustment = '$kode_adjustment'")->result();
        $header = $this->db->query("SELECT 'GA' dept_penerima ,tgl_adjustment , keterangan FROM `as_assetadjustmentheader` where kode_adjustment = '$kode_adjustment'")->result();

        foreach ($detail as $row) {

            // $kode = $this->User_model->getkodeassetdetailmasuk($kode_asset);


            $cekstock = array(


                'tgl_stock' => $header[0]->tgl_adjustment,
                'kode_dept' => $header[0]->dept_penerima,
                'kode_asset' => $row->kode_asset,
                'nama_asset' => $row->nama_asset,
                'kode_transaksi' => $kode_adjustment,
                'jenis_transaksi' => 'OUT',
                'keluar' => $row->qty,
                'harga_satuan' => $row->harga_satuan,
                'harga_total' => $row->harga_satuan * $row->qty,
                'keterangan' => $header[0]->keterangan,
                'user_input' => $this->session->userdata('id'),

            );
            $this->User_model->input_data($cekstock, 'cekstock');
        }
        $this->User_model->update('as_assetadjustmentheader', $data, $where);


        redirect('adjustment/assetadjustment');
    }
}
