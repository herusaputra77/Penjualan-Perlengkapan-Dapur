<?php

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function login()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		if ($this->form_validation->run() == FALSE) {

			$this->load->view('auth');
		} else {
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			// $auth = $this->M_auth->cek_login($email, $password);
			$auth = $this->M_auth->cek_login();
			if ($auth == FALSE) {
				$this->session->set_flashdata('login', '<div class="alert alert-danger">Username atau Password Salah</div>');
				redirect('auth/login/');
			} else {
				$this->session->set_userdata('email', $auth->email);
				$this->session->set_userdata('id_role', $auth->id_role);
				$this->session->set_userdata('nama', $auth->nama);
				$this->session->set_userdata('id_user', $auth->id_user);
				$this->session->set_userdata('username', $auth->username);

				switch ($auth->id_role) {
					case 1:
						redirect('admin/dashboard');
						# code...
						break;
					case 2:
						redirect('penjual/dashboard');
						# code...
						break;
					case 3:
						redirect('dashboard');
						# code...
						break;
				}
				$this->session->set_flashdata('pesan', '<div class="alert alert-success">Selamat Datang</div>');
			}
		}
	}
	public function register()
	{
		$this->_rules();
		if ($this->form_validation->run() == false) {
			$this->load->view('register');
		} else {
			$email = $this->input->post('email');
			$username = $this->input->post('username');
			$nama = $this->input->post('nama');
			$alamat = $this->input->post('alamat');
			$no_hp = $this->input->post('no_hp');
			$password = $this->input->post('password1');
			$gender = $this->input->post('gender');

			$data = array(
				'id_role' => '3',
				'username' => $username,
				'email' => $email,
				// 'password' => password_hash($password, PASSWORD_DEFAULT),
				'password' => $password,
				'nama' => $nama,
				'jenis_kelamin' => $gender,
				'alamat' => $alamat,
				'no_hp' => $no_hp,
				'image' => 'user.png',
				'tgl_buat' => time()

			);
			$this->db->insert('tb_user', $data);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success">Akun anda telah terdaftar, silahkan login!</div>');
			redirect('auth/login');
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('id_user');
		$this->cart->destroy();
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
		redirect('dashboard');
	}
	public function reg_penjual()
	{
		$this->_rules();
		if ($this->form_validation->run() == false) {
			$this->load->view('reg_penjual');
		} else {
			$proses = $this->M_auth->tambah_penjual();
			if ($proses	 == true) {
				$this->session->set_flashdata('pesan', '<div class="alert alert-success">Akun anda telah terdaftar, silahkan login!</div>');
				redirect('auth/login');
			} else {
				echo "Maaf, pesan anda gagal diproses";
			}
		}
	}
	public function _rules()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim');
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
			'matches' => 'Password dont match!',
			'min_length' => 'Password too short!'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
		$this->form_validation->set_rules('no_hp', 'No Hp', 'required|trim');
		$this->form_validation->set_rules('gender', 'Gender', 'required|trim');
	}
	public function toko()
	{
		echo "toko";
	}
}
