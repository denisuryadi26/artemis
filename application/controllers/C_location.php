<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_location extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_location");
        $this->load->library('pagination');
        $this->load->helper(array('url'));
    }

    public function querybuilder()
    {
        //$data = $this->db->query("SELECT location_id, name FROM location")->result();
        $this->db->where('name', 'WH Kamal');
        $data = $this->db->get('location')->result();
        // echo "<pre>";print_r($data);
        foreach ($data as $key => $value) {
            echo $value->location_id."<br>";
            echo $value->name."<br>";
        }
    }

    public function entry()
    {
        $this->db->select('status.status_id');
        $this->db->from('packinglistheader');
        $this->db->join('status', 'status.status_id = packinglistheader.status_id');
        $this->db->where([  'packinglistheader.status_id' => 4,
                            'packinglistheader.program_id' => 48,
                            'packinglistheader.location_id' => 1
                        ]);
        $query = $this->db->get()->result();
        // return $query;

        echo "<pre>";print_r(count($query));
    }

    public function index()
    {
        //konfigurasi pagination
        $config['total_rows'] = $this->db->count_all('location'); //total row
        $config['per_page'] = 5;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
 
        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
        $data['data'] = $this->M_location->get_location_list($config["per_page"], $data['page']);           
 
        $data['pagination'] = $this->pagination->create_links();

        $data["location"] = $this->M_location->getAll();
        
        $this->load->view("admin/layout/v_head",$data);
		$this->load->view("admin/layout/v_header");
		$this->load->view("admin/layout/v_nav",$data);
		$this->load->view("admin/location/list", $data);
		$this->load->view("admin/layout/v_footer");


        
 
        
    }

    public function add()
    {
        $location = $this->M_location;
        $validation = $this->form_validation;

        if ($validation->run()) {
            $location->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("admin/location/new_form");
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/location');
       
        $location = $this->M_location;
        $validation = $this->form_validation;

        if ($validation->run()) {
            $location->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["location"] = $location->getById($id);
        if (!$data["location"]) show_404();
        
        $this->load->view("admin/location/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->M_location->delete($id)) {
            redirect(site_url('admin/location'));
        }
    }
}