<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_nav extends CI_Model {

	public function getNav()
	{
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
        $this->db->select('program_id,program_name');
        $this->db->from('navprogram');
        $this->db->where('location_id', $location_id);
        $this->db->order_by('program_name','ASC');
        $querynav = $this->db->get()->result();
        return $querynav;
    }
    
    // public function setlocation() {

	// 	$LOC_ID = isset($_POST['id'])?$_POST['id']:'';
		
	// 	$this->db->select('location.*');
	// 	$this->db->from('location');
	// 	$this->db->where(array('code'=>$LOC_ID));
	// 	$location               = $this->db->get();
	// 	$this->data['location'] = $location->result();
		 
	// 	foreach($this->session->userdata('location') as $l) 
	// 	{
	// 		if ($l->loc_id == $LOC_ID) 
	// 		{
	// 			$client_id = $_SESSION['CLIENT_ACTIVE'];
	// 			// foreach($l->client as $cl)
	// 			// {
	// 				if($cl->c_id == $client_id)
	// 				{
	// 					unset($_SESSION['CLIENT_ACTIVE']);
	// 					$_SESSION['CLIENT_ACTIVE'] = $cl->c_id;
	// 					break;
	// 				}
	// 				else
	// 				{
	// 					unset($_SESSION['CLIENT_ACTIVE']);
	// 					$_SESSION['CLIENT_ACTIVE'] = $cl->c_id;
	// 				}
	// 			// }
	// 			$this->session->set_userdata('client', $l->client);
	// 		}
	// 	}
	// 	$_SESSION['LOCATION_ACTIVE'] = $LOC_ID;
	// }

	// public function setclient() {
		
	// 	$C_ID = isset($_POST['id'])?$_POST['id']:'';

	// 	$this->db->select('client.*');
	// 	$this->db->from('program');
	// 	$this->db->where(array('code'=>$C_ID));
	// 	$client               = $this->db->get();
	// 	$this->data['client'] = $client->result();

	// 	$_SESSION['CLIENT_ACTIVE'] = $C_ID;
	// }

}

/* End of file M_nav.php */
/* Location: ./application/models/M_nav.php */