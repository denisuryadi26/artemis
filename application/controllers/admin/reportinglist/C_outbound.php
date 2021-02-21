<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    // Load library phpspreadsheet
    require('./excel/vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\Helper\Sample;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    // End load library phpspreadsheet

class C_outbound extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("M_nav");
    }

	//Halaman C_outbound
	public function index()
	{
		$data['navlocation'] = $this->M_nav->getNav();
		$data['title'] = 'Outbound';
		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav',$data);
		$this->load->view('admin/reportinglist/v_outbound');
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

        $start_date       = $this->input->post('start_date');
        $end_date         = $this->input->post('end_date');
        if (!empty($start_date) || !empty($end_date) )
        {
            if ($start_date == $end_date)
                $start_date = "AND DATE(order_created_date) = '$start_date' ";
            else
            {
                if (!empty($start_date))
                    $start_date = "AND order_created_date >= '$start_date'";
                if (!empty($end_date))
                    $end_date = "AND order_created_date <= DATE(TO_DATE('$end_date', 'YYYY-MM-DD') + interval '1 day')";
            }
        }
        else {
            $start_date="";
            $end_date="";
        }

        $is_client = $this->session->userdata('is_client');
        if($is_client == 0)
                $is_clientquery = 'shipping_fee, discount, ';
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

        if(!empty($all_client))
                $file_name = "outbound_all_client_".date("Ymd")."_".date("His");
            else
                $file_name = "outbound_".strtolower(str_replace(' ', '_', $program_name))."_".date("Ymd")."_".date("His");
        $outboundinformation       = " SELECT
								program_name,
                                location_name,
                                last_status,
                                order_code,
                                TO_CHAR(order_created_date, 'mm/dd/YYYY HH24:MI') AS order_created_date,
                                $is_clientquery
                                TO_CHAR(ready_to_pick_date, 'mm/dd/YYYY HH24:MI') AS ready_to_pick_date, 
                                ready_to_pick_by, 
                                print_by,
                                TO_CHAR(print_date, 'mm/dd/YYYY HH24:MI') AS print_date, 
                                assign_by, 
                                TO_CHAR(assign_date, 'mm/dd/YYYY HH24:MI') AS assign_date, 
                                picking_by, 
                                picking_start, 
                                picking_end, 
                                received_by, 
                                TO_CHAR(received_date, 'mm/dd/YYYY HH24:MI') AS received_date, 
                                packing_by, 
                                packing_type, 
                                packing_start, 
                                packing_end
							FROM outboundinformation
							WHERE 1=1 
                            -- AND program_status_id <> '3'   
							$location
                            $client
                            $o_code
                            $w_number
                            $p_type
                            $l_status
                            $start_date
                            $end_date";
        // echo $outboundinformation;die;
        // $data['outboundinformationinfo']  =  $this->db->query($outboundinformation)->result();
        // $data['all_client']         = $this->input->post('all_client');
        // $data['all_location']        = $this->input->post('all_location');
        
        
        // $this->load->view('admin/reportinglist/export/exportoutbound', $data);

        // file name 
        $filename = 'users_'.date('Ymd').'.csv'; 
        header("Content-Description: File Transfer"); 
        header('Content-Disposition: attachment;filename="'. $file_name .'.csv"'); 
        header("Content-Type: application/csv; ");
        
        // get data 
        $outbounddownload     =  $this->db->query($outboundinformation)->result_array();
        // $usersData = $this->Main_model->getUserDetails();

        // file creation 
        $file = fopen('php://output', 'w');
        
        $header = array("Client Name",
                        "Location Name",
                        "Last Status",
                        "Order Code",
                        "Created Date",
                        "Shipping Fee",
                        "Discount",
                        "Ready To Pick Date",
                        "Ready To Pick By",
                        "Print By",
                        "Print Date",
                        "Assign By",
                        "Assign Date",
                        "Picking By",
                        "Picking Start",
                        "Picking End",
                        "Received By",
                        "Received Date",
                        "Packing By",
                        "Packing Type",
                        "Packing Start",
                        "Packing End"
                    ); 
        fputcsv($file, $header);
        foreach ($outbounddownload as $row){ 
            fputcsv($file,$row);
        }
        fclose($file); 
        exit;

        // $outboundinformationdownload  =  $this->db->query($outboundinformation)->result();
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
        // ->setCellValue('C1', 'Last Status')
        // ->setCellValue('D1', 'Order Code')
        // ->setCellValue('E1', 'Created Date')
        // ->setCellValue('F1', 'Shipping Fee')
        // ->setCellValue('G1', 'Discount')
        // ->setCellValue('H1', 'Ready To Pick Date')
        // ->setCellValue('I1', 'Ready To Pick By')
        // ->setCellValue('J1', 'Print By')
        // ->setCellValue('K1', 'Print Date')
        // ->setCellValue('L1', 'Assign By')
        // ->setCellValue('M1', 'Assign Date')
        // ->setCellValue('N1', 'Picking By')
        // ->setCellValue('O1', 'Picking Start')
        // ->setCellValue('P1', 'Picking End')
        // ->setCellValue('Q1', 'Received By')
        // ->setCellValue('R1', 'Received Date')
        // ->setCellValue('S1', 'Packing By')
        // ->setCellValue('T1', 'Packing Type')
        // ->setCellValue('U1', 'Packing Start')
        // ->setCellValue('V1', 'Packing End')

        // ;

        // // Miscellaneous glyphs, UTF-8
        // $i=2; foreach($outboundinformationdownload as $data) {

        // $spreadsheet->setActiveSheetIndex(0)
        // ->setCellValue('A'.$i, $data->program_name)
        // ->setCellValue('B'.$i, $data->location_name)
        // ->setCellValue('C'.$i, $data->last_status)
        // ->setCellValue('D'.$i, "'".$data->order_code)
        // ->setCellValue('E'.$i, $data->order_created_date)
        // ->setCellValue('F'.$i, $data->shipping_fee)
        // ->setCellValue('G'.$i, $data->discount)
        // ->setCellValue('H'.$i, $data->ready_to_pick_date)
        // ->setCellValue('I'.$i, $data->ready_to_pick_by)
        // ->setCellValue('J'.$i, $data->print_by)
        // ->setCellValue('K'.$i, $data->print_date)
        // ->setCellValue('L'.$i, $data->assign_by)
        // ->setCellValue('M'.$i, $data->assign_date)
        // ->setCellValue('N'.$i, $data->picking_by)
        // ->setCellValue('O'.$i, $data->picking_start)
        // ->setCellValue('P'.$i, $data->picking_end)
        // ->setCellValue('Q'.$i, $data->received_by)
        // ->setCellValue('R'.$i, $data->received_date)
        // ->setCellValue('S'.$i, $data->packing_by)
        // ->setCellValue('T'.$i, $data->packing_type)
        // ->setCellValue('U'.$i, $data->packing_start)
        // ->setCellValue('V'.$i, $data->packing_end);
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
        // $spreadsheet->getActiveSheet()->setTitle('Outbound '.date('Ymd'));

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