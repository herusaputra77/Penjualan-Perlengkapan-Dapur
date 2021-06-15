<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
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
        $data['judul'] = 'Transaksi';
        $data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();
        $data['transaksi'] = $this->db->query("SELECT tb_faktur.*, tb_user.nama, tb_metode.metode, penjual.id_user as penjual
            FROM tb_faktur, tb_user, tb_metode, penjual, tb_order, toko
            WHERE tb_faktur.id_user=tb_user.id_user 
            AND tb_metode.id_metode=tb_faktur.metode_bayar 
            AND toko.id_penjual=penjual.id_penjual
            AND tb_order.id_faktur=tb_faktur.id_faktur 
            AND tb_order.id_toko=toko.id_toko 
            AND penjual.id_user='$id' 
            GROUP BY tb_faktur.id_faktur
            HAVING(COUNT(tb_faktur.id_faktur)>=1)")->result_array();
        $this->load->view('template_penjual/header', $data);
        $this->load->view('template_penjual/sidebar');
        $this->load->view('template_penjual/topbar');
        $this->load->view('penjual/transaksi', $data);
        $this->load->view('template_penjual/footer');
    }
    public function detail_transaksi($id_faktur)
    {
        $id = $this->session->userdata('id_user');
        $data['judul'] = 'Detail Transaksi';
        $data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();
        $data['detail_transaksi'] = $this->db->query("SELECT tb_order.*, toko.nama_toko, tb_user.id_user, tb_faktur.alamat
        FROM tb_order , toko, tb_user, penjual, tb_faktur
        WHERE tb_order.id_toko=toko.id_toko
        AND tb_order.id_faktur=tb_faktur.id_faktur
        AND toko.id_penjual=penjual.id_penjual
        AND penjual.id_user=tb_user.id_user
        AND tb_order.id_faktur='$id_faktur'
        AND tb_user.id_user= '$id'
        GROUP BY (tb_order.id_toko)
        HAVING (COUNT(tb_order.id_toko)>=1)")->result_array();
        $this->load->view('template_penjual/header', $data);
        $this->load->view('template_penjual/sidebar');
        $this->load->view('template_penjual/topbar');
        $this->load->view('penjual/detail_transaksi', $data);
        $this->load->view('template_penjual/footer');
    }
    public function detail_brg()
    {
        $id = $this->session->userdata('id_user');
        $data['judul'] = 'Detail Barang';
        $data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();
        $id_toko = $this->input->post('id_toko');
        $id_faktur = $this->input->post('id_faktur');
        $data['barang'] = $this->db->query("SELECT tb_order.*, tb_faktur.ongkir, tb_order.jumlah*tb_order.harga as total, tb_faktur.ongkir*tb_order.jumlah as total_ongkir, (tb_order.jumlah*tb_order.harga + tb_faktur.ongkir*tb_order.jumlah) as total_pesanan
        FROM tb_order, tb_faktur
        WHERE tb_order.id_faktur=tb_faktur.id_faktur
        AND tb_order.id_faktur='$id_faktur'
        AND tb_order.id_toko ='$id_toko'")->result_array();
        $data['total_pesanan'] = $this->db->query("SELECT tb_order.* ,tb_faktur.ongkir, tb_order.jumlah*tb_order.harga as total, SUM(tb_faktur.ongkir*tb_order.jumlah) as total_ongkir, SUM(tb_order.jumlah*tb_order.harga + tb_faktur.ongkir*tb_order.jumlah) as total_pesanan 
        FROM tb_order, tb_faktur
        WHERE tb_order.id_faktur=tb_faktur.id_faktur
        AND tb_order.id_faktur='$id_faktur'
        AND tb_order.id_toko ='$id_toko'")->row_array();
        $this->load->view('template_penjual/header', $data);
        $this->load->view('template_penjual/sidebar');
        $this->load->view('template_penjual/topbar');
        $this->load->view('penjual/detail_barang', $data);
        $this->load->view('template_penjual/footer');
    }
    public function pengiriman()
    {
        $id = $this->session->userdata('id_user');
        $data['judul'] = 'Detail Barang';
        $data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();
        $id_toko = $this->input->post('id_toko');
        $redirect_page = $this->input->post('redirect_page');
        $id_faktur = $this->input->post('id_faktur');
        $nama_pengirim = $this->input->post('nama_pengirim');
        $no_hp_pengirim = $this->input->post('no_hp_pengirim');
        $kendaraan = $this->input->post('kendaraan');
        $alamat_tujuan = $this->input->post('alamat_tujuan');
        $id_user = $this->input->post('id_user');
        $data = array(
            'id_faktur' => $id_faktur,
            'id_toko' => $id_toko,
            'id_user' => $id_user,
            'nama_pengirim' => $nama_pengirim,
            'no_hp_pengirim' => $no_hp_pengirim,
            'kendaraan' => $kendaraan,
            'alamat_pengiriman' => $alamat_tujuan,
            'status_pengiriman' => 1
        );

        $hasil = $this->db->insert('tb_pengiriman', $data);
        if ($hasil == true) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
						 Data berhasil diubah!!
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
                        </div>');
            $this->db->set('status_pengiriman', '1');
            $this->db->where('id_faktur', $id_faktur);
            $this->db->where('id_toko', $id_toko);
            $this->db->update('tb_order');
            redirect($redirect_page);
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						 Data gagal diubah!!
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
                        </div>');
            redirect($redirect_page);
        }
    }
    public function order_terkirim()
    {
        $id = $this->session->userdata('id_user');
        $data['judul'] = 'Detail Barang';
        $data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();
        $id_toko = $this->input->post('id_toko');
        $redirect_page = $this->input->post('redirect_page');
        $id_faktur = $this->input->post('id_faktur');
        $this->db->set('status_pengiriman', '2');
        $this->db->where('id_faktur', $id_faktur);
        $this->db->where('id_toko', $id_toko);
        $this->db->update('tb_order');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
						 Data berhasil diubah!!
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>');
        redirect($redirect_page);
    }
    public function print_faktur()
    {
        $id_toko = $this->input->post('id_toko');
        $id_faktur = $this->input->post('id_faktur');
        $this->load->library('dompdf_gen');
        $data['toko'] = $this->db->query("SELECT tb_faktur.id_faktur, tb_faktur.tgl_order, toko.id_toko, toko.nama_toko, toko.alamat_toko , tb_user.nama, tb_user.no_hp, tb_faktur.alamat, tb_metode.metode,  tb_faktur.ongkir, tb_order.harga*tb_order.jumlah as total, tb_faktur.ongkir*tb_order.jumlah as total_ongkir,(tb_order.harga*tb_order.jumlah)+( tb_faktur.ongkir*tb_order.jumlah) as total_pesanan
		FROM tb_order, toko, barang, tb_faktur, tb_user, tb_metode WHERE
		tb_order.id_barang=barang.id_barang AND 
		tb_order.id_faktur=tb_faktur.id_faktur AND 
        tb_faktur.metode_bayar=tb_metode.id_metode AND
        tb_faktur.id_user=tb_user.id_user AND
		tb_order.id_toko=toko.id_toko AND
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
        $data['pembeli'] = $this->db->query("SELECT tb_user.nama as nama_pembeli 
        FROM tb_faktur, tb_user
        WHERE tb_faktur.id_user=tb_user.id_user
        AND tb_faktur.id_faktur='$id_faktur'")->row_array();
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
        if (isset($_GET['filter']) && !empty($_GET['filter'])) { // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if ($filter == '1') { // Jika filter nya 1 (per tanggal)
                $tgl = $_GET['tanggal'];

                $ket = 'Data Transaksi Tanggal ' . date('d-m-y', strtotime($tgl));
                // $url_cetak = 'transaksi/cetak?filter=1&tanggal=' . $tgl;
                $transaksi = $this->m_penjual->view_by_date($tgl); // Panggil fungsi view_by_date yang ada di m_penjual
            } else if ($filter == '2') { // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

                $ket = 'Data Transaksi Bulan ' . $nama_bulan[$bulan] . ' ' . $tahun;
                // $url_cetak = 'transaksi/cetak?filter=2&bulan=' . $bulan . '&tahun=' . $tahun;
                $transaksi = $this->m_penjual->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di m_penjual
            } else { // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];

                $ket = 'Data Transaksi Tahun ' . $tahun;
                // $url_cetak = 'transaksi/cetak?filter=3&tahun=' . $tahun;
                $transaksi = $this->m_penjual->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di m_penjual
            }
        } else { // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Transaksi';
            $url_cetak = 'transaksi/cetak';
            $transaksi = $this->M_penjual->view_all(); // Panggil fungsi view_all yang ada di m_penjual
        }

        $data['ket'] = $ket;
        // $data['url_cetak'] = base_url('index.php/' . $url_cetak);
        $data['transaksi'] = $transaksi;
        // $data['option_tahun'] = $this->m_penjual->option_tahun();
        $id = $this->session->userdata('id_user');
        $data['judul'] = 'Transaksi';
        $data['user'] = $this->db->get_where('tb_user', array('id_user' => $id))->row_array();
        $this->load->view('template_penjual/header', $data);
        $this->load->view('template_penjual/sidebar');
        $this->load->view('template_penjual/topbar');
        $this->load->view('penjual/transaksi', $data);
        $this->load->view('template_penjual/footer');
    }
}

/* End of file Transaksi.php */
