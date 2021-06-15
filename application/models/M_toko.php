<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_toko extends CI_Model
{
    public function view_by_date($date, $id_toko)
    {

        $hasil = $this->db->query("SELECT tb_order.*, tb_faktur.*, tb_faktur.ongkir*tb_order.jumlah as ongkir, tb_user.nama
		FROM tb_order, tb_faktur, tb_metode, tb_user
		WHERE tb_order.id_faktur=tb_faktur.id_faktur
		AND tb_faktur.id_user=tb_user.id_user 
		AND tb_faktur.metode_bayar=tb_metode.id_metode
		AND tb_order.id_toko=$id_toko
        AND tb_faktur.tgl_order='$date'
		GROUP BY tb_faktur.id_faktur ASC
		HAVING (COUNT(tb_faktur.id_faktur <= 1))");
        return $hasil->result_array();
    }

    public function view_by_month($month, $year,  $id_toko)
    {

        $id = $this->session->userdata('id_user');
        $hasil = $this->db->query("SELECT tb_order.*, tb_faktur.*, tb_faktur.ongkir*tb_order.jumlah as ongkir, tb_user.nama
		FROM tb_order, tb_faktur, tb_metode, tb_user
		WHERE tb_order.id_faktur=tb_faktur.id_faktur
		AND tb_faktur.id_user=tb_user.id_user 
		AND tb_faktur.metode_bayar=tb_metode.id_metode
		AND tb_order.id_toko=$id_toko
        AND month(tb_faktur.tgl_order)='$month'
        AND year(tb_faktur.tgl_order)='$year'
		GROUP BY tb_faktur.id_faktur ASC
		HAVING (COUNT(tb_faktur.id_faktur <= 1))");
        return $hasil->result_array();
    }

    public function view_by_year($year,  $id_toko)
    {

        $id = $this->session->userdata('id_user');
        $hasil = $this->db->query("SELECT tb_order.*, tb_faktur.*, tb_faktur.ongkir*tb_order.jumlah as ongkir, tb_user.nama
		FROM tb_order, tb_faktur, tb_metode, tb_user
		WHERE tb_order.id_faktur=tb_faktur.id_faktur
		AND tb_faktur.id_user=tb_user.id_user 
		AND tb_faktur.metode_bayar=tb_metode.id_metode
		AND tb_order.id_toko=$id_toko
        AND year(tb_faktur.tgl_order)='$year'
		GROUP BY tb_faktur.id_faktur ASC
		HAVING (COUNT(tb_faktur.id_faktur <= 1))");
        return $hasil->result_array();
    }

    public function view_all($id_toko)
    {

        $id = $this->session->userdata('id_user');
        $hasil = $this->db->query("SELECT tb_order.*, tb_faktur.*, tb_faktur.ongkir*tb_order.jumlah as ongkir, tb_user.nama
		FROM tb_order, tb_faktur, tb_metode, tb_user
		WHERE tb_order.id_faktur=tb_faktur.id_faktur
		AND tb_faktur.id_user=tb_user.id_user 
		AND tb_faktur.metode_bayar=tb_metode.id_metode
		AND tb_order.id_toko=$id_toko
		GROUP BY tb_faktur.id_faktur ASC
		HAVING (COUNT(tb_faktur.id_faktur <= 1))");
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

/* End of file M_toko.php */
