<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_orders extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if(!($this->session->has_userdata('users_id'))){
        redirect(base_url());
        }
        $this->load->model("M_location");
        $this->load->model("M_program");
        $this->load->model("M_orders");
        $this->load->model("M_nav");
        $this->load->library('pagination');
        $this->load->library('form_validation');
    }

	//Halaman Orders
	public function index()
	{
		$data["location"] = $this->M_location->getAll();
		$data["program"] = $this->M_program->getAll();
		$data['navlocation'] = $this->M_nav->getNav();
		$location_id = $this->session->userdata('location_id');
        $program_id = $this->session->userdata('program_id');
		$data['title'] = 'Orders';

		$data['orders'] = $this->M_orders->orders();
		$data['orderswithitem'] = $this->M_orders->orderswithitem();

		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav',$data);
		$this->load->view('admin/dashboard/v_orders',$data);
		$this->load->view('admin/layout/v_footer');
    }
    
    // function get_data_order()
    // {
    //     $list = $this->User_model->get_order_datatables();
    //     $data = array();
    //     $no = $_POST['start'];
    //     foreach ($list as $field) {
    //         $no++;
    //         $row = array();
    //         $row[] = $field->order_code;
    //         $row[] = $field->date;
    //         $row[] = $field->time;
    //         $row[] = $field->waybill_number;
    //         $row[] = $field->recipient_name;
    //         $row[] = $field->channel_type;
    //         $row[] = $field->order_created_by;
    //         $row[] = $field->status;
 
    //         $data[] = $row;
    //     }
 
    //     $output = array(
    //         "draw" => $_POST['draw'],
    //         "recordsTotal" => $this->User_model->count_all(),
    //         "recordsFiltered" => $this->User_model->count_filtered(),
    //         "data" => $data,
    //     );
    //     //output dalam format JSON
    //     echo json_encode($output);
    // }

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
}