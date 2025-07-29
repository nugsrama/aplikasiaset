<?php




defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();


        // Jika belum login, arahkan ke halaman login

        $this->load->model('User_model');
        $this->load->library('form_validation');

        $this->load->library('ciqrcode');

        // if ($this->session->userdata('id'));
        // redirect('login');
        if (!$_SESSION['logged']) {
            // Redirect ke halaman login
            header('Location: login');
            exit;
        }
    }

    public function halhome()
    {

        $data = $this->User_model->tampil();
        $DATA = array('data' => $data);
        $this->load->view('home.php', $DATA);
        $this->load->view('layouts/sidebar');
    }

    function barcode_2()
    {

        $periodenext = date('Y-m-01', strtotime(' + 1 months'));
        echo $periodenext;
        // $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        // echo $generator->getBarcode('test', $generator::TYPE_CODE_128);
        $query = $this->db->query("DELETE FROM cekstock WHERE tgl_stock >= $periodenext");

        $this->db->where('jenis_transaksi' == 'AWL');
        $this->db->where('tgl_stock' >= $periodenext);
        $this->db->delete('cekstock');
    }


    public function tambahasset()
    {
        $this->load->view('tambahasset.php');
        $this->load->view('layouts/sidebar');
    }
    function delete($id)
    {
        //delete employee record
        $this->db->where('id', $id);
        $this->db->delete('as_msasset');
        redirect('home');
    }

    public function editmaster()
    {
        $this->load->view('editmaster.php');
        $this->load->view('layouts/sidebar');
    }

    public function fungsiEdit()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama_asset');
        $status = $this->input->post('status_asset');
        $keterangan = $this->input->post('keterangan');
        $harga = $this->input->post('hrg_peroleh');

        $ArrUpdate = array(
            'id' => $id,
            'nama_asset' => $nama,
            'status_asset' => $status,
            'keterangan' => $keterangan,
            'hrg_peroleh' => $harga,

        );
        $this->User_model->editMaster($id, $ArrUpdate);
        redirect(base_url('home'));
    }
    public function tambahmaster()
    {

        $nama_asset = $this->input->post('nama_asset');
        $tanggal = $this->input->post('tgl_peroleh');
        $harga = $this->input->post('hrg_peroleh');
        $status = $this->input->post('status_asset');
        $qrcode = $this->input->post('qr_code');
        $keterangan = $this->input->post('keterangan');

        $base64Gambar = $_FILES["foto_asset"]["tmp_name"];
        $tanggalinput = $this->input->post('tgl_input');

        $Path = "image/";
        $ImagePath = $Path . $nama_asset . "logonobby.png";
        move_uploaded_file($base64Gambar, $ImagePath);

        $kode_barcode = $this->User_model->getkodeasset();

        //proses generate gambar barcode dan simpan ke folder yg ditentukan
        $tempdir = "image/"; //nama folder nya
        $target_path = $tempdir . $kode_barcode . ".png";

        //cek apakah server menggunakan http atau https
        $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://';

        //url file image barcode 
        $file_gambar = $protocol . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/barcode.php?text=" . $kode_barcode . "&print=true&size=65"; //size untuk atur ukuran gambar barcode nya

        //ambil gambar barcode dari url yg ditentukan lalu namanya ditampung ke $gambar_barcode
        $content = file_get_contents($file_gambar);
        file_put_contents($target_path, $content);
        $gambar_barcode = $kode_barcode . '.png';

        $kode = $this->User_model->getkodeasset();
        $nama = $nama_asset;
        $path = 'image/';
        $file = $path .  $kode . ".png";
        $text = $kode . '-' . $nama;
        QRcode::png($text, $file);


        $data = array(

            'kode_asset' => $this->User_model->getkodeasset(),
            'nama_asset' => strtoupper($nama_asset),
            'tgl_peroleh' => $tanggal,
            'hrg_peroleh' => $harga,
            'status_asset' => $status,
            'keterangan' => $keterangan,
            'user_input' => $this->session->userdata('id'),
            'qr_code' => $this->User_model->getkodeasset(),
            'tgl_input' => date('Y-m-d H:i:s'),
            'foto_asset' => base_url() . $ImagePath,
            'barcode' =>  $gambar_barcode,
        );
        $this->User_model->input_data($data, 'as_msasset');
        redirect('home');
    }

    public function halaman_edit($id)
    {
        $masterDetail = $this->User_model->getDataMasterDetail($id);
        $DATA = array('masterDetail' => $masterDetail);
        $this->load->view('editmaster', $DATA);
        $this->load->view('layouts/sidebar');
    }

    public function barcode($code)
    {
        $this->load->library('Zend');
        $this->zend->load('Zend/Barcode');
        //generate barcode
        Zend_Barcode::render('code128', 'image', array('text' => $code), array());
        // $str = 'TEST';
        //     $location = 'assets/image/';
        //     $this->load->library('Zend/Barcode/Barcode');
        //     $file = Zend\Barcode\Barcode::draw('code128', 'image', array('text' => $str), array());
        //     $store_image = imagepng($file, FCPATH . $location . "{$str}.png");
        //     $img = $location . "{$str}.png";
        //     $this->load->helper('html');
        //     echo img($img);
        // }
    }
    public function test()
    {
        $keluar = $this->db->query("SELECT status_keluar from as_assetkeluarheader where status_keluar = 'Process' ")->result();
        var_dump($keluar);
        die();
    }
}
