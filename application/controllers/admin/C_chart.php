<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_chart extends CI_Controller {

	//Halaman Dashboard
	public function index()
	{
		$data['title'] = 'Chart';
		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav');
		$this->load->view('admin/dashboard/v_laporan_chart');
		$this->load->view('admin/layout/v_footer');
	}
}