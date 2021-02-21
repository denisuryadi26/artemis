<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    // Load library phpspreadsheet
    require('./excel/vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\Helper\Sample;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    // End load library phpspreadsheet

class C_outbounddetailbundling extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("M_nav");
    }

	//Halaman C_outbounddetailbundling
	public function index()
	{
		$data['navlocation'] = $this->M_nav->getNav();
		$data['title'] = 'Outbound Detail Bundling';
		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav',$data);
		$this->load->view('admin/reportinglist/v_outbounddetailbundling');
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
                $file_name = "outbound_bundling_all_client_".date("Ymd")."_".date("His");
            else
                $file_name = "outbound_bundling_".strtolower(str_replace(' ', '_', $program_name))."_".date("Ymd")."_".date("His");

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
        $outbounddetailbundling       = " SELECT
								program_name,
                                location_name,
                                order_code, 
                                TO_CHAR(order_date, 'mm/dd/YYYY HH24:MI') AS order_date,
                                status,
                                item_sku,
                                item_name,
                                item_child_sku,
                                item_child_name,
                                publish_price,
                                basic_price,
                                barcode,
                                category, 
                                brand, 
                                color, 
                                size, 
                                outbound_qty,
                                item_information,
                                TO_CHAR(outbound_date, 'mm/dd/YYYY HH24:MI') AS outbound_date,
                                created_by
							FROM outbounddetailbundling
							WHERE 1=1 
							$location
                            $client
                            $o_code
                            $w_number
                            $i_code
                            $i_name
                            $start_date
                            $end_date
                            GROUP BY outbound_bundling_id, child_id";
        // echo $outbounddetailbundling;die;
        // file name 
        $filename = 'users_'.date('Ymd').'.csv'; 
        header("Content-Description: File Transfer"); 
        header('Content-Disposition: attachment;filename="'. $file_name .'.csv"'); 
        header("Content-Type: application/csv; ");
        
        // get data 
        $outboundbundlingdownload     =  $this->db->query($outbounddetailbundling)->result_array();
        // $usersData = $this->Main_model->getUserDetails();

        // file creation 
        $file = fopen('php://output', 'w');
        
        $header = array("Client Name",
                        "Location Name",
                        "Order Code",
                        "Order Date",
                        "Status",
                        "Item SKU",
                        "Item Name",
                        "Item Child SKU",
                        "Item Child Name",
                        "Publish Price",
                        "Basic Price",
                        "Barcode",
                        "Category",
                        "Brand",
                        "Color",
                        "Size",
                        "Outbound Qty",
                        "Item Information",
                        "Outbound Date",
                        "Created By"
                    ); 
        fputcsv($file, $header);
        foreach ($outboundbundlingdownload as $row){ 
            fputcsv($file,$row);
        }
        fclose($file); 
        exit;
        // $outbounddetailbundlingdownload  =  $this->db->query($outbounddetailbundling)->result();
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
        // ->setCellValue('E1', 'Status')
        // ->setCellValue('F1', 'Item SKU')
        // ->setCellValue('G1', 'Item Name')
        // ->setCellValue('H1', 'Item Child SKU')
        // ->setCellValue('I1', 'Item Child Name')
        // ->setCellValue('J1', 'Publish Price')
        // ->setCellValue('K1', 'Basic Price')
        // ->setCellValue('L1', 'Barcode')
        // ->setCellValue('M1', 'Category')
        // ->setCellValue('N1', 'Brand')
        // ->setCellValue('O1', 'Color')
        // ->setCellValue('P1', 'Size')
        // ->setCellValue('Q1', 'Outbound Qty')
        // ->setCellValue('R1', 'Item Information')
        // ->setCellValue('S1', 'Outbound Date')
        // ->setCellValue('T1', 'Created By')

        // ;

        // // Miscellaneous glyphs, UTF-8
        // $i=2; foreach($outbounddetailbundlingdownload as $data) {

        // $spreadsheet->setActiveSheetIndex(0)
        // ->setCellValue('A'.$i, $data->program_name)
        // ->setCellValue('B'.$i, $data->location_name)
        // ->setCellValue('C'.$i, "'".$data->order_code)
        // ->setCellValue('D'.$i, $data->order_date)
        // ->setCellValue('E'.$i, $data->status)
        // ->setCellValue('F'.$i, $data->item_sku)
        // ->setCellValue('G'.$i, $data->item_name)
        // ->setCellValue('H'.$i, $data->item_child_sku)
        // ->setCellValue('I'.$i, $data->item_child_name)
        // ->setCellValue('J'.$i, $data->publish_price)
        // ->setCellValue('K'.$i, $data->basic_price)
        // ->setCellValue('L'.$i, $data->barcode)
        // ->setCellValue('M'.$i, $data->category)
        // ->setCellValue('N'.$i, $data->brand)
        // ->setCellValue('O'.$i, $data->color)
        // ->setCellValue('P'.$i, $data->size)
        // ->setCellValue('Q'.$i, $data->outbound_qty)
        // ->setCellValue('R'.$i, $data->item_information)
        // ->setCellValue('S'.$i, $data->outbound_date)
        // ->setCellValue('T'.$i, $data->created_by);
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

        // // Rename worksheet
        // $spreadsheet->getActiveSheet()->setTitle('Outbound Bundling'." ".date("Ymd"));

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