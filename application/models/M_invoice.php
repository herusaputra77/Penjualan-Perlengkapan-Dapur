<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_invoice extends CI_Model
{
    public function user()
    {
        return $this->db->query("SELECT COUNT(tb_user.id_user) as user FROM tb_user")->row_array();
    }
    public function toko()
    {
        return $this->db->query("SELECT COUNT(toko.id_toko) as toko FROM toko")->row_array();
    }
    public function barang()
    {
        return $this->db->query("SELECT COUNT(barang.id_barang) as barang FROM barang")->row_array();
    }
    public function transaksi()
    {
        return $this->db->query("SELECT COUNT(tb_faktur.id_faktur) as transaksi FROM tb_faktur")->row_array();
    }
    public function bayar()
    {
        $id_user = $this->input->post('id_user');
        $alamat = $this->input->post('alamat');
        $metode = $this->input->post('bayar');
        $penjual = $this->input->post('penjual');
        $total_bayar = $this->input->post('total_bayar');
        $ongkir = $this->input->post('ongkir');
        $data = array(
            'id_user' => $id_user,
            'alamat' => $alamat,
            'tgl_order' => date('Y-m-d'),
            'metode_bayar' => $metode,
            'ongkir' => 2000,
            'total_bayar' => $total_bayar,
            'status_bayar' => 0,
            'bukti_pembayaran' => 'Belum ada'
        );
        $this->db->insert('tb_faktur', $data);
        $id_faktur = $this->db->insert_id();
        foreach ($this->cart->contents() as $items) {
            $data = array(
                'id_faktur' => $id_faktur,
                'id_barang' => $items['id'],
                'id_toko' => $items['options'],
                'nama_brg' => $items['name'],
                'jumlah' => $items['qty'],
                'harga' => $items['price'],
                'status_pengiriman' => 0
            );
            $this->db->insert('tb_order', $data);
        }
        return True;
    }
    public function tampil_order()
    {
        $hasil = $this->db->query("SELECT tb_faktur.*, tb_user.nama, tb_metode.metode FROM
         tb_user, tb_faktur, tb_metode WHERE tb_faktur.id_user=tb_user.id_user AND tb_faktur.metode_bayar=tb_metode.id_metode");
        return $hasil->result_array();
    }
    public function detail_order($id)
    {
        $id_invoice = array('id_invoice' => $id);
        $hasil = $this->db->query("SELECT DISTINCT tb_order.*,toko.id_toko, toko.nama_toko FROM tb_order, toko, barang WHERE
         tb_order.id_barang=barang.id_barang AND barang.id_toko=toko.id_toko AND tb_order.id_invoice='$id_invoice' GROUP BY toko.id_toko HAVING ( COUNT(toko.id_toko)>=1)");
        return $hasil->row_array();
    }
    public function cari_toko()
    {
        $hasil = $this->db->get('toko');
        return $hasil->result();
    }
    // filter tanggal
    public function view_by_date($date)
    {
        $hasil = $this->db->query("SELECT tb_faktur.*, tb_user.nama, tb_metode.metode 
        FROM tb_user, tb_faktur, tb_metode 
        WHERE tb_faktur.id_user=tb_user.id_user 
        AND tb_faktur.metode_bayar=tb_metode.id_metode
        AND tb_faktur.tgl_order='$date'");
        return $hasil->result_array();
    }

    public function view_by_month($month, $year)
    {
        $hasil = $this->db->query("SELECT tb_faktur.*, tb_user.nama, tb_metode.metode 
        FROM tb_user, tb_faktur, tb_metode 
        WHERE tb_faktur.id_user=tb_user.id_user 
        AND tb_faktur.metode_bayar=tb_metode.id_metode
        AND month(tb_faktur.tgl_order)='$month'
        AND year(tb_faktur.tgl_order)='$year'");
        return $hasil->result_array();
    }

    public function view_by_year($year)
    {
        $hasil = $this->db->query("SELECT tb_faktur.*, tb_user.nama, tb_metode.metode 
        FROM tb_user, tb_faktur, tb_metode 
        WHERE tb_faktur.id_user=tb_user.id_user 
        AND tb_faktur.metode_bayar=tb_metode.id_metode
        AND year(tb_faktur.tgl_order)='$year'");
        return $hasil->result_array();
    }

    public function view_all()
    {
        $this->db->join('tb_order', 'tb_faktur.id_invoice = tb_order.id_invoice', 'left');
        $this->db->join('tb_metode', 'tb_faktur.metode_bayar = tb_metode.id_metode', 'left');
        return $this->db->get('tb_faktur')->result_array(); // Tampilkan semua data tb_faktur
    }

    public function option_tahun()
    {
        $this->db->select('YEAR(tgl_order) AS tahun'); // Ambil Tahun dari field tgl_order
        $this->db->from('tb_faktur'); // select ke tabel tb_faktur
        $this->db->order_by('YEAR(tgl_order)'); // Urutkan berdasarkan tahun secara Ascending (ASC)
        $this->db->group_by('YEAR(tgl_order)'); // Group berdasarkan tahun pada field tgl

        return $this->db->get()->result_array(); // Ambil data pada tabel transaksi sesuai kondisi diatas
    }
    public function notifikasi($id_user)
    {
        $result = $this->db->query("SELECT COUNT(DISTINCT tb_faktur.id_faktur) as hasil
        FROM tb_faktur, tb_user, tb_metode, penjual, tb_order, toko
         WHERE tb_faktur.id_user=tb_user.id_user 
         AND tb_metode.id_metode=tb_faktur.metode_bayar 
         AND toko.id_penjual=penjual.id_penjual
         AND tb_order.id_faktur=tb_faktur.id_faktur 
         AND tb_order.id_toko=toko.id_toko 
         AND penjual.id_user='$id_user'");
        return $result->row_array();
    }
    public function detail_notifikasi($id_user)
    {
        $result = $this->db->query("SELECT tb_faktur.*, tb_user.nama, tb_metode.metode, penjual.id_user as penjual
        FROM tb_faktur, tb_user, tb_metode, penjual, tb_order, toko
        WHERE tb_faktur.id_user=tb_user.id_user 
        AND tb_metode.id_metode=tb_faktur.metode_bayar 
        AND toko.id_penjual=penjual.id_penjual
        AND tb_order.id_faktur=tb_faktur.id_faktur 
        AND tb_order.id_toko=toko.id_toko 
        AND penjual.id_user='$id_user' 
        GROUP BY tb_faktur.id_faktur
        HAVING(COUNT(tb_faktur.id_faktur)>=1)
        ORDER BY tb_faktur.tgl_order DESC");
        return $result->result_array();
    }
    public function proses_pengiriman($id_toko)
    {
        $result = $this->db->get_where('tb_pengiriman', array('id_toko' => $id_toko));
        return $result->result_array();
    }
}

/* End of file M_invoice.php */
