<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_program extends CI_Model {
	
	private $_table = "program";

	public $program_id;
	public $program_parent_id;
	public $status_id;
	public $code;
	public $name;
	public $mobile_phone;
	public $office_email;
	public $address;
	public $picture;
	public $description;
	public $api_key;
	public $order_need_approval;
	public $order_parsing;
	public $market_place_activation;
	public $shipping_without_logo;
	public $courier_integration;
	public $marketplace_integration;
	public $backorder_condition;
  public $order_dropshiper;
  public $shipment_with_item;
  public $cod_activation;
  public $noncod_activation;
  public $order_stock_demaged;
  public $partial_fulfilment;
  public $required_serial_number;
  public $transfer_order;
  public $fast_fullfilment;
  public $b2b;
  public $order_default_entry;
  public $multi_channel;
  public $is_partner;
  public $is_invinity_stock;
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
        return $this->db->get_where($this->_table, ["program_id" => $id])->row();
    }

  public function getByLocationId($location_id)
    {
      $this->db->join('locationprogram', 'locationprogram.program_id = program.program_id');
      return $this->db->get_where($this->_table, ["locationprogram.location_id" => $location_id])->result();
    }

  public function save()
    {
        $post = $this->input->post();
        $this->program_id = uniqid();
        $this->program_parent_id = $post["program_parent_id"];
        $this->status_id = $post["status_id"];
        $this->code = $post["code"];
        $this->name = $post["name"];
        $this->mobile_phone = $post["mobile_phone"];
        $this->office_email = $post["office_email"];
        $this->address = $post["address"];
        $this->picture = $post["picture"];
        $this->api_key = $post["api_key"];
        $this->order_need_approval = $post["order_need_approval"];
        $this->order_parsing = $post["order_parsing"];
       	$this->market_place_activation = $post["market_place_activation"];
       	$this->shipping_without_logo = $post["shipping_without_logo"];
       	$this->courier_integration = $post["courier_integration"];
       	$this->marketplace_integration = $post["marketplace_integration"];
       	$this->backorder_condition = $post["backorder_condition"];
       	$this->order_dropshiper = $post["order_dropshiper"];
        $this->shipment_with_item = $post["shipment_with_item"];
        $this->cod_activation = $post["cod_activation"];
        $this->noncod_activation = $post["noncod_activation"];
        $this->order_stock_demaged = $post["order_stock_demaged"];
        $this->partial_fulfilment = $post["partial_fulfilment"];
        $this->required_serial_number = $post["required_serial_number"];
        $this->transfer_order = $post["transfer_order"];
        $this->fast_fullfilment = $post["fast_fullfilment"];
        $this->b2b = $post["b2b"];
        $this->order_default_entry = $post["order_default_entry"];
        $this->multi_channel = $post["multi_channel"];
        $this->is_partner = $post["is_partner"];
        $this->is_invinity_stock = $post["is_invinity_stock"];
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
        $this->program_id = uniqid();
        $this->program_parent_id = $post["program_parent_id"];
        $this->status_id = $post["status_id"];
        $this->code = $post["code"];
        $this->name = $post["name"];
        $this->mobile_phone = $post["mobile_phone"];
        $this->office_email = $post["office_email"];
        $this->address = $post["address"];
        $this->picture = $post["picture"];
        $this->api_key = $post["api_key"];
        $this->order_need_approval = $post["order_need_approval"];
        $this->order_parsing = $post["order_parsing"];
        $this->market_place_activation = $post["market_place_activation"];
        $this->shipping_without_logo = $post["shipping_without_logo"];
        $this->courier_integration = $post["courier_integration"];
        $this->marketplace_integration = $post["marketplace_integration"];
        $this->backorder_condition = $post["backorder_condition"];
        $this->order_dropshiper = $post["order_dropshiper"];
        $this->shipment_with_item = $post["shipment_with_item"];
        $this->cod_activation = $post["cod_activation"];
        $this->noncod_activation = $post["noncod_activation"];
        $this->order_stock_demaged = $post["order_stock_demaged"];
        $this->partial_fulfilment = $post["partial_fulfilment"];
        $this->required_serial_number = $post["required_serial_number"];
        $this->transfer_order = $post["transfer_order"];
        $this->fast_fullfilment = $post["fast_fullfilment"];
        $this->b2b = $post["b2b"];
        $this->order_default_entry = $post["order_default_entry"];
        $this->multi_channel = $post["multi_channel"];
        $this->is_partner = $post["is_partner"];
        $this->is_invinity_stock = $post["is_invinity_stock"];
        $this->update_by = $post["update_by"];
        $this->created_date = $post["created_date"];
        $this->modified_date = $post["modified_date"];
        $this->created_by = $post["created_by"];
        $this->modified_by = $post["modified_by"];
        return $this->db->update($this->_table, $this, array('program_id' => $post['id']));
    }

  public function delete($id)
    {
        return $this->db->delete($this->_table, array("program_id" => $id));
    }



}