<?php
class Keranjang extends CI_Controller
{

	// versi 1
	// public function tambah_keranjang($id)
	// {

	// 	$barang = $this->m_barang->cari_id($id);
	// 	$data= array(
	// 		'id' => $barang->id_barang,
	// 		'qty' => 1,
	// 		'price' => $barang->harga,
	// 		'name' => $barang->nama_barang,
	// 	);
	// 	$this->cart->insert($data);
	// 	redirect('dashboard');
	// }
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('id_role') != '3') {
			$this->session->set_flashdata('login', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						 Anda Belum Login!!
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>');
			redirect('auth/login');
		}
	}
	public function index()
	{
		if (empty($this->cart->contents())) {
		}
		$id = $this->session->userdata('id_user');
		$data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();
		$this->load->view('katalog/header');
		$this->load->view('katalog/navbar', $data);
		$this->load->view('katalog/keranjang', $data);
		$this->load->view('katalog/footer');
	}
	public function tambah_keranjang()

	{
		$redirect_page = $this->input->post('redirect_page');

		$data = 		[
			'id' => $this->input->post('id'),
			'qty' => $this->input->post('qty'),
			'price' => $this->input->post('price'),
			'name' => $this->input->post('name'),
			'options' => $this->input->post('id_toko')
		];
		$this->cart->insert($data);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Sudah Masuk ke Keranjang!</div>');
		redirect($redirect_page, 'refresh');
	}
	public function delete($id)
	{
		$this->cart->remove($id);
		redirect('katalog/keranjang/');
	}
	public function hapus_keranjang()
	{
		$this->cart->destroy();
		redirect('katalog/keranjang');
	}
	public function update()
	{
		$i = 1;
		foreach ($this->cart->contents() as $items) {
			$data = array(
				'rowid' => $items['rowid'],
				'qty' => $this->input->post($i . '[qty]')
			);
			$this->cart->update($data);
			$i++;
		}
		redirect('katalog/keranjang/');
	}
}
