<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	// public function index()
	// {
	// 	$this->load->view('login');
	// }

	// public function proseslogin()
	// {
	// 	$data = array(
	// 		'username' => $this->input->post('username'),
	// 		'password' => $this->input->post('password'),
	// 	);

	// 	// Load Model
	// 	$this->load->model('User_model');
	// 	$cek = $this->User_model->ceklogin($data)->num_rows();

	// 	$data_user = $this->User_model->ceklogin($data)->row();

	// 	if ($cek > 0){
	// 		$sess = array(
	// 			'username'	=>	$data_user->username,
	// 			'status'	=>	TRUE
	// 		);

	// 		$this->session->set_userdata($sess);

	// 		redirect('admin/dashboard');
	// 	}
	// 	else{
	// 		redirect(base_url());
	// 	}

	// }
	// 	public function admin(){
	// 	if ($this->session->userdata('status') == TRUE ) {
	// 		$this->load->view('halaman_admin');
	// 	}else{
	// 		redirect(base_url());
	// 	}
		
	// }

	// public function logout(){
	// 	session_destroy();
	// 	redirect(base_url());
	// }
}
