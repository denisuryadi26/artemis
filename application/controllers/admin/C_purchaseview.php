<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_purchaseview extends CI_Controller {

	public function index()
	{
		$data['title'] = 'View By ID';
		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav',$data);
		$this->load->view('admin/dashboard/v_viewpurchasebyid',$data);
		$this->load->view('admin/layout/v_footer');
	}

}

/* End of file C_purchaseview.php */
/* Location: ./application/controllers/admin/C_purchaseview.php */