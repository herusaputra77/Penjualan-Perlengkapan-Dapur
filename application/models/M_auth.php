<?php

class M_auth extends CI_Model
{
	public function cek_login()
	{
		$email = set_value('email');
		$password = set_value('password');
		$result = $this->db->where('email', $email)
			->where('password', $password)
			->limit(1)
			->get('tb_user');
		if ($result->num_rows() > 0) {
			return $result->row();
		} else {
			return FALSE;
		}
	}
	public function tambah_penjual()
	{
		$email = $this->input->post('email');
		$username = $this->input->post('username');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$no_hp = $this->input->post('no_hp');
		$password = $this->input->post('password1');
		$gender = $this->input->post('gender');

		$data = array(
			'id_role' => '2',
			'username' => $username,
			'email' => $email,
			// 'password' => password_hash($password, PASSWORD_DEFAULT),
			'password' => $password,
			'nama' => $nama,
			'jenis_kelamin' => $gender,
			'alamat' => $alamat,
			'no_hp' => $no_hp,
			'image' => 'user.png',
			'tgl_buat' => time()

		);
		$this->db->insert('tb_user', $data);
		$id_user = $this->db->insert_id();
		$data= array(
			'id_user' => $id_user
		);
		$this->db->insert('penjual',$data);
	}
}
