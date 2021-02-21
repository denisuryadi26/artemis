<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_inbound_mitra extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!($this->session->has_userdata('users_id'))){
        redirect(base_url());
        }
        $this->load->model("M_location");
        $this->load->model("M_program");
        $this->load->model("M_nav");
        $this->load->model("inbound/M_inbound_mitra");
        // $this->load->model("charts/M_slamitratokped");
    }

	public function index()
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
        
        // $data['nilaislatokocabang'] 		                            = $this->M_inbound_mitra->getslaweektokocabang(date('M Y'), 'dawdaw');
        // $data['nilaisladaytokocabang'] 		                            = $this->M_inbound_mitra->getsladaytokocabang(date('M Y'), 'dawdaw');

		$data['title'] = 'Performance';
		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav',$data);
		$this->load->view('admin/dashboard/inbound/v_inbound_mitra',$data);
        $this->load->view('admin/layout/v_footer');

    }
    
    public function getSlaTopClient()
    {
        $date         = $this->input->post('date');
        $allclient       = $this->input->post('view_client_all');
        $nilaislatopclient = $this->M_inbound_mitra->getslatopclient($date, $allclient);

        echo json_encode(['nilaislatopclient' => $nilaislatopclient]);
        
    }
}

/* End of file C_performance.php */
/* Location: ./application/controllers/admin/C_performance.php */