<?php

class Dashboard extends CI_Controller
{

	public function index()
	{
		$id = $this->session->userdata('id_user');
		// $data['user'] = $this->db->get_where('user', array('id_user' => $id))->row_array();
		$data['barang'] = $this->db->query("SELECT barang.*, tb_barang_toko.id_toko 
		FROM barang, tb_barang_toko 
		WHERE barang.id_barang=tb_barang_toko.id_barang")->result();
		$this->load->view('katalog/header');
		$this->load->view('katalog/navbar', $data);
		$this->load->view('katalog/sidebar2');
		$this->load->view('katalog/sidebar');
		$this->load->view('katalog/dashboard', $data);
		$this->load->view('katalog/footer');
	}
	public function detail($id)
	{
		$id_user = $this->session->userdata('id_user');
		$data['user'] = $this->db->get_where('tb_user', array('id_user' => $id_user))->row_array();
		$where = array('id_barang' => $id);
		$data['barang'] = $this->M_barang->tampil_barang($id);
		$data['komentar'] = $this->db->query("SELECT komentar.*, tb_user.nama FROM komentar, tb_user WHERE komentar.id_user=tb_user.id_user AND komentar.id_barang='$id'")->result_array();
		$this->load->view('katalog/template/header2');
		$this->load->view('katalog/template/navbar');
		$this->load->view('katalog/detail', $data);
		$this->load->view('katalog/template/footer2');
	}
	public function tambah_komen()
	{
		if ($this->session->userdata('id_role') != '3') {
			$this->session->set_flashdata('login', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						 Anda Belum Login!!
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>');
			redirect('auth/login');
		}
		$this->form_validation->set_rules('komentar', 'Komentar', 'required|trim');
		$redirect_page = $this->input->post('redirect_page', true);
		if ($this->form_validation->run() == FALSE) {
			redirect($redirect_page, 'refresh');
		} else {

			$id_barang = $this->input->post('id_barang', true);
			$id_user = $this->input->post('id_user', true);
			$komentar = $this->input->post('komentar', true);

			$data = array(
				'id_barang' => $id_barang,
				'id_user' => $id_user,
				'komentar' => $komentar
			);
			$this->db->insert('komentar', $data);
			redirect($redirect_page);
		}
	}
	public function search()
	{
		$keyword = $this->input->post('keyword');
		$data['barang'] = $this->M_barang->search($keyword);
		$this->load->view('katalog/header');
		$this->load->view('katalog/navbar', $data);
		$this->load->view('katalog/sidebar2');
		$this->load->view('katalog/sidebar');
		$this->load->view('katalog/dashboard', $data);
		$this->load->view('katalog/footer');
	}
}
