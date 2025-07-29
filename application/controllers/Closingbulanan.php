<?php

use PhpParser\Node\Expr\Exit_;
use PhpParser\Node\Expr\PostDec;
use PhpParser\Node\Stmt\Echo_;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;

defined('BASEPATH') or exit('No direct script access allowed');

class Closingbulanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Jika belum login, arahkan ke halaman login

        $this->load->model('User_model');
        $this->session->set_userdata('status', 'status_masuk');
    }

    public function closing()
    {
        $data = $this->User_model->closing();
        $DATA = array('data' => $data);
        $this->load->view('closingbulanan', $DATA);
        $this->load->view('layouts/sidebar');
    }

    public function tambahclosing()
    {
        $id = $this->input->post('id');
        $bulanclosing = $this->input->post('bulan_closing');
        $tahunclosing = $this->input->post('tahun_closing');


        $periodeclosing = $tahunclosing . '-' . $bulanclosing . '-01';
        $periodenext = date('Y-m-01', strtotime(' + 1 months', strtotime($periodeclosing)));
        $this->db->query("DELETE FROM cekstock WHERE jenis_transaksi ='AWL' AND tgl_stock >= '$periodenext' ");
        $stok = $this->db->query("SELECT kode_asset, (SUM(sisa) + SUM(masuk) )- SUM(keluar) AS sisastock ,nama_asset,kode_transaksi ,keterangan,masuk,harga_satuan,keterangan,harga_total FROM cekstock where month(tgl_stock ) = $bulanclosing  AND YEAR(tgl_stock)=$tahunclosing GROUP BY kode_asset ")->result();

        if ($periodeclosing == $periodenext) {
            $this->session->set_flashdata('pesan4', "<div class='alert alert-danger'>Closing dapat dilakukan bulan depan</div>");
            redirect('closingbulanan/closing');
        }

        foreach ($stok as $a) {
            if ($a->sisastock > 0) {
                $sisastock = array(
                    'jenis_transaksi ' => 'AWL',
                    'tgl_stock' => $periodenext,
                    'sisa' => $a->sisastock,
                    'kode_asset ' => $a->kode_asset,
                    'nama_asset' => $a->nama_asset,
                    'kode_transaksi' => $a->kode_transaksi,
                    'keterangan' => $a->keterangan,
                    'harga_satuan' => $a->harga_satuan,
                    'harga_total' => $a->sisastock * $a->harga_satuan,
                    'keterangan' => $a->keterangan,
                    'user_input' => $this->session->userdata('id'),
                );

                $this->User_model->input_data($sisastock, 'cekstock');
            }
        }
        $closing = $this->db->query("SELECT status_closing from as_closingbulananho where bulan_closing = '$bulanclosing'  ")->result();
        $keluar = $this->db->query("SELECT status_keluar from as_assetkeluarheader ")->result();
        $masuk = $this->db->query("SELECT status_masuk from as_assetmasukheader ")->result();
        $adjustment = $this->db->query("SELECT status_adjustment from as_assetadjustmentheader ")->result();
        $writeoff = $this->db->query("SELECT status_writeoff from as_assetwriteoffheader1 ")->result();

        foreach ($closing as $c)
            if ($c->status_closing != 0) {

                $this->session->set_flashdata('pesan1', "<div class='alert alert-danger'>Closing sudah dilakukan</div>");
                redirect('closingbulanan/closing');
            }
        foreach ($keluar as $a)

            $keluar = $a->status_keluar;
        if ($keluar == "Process") {

            $this->session->set_flashdata('pesan2', "<div class='alert alert-warning'> Realisasi Asset Keluar Telebih Dahulu </div>");
            redirect('closingbulanan/closing');
        }

        foreach ($masuk as $a)
            $masuk = $a->status_masuk;
        if ($masuk == "Process") {

            $this->session->set_flashdata('pesan3', "<div class='alert alert-warning' ><strong>Realisasi Asset Masuk Telebih Dahulu </strong></div>");
            redirect('closingbulanan/closing');
        }

        foreach ($adjustment as $a)
            $adjustment = $a->status_adjustment;
        if ($adjustment == "Process") {

            $this->session->set_flashdata('pesan5', "<div class='alert alert-warning' ><strong>Realisasi Asset Adjustment Telebih Dahulu </strong></div>");
            redirect('closingbulanan/closing');
        }
        foreach ($writeoff as $w)
            $writeoff = $w->status_writeoff;
        if ($writeoff == "Process") {
            $this->session->set_flashdata('pesan6', "<div class='alert alert-warning' ><strong>Realisasi Asset Writeoff Telebih Dahulu </strong></div>");
            redirect('closingbulanan/closing');
        }

        $status = array(


            'status_closing' => 1,

        );
        $query = $this->db->query("SELECT id as id from as_closingbulananho where bulan_closing")->result();

        $where = array(
            'bulan_closing' => $bulanclosing,
        );

        // $where = array(
        //     'jenis_transaksi' => "AWL",
        //     'tgl_stock' => $periodenext,

        // );


        $userinput = $this->session->userdata('id');
        $bulan = date('m', strtotime('+ 1 months', strtotime($periodeclosing)));
        $tahun = date('Y', strtotime('+ 1 months', strtotime($periodeclosing)));
        $data = array(
            'id' => $id,
            'bulan_closing' => $bulan,
            'tanggal_closing' => $periodenext,
            'tahun_closing' => $tahun,
            'status_closing' => 0,
            'user_input' => $userinput,
        );
        $this->User_model->input_data($data, 'as_closingbulananho');
        $this->User_model->update('as_closingbulananho', $status, $where);
        $this->session->set_flashdata('closing', "<div class='alert alert-success' ><strong>Closing berhasil</strong></div>");
        redirect('closingbulanan/closing');
    }
}
