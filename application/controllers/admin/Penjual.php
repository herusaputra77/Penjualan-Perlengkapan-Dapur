<?php

class Penjual extends CI_Controller
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
		$data['judul'] = 'Form Penjual';
		$id = $this->session->userdata('id_user');
		$data['penjual'] = $this->db->get_where('tb_user', ['id_role' => 2])->result();
		$data['validasi'] = $this->db->get_where('penjual', ['id_user' => $id])->result();
		$data['judul'] = 'Data Penjual';
		$data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar', $data);
		$this->load->view('template_admin/topbar');
		$this->load->view('admin/d_penjual', $data);
		$this->load->view('template_admin/footer');
	}
	public function toko()
	{
		$data['judul'] = 'Form Toko';
		$data['toko'] = $this->db->query("SELECT toko.*, penjual.id_penjual, tb_user.jenis_kelamin, tb_user.nama, tb_user.alamat FROM toko, penjual, tb_user WHERE toko.id_penjual=penjual.id_penjual AND penjual.id_user=tb_user.id_user")->result();
		$data['judul'] = 'Data Toko';
		$id = $this->session->userdata('id_user');
		$data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar', $data);
		$this->load->view('template_admin/topbar', $data);
		$this->load->view('admin/d_toko', $data);
		$this->load->view('template_admin/footer');
	}
	public function hapus($id)
	{
		$where = array('id_toko' => $id);
		$this->db->query("DELETE penjual.*, toko.* FROM penjual, toko WHERE penjual.id_penjual and toko.id_penjual = $id ");
		redirect('admin/penjual');
	}
	public function edit($id)
	{
	}
	public function detail_penjual()
	{
		$data['judul'] = 'Form Detail Penjual';
		$id = $this->session->userdata('id_user');
		$data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();
		$data['penjual'] = $this->db->get_where('tb_user', array('id_role' => 2))->result();
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar', $data);
		$this->load->view('template_admin/topbar', $data);
		$this->load->view('admin/detail_penjual', $data);
		$this->load->view('template_admin/footer');
		var_dump($data['penjual']);
	}
	public function detail($id)
	{
		$data['judul'] = 'Form Detail Toko';
		$data['toko'] = $this->db->query("SELECT toko.*, penjual.id_penjual, tb_user.jenis_kelamin, tb_user.nama, tb_user.alamat FROM toko, penjual, tb_user WHERE toko.id_penjual=penjual.id_penjual AND penjual.id_user=tb_user.id_user AND toko.id_toko='$id'")->result();
		$id = $this->session->userdata('id_user');
		$data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar', $data);
		$this->load->view('template_admin/topbar', $data);
		$this->load->view('admin/detail_toko', $data);
		$this->load->view('template_admin/footer');
	}
	public function hapus_toko($id)
	{
		$where = array('id_toko' => $id);
		$this->m_penjual->hapus($where, 'toko');
		redirect('admin/penjual/toko');
	}
	public function validasi($id)
	{
		$id_user = array('id_user' => $id);
		$this->db->insert('penjual', $id_user);
		redirect('admin/penjual');
	}
	public function pemesanan()
	{
		$data['judul'] = 'Pesanan';
		$data['ket'] = 'Semua Data Transaksi';
		$id = $this->session->userdata('id_user');
		$data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();
		$data['pesanan'] = $this->M_invoice->tampil_order();
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar', $data);
		$this->load->view('template_admin/topbar', $data);
		$this->load->view('admin/pesanan', $data);
		$this->load->view('template_admin/footer');
	}
	public function detail_pesanan($id)
	{
		$data['judul'] = 'Detail Pesanan';

		$id_faktur = array('id_faktur' => $id);
		$data['toko'] = $this->M_invoice->cari_toko();
		$data['detail_pesanan'] = $this->db->query("SELECT tb_order.id_toko, tb_order.id_faktur, toko.nama_toko , toko.alamat_toko, toko.keterangan
		FROM tb_order, toko
		WHERE tb_order.id_toko=toko.id_toko
		AND tb_order.id_faktur='$id'")->result_array();
		$id_user = $this->session->userdata('id_user');
		$data['user'] = $this->db->get_where('tb_user', array('id_user' => $id_user))->row_array();
		// $data['barang'] = $this->db->query("SELECT tb_order.*, toko.id_toko, toko.nama_toko, toko.alamat_toko , tb_faktur.ongkir, tb_order.harga*tb_order.jumlah as total, tb_faktur.ongkir*tb_order.jumlah as total_ongkir,(tb_order.harga*tb_order.jumlah)+( tb_faktur.ongkir*tb_order.jumlah) as total_pesanan
		// FROM tb_order, toko, barang, tb_faktur WHERE
		// 		tb_order.id_barang=barang.id_barang AND tb_order.id_faktur=tb_faktur.id_faktur AND barang.id_toko=toko.id_toko AND tb_order.id_faktur='$id' AND barang.id_toko='$id_toko'")->result_array();


		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar', $data);
		$this->load->view('template_admin/topbar', $data);
		$this->load->view('admin/detail_pesanan', $data);
		$this->load->view('template_admin/footer');
	}
	public function detail_barang()
	{
		$data['judul'] = 'Detail Barang';
		$id_toko = $this->input->post('id_toko');
		$id_faktur = $this->input->post('id_faktur');
		$data['barang'] = $this->db->query("SELECT tb_order.*, tb_faktur.ongkir, tb_order.harga*tb_order.jumlah as total, tb_faktur.ongkir*tb_order.jumlah as total_ongkir,(tb_order.harga*tb_order.jumlah)+( tb_faktur.ongkir*tb_order.jumlah) as total_pesanan
		FROM tb_order, tb_faktur
		WHERE tb_order.id_faktur=tb_faktur.id_faktur
		AND tb_order.id_toko='$id_toko'
		AND tb_order.id_faktur='$id_faktur'")->result_array();

		$data['total_pesanan'] = $this->db->query("SELECT tb_faktur.ongkir, tb_order.nama_brg, SUM(tb_order.jumlah*tb_order.harga) as total, SUM(tb_faktur.ongkir*tb_order.jumlah)as ongkir, SUM(tb_order.jumlah*tb_order.harga + tb_order.jumlah*tb_faktur.ongkir)as total_pesanan
        FROM tb_faktur, tb_order
        WHERE tb_faktur.id_faktur=tb_order.id_faktur
        AND tb_faktur.id_faktur='$id_faktur'
        AND tb_order.id_toko='$id_toko'")->row_array();
		$id_user = $this->session->userdata('id_user');
		$data['user'] = $this->db->get_where('tb_user', array('id_user' => $id_user))->row_array();

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar', $data);
		$this->load->view('template_admin/topbar', $data);
		$this->load->view('admin/detail_barang', $data);
		$this->load->view('template_admin/footer');
	}
	public function validasi_pembayaran($id)
	{
		$this->db->set('status_bayar', '2');
		$this->db->where('id_faktur', $id);
		$this->db->update('tb_faktur');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
						 Data berhasil diubah!!
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>');
		redirect('admin/penjual/pemesanan');
	}
	public function cetak_faktur()
	{
		$id_toko = $this->input->post('id_toko');
		$id_faktur = $this->input->post('id_faktur');
		$this->load->library('dompdf_gen');
		$data['toko'] = $this->db->query("SELECT tb_faktur.id_faktur, tb_faktur.tgl_order, toko.id_toko, toko.nama_toko, toko.alamat_toko , tb_user.nama, tb_user.no_hp, tb_faktur.alamat, tb_metode.metode,  tb_faktur.ongkir, tb_order.harga*tb_order.jumlah as total, tb_faktur.ongkir*tb_order.jumlah as total_ongkir,(tb_order.harga*tb_order.jumlah)+( tb_faktur.ongkir*tb_order.jumlah) as total_pesanan
		FROM tb_order, toko, barang, tb_faktur, tb_user, tb_metode, tb_barang_toko WHERE
		tb_order.id_barang=barang.id_barang AND 
		tb_order.id_faktur=tb_faktur.id_faktur AND 
        tb_faktur.metode_bayar=tb_metode.id_metode AND
		tb_barang_toko.id_barang=barang.id_barang AND
        tb_faktur.id_user=tb_user.id_user AND
		tb_barang_toko.id_toko=toko.id_toko AND 
		tb_order.id_faktur='$id_faktur' AND toko.id_toko='$id_toko'")->row_array();
		$data['barang'] = $this->db->query("SELECT tb_order.*, toko.nama_toko, toko.id_toko ,tb_faktur.ongkir, tb_order.jumlah*tb_order.harga as total, tb_faktur.ongkir*tb_order.jumlah as total_ongkir, (tb_order.jumlah*tb_order.harga + tb_faktur.ongkir*tb_order.jumlah) as total_pesanan
        FROM tb_order, toko, tb_faktur, barang, tb_barang_toko WHERE 
        tb_order.id_barang=barang.id_barang AND
        tb_order.id_toko=toko.id_toko AND
                tb_order.id_faktur=tb_faktur.id_faktur AND
                tb_barang_toko.id_barang=tb_order.id_barang AND
                tb_barang_Toko.id_penjual=toko.id_penjual AND
                tb_order.id_faktur='$id_faktur' AND
                toko.id_toko='$id_toko'")->result_array();
		$data['total_pesanan'] = $this->db->query("SELECT tb_faktur.ongkir, tb_order.nama_brg, SUM(tb_order.jumlah*tb_order.harga) as total, SUM(tb_faktur.ongkir*tb_order.jumlah)as ongkir, SUM(tb_order.jumlah*tb_order.harga + tb_order.jumlah*tb_faktur.ongkir)as total_pesanan
        FROM tb_faktur, tb_order
        WHERE tb_faktur.id_faktur=tb_order.id_faktur
        AND tb_faktur.id_faktur='$id_faktur'
		AND tb_order.id_toko='$id_toko' ")->row_array();
		$data['penjual'] = $this->db->query("SELECT tb_user.nama as penjual 
        FROM tb_user, tb_order, toko, penjual
        WHERE tb_order.id_toko=toko.id_toko
        AND toko.id_penjual=penjual.id_penjual
        AND penjual.id_user=tb_user.id_user
        AND tb_order.id_faktur='$id_faktur'
        AND tb_order.id_toko='$id_toko'")->row_array();

		$this->load->view('laporan_faktur', $data, FALSE);

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
	public function filter_tgl()
	{
		$filter = $this->input->post('filter');

		if ($filter && !empty($filter)) { // Cek apakah user telah memilih filter dan klik tombol tampilkan

			if ($filter == '1') { // Jika filter nya 1 (per tanggal)
				$tgl = $this->input->post('tanggal');
				$ket = 'Data Transaksi Tanggal ' . date('d-m-y', strtotime($tgl));
				// $url_cetak = 'transaksi/cetak?filter=1&tanggal=' . $tgl;
				$transaksi = $this->M_invoice->view_by_date($tgl); // Panggil fungsi view_by_date yang ada di M_invoice
			} else if ($filter == '2') { // Jika filter nya 2 (per bulan)
				$bulan = $this->input->post('bulan');

				$tahun = $this->input->post('tahun');

				$nama_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

				$ket = 'Data Transaksi Bulan ' . $nama_bulan[$bulan] . ' ' . $tahun;
				// $url_cetak = 'transaksi/cetak?filter=2&bulan=' . $bulan . '&tahun=' . $tahun;
				$transaksi = $this->M_invoice->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di M_invoice
			} else { // Jika filter nya 3 (per tahun)
				$tahun = $this->input->post('tahun');

				$ket = 'Data Transaksi Tahun ' . $tahun;
				// $url_cetak = 'transaksi/cetak?filter=3&tahun=' . $tahun;
				$transaksi = $this->M_invoice->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di M_invoice
			}
		} else { // Jika user tidak mengklik tombol tampilkan
			$ket = 'Semua Data Transaksi';
			// $url_cetak = 'transaksi/cetak';
			$transaksi = $this->M_invoice->tampil_order(); // Panggil fungsi view_all yang ada di M_invoice
		}

		$data['ket'] = $ket;
		// $data['url_cetak'] = base_url('index.php/' . $url_cetak);
		// $data['option_tahun'] = $this->M_invoice->option_tahun();
		$data['judul'] = 'Pesanan';
		$id = $this->session->userdata('id_user');
		$data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();
		$data['pesanan'] = $transaksi;
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar', $data);
		$this->load->view('template_admin/topbar', $data);
		$this->load->view('admin/pesanan', $data);
		$this->load->view('template_admin/footer');
	}
	public function transaksi_toko($id_toko)
	{
		$data['judul'] = 'Transaksi Toko';
		$id = $this->session->userdata('id_user');
		$data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();
		$data['toko'] = $this->db->get_where('toko', array('id_toko' => $id_toko))->row_array();
		$data['transaksi'] = $this->db->query("SELECT tb_order.*, tb_faktur.*, tb_faktur.ongkir*tb_order.jumlah as ongkir, tb_user.nama
		FROM tb_order, tb_faktur, tb_metode, tb_user
		WHERE tb_order.id_faktur=tb_faktur.id_faktur
		AND tb_faktur.id_user=tb_user.id_user 
		AND tb_faktur.metode_bayar=tb_metode.id_metode
		AND tb_order.id_toko=$id_toko
		GROUP BY tb_faktur.id_faktur ASC
		HAVING (COUNT(tb_faktur.id_faktur <= 1))")->result_array();
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar', $data);
		$this->load->view('template_admin/topbar', $data);
		$this->load->view('admin/transaksi_toko', $data);
		$this->load->view('template_admin/footer');
	}
	public function filter_tgl_toko()
	{
		$filter = $this->input->post('filter');
		$id_toko = $this->input->post('id_toko');


		if ($filter && !empty($filter)) { // Cek apakah user telah memilih filter dan klik tombol tampilkan

			if ($filter == '1') { // Jika filter nya 1 (per tanggal)
				$tgl = $this->input->post('tanggal');
				$ket = 'Data Transaksi Tanggal ' . date('d-m-y', strtotime($tgl));
				// $url_cetak = 'transaksi/cetak?filter=1&tanggal=' . $tgl;
				$transaksi = $this->M_toko->view_by_date($tgl, $id_toko); // Panggil fungsi view_by_date yang ada di M_toko
			} else if ($filter == '2') { // Jika filter nya 2 (per bulan)
				$bulan = $this->input->post('bulan');

				$tahun = $this->input->post('tahun');

				$nama_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

				$ket = 'Data Transaksi Bulan ' . $nama_bulan[$bulan] . ' ' . $tahun;
				// $url_cetak = 'transaksi/cetak?filter=2&bulan=' . $bulan . '&tahun=' . $tahun;
				$transaksi = $this->M_toko->view_by_month($bulan, $tahun, $id_toko); // Panggil fungsi view_by_month yang ada di M_toko
			} else { // Jika filter nya 3 (per tahun)
				$tahun = $this->input->post('tahun');

				$ket = 'Data Transaksi Tahun ' . $tahun;
				// $url_cetak = 'transaksi/cetak?filter=3&tahun=' . $tahun;
				$transaksi = $this->M_toko->view_by_year($tahun, $id_toko); // Panggil fungsi view_by_year yang ada di M_toko
			}
		} else { // Jika user tidak mengklik tombol tampilkan
			$ket = 'Semua Data Transaksi';
			// $url_cetak = 'transaksi/cetak';
			$transaksi = $this->M_toko->view_all($id_toko); // Panggil fungsi view_all yang ada di M_toko
		}

		$data['ket'] = $ket;
		// $data['url_cetak'] = base_url('index.php/' . $url_cetak);
		// $data['option_tahun'] = $this->M_toko->option_tahun();
		$data['judul'] = 'Pesanan';
		$id = $this->session->userdata('id_user');
		$data['toko'] = $this->db->get_where('toko', array('id_toko' => $id_toko))->row_array();
		$data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();
		$data['filter'] = $transaksi;
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar', $data);
		$this->load->view('template_admin/topbar', $data);
		$this->load->view('admin/filter_toko', $data);
		$this->load->view('template_admin/footer');
	}
}
