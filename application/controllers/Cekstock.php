<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cekstock extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Masset');
        $this->load->model('User_model');
        $this->load->library('session');
        if (!$_SESSION['logged']) {
            // Redirect ke halaman login
            header('Location: login');
            exit;
        }
    }
    function cekstock()
    {
        // $kode_asset = $this->uri->segment(3);

        $data = $this->User_model->cekstock();
        $DATA = array('data' => $data);
        $this->load->view('cekstock', $DATA);
        $this->load->view('layouts/sidebar');
    }
}
