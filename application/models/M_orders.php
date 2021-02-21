<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_orders extends CI_Model {


    public function orders()
    {
        $where = array();
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
        // echo var_dump($this->session->userdata('program_id'));
        if(!empty($this->input->get('order_search_by1') && $this->input->get('order_search_value1')))
        {
            $where[] = " AND CAST(".$this->input->get('order_search_by1')." AS TEXT) LIKE '%".$this->input->get('order_search_value1')."%'";
        }
        elseif(!empty($this->input->get('order_search_by1') == 'Entry'))
        {
            $where[] = " AND status = 'Entry'";
        }
        elseif(!empty($this->input->get('order_search_by1') == 'Backorder'))
        {
            $where[] = " AND status = 'Backorder'";
        }
        elseif(!empty($this->input->get('order_search_by1') == 'Pending'))
        {
            $where[] = " AND status = 'Pending'";
        }
        elseif(!empty($this->input->get('order_search_by1') == 'Ready To Picked'))
        {
            $where[] = " AND status = 'Ready To Picked'";
        }
        elseif(!empty($this->input->get('order_search_by1') == 'Print Picklist'))
        {
            $where[] = " AND status = 'Print Picklist'";
        }
        elseif(!empty($this->input->get('order_search_by1') == 'Assign To Picker'))
        {
            $where[] = " AND status = 'Assign To Picker'";
        }
        elseif(!empty($this->input->get('order_search_by1') == 'Picked'))
        {
            $where[] = " AND status = 'Picked'";
        }
        elseif(!empty($this->input->get('order_search_by1') == 'Ready To Packed'))
        {
            $where[] = " AND status = 'Ready To Packed'";
        }
        elseif(!empty($this->input->get('order_search_by1') == 'Packed'))
        {
            $where[] = " AND status = 'Packed'";
        }
        elseif(!empty($this->input->get('order_search_by1') == 'Ready To Shipped'))
        {
            $where[] = " AND status = 'Ready To Shipped'";
        }
        elseif(!empty($this->input->get('order_search_by1') == 'Shipped'))
        {
            $where[] = " AND status = 'Shipped'";
        }
        elseif(!empty($this->input->get('order_search_by1') == 'Delivered'))
        {
            $where[] = " AND status = 'Delivered'";
        }
        elseif(!empty($this->input->get('order_search_by1') == 'Returned'))
        {
            $where[] = " AND status = 'Returned'";
        }
        elseif(!empty($this->input->get('order_search_by1') == 'Canceled'))
        {
            $where[] = " AND status = 'Canceled'";
        }
        if(!empty($this->input->get('order_search_by2') && $this->input->get('order_search_value2')))
        {
            $where[] = " AND CAST(".$this->input->get('order_search_by2')." AS TEXT) LIKE '%".$this->input->get('order_search_value2')."%'";
        }
        elseif(!empty($this->input->get('order_search_by2') == 'Entry'))
        {
            $where[] = " AND status = 'Entry'";
        }
        elseif(!empty($this->input->get('order_search_by2') == 'Backorder'))
        {
            $where[] = " AND status = 'Backorder'";
        }
        elseif(!empty($this->input->get('order_search_by2') == 'Pending'))
        {
            $where[] = " AND status = 'Pending'";
        }
        elseif(!empty($this->input->get('order_search_by2') == 'Ready To Picked'))
        {
            $where[] = " AND status = 'Ready To Picked'";
        }
        elseif(!empty($this->input->get('order_search_by2') == 'Print Picklist'))
        {
            $where[] = " AND status = 'Print Picklist'";
        }
        elseif(!empty($this->input->get('order_search_by2') == 'Assign To Picker'))
        {
            $where[] = " AND status = 'Assign To Picker'";
        }
        elseif(!empty($this->input->get('order_search_by2') == 'Picked'))
        {
            $where[] = " AND status = 'Picked'";
        }
        elseif(!empty($this->input->get('order_search_by2') == 'Ready To Packed'))
        {
            $where[] = " AND status = 'Ready To Packed'";
        }
        elseif(!empty($this->input->get('order_search_by2') == 'Packed'))
        {
            $where[] = " AND status = 'Packed'";
        }
        elseif(!empty($this->input->get('order_search_by2') == 'Ready To Shipped'))
        {
            $where[] = " AND status = 'Ready To Shipped'";
        }
        elseif(!empty($this->input->get('order_search_by2') == 'Shipped'))
        {
            $where[] = " AND status = 'Shipped'";
        }
        elseif(!empty($this->input->get('order_search_by2') == 'Delivered'))
        {
            $where[] = " AND status = 'Delivered'";
        }
        elseif(!empty($this->input->get('order_search_by2') == 'Returned'))
        {
            $where[] = " AND status = 'Returned'";
        }
        elseif(!empty($this->input->get('order_search_by2') == 'Canceled'))
        {
            $where[] = " AND status = 'Canceled'";
        }
        $stringwhere = implode(" ", $where);

        $queryorders = " SELECT
                            order_code,
                            to_char(order_date,'YYYY-mm-dd') as date,
                            to_char(order_date,'HH24:MM:SS') as time,
                            waybill_number, 
                            recipient_name,
                            channel_type, 
                            order_created_by, 
                            status,
                            color
                            FROM orders
                            WHERE location_id = $location_id
                            and program_id = $program_id
                            $stringwhere
                            ORDER BY order_header_id DESC";
        // echo $queryorders;die;
        $orderinformation  =  $this->db->query($queryorders)->result();
        return $orderinformation;
    }
    
    // function get_order_datatables()
    // {
    //     $this->orders();
    //     if($_POST['length'] != -1)
    //     $this->db->limit($_POST['length'], $_POST['start']);
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    // function count_filtered()
    // {
    //     $this->orders();
    //     $query = $this->db->get();
    //     return $query->num_rows();
    // }
 
    // public function count_all()
    // {
    //     $this->db->from($this->table);
    //     return $this->db->count_all_results();
    // }

    public function orderswithitem()
    {
        $where = array();
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
        // echo var_dump($this->session->userdata('program_id'));
        if(!empty($this->input->get('orderitem_search_by1') && $this->input->get('orderitem_search_value1')))
        {
            $where[] = " AND CAST(".$this->input->get('orderitem_search_by1')." AS TEXT) LIKE '%".$this->input->get('orderitem_search_value1')."%'";
        }
        elseif(!empty($this->input->get('orderitem_search_by1') == 'Entry'))
        {
            $where[] = " AND status = 'Entry'";
        }
        elseif(!empty($this->input->get('orderitem_search_by1') == 'Backorder'))
        {
            $where[] = " AND status = 'Backorder'";
        }
        elseif(!empty($this->input->get('orderitem_search_by1') == 'Pending'))
        {
            $where[] = " AND status = 'Pending'";
        }
        elseif(!empty($this->input->get('orderitem_search_by1') == 'Ready To Picked'))
        {
            $where[] = " AND status = 'Ready To Picked'";
        }
        elseif(!empty($this->input->get('orderitem_search_by1') == 'Print Picklist'))
        {
            $where[] = " AND status = 'Print Picklist'";
        }
        elseif(!empty($this->input->get('orderitem_search_by1') == 'Assign To Picker'))
        {
            $where[] = " AND status = 'Assign To Picker'";
        }
        elseif(!empty($this->input->get('orderitem_search_by1') == 'Picked'))
        {
            $where[] = " AND status = 'Picked'";
        }
        elseif(!empty($this->input->get('orderitem_search_by1') == 'Ready To Packed'))
        {
            $where[] = " AND status = 'Ready To Packed'";
        }
        elseif(!empty($this->input->get('orderitem_search_by1') == 'Packed'))
        {
            $where[] = " AND status = 'Packed'";
        }
        elseif(!empty($this->input->get('orderitem_search_by1') == 'Ready To Shipped'))
        {
            $where[] = " AND status = 'Ready To Shipped'";
        }
        elseif(!empty($this->input->get('orderitem_search_by1') == 'Shipped'))
        {
            $where[] = " AND status = 'Shipped'";
        }
        elseif(!empty($this->input->get('orderitem_search_by1') == 'Delivered'))
        {
            $where[] = " AND status = 'Delivered'";
        }
        elseif(!empty($this->input->get('orderitem_search_by1') == 'Returned'))
        {
            $where[] = " AND status = 'Returned'";
        }
        elseif(!empty($this->input->get('orderitem_search_by1') == 'Canceled'))
        {
            $where[] = " AND status = 'Canceled'";
        }
        if(!empty($this->input->get('orderitem_search_by2') && $this->input->get('orderitem_search_value2')))
        {
            $where[] = " AND CAST(".$this->input->get('orderitem_search_by2')." AS TEXT) LIKE '%".$this->input->get('orderitem_search_value2')."%'";
        }
        elseif(!empty($this->input->get('orderitem_search_by2') == 'Entry'))
        {
            $where[] = " AND status = 'Entry'";
        }
        elseif(!empty($this->input->get('orderitem_search_by2') == 'Backorder'))
        {
            $where[] = " AND status = 'Backorder'";
        }
        elseif(!empty($this->input->get('orderitem_search_by2') == 'Pending'))
        {
            $where[] = " AND status = 'Pending'";
        }
        elseif(!empty($this->input->get('orderitem_search_by2') == 'Ready To Picked'))
        {
            $where[] = " AND status = 'Ready To Picked'";
        }
        elseif(!empty($this->input->get('orderitem_search_by2') == 'Print Picklist'))
        {
            $where[] = " AND status = 'Print Picklist'";
        }
        elseif(!empty($this->input->get('orderitem_search_by2') == 'Assign To Picker'))
        {
            $where[] = " AND status = 'Assign To Picker'";
        }
        elseif(!empty($this->input->get('orderitem_search_by2') == 'Picked'))
        {
            $where[] = " AND status = 'Picked'";
        }
        elseif(!empty($this->input->get('orderitem_search_by2') == 'Ready To Packed'))
        {
            $where[] = " AND status = 'Ready To Packed'";
        }
        elseif(!empty($this->input->get('orderitem_search_by2') == 'Packed'))
        {
            $where[] = " AND status = 'Packed'";
        }
        elseif(!empty($this->input->get('orderitem_search_by2') == 'Ready To Shipped'))
        {
            $where[] = " AND status = 'Ready To Shipped'";
        }
        elseif(!empty($this->input->get('orderitem_search_by2') == 'Shipped'))
        {
            $where[] = " AND status = 'Shipped'";
        }
        elseif(!empty($this->input->get('orderitem_search_by2') == 'Delivered'))
        {
            $where[] = " AND status = 'Delivered'";
        }
        elseif(!empty($this->input->get('orderitem_search_by2') == 'Returned'))
        {
            $where[] = " AND status = 'Returned'";
        }
        elseif(!empty($this->input->get('orderitem_search_by2') == 'Canceled'))
        {
            $where[] = " AND status = 'Canceled'";
        }
        $stringwhere = implode(" ", $where);
        // $this->db->select(' order_code,
        //                     item_code,
        //                     item_name,
        //                     qty,
        //                     picked,
        //                     status,
        //                     color');
        // $this->db->from('orderwithitem');
        // $this->db->where('location_id', $location_id);
        // $this->db->where('program_id', $program_id);
        // $this->db->limit(10);
        // $queryorders = $this->db->get()->result();
        // return ($queryorders);

        $queryorderwithitem = " SELECT
                            order_code,
                            item_code,
                            item_name,
                            qty,
                            picked,
                            status,
                            color
                            FROM orderwithitem
                            WHERE location_id = $location_id
                            and program_id = $program_id
                            $stringwhere
                            ORDER BY order_created_date DESC";
        // echo $queryorderwithitem;die;
        $orderwithitem  =  $this->db->query($queryorderwithitem)->result();
        return $orderwithitem;
    }

}