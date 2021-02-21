<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_purchaselist extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if(!($this->session->has_userdata('users_id'))){
        redirect(base_url());
        }
        $this->load->model("M_location");
        $this->load->model("M_program");
        $this->load->model("M_purchaselist");
        $this->load->model("M_nav");
        $this->load->library('pagination');
        $this->load->library('form_validation');
    }

	//Halaman Dashboard
	public function index()
	{
		$data['location'] 		= $this->M_location->getAll();
		$data['program'] 		= $this->M_program->getAll();
		$data['navlocation'] 	= $this->M_nav->getNav();
		$location_id 			= $this->session->userdata('location_id');
        $program_id 			= $this->session->userdata('program_id');
		$data['title'] 			= 'Purchase List';

		

        // $config['base_url'] = base_url('').'/admin/C_purchaselist/index';

        // $where = array();
        // if($this->session->userdata('location_id'))
        // {
        //     $location_id = $this->session->userdata('location_id');
        //     $program_id = $this->session->userdata('program_id');
        // }
        // else
        // {
        //     $location_id = $this->session->userdata('loc_id');
        //     $program_id = $this->session->userdata('prog_id');
        // }
        // // echo var_dump($this->session->userdata('program_id'));
        // if(!empty($this->input->get('search_by1') && $this->input->get('search_value1')))
        // {
        //     $where[] = " AND CAST(".$this->input->get('search_by1')." AS TEXT) LIKE upper('%".$this->input->get('search_value1')."%')";
        // }
        // if(!empty($this->input->get('search_by2') && $this->input->get('searchvaluemapitem2')))
        // {
        //     $where[] = " AND CAST(".$this->input->get('search_by2')." AS TEXT) LIKE upper('%".$this->input->get('search_value2')."%')";
        // }
        // $stringwhere = implode(" ", $where);
		// $this->db->select('	purchase_code,
        //                     item_code,
        //                     item_name,
        //                     quantity,
        //                     received,
        //                     putaway,
        //                     damaged,
        //                     status,
        //                     color');
        // $this->db->from('purchaselist');
        // $this->db->where('location_id', $location_id);
        // $this->db->where('program_id', $program_id);
        // $this->db->where('location_id', $location_id);
        // $this->db->where('program_id', $program_id);
        // $query = "  SELECT * 
        //             FROM purchaselist 
        //             WHERE program_id = ".$program_id." ".$stringwhere." ";
        // // echo var_dump($query);exit;
        // $querypurchase = $this->db->query($query)->result();
		// $config['total_rows'] = $this->db->count_all_results();
        // // var_dump($config['total_rows']);die;
        // // $config['total_rows'] = $this->M_client->getcountall();
        // $data['total_rows'] = $config['total_rows'];
        // $config['per_page'] = 10;

		// //INITIALIZE
        // $this->pagination->initialize($config);
        // $data['pagination'] = $this->pagination->create_links();

        // $data['start'] = $this->uri->segment(4);
        // if ($data['start'] == null) {
        //     $data['start'] = 0;
        // }

		$data['purchaselist'] = $this->M_purchaselist->purchase();

		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav',$data);
		$this->load->view('admin/dashboard/v_purchaselist',$data);
		$this->load->view('admin/layout/v_footer');
	}

	public function getClientByLocation($location_id)
	{	
		echo json_encode(
			$this->M_program->getByLocationId($location_id)
		);
	}

	public function getpurchase()
	{
		echo json_encode(
			$this->M_purchaselist->purchase()
		);
	}


	public function gettesquery()
	{
		print_r(json_encode(
			$this->M_purchaselist->tesquery()
		)) ;
	}
}