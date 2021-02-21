<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	//Halaman Dashboard
	public function index()
	{
		$data["location"] = $this->M_location->getAll();
		$data["program"] = $this->M_program->getAll();
		$data['navlocation'] = $this->M_nav->getNav();
		$data["title"] = "Dashboard";
		$this->load->view("admin/layout/v_head",$data);
		$this->load->view("admin/layout/v_header");
		$this->load->view("admin/layout/v_nav",$data);
		$this->load->view("admin/dashboard/Profile"$data);
		$this->load->view("admin/layout/v_footer");
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