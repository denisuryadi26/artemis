<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    // Load library phpspreadsheet
    require('./excel/vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\Helper\Sample;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    // End load library phpspreadsheet

class C_stockaging extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("M_nav");
    }

	//Halaman Stock Aging
	public function index()
	{
		$data['navlocation'] = $this->M_nav->getNav();
		$data['title'] = 'Stock Aging';
		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav',$data);
		$this->load->view('admin/reportinglist/v_stockaging');
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
                $file_name = "stock_aging_all_client_".date("Ymd")."_".date("His");
            else
                $file_name = "stock_aging_".strtolower(str_replace(' ', '_', $program_name))."_".date("Ymd")."_".date("His");

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

        $item_barcode     = $this->input->post('item_barcode');
        if(!empty($item_barcode))
        {
            $i_barcode = "AND barcode = '$item_barcode'";
        }
        else
        {
            $i_barcode = "";
        }
        $marketplace     = $this->input->post('marketplace');
        if(!empty($marketplace))
        {
            $m_place = "AND market_place = '$marketplace'";
        }
        else
        {
            $m_place = "";
        }
        $grid     = $this->input->post('grid');
        if(!empty($grid))
        {
            $g_grid = "AND grid_name = '$grid'";
        }
        else
        {
            $g_grid = "";
        }

        $start_date       = $this->input->post('start_date');
        $end_date         = $this->input->post('end_date');
        if (!empty($start_date) || !empty($end_date) )
        {
            if ($start_date == $end_date)
                $start_date = "AND DATE(inbound_date) = '$start_date' ";
            else
            {
                if (!empty($start_date))
                    $start_date = "AND inbound_date >= '$start_date'";
                if (!empty($end_date))
                    $end_date = "AND inbound_date <= DATE(TO_DATE('$end_date', 'YYYY-MM-DD') + interval '1 day')";
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
        $stockaging       = " SELECT
                                location_name,
                                program_name,
                                market_place,
                                item_sku,
                                item_name,
                                barcode,
                                ready_order,
                                grid_name,
                                managed_by,
                                item_information,
                                ready_order,
                                onhand,
                                damaged,
                                TO_CHAR(inbound_date, 'mm/dd/YYYY HH24:MI') AS inbound_date,
                                NOW() AS cut_off,
                                stock_aging
							FROM stockaging
							WHERE 1=1 
                            -- AND program_status_id <> '3'
							$location
                            $client
                            $i_code
                            $i_name
                            $i_barcode
                            $m_place
                            $g_grid
                            $start_date
                            $end_date";
        // echo $stockaging;die;

        // file name 
        $filename = 'users_'.date('Ymd').'.csv'; 
        header("Content-Description: File Transfer"); 
        header('Content-Disposition: attachment;filename="'. $file_name .'.csv"'); 
        header("Content-Type: application/csv; ");
        
        // get data 
        $stockagingdownload     =  $this->db->query($stockaging)->result_array();
        // $usersData = $this->Main_model->getUserDetails();

        // file creation 
        $file = fopen('php://output', 'w');
        
        $header = array("Location Name",
                        "Client Name",
                        "Market Place",
                        "Item Code",
                        "Item Name",
                        "Barcode",
                        "Ready Order",
                        "Grid Name",
                        "Managed By",
                        "Item Information",
                        "Ready Order",
                        "OnHand",
                        "Damaged",
                        "Inbound Date",
                        "Cut Off",
                        "Stock Aging"
                    ); 
        fputcsv($file, $header);
        foreach ($stockagingdownload as $row){ 
            fputcsv($file,$row);
        }
        fclose($file); 
        exit;
        // $stockagingdownload  =  $this->db->query($stockaging)->result();
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
        // ->setCellValue('A1', 'Location Name')
        // ->setCellValue('B1', 'Client Name')
        // ->setCellValue('C1', 'Market Place')
        // ->setCellValue('D1', 'Item Code')
        // ->setCellValue('E1', 'Item Name')
        // ->setCellValue('F1', 'Barcode')
        // ->setCellValue('G1', 'Ready Order')
        // ->setCellValue('H1', 'Grid Name')
        // ->setCellValue('I1', 'Managed By')
        // ->setCellValue('J1', 'Item Information')
        // ->setCellValue('K1', 'Ready Order')
        // ->setCellValue('L1', 'OnHand')
        // ->setCellValue('M1', 'Damaged')
        // ->setCellValue('N1', 'Inbound Date')
        // ->setCellValue('O1', 'Cut Off')
        // ->setCellValue('P1', 'Stock Aging')

        // ;

        // // Miscellaneous glyphs, UTF-8
        // $i=2; foreach($stockagingdownload as $data) {

        // $spreadsheet->setActiveSheetIndex(0)
        // ->setCellValue('A'.$i, $data->location_name)
        // ->setCellValue('B'.$i, $data->program_name)
        // ->setCellValue('C'.$i, $data->market_place)
        // ->setCellValue('D'.$i, "'".$data->item_sku)
        // ->setCellValue('E'.$i, $data->item_name)
        // ->setCellValue('F'.$i, "'".$data->barcode)
        // ->setCellValue('G'.$i, $data->ready_order)
        // ->setCellValue('H'.$i, $data->grid_name)
        // ->setCellValue('I'.$i, $data->managed_by)
        // ->setCellValue('J'.$i, $data->item_information)
        // ->setCellValue('K'.$i, $data->ready_order)
        // ->setCellValue('L'.$i, $data->onhand)
        // ->setCellValue('M'.$i, $data->damaged)
        // ->setCellValue('N'.$i, $data->inbound_date)
        // ->setCellValue('O'.$i, $data->cut_off)
        // ->setCellValue('P'.$i, $data->stock_aging);
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

        // // Rename worksheet
        // $spreadsheet->getActiveSheet()->setTitle('Stock Aging'." ".date("Ymd"));

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