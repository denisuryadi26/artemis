<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_testing2 extends CI_Controller {

	public function index()
	{
		
		$data['title'] = 'Orders';
		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav',$data);
		$this->load->view('admin/dashboard/testing2',$data);
		$this->load->view('admin/layout/v_footer');
	}

}

/* End of file C_testing2.php */
/* Location: ./application/controllers/admin/C_testing2.php */