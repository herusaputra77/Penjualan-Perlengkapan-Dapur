<?php

class Toko extends CI_Controller
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
	public function index($id)
	{
		$where = array('id_toko' => $id);
		$data['toko'] = $this->db->get_where('toko', $where)->row_array();
		$data['penjual'] = $this->db->query("SELECT toko.*, tb_user.nama, tb_user.no_hp
		 FROM toko, tb_user, penjual 
		 WHERE toko.id_penjual=penjual.id_penjual 
		 AND penjual.id_user=tb_user.id_user 
		 AND toko.id_toko='$id'")->row_array();
		$data['barang'] = $this->db->query("SELECT barang.* 
		FROM barang, toko, tb_barang_toko
		WHERE barang.id_barang=tb_barang_toko.id_barang
		AND tb_barang_toko.id_toko=toko.id_toko 
		AND toko.id_toko='$id'")->result_array();
		$this->load->view('katalog/template/header2');
		$this->load->view('katalog/template/navbar');
		$this->load->view('katalog/toko', $data);
		$this->load->view('katalog/template/footer2');
	}
}
