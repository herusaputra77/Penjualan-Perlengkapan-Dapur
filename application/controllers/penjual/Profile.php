<?php

class Profile extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('id_role') != '2') {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						 Anda Belum Login Sebagai Penjual!!
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>');
			redirect('auth/login');
		}
	}
	public function index()
	{
		$id = $this->session->userdata('id_user');
		$data['judul'] = 'My Profile';
		$data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();

		$this->load->view('template_penjual/header', $data);
		$this->load->view('template_penjual/sidebar', $data);
		$this->load->view('template_penjual/topbar');
		$this->load->view('penjual/profile');
		$this->load->view('template_penjual/footer');
	}
	public function edit_profile()
	{

		$id = $this->session->userdata('id_user');
		$data['judul'] = 'Edit Profile';
		$data['penjual'] = $this->db->get_where('tb_user', $id)->row();
		$data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();
		$data['toko'] = $this->db->query("SELECT toko.*, tb_user.*, penjual.id_penjual FROM toko, tb_user, penjual WHERE toko.id_penjual=penjual.id_penjual AND penjual.id_user = tb_user.id_user AND tb_user.id_user='$id'")->result();
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		if ($this->form_validation->run() == FALSE) {

			$this->load->view('template_penjual/header', $data);
			$this->load->view('template_penjual/sidebar', $data);
			$this->load->view('template_penjual/topbar');
			$this->load->view('penjual/edit_profile');
			$this->load->view('template_penjual/footer');
		} else {
			$nama = $this->input->post('nama');
			$email = $this->input->post('email');
			$username = $this->input->post('username');

			$upload_image = $_FILES['image']['name'];

			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']      = '2048';
				$config['upload_path'] = './assets/user/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$old_image = $data['user']['image'];
					if ($old_image != 'user.png') {
						unlink(FCPATH . 'assets/user/' . $old_image);
					}
					$new_image = $this->upload->data('file_name');
					$this->db->set('image', $new_image);
				} else {
					echo $this->upload->display_errors();
				}
			}

			$this->db->set('nama', $nama);
			$this->db->set('username', $username);
			$this->db->where('email', $email);
			$this->db->update('tb_user');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
			redirect('penjual/profile');
		}
	}

	public function ganti_password()
	{
		$id = $this->session->userdata('id_user');
		$data['judul'] = 'Ganti Password';
		$data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();

		$this->load->view('template_penjual/header', $data);
		$this->load->view('template_penjual/sidebar', $data);
		$this->load->view('template_penjual/topbar');
		$this->load->view('penjual/ganti_password');
		$this->load->view('template_penjual/footer');
	}
	public function ganti_password_aksi()
	{
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		$this->form_validation->set_rules('password_baru', 'Password', 'required|trim|min_length[3]|matches[ulangi_password]');
		$this->form_validation->set_rules('ulangi_password', 'Ulangi Password', 'required|trim|min_length[3]|matches[password_baru]');
		if ($this->form_validation->run() == FALSE) {
			$this->ganti_password();
		} else {

			$password = $this->input->post('password');
			$password_baru = $this->input->post('password_baru');
			if ($password != $data = ['user']['password']) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
				redirect('penjual/profile/ganti_password');
			} else {
				if ($password == $password_baru) {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
					redirect('penjual/profile/ganti_password');
				} else {
					// password sudah ok
					$password_hash = password_hash($password_baru, PASSWORD_DEFAULT);


					$this->db->set('password', $password_hash);
					$this->db->where('email', $this->session->userdata('id_user'));
					$this->db->update('user');

					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
					redirect('penjual/profile/ganti_password');
				}
			}
		}
	}
}
