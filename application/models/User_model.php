<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
	
	// public function ambillogin($username, $password)
	// {
	// 	$this->db->where('username', $username);
	// 	$this->db->where('password', $password);
	// 	$query = $this->db->get('tbl_user');
	// 	if($query->num_rows()<0){
	// 		foreach ($query->result as $row) {
	// 			$sess = array(	'username' => $row->username,
	// 							'password' => $row->password
	// 		);
	// 		}
	// 		$this->session->get_userdata($sess);
	// 		redirect('admin/dashboard');

	// 		}
	// 		else{
	// 		$this->session->set_flashdata('info', 'Maaf, Username dan Password anda salah!');
	// 		redirect('login');
	// 	}

	// }
	public function cekLogin($data){
        $this->db->where($data);
        return $this->db->get('user');
    }


}