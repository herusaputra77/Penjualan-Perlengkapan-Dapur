<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
		$id = $this->session->userdata('id_user');
		$data['user1'] = $this->M_invoice->user();
		$data['toko'] = $this->M_invoice->toko();
		$data['barang'] = $this->M_invoice->barang();
		$data['transaksi'] = $this->M_invoice->transaksi();
		$data['judul'] = 'Dashboard';
		$data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar', $data);
		$this->load->view('template_admin/topbar', $data);
		$this->load->view('admin/dashboard');
		$this->load->view('template_admin/footer');
	}
}
