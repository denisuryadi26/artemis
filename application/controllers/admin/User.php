<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __constract(){
		parent::__constract();
	}
	//Login Page
	public function login()
	{
		$this->load->view('login');
	}
	/*public function temporary_register(){
		$data_user_baru = array(
				'username' => 'deni',
				'group' => 'user',
				'password' => bCrypt('admin',12),
				'email' => 'admin@ilmuwebsite.com',
				'active' => 1
			);

		$this->User_model->insert($data_user_baru);
	}*/
}
