<?php

class M_penjual extends CI_Model
{
	public function hapus($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}
	public function view_by_date($date)
	{
		$id = $this->session->userdata('id_user');
		$hasil = $this->db->query("SELECT tb_faktur.*, tb_user.nama, tb_metode.metode, penjual.id_user as penjual
        FROM tb_faktur, tb_user, tb_metode, penjual, tb_order, toko
         WHERE tb_faktur.id_user=tb_user.id_user 
         AND tb_metode.id_metode=tb_faktur.metode_bayar 
         AND toko.id_penjual=penjual.id_penjual
         AND tb_order.id_faktur=tb_faktur.id_faktur 
         AND tb_order.id_toko=toko.id_toko 
        AND penjual.id_user='$id'
		AND date(tb_faktur.tgl_order) = '$date'
         GROUP BY tb_faktur.id_faktur
         HAVING(COUNT(tb_faktur.id_faktur)>=1)");
		return $hasil->result_array();
	}

	public function view_by_month($month, $year)
	{
		$id = $this->session->userdata('id_user');
		$hasil = $this->db->query("SELECT tb_faktur.*, tb_user.nama, tb_metode.metode, penjual.id_user as penjual
        FROM tb_faktur, tb_user, tb_metode, penjual, tb_order, toko
         WHERE tb_faktur.id_user=tb_user.id_user 
         AND tb_metode.id_metode=tb_faktur.metode_bayar 
         AND toko.id_penjual=penjual.id_penjual
         AND tb_order.id_faktur=tb_faktur.id_faktur 
         AND tb_order.id_toko=toko.id_toko 
        AND penjual.id_user='$id'
		AND month(tb_faktur.tgl_order) = '$month'
		AND year(tb_faktur.tgl_order) = '$year'
         GROUP BY tb_faktur.id_faktur
         HAVING(COUNT(tb_faktur.id_faktur)>=1)");
		return $hasil->result_array();
	}

	public function view_by_year($year)
	{
		$id = $this->session->userdata('id_user');
		$hasil = $this->db->query("SELECT tb_faktur.*, tb_user.nama, tb_metode.metode, penjual.id_user as penjual
        FROM tb_faktur, tb_user, tb_metode, penjual, tb_order, toko
         WHERE tb_faktur.id_user=tb_user.id_user 
         AND tb_metode.id_metode=tb_faktur.metode_bayar 
         AND toko.id_penjual=penjual.id_penjual
         AND tb_order.id_faktur=tb_faktur.id_faktur 
         AND tb_order.id_toko=toko.id_toko 
        AND penjual.id_user='$id'
		AND year(tb_faktur.tgl_order) = '$year'
         GROUP BY tb_faktur.id_faktur
         HAVING(COUNT(tb_faktur.id_faktur)>=1)");
		return $hasil->result_array();
	}

	public function view_all()
	{
		$id = $this->session->userdata('id_user');
		$hasil = $this->db->query("SELECT tb_faktur.*, tb_user.nama, tb_metode.metode, penjual.id_user as penjual
        FROM tb_faktur, tb_user, tb_metode, penjual, tb_order, toko
         WHERE tb_faktur.id_user=tb_user.id_user 
         AND tb_metode.id_metode=tb_faktur.metode_bayar 
         AND toko.id_penjual=penjual.id_penjual
         AND tb_order.id_faktur=tb_faktur.id_faktur 
         AND tb_order.id_toko=toko.id_toko 
        AND penjual.id_user='$id'
         GROUP BY tb_faktur.id_faktur
		 HAVING(COUNT(tb_faktur.id_faktur)>=1)");
		return $hasil->result_array(); // Tampilkan semua data transaksi
	}

	public function option_tahun()
	{
		$this->db->select('YEAR(tgl) AS tahun'); // Ambil Tahun dari field tgl
		$this->db->from('transaksi'); // select ke tabel transaksi
		$this->db->order_by('YEAR(tgl)'); // Urutkan berdasarkan tahun secara Ascending (ASC)
		$this->db->group_by('YEAR(tgl)'); // Group berdasarkan tahun pada field tgl

		return $this->db->get()->result(); // Ambil data pada tabel transaksi sesuai kondisi diatas
	}
}
