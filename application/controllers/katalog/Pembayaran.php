<?php

class Pembayaran extends CI_Controller
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
		$data['metode'] = $this->db->get('tb_metode')->result_array();
		$id = $this->session->userdata('id_user');
		$data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();
		$this->load->view('katalog/header');
		$this->load->view('katalog/navbar', $data);
		$this->load->view('katalog/pembayaran', $data);
		$this->load->view('katalog/footer');
	}
	public function simpan_bayar()
	{
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		if ($this->form_validation->run() == false) {
			$this->index();
		} else {

			$proses = $this->M_invoice->bayar();
			if ($proses) {
				$this->cart->destroy();
				redirect('katalog/pembayaran/pesanan');
			} else {
				echo "Maaf, pesan anda gagal diproses";
			}
		}
	}
	public function pesanan()
	{
		$id = $this->session->userdata('id_user');
		$data['pesanan'] = $this->db->query("SELECT tb_faktur.*, tb_user.nama, tb_metode.metode
		FROM tb_faktur , tb_user, tb_metode
		WHERE tb_faktur.id_user=tb_user.id_user 
		AND tb_faktur.metode_bayar=tb_metode.id_metode
		AND tb_faktur.id_user='$id'
        AND tb_faktur.status_bayar <'2'
        ")->result_array();
		$data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();
		$this->load->view('katalog/header');
		$this->load->view('katalog/navbar', $data);
		$this->load->view('katalog/pesanan', $data);
		$this->load->view('katalog/footer');
	}
	public function bukti_pembayaran($id_faktur)
	{
		$id = $this->session->userdata('id_user');
		$data['bukti'] = $this->db->query("SELECT tb_faktur.*, tb_user.nama FROM tb_faktur , tb_user
		WHERE tb_faktur.id_user=tb_user.id_user AND tb_faktur.id_faktur='$id_faktur'")->row_array();
		$data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();
		$this->load->view('katalog/header');
		$this->load->view('katalog/navbar', $data);
		$this->load->view('katalog/bukti_pembayaran', $data);
		$this->load->view('katalog/footer');
	}

	public function simpan_bukti()
	{
		$id_faktur = $this->input->post('id_faktur');

		$id = $this->session->userdata('id_user');
		$bukti_pembayaran		= $_FILES['bukti_pembayaran']['name'];
		if ($bukti_pembayaran = '') {
		} else {
			$config['upload_path'] = './assets/bukti_pembayaran';
			$config['allowed_types'] = 'jpg|gif|png|jpeg|pdf';
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('bukti_pembayaran')) {
				echo "Gambar gagal diupload!";
			} else {
				$bukti_pembayaran = $this->upload->data('file_name');
			}
		}
		$this->db->set('status_bayar', '1');
		$this->db->set('bukti_pembayaran', $bukti_pembayaran);
		$this->db->where('id_faktur', $id_faktur);
		$this->db->update('tb_faktur');
		redirect('katalog/pembayaran/pesanan');
	}
	public function detail_bayar($id_faktur)
	{
		$id = $this->session->userdata('id_user');
		$data['nama_toko'] = $this->db->query("SELECT tb_order.*, barang.gambar, tb_faktur.* , toko.nama_toko
		FROM barang, tb_order, tb_faktur , toko
		WHERE tb_order.id_barang=barang.id_barang 
		AND tb_order.id_faktur=tb_faktur.id_faktur 
        and tb_order.id_toko=toko.id_toko
		AND tb_faktur.id_user='$id' 
		AND tb_faktur.id_faktur='$id_faktur'
		group by (tb_order.id_toko)
		HAVING(COUNT(toko.nama_toko)>=1)
		ORDER BY toko.nama_toko ASC")->result_array();
		$data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();
		$data['pesanan'] = $this->db->query("SELECT tb_faktur.*, tb_user.nama, tb_order.jumlah, tb_faktur.ongkir, SUM(tb_order.jumlah*tb_faktur.ongkir) as total_ongkir
		FROM tb_user, tb_order, tb_faktur
				WHERE tb_faktur.id_user=tb_user.id_user 
				AND tb_order.id_faktur=tb_faktur.id_faktur
				AND tb_faktur.id_user='$id'
				AND tb_faktur.id_faktur ='$id_faktur'")->row_array();
		$this->load->view('katalog/header');
		$this->load->view('katalog/navbar', $data);
		$this->load->view('katalog/detail_bayar', $data);
		$this->load->view('katalog/footer');
	}
	public function hapus_bayar($id_faktur)
	{
		$tabel = array('tb_faktur	', 'tb_order');
		$this->db->where('id_faktur', $id_faktur);
		$this->db->delete($tabel);
		redirect('katalog/pembayaran/pesanan');
	}
	public function riwayat()
	{
		$id = $this->session->userdata('id_user');
		$data['pesanan'] = $this->db->query("SELECT tb_faktur.*, tb_user.nama, tb_metode.metode
		FROM tb_faktur , tb_user, tb_metode
		WHERE tb_faktur.id_user=tb_user.id_user 
		AND tb_faktur.metode_bayar=tb_metode.id_metode
		AND tb_faktur.id_user='$id'
        AND tb_faktur.status_bayar='2'")->result_array();
		$data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();
		$this->load->view('katalog/header');
		$this->load->view('katalog/navbar', $data);
		$this->load->view('katalog/riwayat', $data);
		$this->load->view('katalog/footer');
	}
	public function cetak_faktur($id_faktur)
	{
		$id = $this->session->userdata('id_user');
		$data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();
		$this->load->library('dompdf_gen');
		$data['bayar'] = $this->db->query("SELECT tb_order.*, barang.gambar, tb_faktur.* , toko.nama_toko
		FROM barang, tb_order, tb_faktur , toko
		WHERE tb_order.id_barang=barang.id_barang 
		AND tb_order.id_faktur=tb_faktur.id_faktur 
        and tb_order.id_toko=toko.id_toko
		AND tb_faktur.id_user='$id' 
		AND tb_faktur.id_faktur='$id_faktur
		group by (tb_order.id_toko)'")->result_array();
		$data['pesanan'] = $this->db->query("SELECT tb_faktur.*, tb_user.nama, tb_order.jumlah, tb_faktur.ongkir, SUM(tb_order.jumlah*tb_faktur.ongkir) as total_ongkir
		FROM tb_user, tb_order, tb_faktur
				WHERE tb_faktur.id_user=tb_user.id_user 
				AND tb_order.id_faktur=tb_faktur.id_faktur
				AND tb_faktur.id_user='$id'
				AND tb_faktur.id_faktur ='$id_faktur'")->row_array();

		$this->load->view('katalog/faktur', $data, FALSE);

		// Get output html
		$html = $this->output->get_output();
		$jenis_kertas = 'A4';
		$orientation = 'potrait';
		$this->dompdf->set_paper($jenis_kertas, $orientation);
		$filename = "laporan_faktur" . date("d-m-Y-H-i-s") . '.pdf';

		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream($filename, array('Attachment' => 0));
	}
}
