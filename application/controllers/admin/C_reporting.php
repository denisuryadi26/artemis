<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_reporting extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		if(!($this->session->has_userdata('users_id'))){
		redirect(base_url());
		}
        $this->load->model("M_location");
        $this->load->model("M_program");
        $this->load->model("M_nav");
        $this->load->library('form_validation');
    }

	//Halaman Reporting
	public function index()
	{
		$data["location"] = $this->M_location->getAll();
		$data["program"] = $this->M_program->getAll();
		$data['navlocation'] = $this->M_nav->getNav();
		$data['title'] = 'Reporting';
		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav',$data);
		$this->load->view('admin/dashboard/v_reporting');
		$this->load->view('admin/layout/v_footer');
	}

	function set_loc()
    {
        // echo json_encode($_POST['loc']);
        $loc_id 		= str_replace('"', '', json_encode($_POST['loc_id']));
        $loc_name 		= str_replace('"', '', json_encode($_POST['loc_name']));
        $this->session->set_userdata('location_id', $loc_id);
        $this->session->set_userdata('location_name', $loc_name);
    }

    function set_prog()
    {
        // echo json_encode($_POST['loc']);
        $program_id 	= str_replace('"', '', json_encode($_POST['program_id']));
        $program_name 	= str_replace('"', '', json_encode($_POST['program_name']));
        $this->session->set_userdata('program_id', $program_id);
        $this->session->set_userdata('name', $program_name);
    }

	public function getClientByLocation($location_id)
	{	
		echo json_encode(
			$this->M_program->getByLocationId($location_id)
		);
	}
	
	public function purchase()
	{
		$this->load->view('admin/reportinglist/v_purchase');
	}

	public function arrival()
	{
		$this->load->view('admin/reportinglist/v_arrival');
	}
	public function recieved()
	{
		$this->load->view('admin/reportinglist/v_recieved');
	}
	public function putaway()
	{
		$this->load->view('admin/reportinglist/v_putaway');
	}
	public function serialnumber()
	{
		$this->load->view('admin/reportinglist/v_serialnumber');
	}
	public function inboundperpormance()
	{
		$this->load->view('admin/reportinglist/v_inboundperpormance');
	}
	public function redzone()
	{
		$this->load->view('admin/reportinglist/v_redzone');
	}
	public function stockitem()
	{
		$this->load->view('admin/reportinglist/v_stockitem');
	}
	public function stokgrid()
	{
		$this->load->view('admin/reportinglist/v_stokgrid');
	}
	public function stockaging()
	{
		$this->load->view('admin/reportinglist/v_stockaging');
	}
	public function stockcard()
	{
		$this->load->view('admin/reportinglist/v_stockcard');
	}
	public function stockdaily()
	{
		$this->load->view('admin/reportinglist/v_stockdaily');
	}
	public function stockmovement()
	{
		$this->load->view('admin/reportinglist/v_stockmovement');
	}
	public function stockadjustment()
	{
		$this->load->view('admin/reportinglist/v_stockadjustment');
	}
	public function emptyinventory()
	{
		$this->load->view('admin/reportinglist/v_emptyinventory');
	}
	public function transferbin()
	{
		$this->load->view('admin/reportinglist/v_transferbin');
	}
	public function stagingcancel()
	{
		$this->load->view('admin/reportinglist/v_stagingcanceln');
	}
	public function order()
	{
		$this->load->view('admin/reportinglist/v_order');
	}
	public function moving()
	{
		$this->load->view('admin/reportinglist/v_moving');
	}
	public function picklist()
	{
		$this->load->view('admin/reportinglist/v_picklist');
	}
	public function outbound()
	{
		$this->load->view('admin/reportinglist/v_outbound');
	}
	public function outbounddetail()
	{
		$this->load->view('admin/reportinglist/v_outbounddetail');
	}
	public function outbounddetailbundling()
	{
		$this->load->view('admin/reportinglist/v_outbounddetailbundling');
	}
	public function outboundperformance()
	{
		$this->load->view('admin/reportinglist/v_outboundperformance');
	}
	public function movingperformance()
	{
		$this->load->view('admin/reportinglist/v_movingperformance');
	}
	public function shipment()
	{
		$this->load->view('admin/reportinglist/v_shipment');
	}
	public function shipmentperformance()
	{
		$this->load->view('admin/reportinglist/v_shipmentperformance');
	}



}