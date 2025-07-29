<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Assetmasuk extends CI_Controller
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
    public function tambahassetmasuk()
    {
        $this->load->view('tambahassetmasuk.php');
        $this->load->view('layouts/sidebar');
    }
    public function tambahdatamasuk()
    {


        $tanggal = $this->input->post('tgl_masuk');
        $pengirim = $this->input->post('dept_pengirim');
        $penerima = $this->input->post('dept_penerima');
        $nomor = $this->input->post('no_po');
        $keterangan = $this->input->post('keterangan');



        $userinput = $this->session->userdata('id');

        $data = array(
            'kode_masuk' => $this->User_model->getkodemasuk(),
            'tgl_masuk' => $tanggal,
            'dept_pengirim' => strtoupper($pengirim),
            'dept_penerima' => strtoupper($penerima),
            'no_po' => strtoupper($nomor),
            'keterangan' => $keterangan,
            'user_input' => $userinput,
            'tgl_input' => date('Y-m-d H:i:s'),
        );
        $this->User_model->input_data($data, 'as_assetmasukheader');


        redirect(base_url('assetmasuk/asetmasuk'));
    }
    public function asetmasuk()
    {
        $data = $this->User_model->getAsetMasuk();
        $DATA = array('data' => $data);
        $this->load->view('assetmasuk.php', $DATA);
        $kodemasuk = $this->User_model->getstatus();
        $this->session->set_flashdata('pesan', 'Data asset masuk dari') . $kodemasuk;
        $this->load->view('layouts/sidebar');
    }
    public function editMasuk($id)
    {
        $masukDetail = $this->User_model->getDataMasukDetail($id);
        $DATA = array('masukDetail' => $masukDetail);
        $this->load->view('editmasuk', $DATA);
        $this->load->view('layouts/sidebar');
    }
    public function fungsiMasuk()
    {
        $id = $this->input->post('id');

        $tanggal = $this->input->post('tgl_masuk');
        $pengirim = $this->input->post('dept_pengirim');
        $penerima = $this->input->post('dept_penerima');
        $keterangan = $this->input->post('keterangan');
        $nopo = $this->input->post('no_po');
        $totalqty = $this->input->post('total_qty');





        $updateMasuk = array(
            'id' => $id,
            'total_Qty' => $totalqty,
            'tgl_masuk' => $tanggal,
            'keterangan' => $keterangan,
            'no_po' => $nopo,
            'dept_pengirim' => strtoupper($pengirim),
            'dept_penerima' => strtoupper($penerima),


        );
        $this->User_model->editMasuk($id, $updateMasuk);

        redirect(base_url('assetmasuk/asetmasuk'));
    }
    function deletemasuk($kode_masuk)
    {
        $this->db->where('kode_masuk', $kode_masuk);
        $this->db->delete('as_assetmasukheader');
        redirect(base_url('assetmasuk'));
    }
    public function detailassetmasuk()
    {
        $kode_masuk = $this->uri->segment(3);
        $data = $this->User_model->detailassetmasuk($kode_masuk);
        $DATA = array('data' => $data);
        $this->load->view('detailassetmasuk.php', $DATA);
        $this->load->view('layouts/sidebar');
    }
    public function tambahdetailassetmasuk()
    {
        $kode_masuk = $this->uri->segment(3);
        $data = $this->User_model->detailassetmasuk($kode_masuk);
        $this->load->view('tambahdetailmasuk.php', $data);
        $this->load->view('layouts/sidebar');
    }
    function deletedetailassetmasuk($kode_masuk, $kode_asset)
    {
        $this->db->where('kode_masuk', $kode_masuk);
        $this->db->where('kode_asset', $kode_asset);
        $this->db->delete('as_assetmasukdetail');
        redirect('detailassetmasuk/' . $kode_masuk);
    }
    public function editdetailmasuk($kode_masuk)
    {
        $masukDetail = $this->User_model->getDataAssetMasukDetail($kode_masuk);
        $DATA = array('masukDetail' => $masukDetail);
        $this->load->view('editdetailmasuk', $DATA);
        $this->load->view('layouts/sidebar');
    }
    public function editdetailassetmasuk()
    {
        $kode = $this->input->post('kode_masuk');
        $kode_asset = $this->input->post('kode_asset');
        $nama_asset = $this->input->post('nama_asset');
        $qty = $this->input->post('qty');
        $hargasatuan = $this->input->post('harga_satuan');
        $hargatotal = $this->input->post('harga_total');
        $userinput = $this->input->post('user_input');
        $tanggal = $this->input->post('tgl_input');

        $data = array(
            'kode_masuk' => $kode,
            'kode_asset' => $kode_asset,
            'nama_asset' => $nama_asset,
            'qty' => $qty,
            'harga_satuan' => $hargasatuan,
            'harga_total' => $hargatotal,
            'user_input' => $userinput,
            'tgl_input' => $tanggal,
        );
        $this->User_model->editAssetMasukDetail($kode, $data);

        $kode_masuk = $this->uri->segment(3);
        redirect('assetmasuk/detailassetmasuk/' . $kode_masuk);
    }
    public function tambahdetailmasuk()
    {

        $kode_masuk = $this->input->post('kode_masuk');
        $kode_asset = $this->input->post('kode_asset');
        $msasset = $this->User_model->get_data_master_by_code($kode_asset);
        $nama_asset = $msasset[0]->nama_asset;
        $qty = $this->input->post('qty');
        $hargasatuan = $msasset[0]->hrg_peroleh;


        $this->db->where('kode_asset', $kode_asset);
        $this->db->where('kode_masuk', $kode_masuk);
        $query = $this->db->get('as_assetmasukdetail');

        if ($query->num_rows() > 0) {
            $detail = $query->result();
            $data = array(
                'qty' => $detail[0]->qty + $qty,
                'harga_total' => ($detail[0]->qty + $qty) * $hargasatuan,

            );
            $where = array(
                'kode_masuk' => $kode_masuk,
                'kode_asset' => $kode_asset,

            );
            // };
            $this->User_model->update('as_assetmasukdetail', $data, $where);
        } else {

            $kode = $this->uri->segment(3);
            $data = array(
                'kode_masuk' => $kode_masuk,
                'kode_asset' => $kode_asset,
                'nama_asset' => $nama_asset,
                'qty' => $qty,
                'harga_satuan' => $hargasatuan,
                'harga_total' => $hargasatuan * $qty,
                'user_input' => $this->session->userdata('id'),
                'tgl_input' => date('Y-m-d H:i:s'),
            );


            // };
            $this->User_model->input_data($data,  'as_assetmasukdetail');
        }
        $sumdetail = $this->User_model->summasukdetail($kode_masuk);

        $data = array(
            'total_qty' => $sumdetail[0]->qty,
            'total_harga' => $sumdetail[0]->hargatotal,

        );
        $where = array(
            'kode_masuk' => $kode_masuk,
        );
        // };
        $this->User_model->update('as_assetmasukheader', $data, $where);


        redirect('assetmasuk/detailassetmasuk/' . $kode_masuk);
    }
    public function realisasimasuk()
    {
        $kode_masuk = $this->uri->segment(3);
        $data = array(

            'status_masuk' => 'Realisasi',
            'user_realisasi' => $this->session->userdata('id'),
            'tgl_realisasi' => date('Y-m-d H:i:s'),
        );
        $where = array(
            'kode_masuk' => $kode_masuk,

        );

        // $kode = $this->input->post('kode_asset');
        // $nama = $this->input->post('nama_asset');
        // $masuk = $this->input->post('masuk');

        $detail = $this->db->query("SELECT kode_asset , nama_asset , qty, harga_satuan  FROM `as_assetmasukdetail` where kode_masuk = '$kode_masuk'")->result();
        $header = $this->db->query("SELECT dept_penerima , tgl_masuk , keterangan FROM `as_assetmasukheader` where kode_masuk = '$kode_masuk'")->result();

        foreach ($detail as $row) {
            // $masuk = $this->User_model->get_data_detail_masuk($dept_penerima);
            // $dept_penerima = $masuk[0]->dept_penerima;
            $cekstock = array(

                'tgl_stock' => $header[0]->tgl_masuk,
                'kode_dept' => $header[0]->dept_penerima,
                'kode_asset' => $row->kode_asset,
                'nama_asset' => $row->nama_asset,
                'kode_transaksi' => $kode_masuk,
                'jenis_transaksi' => 'IN',
                'masuk' => $row->qty,
                'harga_satuan' => $row->harga_satuan,
                'harga_total' => $row->harga_satuan * $row->qty,
                'keterangan' => $header[0]->keterangan,
                'user_input' => $this->session->userdata('id'),
                // 'kode_dept' => $dept_penerima,

            );
            $this->User_model->input_data($cekstock, 'cekstock');
        }

        $this->User_model->update('as_assetmasukheader', $data, $where);

        redirect('assetmasuk/asetmasuk');
    }
    public function editMasukDetail($kode_masuk)

    {
        $DetailMasuk = $this->User_model->getDataAssetMasukDetail($kode_masuk);
        $DATA = array('DetailMasuk' => $DetailMasuk);
        $this->load->view('editdetailmasuk', $DATA);
        $this->load->view('layouts/sidebar');
    }

    public function statusmasuk() {}
}
