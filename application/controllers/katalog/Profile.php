<?php

class Profile extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('id_role') != '3') {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						 Anda Belum Login Sebagai Pembeli!!
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
		$data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();
		$this->load->view('katalog/header');
		$this->load->view('katalog/navbar', $data);
		$this->load->view('katalog/profile');
		$this->load->view('katalog/footer');
	}
	public function edit_profile()
	{

		$id = $this->session->userdata('id_user');
		$data['judul'] = 'Edit Profile';
		$data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('katalog/header');
			$this->load->view('katalog/navbar', $data);
			$this->load->view('katalog/edit_profile');
			$this->load->view('katalog/footer');
		} else {
			$nama = $this->input->post('nama');
			$email = $this->input->post('email');
			$username = $this->input->post('username');
			$alamat = $this->input->post('alamat');
			$no_hp = $this->input->post('no_hp');

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
			$this->db->set('alamat', $alamat);
			$this->db->set('no_hp', $no_hp);
			$this->db->where('email', $email);
			$this->db->update('tb_user');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
			redirect('katalog/profile');
		}
	}
}
