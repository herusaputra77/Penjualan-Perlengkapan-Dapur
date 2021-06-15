<?php

class M_barang extends CI_Model
{
	public function cari_id($id)
	{
		$result = $this->db->query("SELECT barang.*, toko.nama_toko, toko.id_toko, tb_user.nama as nama_penjual 
		FROM barang, toko, penjual, tb_user, tb_barang_toko
		WHERE barang.id_barang=tb_barang_toko.id_barang AND 
		tb_barang_toko.id_toko=toko.id_toko AND
		tb_barang_toko.id_penjual=penjual.id_penjual AND
		penjual.id_user=tb_user.id_user AND 
		barang.id_barang='$id'");
		if ($result->num_rows() > 0) {
			return $result->row();
		} else {
			return array();
		}
	}
	public function cari_penjual($id)
	{
		$result = $this->db->query("SELECT barang.*, toko.nama_toko, tb_user.nama as nama_penjual FROM barang, toko, penjual, tb_user, tb_barang_toko
		WHERE barang.id_barang=tb_barang_toko.id_barang AND 
		tb_barang_toko.id_penjual=penjual.id_penjual AND
		penjual.id_user=tb_user.id_user AND barang.id_barang='$id' GROUP BY tb_barang_toko.id_penjual HAVING (COUNT(tb_barang_toko.id_penjual) >= 1)");
		if ($result->num_rows() > 0) {
			return $result->row();
		} else {
			return array();
		}
	}
	public function tampil_barang($where)
	{
		$hasil = $this->db->query("SELECT barang.*, tb_barang_toko.* FROM barang, tb_barang_toko 
		WHERE barang.id_barang=tb_barang_toko.id_barang
		AND barang.id_barang='$where'");
		return $hasil->result();
	}
	public function search($keyword)
	{
		$this->db->select('barang.*, tb_barang_toko.id_toko');
		$this->db->from('barang');
		$this->db->join('tb_barang_toko', 'barang.id_barang = tb_barang_toko.id_barang');

		$this->db->like('nama_barang', $keyword);
		$this->db->or_like('harga', $keyword);
		return $this->db->get()->result();
	}

	public function tambah_barang()
	{
		$id_toko = $this->input->post('toko');
		$id_penjual = $this->input->post('id_penjual');
		$nama_barang = $this->input->post('nama_barang');
		$jumlah = $this->input->post('jumlah');
		$harga = $this->input->post('harga');
		$satuan = $this->input->post('satuan');
		$gambar1 = $this->input->post('gambar');
		$gambar = $_FILES['gambar']['name'];
		if ($gambar != null) {
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['upload_path']   = './assets/barang/';
			$config['max_size'] = '4096';
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('gambar')) {
				$gambar = $this->upload->data('file_name');
			} else {
				echo $this->upload->display_errors();
			}
		} elseif ($gambar1) {
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['upload_path']   = './assets/barang/';
			$config['max_size'] = '4096';

			$this->load->library('upload', $config);
			if ($this->upload->do_upload('gambar')) {
				$gambar1 = $this->upload->data('file_name');
			} else {
				echo $this->upload->display_errors();
			}
		}
		$data1 = array(
			'nama_barang' => $nama_barang,
			'satuan' => $satuan,
			'jumlah' => $jumlah,
			'harga' => $harga,
			'gambar' => $gambar
		);

		$hasil1 = $this->db->insert('barang', $data1);
		if ($hasil1 == true) {
			$id_barang = $this->db->insert_id();
			$data2 = array(
				'id_barang' => $id_barang,
				'id_toko' => $id_toko,
				'id_penjual' => $id_penjual
			);
			$this->db->insert('tb_barang_toko', $data2);
		}
	}
	public function cari_toko($toko)
	{
		$id_faktur = $this->uri->segment(4);
		$id = $this->session->userdata('id_user');
		$result = $this->db->query("SELECT tb_order.*, toko.nama_toko, barang.gambar
		FROM barang, tb_order, tb_faktur , toko 
		WHERE tb_order.id_barang=barang.id_barang 
		AND tb_order.id_faktur=tb_faktur.id_faktur 
		AND tb_order.id_toko=toko.id_toko 
		AND tb_faktur.id_user='$id' 
		AND tb_faktur.id_faktur='$id_faktur'
		AND toko.id_toko='$toko' 
		ORDER BY toko.nama_toko ASC ");
		if ($result->num_rows() > 0) {
			return $result->result_array();
		} else {
			return array();
		}
	}
	public function pengiriman($toko)
	{
		$id_faktur = $this->uri->segment(4);
		$id = $this->session->userdata('id_user');
		$result = $this->db->query("SELECT tb_order.*, toko.nama_toko, barang.gambar
		FROM barang, tb_order, tb_faktur , toko 
		WHERE tb_order.id_barang=barang.id_barang 
		AND tb_order.id_faktur=tb_faktur.id_faktur 
		AND tb_order.id_toko=toko.id_toko 
		AND tb_faktur.id_user='$id' 
		AND tb_faktur.id_faktur='$id_faktur'
		AND toko.id_toko='$toko' 
		ORDER BY toko.nama_toko ASC ");
		if ($result->num_rows() > 0) {
			return $result->row_array();
		} else {
			return array();
		}
	}
	// public function cari_id_brg($id)
	// {
	// 	$result = $this->db->where('id_barang', $id)
	// 						->get('barang');
	// 	if($result->num_rows() > 0){
	// 		return $result->row();
	// 	}else{
	// 		return array();
	// 	}
	// }
}
