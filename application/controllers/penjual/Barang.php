<?php

class Barang extends CI_Controller
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
		$data['judul'] = 'Data Barang';
		$data['penjual'] = $this->db->query("SELECT penjual.id_penjual FROM penjual , tb_user WHERE penjual.id_user=tb_user.id_user AND tb_user.id_user='$id'")->row();
		$data['satuan'] = $this->db->get('tb_satuan')->result_array();
		$data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();
		$data['toko'] = $this->db->query("SELECT toko.* FROM toko, penjual , tb_user WHERE toko.id_penjual=penjual.id_penjual AND penjual.id_user=tb_user.id_user AND tb_user.id_user='$id'")->result();
		$data['barang'] = $this->db->query("SELECT barang.*, toko.id_toko, toko.nama_toko, tb_user.id_user, tb_user.username,tb_user.nama, toko.alamat_toko 
		FROM barang, toko, penjual, tb_user, tb_barang_toko
		WHERE barang.id_barang=tb_barang_toko.id_barang 
		AND tb_barang_toko.id_penjual=penjual.id_penjual
		AND tb_barang_toko.id_toko=toko.id_toko
		AND penjual.id_user=tb_user.id_user AND tb_user.id_user='$id'")->result();
		$data['edit_brg'] = $this->db->get('barang')->row_array();
		$this->load->view('template_penjual/header', $data);
		$this->load->view('template_penjual/sidebar', $data);
		$this->load->view('template_penjual/topbar');
		$this->load->view('penjual/barang', $data);
		$this->load->view('template_penjual/footer');
	}
	public function tambah_barang()
	{
		$redirect = $this->input->post('redirect');
		$proses = $this->M_barang->tambah_barang();

		$this->session->set_flashdata('pesan', '<div class="alert alert-success">Data Berhasil di tambah</div>');
		redirect($redirect);
	}
	public function hapus($id)
	{
		$where = array('id_barang' => $id);
		$this->db->query("DELETE barang.*, tb_barang_toko.* 
		FROM barang, tb_barang_toko
		WHERE barang.id_barang=tb_barang_toko.id_barang
		AND barang.id_barang='$id'");
		redirect('penjual/barang');
	}
	public function edit_barang()
	{
		$id = $this->session->userdata('id_user');
		$data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();
		$barang = $this->uri->segment(4);
		$redirect = $this->input->post('redirect');
		$id_barang = $this->input->post('id_barang');
		$nama_barang = $this->input->post('nama_barang');
		$satuan = $this->input->post('satuan');
		$jumlah = $this->input->post('jumlah');
		$harga = $this->input->post('harga');
		$gambar = $_FILES['gambar']['name'];
		if ($gambar) {
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']      = '2048';
			$config['upload_path'] = './assets/barang/';

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('gambar')) {
				$old_image = $data['barang']['gambar'];
				if ($old_image != 'user.png') {
					unlink(FCPATH . 'assets/barang/' . $old_image);
				}
				$new_image = $this->upload->data('file_name');
				$this->db->set('gambar', $new_image);
			} else {
				echo $this->upload->display_errors();
			}
		}
		$data = array(
			'nama_barang' => $nama_barang,
			'satuan' => $satuan,
			'jumlah' => $jumlah,
			'harga' => $harga
		);
		$this->db->set($data);
		$this->db->where('id_barang', $id_barang);
		$this->db->update('barang');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success">Data Berhasil di ubah</div>');
		redirect($redirect, 'refresh');
	}
}
