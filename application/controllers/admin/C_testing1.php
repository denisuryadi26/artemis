<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_testing1 extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
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
		redirect('admin/C_testing1/item');
	}


	public function item()
	{
		$data["location"] = $this->M_location->getAll();
		$data["program"] = $this->M_program->getAll();
		$data['navlocation'] = $this->M_nav->getNav();
		$location_id = $this->session->userdata('location_id');
        $program_id = $this->session->userdata('program_id');
		$data['title'] = 'Inventory';

        //INVENTORY ITEM
        $config['base_url'] = base_url('').'/admin/C_testing1/item';

        if($this->session->userdata('location_id'))
	    {
	        $location_id = $this->session->userdata('location_id');
	        $program_id = $this->session->userdata('program_id');
	    }
	    else
	    {
	        $location_id = $this->session->userdata('loc_id');
	        $program_id = $this->session->userdata('prog_id');
	    }
        $this->db->select('		market_place,
                                item_code,
                                item_name,
                                item_barcode,
                                ready_order,
                                onhand,
                                damage');
        $this->db->from('inventoryitem');
        $this->db->where('location_id', $location_id);
        $this->db->where('program_id', $program_id);
        $this->db->order_by('inventory_id', 'DESC');
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

        $data['type'] = "item";
		$data['table'] = $this->M_inventory->inventoryitem($data['start'], $config['per_page']);

		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav',$data);
		$this->load->view('admin/dashboard/v_inventory',$data);
		$this->load->view('admin/layout/v_footer');
	}

	public function tesDatatable(Type $var = null)
	{
		$data['table'] = $this->M_inventory->inventorygrid($data['start'], $config['per_page']);
		$this->load->view('admin/dashboard/v_inventory',$data);
	}


	public function grid()
	{
		$data["location"] = $this->M_location->getAll();
		$data["program"] = $this->M_program->getAll();
		$data['navlocation'] = $this->M_nav->getNav();
		$location_id = $this->session->userdata('location_id');
        $program_id = $this->session->userdata('program_id');
		$data['title'] = 'Inventory';

        //INVENTORY GRID
        $config['base_url'] = base_url('').'/admin/C_testing1/grid';

        if($this->session->userdata('location_id'))
	    {
	        $location_id = $this->session->userdata('location_id');
	        $program_id = $this->session->userdata('program_id');
	    }
	    else
	    {
	        $location_id = $this->session->userdata('loc_id');
	        $program_id = $this->session->userdata('prog_id');
	    }
        $this->db->select(     'market_place,
                                grid_name,
                                item_information,
                                item_code,
                                item_name,
                                ready_order,
                                onhand,
                                damage');
        $this->db->from('inventorygrid');
        $this->db->where('location_id', $location_id);
        $this->db->where('program_id', $program_id);
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

        $data['type'] = "grid";
		$data['table'] = $this->M_inventory->inventorygrid($data['start'], $config['per_page']);

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

}

/* End of file C_testing1.php */
/* Location: ./application/controllers/admin/C_testing1.php */