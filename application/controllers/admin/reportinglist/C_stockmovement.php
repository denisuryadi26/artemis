<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_stockmovement extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("M_nav");
    }

	//Halaman C_stockmovement
	public function index()
	{
		$data['navlocation'] = $this->M_nav->getNav();
		$data['title'] = 'Stock Movement';
		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav',$data);
		$this->load->view('admin/reportinglist/v_stockmovement');
		$this->load->view('admin/layout/v_footer');
	}

	public function download_stockmovement_report()
    {
        include APPPATH.'third_party/PHPExcel/PHPExcel.php';

		$location_id = $this->session->userdata('location_id');
        $program_id = $this->session->userdata('program_id');
 
        // membuat obyek dari class PHPExcel
        $objPHPExcel = new PHPExcel();
        // memberi nama sheet pertama dengan nama 'Sheet 1'
        $objPHPExcel->getSheet(0)->setTitle('STOCK AGING INFORMATION');

        // Isi Sheet 1
        // STYLE
        $style_col = array(
            'font'      => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top'    => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right'  => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left'   => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top'    => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right'  => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left'   => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
        $border = array(
            'borders' => array(
                'top'    => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right'  => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left'   => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
        $center = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
            ),
        );
        $right = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
            ),
        );
        // END STYLE

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "Location Name");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', "Item Code");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', "Item Name");  
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', "Barcode");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', "Marketplace");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', "Grid");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', "Start/End Date");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1', "Client Name");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', "Market Place");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J1', "Item Code");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K1', "Item Name");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L1', "Barcode");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M1', "Ready Order");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N1', "Grid Name");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O1', "Managed By");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P1', "Item Information");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q1', "Ready Order");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R1', "OnHand");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S1', "Damaged");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T1', "Inbound Date");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('U1', "Cut Off");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('V1', "Stock Aging");

        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('F1')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('G1')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('H1')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('I1')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('J1')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('K1')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('L1')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('M1')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('N1')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('O1')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('P1')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('Q1')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('R1')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('S1')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('T1')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('U1')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('V1')->applyFromArray($style_col);

        $item_code        = $this->input->post('item_code');
        if(!empty($item_code))
        {
            $i_code = "AND item_code = '$item_code'";
        }
        else
        {
            $i_code = "";
        }

        $item_name        = $this->input->post('item_name');
        if(!empty($item_name))
        {
            $i_name = "AND item_name = '$item_name'";
        }
        else
        {
            $i_name = "";
        }
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

        $all_client         = $this->input->post('all_client');
        $all_location       = $this->input->post('all_location');
        $filterclient      = $this->session->userdata('client');
        $filterlocation     = $this->session->userdata('list_location_id');

        // Untuk client privilage peruser
        $stringclient = "";
		foreach($filterclient as $client)
		{
			$stringclient = $stringclient.",".$client[0];
		}
        $stringclient = ltrim($stringclient, ',');

        // Untuk location privilage peruser
        $stringlocation = "";
		foreach($filterlocation as $location)
		{
			$stringlocation = $stringlocation.",".$location[0];
		}
        $stringlocation = ltrim($stringlocation, ',');

        
        if(!empty($all_client))
                $file_name = "arrival_all_client_".date("Ymd")."_".date("His");
            else
                $file_name = "arrival_".strtolower(str_replace(' ', '_', $program_name))."_".date("Ymd")."_".date("His");

        if (!empty($all_client))
        {
            $client = "AND b.program_id in (".$stringclient.")";
            // $client = "";

        }
        else
        {
            $client = " AND b.program_id = ".$program_id;
        }

        if (!empty($all_location))
        {
            $location = "AND inv.location_id in (".$stringlocation.")";
            // $location = "";
        }
        else
        {
            $location = " AND inv.location_id = ".$location_id;
        }

        if (!empty($start_date) || !empty($end_date) )
        {
            if ($start_date == $end_date){
                $start_date = "AND DATE(created_date) = '$start_date' ";
            }
            else
            {
                if (!empty($start_date)){
                    $start_date = "AND created_date >= '$start_date'";
                }
                if (!empty($end_date)){
                    $end_date = "AND created_date <= DATE(TO_DATE('$end_date', 'YYYY-MM-DD') + interval '1 day')";
                }
            }
        }
        else {
            $start_date="";
            $end_date="";
        }
        
        $select_m = '';
        $select_n = '';
        $count_m = 1;
        $count_n = 1;
        
        $start = new DateTime($start_date);
        $end = new DateTime($end_date);
        $end->add(new DateInterval('P1D'));
        
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($start, $interval, $end);
        
        $total_day = 0;
        foreach($period as $dt)
        {
            $total_day++;
        }

        // if(is_client == 0)
        //                     {
        //                     $is_client = "LEFT JOIN (
        //                         SELECT c.program_item_id, SUM((to_quantity-from_quantity)) AS adj_qty
        //                         FROM inventoryadjustment a JOIN inventorydetail b ON a.inventory_detail_id = b.inventory_detail_id
        //                         JOIN inventory c ON b.inventory_id = c.inventory_id 
        //                         WHERE DATE(a.created_date) < $start_date
        //                         GROUP BY c.program_item_id
        //                         ) adj ON b.program_item_id = adj.program_item_id";
        //                     }

        // if(is_client == 0)  {
        //                     $is_client2 = "LEFT JOIN (
        //                         SELECT c.program_item_id, SUM((to_quantity-from_quantity)) AS adj_qty
        //                         FROM inventoryadjustment a JOIN inventorydetail b ON a.inventory_detail_id = b.inventory_detail_id
        //                         JOIN inventory c ON b.inventory_id = c.inventory_id 
        //                         WHERE DATE(a.created_date) < $dt->format('Y-m-d')
        //                         GROUP BY c.program_item_id
        //                         ) adj ON b.program_item_id = adj.program_item_id";
        //                     }

        // if(is_client == 0)  {
        //                     $is_client3 = "LEFT JOIN (
        //                         SELECT c.program_item_id, SUM((to_quantity-from_quantity)) AS adj_qty
        //                         FROM inventoryadjustment a JOIN inventorydetail b ON a.inventory_detail_id = b.inventory_detail_id
        //                         JOIN inventory c ON b.inventory_id = c.inventory_id 
        //                         WHERE DATE(a.created_date) = $dt->format('Y-m-d')
        //                         GROUP BY c.program_item_id
        //                         ) adj ON b.program_item_id = adj.program_item_id";
        //                     }

        // $query2 = foreach($period as $dt)
        //                     {
        //                         "LEFT JOIN (
                                
        //                         SELECT a.program_item_id, b.item_code, b.item_name, stock_bfr, (stock_bfr+stock_aft) AS stock_now FROM (
        //                         SELECT b.program_item_id, b.code AS item_code, b.name AS item_name, 
        //                         (IFNULL(inbound,'0') + IFNULL(kitting_in,'0')) - (IFNULL(kitting_out,'0') + IFNULL(reject,'0') + IFNULL(outbound,'0') + IFNULL(shipped,'0')) + IFNULL(adj_qty, '0') AS stock_bfr
        //                         FROM  programitem b
        //                         LEFT JOIN inventory inv ON b.program_item_id = inv.program_item_id
        //                         LEFT JOIN(
        //                         SELECT program_item_id, SUM(order_quantity) AS outbound 
        //                         FROM orderdetail a JOIN orderheader b ON a.order_header_id = b.order_header_id
        //                         WHERE a.status_id IN('16','8','9','10') AND DATE(a.created_date) < $dt->format('Y-m-d')
        //                         GROUP BY program_item_id
        //                         ) e ON b.program_item_id = e.program_item_id LEFT JOIN (
        //                         SELECT program_item_id, SUM(order_quantity) AS shipped 
        //                         FROM orderdetail a JOIN orderheader b ON a.order_header_id = b.order_header_id
        //                         WHERE a.status_id IN ('11','12','15') AND DATE(a.created_date) < $dt->format('Y-m-d')
        //                         GROUP BY program_item_id
        //                         ) h ON b.program_item_id = h.program_item_id LEFT JOIN (
        //                         SELECT program_item_id, SUM(b.putaway_quantity) AS inbound 
        //                         FROM packinglistdetail a 
        //                         JOIN packinglistallocation b ON a.packinglist_detail_id = b.packinglist_detail_id
        //                         WHERE DATE(a.created_date) < $dt->format('Y-m-d')
        //                         GROUP BY program_item_id
        //                         ) inb ON b.program_item_id = inb.program_item_id LEFT JOIN (
        //                         SELECT program_item_id, SUM(quantity) AS reject 
        //                         FROM rejecthistory a 
        //                         JOIN inventorydetail b ON a.inventory_detail_id = b.inventory_detail_id
        //                         JOIN inventory c ON b.inventory_id = c.inventory_id
        //                         WHERE DATE(a.created_date) < $dt->format('Y-m-d')
        //                         GROUP BY program_item_id
        //                         ) rjc ON b.program_item_id = rjc.program_item_id LEFT JOIN (
        //                         SELECT c.child_id, SUM(finishing_quantity) AS kitting_out
        //                         FROM kitting a JOIN programitem b ON a.program_item_id = b.program_item_id
        //                         JOIN itembundling c ON b.program_item_id = c.parent_id
        //                         WHERE a.status_id IN ('17','18','19') AND DATE(a.created_date) < $dt->format('Y-m-d')
        //                         GROUP BY c.child_id
        //                         ) kt_out ON b.program_item_id = kt_out.child_id LEFT JOIN (
        //                         SELECT b.program_item_id, SUM(finishing_quantity) AS kitting_in
        //                         FROM kitting a JOIN programitem b ON a.program_item_id = b.program_item_id
        //                         WHERE a.status_id IN (''17'',''18'',''19'') AND DATE(a.created_date) < $dt->format('Y-m-d')
        //                         GROUP BY b.program_item_id
        //                         ) kt_in ON b.program_item_id = kt_in.program_item_id 

        //                         $is_client2
        //                         WHERE 1=1  
        //                         $client
        //                         $location

        //                         ) a LEFT JOIN (
        //                         SELECT b.program_item_id, b.code AS item_code, b.name AS item_name, 
        //                         (IFNULL(inbound,'0') + IFNULL(kitting_in,'0')) - (IFNULL(kitting_out,'0') + IFNULL(reject,'0') + IFNULL(outbound,'0') + IFNULL(shipped,'0')) + IFNULL(adj_qty, '0') AS stock_aft
        //                         FROM  programitem b 
        //                         LEFT JOIN inventory inv ON b.program_item_id = inv.program_item_id
        //                         LEFT JOIN(
        //                         SELECT program_item_id, SUM(order_quantity) AS outbound 
        //                         FROM orderdetail a JOIN orderheader b ON a.order_header_id = b.order_header_id
        //                         WHERE a.status_id IN('16','8','9','10') AND DATE(a.created_date) = $dt->format('Y-m-d')
        //                         GROUP BY program_item_id
        //                         ) e ON b.program_item_id = e.program_item_id LEFT JOIN (
        //                         SELECT program_item_id, SUM(order_quantity) AS shipped 
        //                         FROM orderdetail a JOIN orderheader b ON a.order_header_id = b.order_header_id
        //                         WHERE a.status_id IN ('11','12','15') AND DATE(a.created_date) = $dt->format('Y-m-d')
        //                         GROUP BY program_item_id
        //                         ) h ON b.program_item_id = h.program_item_id LEFT JOIN (
        //                         SELECT program_item_id, SUM(b.putaway_quantity) AS inbound 
        //                         FROM packinglistdetail a 
        //                         JOIN packinglistallocation b ON a.packinglist_detail_id = b.packinglist_detail_id
        //                         WHERE DATE(a.created_date) = $dt->format('Y-m-d')
        //                         GROUP BY program_item_id
        //                         ) inb ON b.program_item_id = inb.program_item_id LEFT JOIN (
        //                         SELECT program_item_id, SUM(quantity) AS reject 
        //                         FROM rejecthistory a 
        //                         JOIN inventorydetail b ON a.inventory_detail_id = b.inventory_detail_id
        //                         JOIN inventory c ON b.inventory_id = c.inventory_id
        //                         WHERE DATE(a.created_date) = $dt->format('Y-m-d')
        //                         GROUP BY program_item_id
        //                         ) rjc ON b.program_item_id = rjc.program_item_id LEFT JOIN (
        //                         SELECT c.child_id, SUM(finishing_quantity) AS kitting_out
        //                         FROM kitting a JOIN programitem b ON a.program_item_id = b.program_item_id
        //                         JOIN itembundling c ON b.program_item_id = c.parent_id
        //                         WHERE a.status_id IN ('17','18','19') AND DATE(a.created_date) = $dt->format('Y-m-d')
        //                         GROUP BY c.child_id
        //                         ) kt_out ON b.program_item_id = kt_out.child_id LEFT JOIN (
        //                         SELECT b.program_item_id, SUM(finishing_quantity) AS kitting_in
        //                         FROM kitting a JOIN programitem b ON a.program_item_id = b.program_item_id
        //                         WHERE a.status_id IN ('17','18','19') AND DATE(a.created_date) = $dt->format('Y-m-d')
        //                         GROUP BY b.program_item_id
        //                         ) kt_in ON b.program_item_id = kt_in.program_item_id

        //                         $is_client3

        //                         WHERE 1=1  
        //                         $client
        //                         $location

        //                         ORDER BY b.program_id, b.code
        //                         ) b ON a.program_item_id = b.program_item_id) b'.$count_n.' ON stock_bef.program_item_id = b'.$count_n.'.program_item_id";
        //                         $count_n++;
        //                     }

        // $stockmovement       = " SELECT
        //                         stock_bef.location_name AS location_name,
        //                         stock_bef.client_name AS program_name,
        //                         stock_bef.item_code AS item_sku, 
        //                         stock_bef.item_name AS item_name, 
        //                         stock_bef AS stock_before , 
        //                         foreach($period as $dt) 
		// 		                {
        //                         IFNULL(COUNT(b'.$count_m.'.stock_now, 0) AS $dt->format('Y-m-d')
        //                         $count_m++;
		// 		                }
        //                         if($select_m != ''){
		// 			            $select_m;
        //                         }
        //                     FROM (
        //                         SELECT cl.name AS client_name, lc.name AS location_name, b.program_item_id, b.code AS item_code, b.name AS item_name,
        //                             (IFNULL(inbound,'0') + IFNULL(kitting_in,'0')) -
        //                             (IFNULL(kitting_out,'0') + IFNULL(reject,'0') + IFNULL(outbound,'0') + IFNULL(shipped,'0'))
        //                             + IFNULL(adj_qty, '0') AS stock_bef
        //                         FROM programitem b 
        //                     LEFT JOIN program cl ON b.program_id = cl.program_id
        //                     LEFT JOIN inventory inv ON b.program_item_id = inv.program_item_id
        //                     LEFT JOIN location lc ON inv.location_id = lc.location_id
        //                     LEFT JOIN(
        //                         SELECT program_item_id, SUM(order_quantity) AS outbound 
        //                         FROM orderdetail a JOIN orderheader b ON a.order_header_id = b.order_header_id
        //                         WHERE a.status_id IN('16','8','9','10') AND DATE(a.created_date) < $start_date
        //                         GROUP BY program_item_id
        //                         ) e ON b.program_item_id = e.program_item_id 
        //                     LEFT JOIN (
        //                         SELECT program_item_id, SUM(order_quantity) AS shipped 
        //                         FROM orderdetail a JOIN orderheader b ON a.order_header_id = b.order_header_id
        //                         WHERE a.status_id IN ('11','12','15') AND DATE(a.created_date) < $start_date
        //                         GROUP BY program_item_id
        //                         ) h ON b.program_item_id = h.program_item_id 
        //                     LEFT JOIN (
        //                         SELECT program_item_id, SUM(b.putaway_quantity) AS inbound 
        //                         FROM packinglistdetail a 
        //                         JOIN packinglistallocation b ON a.packinglist_detail_id = b.packinglist_detail_id
        //                         WHERE DATE(a.created_date) < $start_date
        //                         GROUP BY program_item_id
        //                         ) inb ON b.program_item_id = inb.program_item_id 
        //                     LEFT JOIN (
        //                         SELECT program_item_id, SUM(quantity) AS reject 
        //                         FROM rejecthistory a 
        //                         JOIN inventorydetail b ON a.inventory_detail_id = b.inventory_detail_id
        //                         JOIN inventory c ON b.inventory_id = c.inventory_id
        //                         WHERE DATE(a.created_date) < $start_date
        //                         GROUP BY program_item_id
        //                         ) rjc ON b.program_item_id = rjc.program_item_id 
        //                     LEFT JOIN (
        //                         SELECT c.child_id, SUM(finishing_quantity * c.quantity) AS kitting_out
        //                         FROM kitting a JOIN programitem b ON a.program_item_id = b.program_item_id
        //                         JOIN itembundling c ON b.program_item_id = c.parent_id
        //                         WHERE a.status_id IN ('17','18','19') AND DATE(a.created_date) < $start_date
        //                         GROUP BY c.child_id
        //                         ) kt_out ON b.program_item_id = kt_out.child_id 
        //                     LEFT JOIN (
        //                         SELECT b.program_item_id, SUM(finishing_quantity) AS kitting_in
        //                         FROM kitting a JOIN programitem b ON a.program_item_id = b.program_item_id
        //                         WHERE a.status_id IN ('17','18','19') AND DATE(a.created_date) < $start_date
        //                         GROUP BY b.program_item_id
        //                         ) kt_in ON b.program_item_id = kt_in.program_item_id
                                
        //                         $is_client

        //                     WHERE 1=1   
        //                     $i_code
        //                     $i_name
        //                     $client
        //                     $location

        //                     ) stock_bef 

        //                     $query2";

        //                     if($select_n != '')
        //                     $select .= $select_n;
        // echo $stockmovement;die;
        // $download  =  $this->db->query($stockmovement)->result();
        $no           =  1;
        $numrow       =  2;
        
        foreach($download as $data_download){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $data_download->location_name);     
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, "'".$data_download->item_code);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data_download->item_name);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, "'".$data_download->barcode);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data_download->marketplace);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data_download->grid);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data_download->start_end_date);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data_download->client_name);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data_download->marketplace);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('j'.$numrow, "'".$data_download->item_code);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data_download->item_name);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, "'".$data_download->barcode);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $data_download->ready_order);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $data_download->grid_name);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $data_download->managed_by);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$numrow, $data_download->item_information);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$numrow, $data_download->ready_order);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.$numrow, $data_download->onhand);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'.$numrow, $data_download->damaged);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.$numrow, $data_download->inbound_date);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('U'.$numrow, $data_download->cut_off);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('V'.$numrow, $data_download->stock_aging);

            $objPHPExcel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('P'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('Q'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('R'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('S'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('T'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('U'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('V'.$numrow)->applyFromArray($style_row);


            $no++;
            $numrow++;
        }
        

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(20);

        // mengeset sheet yang aktif
        $objPHPExcel->setActiveSheetIndex(0);
        
       
        // output file dengan nama file 'contoh.xls'
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="STOCK AGING INFORMATION.xlsx"');
        header('Cache-Control: max-age=0');
         
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }
}