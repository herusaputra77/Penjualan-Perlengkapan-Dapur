<?php

class Dashboard extends CI_Controller
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
		$data['judul'] = 'Dashboard';
		$id = $this->session->userdata('id_user');
		$data['toko'] = $this->db->query("SELECT toko.*, tb_user.*, penjual.id_penjual FROM toko, tb_user, penjual WHERE toko.id_penjual=penjual.id_penjual AND penjual.id_user = tb_user.id_user AND tb_user.id_user='$id'")->result();
		// $data['penjual'] = $this->db->get('penjual')->result();
		$data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();
		$this->load->view('template_penjual/header', $data);
		$this->load->view('template_penjual/sidebar', $data);
		$this->load->view('template_penjual/topbar');
		$this->load->view('penjual/dashboard');
		$this->load->view('template_penjual/footer');
	}
}
