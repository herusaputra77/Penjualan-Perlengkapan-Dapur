

<?php

class Toko extends CI_Controller
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
		$data['judul'] = 'Data Toko';
		$data['penjual'] = $this->db->query("SELECT penjual.* FROM penjual, tb_user WHERE penjual.id_user=tb_user.id_user AND tb_user.id_user='$id' ")->result();
		// $data['toko'] = $this->db->query("SELECT toko.*, penjual.id_penjual, user.id_user, user.username,user.alamat, user.jenis_kelamin, user.nama FROM toko, user, penjual, barang WHERE toko.id_penjual=penjual.id_penjual AND penjual.id_user = user.id_user AND user.id_user='$id'")->result();
		$data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();
		$data['toko'] = $this->db->query("SELECT toko.*,penjual.* FROM toko, penjual WHERE toko.id_penjual=penjual.id_penjual AND penjual.id_user='$id'")->result();
		$data['barang'] = $this->db->get('barang')->row_array();
		$this->load->view('template_penjual/header', $data);
		$this->load->view('template_penjual/sidebar', $data);
		$this->load->view('template_penjual/topbar');
		$this->load->view('penjual/toko', $data);
		$this->load->view('template_penjual/footer');
	}
	public function tambah_toko()
	{
		$id_penjual = $this->input->post('id_penjual');
		$nama_toko = $this->input->post('nama_toko');
		$alamat_toko = $this->input->post('alamat_toko');
		$keterangan = $this->input->post('keterangan');
		$logo = $_FILES['logo']['name'];
		if ($logo) {
			$config['upload_path'] = './assets/logo/';
			$config['allowed_types'] = 'jpg|jpeg|png|';
			$config['max_size'] = '4096';
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('logo')) {
				$logo = $this->upload->data('file_name');
			} else {
				echo $this->upload->display_errors();
			}
		}
		$data = array(
			'id_penjual' => $id_penjual,
			'nama_toko' => $nama_toko,
			'alamat_toko' => $alamat_toko,
			'keterangan' => $keterangan,
			'logo' => $logo
		);
		$this->db->insert('toko', $data);
		redirect('penjual/toko');
	}
	public function edit_toko()
	{
		$id = $this->input->post('id_toko');
		$nama_toko = $this->input->post('nama_toko');
		$alamat_toko = $this->input->post('alamat_toko');
		$keterangan = $this->input->post('keterangan');
		$logo = $_FILES['logo']['name'];
		if ($logo) {
			$config['upload_path'] = './assets/logo/';
			$config['allowed_types'] = 'jpg|jpeg|png|';
			$config['max_size'] = '4096';
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('logo')) {
				$logo = $this->upload->data('file_name');
			} else {
				echo $this->upload->display_errors();
			}
		}
		$where = array('id_toko' => $id);
		$data = array(
			'nama_toko' => $nama_toko,
			'alamat_toko' => $alamat_toko,
			'keterangan' => $keterangan,
			'logo' => $logo
		);
		$this->db->update('toko', $data, $where);
		redirect('penjual/toko');
	}
	public function hapus($id)
	{
		$where = array('id_toko' => $id);
		$this->db->query("DELETE toko.*, barang.* FROM barang, toko WHERE toko.id_toko=barang.id_toko and toko.id_toko = $id ");
		redirect('penjual/toko');
	}
	public function detail($id_toko)
	{
		$id = $this->session->userdata('id_user');
		$data['judul'] = 'Detail Toko';
		$data['penjual'] = $this->db->query("SELECT penjual.* FROM penjual, tb_user WHERE penjual.id_user=tb_user.id_user AND tb_user.id_user='$id' ")->result();
		$data['toko'] = $this->db->query("SELECT toko.*, penjual.id_penjual, tb_user.id_user, tb_user.username,tb_user.alamat, tb_user.jenis_kelamin, tb_user.nama FROM toko, tb_user, penjual WHERE toko.id_penjual=penjual.id_penjual AND penjual.id_user = tb_user.id_user AND tb_user.id_user='$id'")->result();
		$data['detail'] = $this->db->query("SELECT toko.*, penjual.id_penjual, tb_user.id_user, tb_user.username,tb_user.alamat, tb_user.jenis_kelamin, tb_user.nama FROM toko, tb_user, penjual WHERE toko.id_penjual=penjual.id_penjual AND penjual.id_user = tb_user.id_user AND toko.id_toko='$id_toko'")->result();
		$data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();
		$this->load->view('template_penjual/header', $data);
		$this->load->view('template_penjual/sidebar');
		$this->load->view('template_penjual/topbar');
		$this->load->view('penjual/detail_toko', $data);
		$this->load->view('template_penjual/footer');
	}
	public function tampil_barang($id)
	{
		$id_toko = $this->uri->segment(4);
		$id = $this->session->userdata('id_user');
		$data['judul'] = 'Data Barang';
		$data['penjual'] = $this->db->query("SELECT penjual.id_penjual FROM penjual , tb_user WHERE penjual.id_user=tb_user.id_user AND tb_user.id_user='$id'")->row_array();
		$data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();
		// $data['toko'] = $this->db->query("SELECT toko.* FROM toko, penjual , tb_user WHERE toko.id_penjual=penjual.id_penjual AND penjual.id_user=tb_user.id_user AND tb_user.id_user='$id'")->row_array();
		$data['toko'] = $this->db->get_where('toko', ['id_toko' => $id_toko])->row_array();
		$data['barang'] = $this->db->query("SELECT barang.*, tb_barang_toko.*, toko.nama_toko
		FROM barang, tb_barang_toko, toko
		WHERE barang.id_barang=tb_barang_toko.id_barang
		AND tb_barang_toko.id_toko=toko.id_toko
		AND tb_barang_toko.id_toko='$id_toko'")->result();
		$data['satuan'] = $this->db->get('tb_satuan')->result_array();
		$this->load->view('template_penjual/header', $data);
		$this->load->view('template_penjual/sidebar', $data);
		$this->load->view('template_penjual/topbar');
		$this->load->view('penjual/barang_toko', $data);
		$this->load->view('template_penjual/footer');
	}
}
