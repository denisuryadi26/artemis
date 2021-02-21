<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    // Load library phpspreadsheet
    require('./excel/vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\Helper\Sample;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    // End load library phpspreadsheet

class C_picklist extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("M_nav");
    }

	//Halaman C_picklist
	public function index()
	{
		$data['navlocation'] = $this->M_nav->getNav();
		$data['title'] = 'Pick List';
		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav',$data);
		$this->load->view('admin/reportinglist/v_picklist');
		$this->load->view('admin/layout/v_footer');
	}

    // Export ke excel
    public function export()
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

        if($this->session->userdata('location_name'))
        {
            $location_name = $this->session->userdata('location_name');
            $program_name = $this->session->userdata('program_name');
        }
        else
        {
            $location_name = $this->session->userdata('loc_name');
            $program_name = $this->session->userdata('prog_name');
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
                $file_name = "picklist_all_client_".date("Ymd")."_".date("His");
            else
                $file_name = "picklist_".strtolower(str_replace(' ', '_', $program_name))."_".date("Ymd")."_".date("His");

        $order_code        = $this->input->post('order_code');
        if(!empty($order_code))
        {
            $o_code = "AND order_code = '$order_code'";
        }
        else
        {
            $o_code = "";
        }

        $waybill_number        = $this->input->post('waybill_number');
        if(!empty($waybill_number))
        {
            $w_number = "AND waybill_number = '$waybill_number'";
        }
        else
        {
            $w_number = "";
        }

        $courier_name        = $this->input->post('courier_name');
        if(!empty($courier_name))
        {
            $c_name = "AND courier_name = '$courier_name'";
        }
        else
        {
            $c_name = "";
        }

        $payment_type        = $this->input->post('payment_type');
        if(!empty($payment_type))
        {
            $p_type = "AND payment_type = '$payment_type'";
        }
        else
        {
            $p_type = "";
        }

        $last_status        = $this->input->post('last_status');
        if(!empty($last_status))
        {
            $l_status = "AND last_status = '$last_status'";
        }
        else
        {
            $l_status = "";
        }

        $grid        = $this->input->post('grid');
        if(!empty($grid))
        {
            $g_name = "AND grid_name = '$grid'";
        }
        else
        {
            $g_name = "";
        }

        $item_code        = $this->input->post('item_code');
        if(!empty($item_code))
        {
            $i_code = "AND item_sku = '$item_code'";
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
        $start_date_field       = $this->input->post('start_date');
        $end_date_field         = $this->input->post('end_date');
        if (!empty($start_date_field) || !empty($end_date_field) )
        {
            if ($start_date_field == $end_date_field)
            {
                $start_date = "AND DATE(order_created_date) = '$start_date_field' ";
                $end_date   = "";
            }
            else
            {
                if (!empty($start_date_field)){
                    $start_date = "AND order_created_date >= '$start_date_field'";
                }
                else{
                    $start_date = "";
                }
                if (!empty($end_date_field)){
                    $end_date = "AND order_created_date <= DATE(TO_DATE('$end_date_field', 'YYYY-MM-DD') + interval '1 day')";
                }
                else{
                    $end_date = "";
                }
            }
        }
        else {
            $start_date="";
            $end_date="";
        }

        if (!empty($all_client))
        {
            $client = "AND program_id in (".$stringclient.")";
            // $client = "";

        }
        else
        {
            $client = " AND program_id = ".$program_id;
        }

        if (!empty($all_location))
        {
            $location = "AND location_id in (".$stringlocation.")";
            // $location = "";
        }
        else
        {
            $location = " AND location_id = ".$location_id;
        }
        $orderpicklist       = " SELECT	
								program_name,
                                location_name,
                                order_code,
                                TO_CHAR(order_date, 'mm/dd/YYYY HH24:MI') AS order_date,
                                TO_CHAR(order_created_date, 'mm/dd/YYYY HH24:MI') AS order_created_date,
                                last_status,
                                market_place,
                                channel_name,
                                payment_type,
                                courier_name,
                                delivery_type,
                                parent_sku,
                                item_sku,
                                item_name,
                                item_barcode,
                                category,
                                brand,
                                color,
                                size,
                                grid,
                                allocation_quantity,
                                item_status,
                                remark
							FROM orderpicklist
							WHERE 1=1 
							$location
                            $client
                            $o_code
                            $w_number
                            $c_name
                            $p_type
                            $l_status
                            $g_name
                            $i_code
                            $i_name
                            $start_date
                            $end_date";
        // echo $orderpicklist;die;

        // file name 
        $filename = 'users_'.date('Ymd').'.csv'; 
        header("Content-Description: File Transfer"); 
        header('Content-Disposition: attachment;filename="'. $file_name .'.csv"'); 
        header("Content-Type: application/csv; ");
        
        // get data 
        $orderpicklistdownload     =  $this->db->query($orderpicklist)->result_array();
        // $usersData = $this->Main_model->getUserDetails();

        // file creation 
        $file = fopen('php://output', 'w');
        
        $header = array("Client Name",
                        "Location Name",
                        "Order Code",
                        "Order Date",
                        "Created Date",
                        "Last Status",
                        "Market Place",
                        "Channel Name",
                        "Payment Type",
                        "Courier Name",
                        "Delivery Type",
                        "Parent SKU",
                        "Item SKU",
                        "Item Name",
                        "Item Barcode",
                        "Category",
                        "Brand",
                        "Color",
                        "Size",
                        "Grid",
                        "Allocation Quantity",
                        "Item Status",
                        "Remark"
                    ); 
        fputcsv($file, $header);
        foreach ($orderpicklistdownload as $row){ 
            fputcsv($file,$row);
        }
        fclose($file); 
        exit;
        // $orderpicklistdownload  =  $this->db->query($orderpicklist)->result();
        // // $purchaseinfo = $this->provinsi_model->listing();
        // // Create new Spreadsheet object
        // $spreadsheet = new Spreadsheet();

        // // Set document properties
        // $spreadsheet->getProperties()->setCreator('Artemis')
        // ->setLastModifiedBy('Andoyo - Java Web Medi')
        // ->setTitle('Office 2007 XLSX Test Document')
        // ->setSubject('Office 2007 XLSX Test Document')
        // ->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
        // ->setKeywords('office 2007 openxml php')
        // ->setCategory('Test result file');

        // // Add some data
        // $spreadsheet->setActiveSheetIndex(0)
        // ->setCellValue('A1', 'Client Name')
        // ->setCellValue('B1', 'Location Name')
        // ->setCellValue('C1', 'Order Code')
        // ->setCellValue('D1', 'Order Date')
        // ->setCellValue('E1', 'Created Date')
        // ->setCellValue('F1', 'Last Status')
        // ->setCellValue('G1', 'Market Place')
        // ->setCellValue('H1', 'Channel Name')
        // ->setCellValue('I1', 'Payment Type')
        // ->setCellValue('J1', 'Courier Name')
        // ->setCellValue('K1', 'Delivery Type')
        // ->setCellValue('L1', 'Item SKU')
        // ->setCellValue('M1', 'Item Name')
        // ->setCellValue('N1', 'Item Barcode')
        // ->setCellValue('O1', 'Category')
        // ->setCellValue('P1', 'Brand')
        // ->setCellValue('Q1', 'Color')
        // ->setCellValue('R1', 'Size')
        // ->setCellValue('S1', 'Grid')
        // ->setCellValue('T1', 'Allocation Quantity')
        // ->setCellValue('U1', 'Item Status')
        // ->setCellValue('V1', 'Remark')

        // ;

        // // Miscellaneous glyphs, UTF-8
        // $i=2; foreach($orderpicklistdownload as $data) {

        // $spreadsheet->setActiveSheetIndex(0)
        // ->setCellValue('A'.$i, $data->program_name)
        // ->setCellValue('B'.$i, $data->location_name)
        // ->setCellValue('C'.$i, "'".$data->order_code)
        // ->setCellValue('D'.$i, $data->order_date)
        // ->setCellValue('E'.$i, $data->order_created_date)
        // ->setCellValue('F'.$i, $data->last_status)
        // ->setCellValue('G'.$i, $data->market_place)
        // ->setCellValue('H'.$i, $data->channel_name)
        // ->setCellValue('I'.$i, $data->payment_type)
        // ->setCellValue('J'.$i, $data->courier_name)
        // ->setCellValue('K'.$i, $data->delivery_type)
        // ->setCellValue('L'.$i, $data->item_sku)
        // ->setCellValue('M'.$i, $data->item_name)
        // ->setCellValue('N'.$i, $data->item_barcode)
        // ->setCellValue('O'.$i, $data->category)
        // ->setCellValue('P'.$i, $data->brand)
        // ->setCellValue('Q'.$i, $data->color)
        // ->setCellValue('R'.$i, $data->size)
        // ->setCellValue('S'.$i, $data->grid)
        // ->setCellValue('T'.$i, $data->allocation_quantity)
        // ->setCellValue('U'.$i, $data->item_status)
        // ->setCellValue('V'.$i, $data->remark);
        // $i++;
        // }

        // $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        // $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        // $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        // $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        // $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        // $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        // $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        // $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        // $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        // $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        // $spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        // $spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        // $spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        // $spreadsheet->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        // $spreadsheet->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        // $spreadsheet->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        // $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
        // $spreadsheet->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
        // $spreadsheet->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
        // $spreadsheet->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
        // $spreadsheet->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
        // $spreadsheet->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);

        // // Rename worksheet
        // $spreadsheet->getActiveSheet()->setTitle('Picklist '.date('Ymd'));

        // // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        // $spreadsheet->setActiveSheetIndex(0);

        // // Redirect output to a client’s web browser (Xlsx)
        // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // header('Content-Disposition: attachment;filename="'. $file_name .'.xlsx"');
        // header('Cache-Control: max-age=0');
        // // If you're serving to IE 9, then the following may be needed
        // header('Cache-Control: max-age=1');

        // // If you're serving to IE over SSL, then the following may be needed
        // // Matikan ini kalo mau di zip
        // header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        // header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        // header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        // header('Pragma: public'); // HTTP/1.0

        // $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        // $writer->save('php://output'); // Matikan ini jika mau di zip

        // // Nyalakan ini kalo mau di zip
        // // $excel_file_tmp = tempnam("/tmp", 'your_prefix');
        // // $writer->save($excel_file_tmp);

        // // $zip_file_tmp = tempnam("/tmp", 'your_prefix');
        // // $zip        = new ZipArchive();
        // // $zip->open($zip_file_tmp, ZipArchive::OVERWRITE);
        // // $zip->addFile($excel_file_tmp, $file_name.'.xlsx');
        // // $zip->close();

        // // //download
        // // $download_filename = $file_name.'.zip'; 
        // // header("Content-Type: application/zip");
        // // header("Content-Length: " . filesize($zip_file_tmp));
        // // header("Content-Disposition: attachment; filename=\"" . $download_filename . "\"");
        // // readfile($zip_file_tmp);
        // // unlink($excel_file_tmp);
        // // unlink($zip_file_tmp);

        // exit;
    }
}