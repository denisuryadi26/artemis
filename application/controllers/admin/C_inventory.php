<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_inventory extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		if(!($this->session->has_userdata('users_id'))){
		redirect(base_url());
		}
        $this->load->model("M_location");
        $this->load->model("M_program");
        $this->load->model("M_inventory");
        $this->load->model("M_nav");
        $this->load->library('pagination');
        $this->load->library('form_validation');
    }

	//Halaman Dashboard
	public function index()
	{
		$data["location"] = $this->M_location->getAll();
		$data["program"] = $this->M_program->getAll();
		$data['navlocation'] = $this->M_nav->getNav();
		$location_id = $this->session->userdata('location_id');
        $program_id = $this->session->userdata('program_id');
		$data['title'] = 'Inventory';

		$data['inventoryitem'] = $this->M_inventory->inventoryitem();
		$data['inventorygrid'] = $this->M_inventory->inventorygrid();

		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav',$data);
		$this->load->view('admin/dashboard/v_inventory',$data);
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

	public function inventoryitem()
	{
		$data["location"] = $this->M_location->getAll();
		$data["program"] = $this->M_program->getAll();
		$data['title'] = 'Inventory';

        //INVENTORY ITEM
        $config['base_url'] = base_url('').'admin/inventory/C_inventoryitem';
        $this->db->select(	'*');
        $this->db->from('inventoryitem');
        $this->db->join('inventorydetail b', 'a.inventory_id = b.inventory_id');
        $this->db->join('programitem c', 'a.program_item_id = c.program_item_id');
        $this->db->join('marketplace d', 'a.market_place_id = a.market_place_id');
		$config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 10;

        //INITIALIZE
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $data['start'] = $this->uri->segment(4);
        if ($data['start'] == null) {
            $data['start'] = 0;
        }

		$data['inventoryitem'] = $this->M_inventory->inventoryitem($data['start'], $config['per_page']);

		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav',$data);
		$this->load->view('admin/dashboard/testing1',$data);
		$this->load->view('admin/layout/v_footer');
	}

	public function getClientByLocation($location_id)
	{	
		echo json_encode(
			$this->M_program->getByLocationId($location_id)
		);
	}

	public function getinventoryitem()
	{
		echo json_encode(
			$this->M_inventory->inventoryitem()
		);
	}

	public function getinventorygrid()
	{
		echo json_encode(
			$this->M_inventory->inventorygrid()
		);
	}

	public function gettesquery()
	{
		print_r(json_encode(
			$this->M_inventory->inventorygrid()
		)) ;
	}
}