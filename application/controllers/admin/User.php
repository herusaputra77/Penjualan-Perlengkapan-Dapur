<?php

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('id_role') != '1') {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						 Anda Belum Login Sebagai Admin!!
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>');
			redirect('auth/login');
		}
	}
	public function index()
	{
		$data['judul'] = 'Data User';
		$data['role'] = $this->db->get('role')->result();
		$data['user1'] = $this->db->query("SELECT * FROM tb_user, role WHERE tb_user.id_role=role.id_role")->result();
		$id = $this->session->userdata('id_user');
		$data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar', $data);
		$this->load->view('template_admin/topbar');
		$this->load->view('admin/user', $data);
		$this->load->view('template_admin/footer');
	}
	public function edit_user()
	{
		$role = $this->input->post('role');
		$id_user = $this->input->post('id_user');
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$gender = $this->input->post('gender');
		$where = array('id_user' => $id_user);

		$data = array(
			'id_role' => $role,
			'nama' => $nama,
			'username' => $username,
			'jenis_kelamin' => $gender
		);
		$this->db->update('tb_user', $data, $where);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success">Data Berhasil di ubah</div>');
		redirect('admin/user/');
	}
	public function hapus($id)
	{
		$where = array('id_user' => $id);
		$this->db->delete('tb_user', $where);
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						 Data Berhasil Dihapus!!!
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>');
		redirect('admin/user');
	}
	public function detail()
	{
		$id_user = $this->uri->segment(4);
		$id = $this->session->userdata('id_user');
		$data['judul'] = 'Data User';
		$data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();
		$data['role'] = $this->db->get('role')->result();
		$data['detail'] = $this->db->get_where('tb_user', array('id_user' => $id_user))->row_array();
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar', $data);
		$this->load->view('template_admin/topbar');
		$this->load->view('admin/detail_user', $data);
		$this->load->view('template_admin/footer');
	}
}
