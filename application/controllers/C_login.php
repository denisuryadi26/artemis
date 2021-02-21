<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_login extends CI_Controller {
	//Login Page
	public function index()
	{
		$this->load->view('v_login');
	}

	public function proseslogin()
	{
		$secretKey = "SW5pQXBpQmlhckFtYW5QZWtvaw==";
		$res_data  = array(
			'apikey'    	=> $secretKey,
			'username' 		=> $user=$this->input->post("username"),
			'password' 	 	=> $pass=$this->input->post("password"),
			'application' 	=> 'ARTEMIS'
			,
			'host'			=> 'artemis.haistar.co.id'
		);

		//$url    = "https://poseidon.haistar.co.id/index.php?r=Service/Base/postLogin";

		$url    = "https://dev.haistar.co.id/poseidon/index.php?r=Service/Base/postLogin";

		$handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_TIMEOUT, 1000);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($res_data));
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        $res_api            = curl_exec($handle);
        $res                = json_decode($res_api);
		
		foreach($res->data->list_location as $location2)
		{
			foreach($location2->client as $client2)
			{
				$get_client[] = array(
					$client2->c_id
				);
			}
		}

		foreach($res->data->list_location as $location4)
		{
			foreach($location4->client as $clientname)
			{
				$get_client_name[] = array(
					$clientname->name
				);
			}
		}

		foreach($res->data->list_location as $location3)
		{
			$get_location[] = array(
				$location3->loc_id
			);		
		}
    	if($res->response  == 200)
        {
			// var_dump($res->data->current_client->client_id);exit(1);
        	$ses = array(
        			'users_id' 				=> $res->data->users_id,
        			'username' 				=> $res->data->username,
        			'full_name' 			=> $res->data->full_name,
        			'phone' 				=> $res->data->phone,
        			'email' 				=> $res->data->email,
        			'join_date' 			=> $res->data->join_date,
        			'is_client' 			=> $res->data->is_client,
        			'photo'					=> $res->data->photo,
        			'current_authorization' => $res->data->current_authorization,
                    'list_menu'             => $res->data->list_menu,
					'list_location'			=> $res->data->list_location,
					'list_location_id'		=> array_unique($get_location, SORT_REGULAR),
					'client'				=> array_unique($get_client, SORT_REGULAR),
					'clientname'			=> array_unique($get_client_name, SORT_REGULAR),
                    'current_location'		=> $res->data->current_location,
                    'current_client'		=> $res->data->current_client
			        );
			$this->session->set_userdata($ses);
			$this->session->set_userdata('loc_id', $res->data->current_location->loc_id);
        	$this->session->set_userdata('loc_name', $res->data->current_location->name);
        	$this->session->set_userdata('prog_id', $res->data->current_client->client_id);
			$this->session->set_userdata('prog_name', $res->data->current_client->name);
			
			// $loc_id = $this->session->userdata('loc_id');


	        redirect('admin/C_home');
        }
        else if($res->response == 0)
        {
			// echo "error";
			$salah = '<div class="alert alert-danger" style="margin-top: 3px">
			<div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> username atau password salah!</div></div>';
        	$this->session->set_flashdata('salah', $salah);
        	
        	// echo "Username dan password salah !";
            // echo $datasalah;die;
            // $this->load->view('C_login', $data);
        	redirect(base_url());	        

        } 
    }

	public function logout(){
		$this->session->unset_userdata('users_id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('full_name');
        $this->session->unset_userdata('phone');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('join_date');
        $this->session->unset_userdata('is_client');
        $this->session->unset_userdata('photo');
        $this->session->unset_userdata('current_authorization');
		$this->session->unset_userdata('list_menu');
		$this->session->unset_userdata('list_location');
		$this->session->unset_userdata('location_id');
		$this->session->unset_userdata('location_name');
		$this->session->unset_userdata('program_id');
		$this->session->unset_userdata('program_name');
		$this->session->unset_userdata('loc_id');
		$this->session->unset_userdata('loc_name');
		$this->session->unset_userdata('prog_id');
		$this->session->unset_userdata('prog_name');
		
		session_destroy();
		redirect(base_url());
	}
}
