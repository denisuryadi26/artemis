<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_nav extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model(["M_nav"]);
    }

	public function index()
	{
		$data['navlocation'] = $this->M_nav->getNav();
		$this->load->view("admin/layout/v_head",$data);
		$this->load->view("admin/layout/v_header");
		$this->load->view('admin/layout/v_nav',$data);
		$this->load->view("admin/layout/v_footer");
	}

	public function getNavlist()
	{
		echo json_encode(
			$this->M_nav->getNav()
		);
	}

	// public function getLoclist()
	// {
	// 	echo json_encode(
	// 		$this->M_nav->setlocation()
	// 	);
	// }

	public function setlocation() {

		$LOC_ID = isset($_POST['id'])?$_POST['id']:'';
		
		$this->db->select('*');
		$this->db->from('location');
		$this->db->where(array('code'=>$LOC_ID));
		$location               = $this->db->get();
		$this->data['location'] = $location->result();
		 
		foreach($this->session->userdata('location') as $l) 
		{
			if ($l->loc_id == $LOC_ID) 
			{
				$client_id = $_SESSION['CLIENT_ACTIVE'];
				// foreach($l->client as $cl)
				// {
					if($cl->c_id == $client_id)
					{
						unset($_SESSION['CLIENT_ACTIVE']);
						$_SESSION['CLIENT_ACTIVE'] = $cl->c_id;
						break;
					}
					else
					{
						unset($_SESSION['CLIENT_ACTIVE']);
						$_SESSION['CLIENT_ACTIVE'] = $cl->c_id;
					}
				// }
				$this->session->set_userdata('client', $l->client);
			}
		}
		$_SESSION['LOCATION_ACTIVE'] = $LOC_ID;
	}

	public function setclient() {
		
		$C_ID = isset($_POST['program_id'])?$_POST['program_id']:'';

		$this->db->select('program_id,program_name');
		$this->db->from('navprogram');
		// $this->db->where(array('code'=>$C_ID));
		$this->db->where('location_id', $location_id);
        $this->db->order_by('program_name','ASC');
		$client               = $this->db->get();
		$this->data['client'] = $client->result();

		$_SESSION['CLIENT_ACTIVE'] = $C_ID;
	}


}

/* End of file C_nav.php */
/* Location: ./application/controllers/admin/C_nav.php */