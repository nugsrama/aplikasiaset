<?php

use function PHPUnit\Framework\identicalTo;

defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		// Jika belum login, arahkan ke halaman login

		$this->load->model('User_model');
		$this->load->library('form_validation');
		$this->load->library('ciqrcode');
		// ini_set(
		// 	'include_path',
		// 	ini_get('include_path') . PATH_SEPARATOR . APPPATH . 'third_party'
		// );

		// if ($class) {
		// 	require_once (string) $class . EXT;
		// 	log_message('debug', "Zend class $class loaded");
		// } else {
		// 	log_message('debug', "Zend class initialized");
		// }
	}
	private function barcode($code)
	{ {
			//load library
			// $this->load->library('Zend');
			// //load in folder Zend
			// $this->zend->load('Zend/Barcode');
			// //generate barcode
			// Zend_Barcode::render('code128', 'image', array('text' => '11111'), array());

			$this->zend->load('Zend/Barcode');
			Zend_Barcode::render('code128', 'image', array('text' => $this->load->User_model->getkodeasset()), array());
		}
	}

	public function index()
	{

		$this->load->view('login');
	}
	public function halhome()
	{

		$data = $this->User_model->tampil();
		$DATA = array('data' => $data);
		$this->load->view('home.php', $DATA);
		$this->load->view('layouts/sidebar');
	}

	public function login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$userData = $this->User_model->getLoginUser($username, $password);
		if (!empty($userData)) {
			$sess = array(
				'username' => $userData->username,

			);
			$data = $this->session->set_userdata($sess);
			redirect('home', $data);
		} else {
			$this->session->set_flashdata('');
			redirect('home');
		}
	}
	public function registrasi()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|trim|valid_username');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');
		if ($this->form_validation->run() == false) {
			$this->load->view('registrasi.php');
		} else {
			$data = [
				'username' => $this->input->post('username'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'role_id' => 3,
			];

			$this->db->insert('users', $data);
			redirect('login.php');
		}
	}
	public function hallogin()
	{
		$this->load->view('login.php');
	}
	public function imagecrop()
	{

		// $this->load->library('image_lib');
		// // Pastikan ada file yang diupload
		// if (isset($_FILES['foto_asset']) && $_FILES['foto_asset']['error'] == 0) {
		// 	// Dapatkan data gambar yang diupload
		// 	$config['upload_path'] = './image/';
		// 	$config['allowed_types'] = 'jpg|jpeg|png|gif';
		// 	$config['file_name'] = uniqid() . '.jpg'; // Nama file unik

		// 	// Inisialisasi upload library dengan konfigurasi
		// 	$this->load->library('upload', $config);

		// 	if ($this->upload->do_upload('foto_asset')) {
		// 		$upload_data = $this->upload->data();
		// 		$file_path = $upload_data['full_path'];

		// 		// Simpan path gambar atau proses lebih lanjut sesuai kebutuhan
		// 		echo json_encode(['status' => 'success', 'file' => $file_path]);
		// 	} else {
		// 		echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors()]);
		// 	}
		// } else {
		// 	echo json_encode(['status' => 'error', 'message' => 'No file uploaded.']);
		// }


		$this->load->library('image_lib');
		$config['upload_path'] = 'image/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('foto_asset')) {
			$file_data = $this->upload->data();
			$resize['image_library'] = 'gd2';
			$resize['create_thumb'] = TRUE;
			$resize['maintain_ratio'] = TRUE;
			$resize['quality'] = '60%';
			$resize['width'] = 200;
			$resize['height'] = 200;
			$resize['source_image'] = $file_data['full_path'];
			$this->load->library('image_lib', $resize);
			if (!$this->image_lib->crop()) {
				echo $this->image_lib->display_errors();
			}
		} else {
			echo $this->upload->display_errors('<p>', '</p>');
		}
	}

	function qrcode()
	{
		//membuat qrcode menjadi png

		$kode = $row->kode_asset;
		$nama = $row->nama_asset;
		$path = 'image/';
		$file = $path .  $kode . ".png";
		$text = $kode . '-' . $nama;
		QRcode::png($text, $file);
	}
	public function regis()
	{

		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$email = $this->input->post('email');

		$reg = array(
			'username' => $username,
			'password' => $password,
			'email '   => $email,
		);
		$this->User_model->registrasi($reg);
		$this->session->set_flashdata('pesan', 'Akun anda berhasil dibuat, silahkan login');
		redirect(base_url('login'));
	}

	function delete($id)
	{
		//delete employee record
		$this->db->where('id', $id);
		$this->db->delete('as_msasset');
		redirect('home');
	}
	function logout()
	{
		$this->session->sess_destroy();
		$url = base_url('login');
		redirect($url);
	}
	function autentikasi()
	{

		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$validasi_username = $this->User_model->query_validasi_username($username);
		if ($validasi_username->num_rows() > 0) {
			$validate_ps = $this->User_model->query_validasi_password($password);

			$this->session->set_userdata('logged', TRUE);
			$this->session->set_userdata('users', $username, $password,);
			$x = $validate_ps->row_array();
			$id = $x['id'];
			if ($x['role'] == '1') { //Administrator
				$name = $x['username'];
				$this->session->set_userdata('access', 'Super Admin');
				$this->session->set_userdata('id', $id);
				$this->session->set_userdata('name', $name);
				redirect('home');
			} else if ($x['role'] == '2') { //Admin
				$name = $x['username'];
				$this->session->set_userdata('access', 'Admin');
				$this->session->set_userdata('id', $id);
				$this->session->set_userdata('name', $name);
				redirect('home');
			} else if ($x['role'] == '3') { //User
				$name = $x['username'];
				$this->session->set_userdata('access', 'User');
				$this->session->set_userdata('id', $id);
				$this->session->set_userdata('name', $name);
				redirect('home');
			}
		} else {
			$url = base_url('login');
			echo $this->session->set_flashdata('msg', ' username atau password salah');
			redirect($url);
		}
	}



	function cekstock()
	{

		$data = $this->User_model->cekstock();
		$DATA = array('data' => $data);
		$this->load->view('cekstock', $DATA);
		$this->load->view('layouts/sidebar');
	}

	public function datacekstock()
	{

		$tglstock = $this->input->post('tgl_stock');
		$kode_dept = $this->input->post('kode_dept');
		$kode_asset = $this->input->post('kode_asset');
		$nama_asset = $this->input->post('nama_asset');
		$nourut = $this->input->post('no_urut');
		$jenis_asset = $this->input->post('jenis_asset');
		$kode_transaksi = $this->input->post('kode_transaksi');
		$jenis_transaksi = $this->input->post('jenis_transaksi');
		$masuk = $this->input->post('masuk');
		$keluar = $this->input->post('keluar');
		$sisa = $this->input->post('sisa');
		$satuan = $this->input->post('satuan');
		$hargasatuan = $this->input->post('harga_satuan');
		$hargatotal = $this->input->post('harga_total');
		$keterangan = $this->input->post('keterangan');
		$waktuinput = $this->input->post('waktu_input');
		$user_input = $this->input->post('user_input');

		$data = array(
			'tgl_stock' => $tglstock,
			'kode_dept' => $kode_dept,
			'kode_asset' => $kode_asset,
			'nama_asset' => $nama_asset,
			'no_urut' => $nourut,
			'jenis_asset' => $jenis_asset,
			'kode_transaksi' => $kode_transaksi,
			'jenis_transaksi' => $jenis_transaksi,
			'masuk' => $masuk,
			'keluar' => $keluar,
			'sisa' => $sisa,
			'satuan' => $satuan,
			'keterangan' => $keterangan,
			'harga_satuan' => $hargasatuan,
			'harga_total' => $hargatotal,
			'waktu_input' => $waktuinput,
			'user_input' => $user_input,

		);
		$this->User_model->input_data($data, 'cekstock');
		redirect('Welcome/cekstock');
	}
	public function get_stok($kode_asset)
	{
		$this->db->select('kode_asset, (SUM(sisa) + SUM(masuk) - SUM(keluar)) AS sisastock');
		$this->db->from('cekstock');
		$this->db->where('kode_asset', $kode_asset);
		$this->db->group_by('kode_asset');
		$query = $this->db->get();


		if ($query->num_rows() > 0) {
			return $query->row();  // Mengembalikan data sisa stok
		} else {
			return null;  // Jika data tidak ditemukan
		}
	}
}
