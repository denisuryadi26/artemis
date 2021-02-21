<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_location extends CI_Model {
	
	private $_table = "location";

	public $location_id;
	public $location_type_id;
	public $code;
	public $name;
	public $phone;
	public $email;
	public $address;
	public $district;
	public $city;
	public $province;
	public $country;
	public $latitude;
	public $longitude;
	public $update_by;
	public $created_date;
	public $modified_date;
	public $created_by;
	public $modified_by;

	public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["location_id" => $id])->row();
    }

    function get_location_list($limit, $start){
        $query = $this->db->get('location', $limit, $start);
        return $query;
    }

    public function save()
    {
        $post = $this->input->post();
        $this->location_id = uniqid();
        $this->location_type_id = $post["location_type_id"];
        $this->code = $post["code"];
        $this->name = $post["name"];
        $this->phone = $post["post"];
        $this->email = $post["email"];
        $this->address = $post["address"];
        $this->district = $post["district"];
        $this->city = $post["city"];
        $this->province = $post["province"];
        $this->country = $post["country"];
        $this->latitude = $post["latitude"];
       	$this->longitude = $post["longitude"];
       	$this->update_by = $post["update_by"];
       	$this->created_date = $post["created_date"];
       	$this->modified_date = $post["modified_date"];
       	$this->created_by = $post["created_by"];
       	$this->modified_by = $post["modified_by"];
        return $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->location_id = uniqid();
        $this->location_type_id = $post["location_type_id"];
        $this->code = $post["code"];
        $this->name = $post["name"];
        $this->phone = $post["post"];
        $this->email = $post["email"];
        $this->address = $post["address"];
        $this->district = $post["district"];
        $this->city = $post["city"];
        $this->province = $post["province"];
        $this->country = $post["country"];
        $this->latitude = $post["latitude"];
       	$this->longitude = $post["longitude"];
       	$this->update_by = $post["update_by"];
       	$this->created_date = $post["created_date"];
       	$this->modified_date = $post["modified_date"];
       	$this->created_by = $post["created_by"];
       	$this->modified_by = $post["modified_by"];
        return $this->db->update($this->_table, $this, array('location_id' => $post['id']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("location_id" => $id));
    }



}