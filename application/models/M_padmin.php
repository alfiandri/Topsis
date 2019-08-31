<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_padmin extends CI_Model{


	function cekadminlogin($user_nip,$user_password){
		$hasil=$this->db->query("SELECT * FROM user WHERE user_nip='$user_nip' AND user_password=md5('$user_password')");
		return $hasil;
	}

	function get_user($user_nip){
		$hsl=$this->db->query("SELECT * FROM user where user_nip='$user_nip'");
		return $hsl;
	}
	function get_nilai_by_user($user_nip){
		$hsl=$this->db->query("SELECT * FROM nilai inner join kriteria on nilai.kriteria_id=kriteria.kriteria_id where nilai.user_nip='$user_nip'");
		return $hsl;
	}

	function get_all_user(){
		$hsl=$this->db->query("SELECT * FROM user");
		return $hsl;
	}

	function get_all_dosen(){
		$hsl=$this->db->query("SELECT * FROM user where user_role='dosen'");
		return $hsl;
	}
	function get_all_nilai(){
		$hsl=$this->db->query("SELECT * FROM nilai inner join user on nilai.user_nip=user.user_nip inner join kriteria on nilai.kriteria_id=kriteria.kriteria_id ORDER BY nilai_id");
		return $hsl;
	}

	function get_all_kriteria(){
		$hsl=$this->db->query("SELECT * FROM kriteria ORDER BY kriteria_id");
		return $hsl;
	}
	function get_alter_kriter($datadosen1,$datakriteria1){
		$hsl=$this->db->query("SELECT * FROM nilai WHERE user_nip ='$datadosen1' AND kriteria_id = '$datakriteria1'");
		return $hsl;
	}

	function save_kriteria($nama,$bobot,$attribute){
		$hsl=$this->db->query("INSERT INTO kriteria (kriteria_nama,kriteria_bobot,kriteria_attribute) VALUES ('$nama','$bobot','$attribute')");
		return $hsl;
	}


	function update_kriteria($kode,$nama,$bobot,$attribute){
		$hsl=$this->db->query("UPDATE kriteria SET kriteria_nama='$nama',kriteria_bobot='$bobot',kriteria_attribute='$attribute' where kriteria_id='$kode'");
		return $hsl;
	}
	function delete_kriteria($kode){
		$hsl=$this->db->query("DELETE FROM kriteria where kriteria_id='$kode'");
		return $hsl;
	}



	function save_nilai($user_nip,$kriteria,$nilai){
		$hsl=$this->db->query("INSERT INTO nilai (user_nip,kriteria_id,nilai_nilai) VALUES ('$user_nip','$kriteria','$nilai')");
		return $hsl;
	}

	function update_nilai($kode,$kriteria,$nilai){
		$hsl=$this->db->query("UPDATE nilai SET kriteria_id='$kriteria',nilai_nilai='$nilai' where nilai_id='$kode'");
		return $hsl;
	}
	function delete_nilai($kode){
		$hsl=$this->db->query("DELETE FROM nilai where nilai_id='$kode'");
		return $hsl;
	}


	function save_user($user_nip,$user_nama,$user_password,$user_role,$gambar){
		$hsl=$this->db->query("INSERT INTO user (user_nip,user_nama,user_password,user_role,user_foto) VALUES ('$user_nip','$user_nama',md5('$user_password'),'$user_role','$gambar')");
		return $hsl;
	}
	function save_user_wo_img($user_nip,$user_nama,$user_password,$user_role){
		$hsl=$this->db->query("INSERT INTO user (user_nip,user_nama,user_password,user_role) VALUES ('$user_nip','$user_nama','$user_password','$user_role')");
		return $hsl;
	}

	function update_user($kode,$user_nama,$user_role,$gambar){
		$hsl=$this->db->query("UPDATE user SET user_nama='$user_nama',user_role='$user_role',user_foto='$gambar' where user_nip='$kode'");
		return $hsl;
	}
	function update_user_wo_img($kode,$user_nama,$user_role){
		$hsl=$this->db->query("UPDATE user SET user_nama='$user_nama',user_role='$user_role' where user_nip='$kode'");
		return $hsl;
	}
	function delete_user($kode){
		$hsl=$this->db->query("DELETE FROM user where user_nip='$kode'");
		return $hsl;
	}
}