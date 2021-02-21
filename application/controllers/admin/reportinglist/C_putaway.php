<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    // Load library phpspreadsheet
    require('./excel/vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\Helper\Sample;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    // End load library phpspreadsheet

class C_putaway extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("M_nav");
    }

	//Halaman Putaway
	public function index()
	{
		$data['navlocation'] = $this->M_nav->getNav();
		$data['title'] = 'Putaway';
		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav',$data);
		$this->load->view('admin/reportinglist/v_putaway');
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
                $file_name = "putaway_all_client_".date("Ymd")."_".date("His");
            else
                $file_name = "putaway_".strtolower(str_replace(' ', '_', $program_name))."_".date("Ymd")."_".date("His");

        $purchase_code    = $this->input->post('purchase_code');
        if(!empty($purchase_code))
        {
            $p_code = "AND packinglist_number = '$purchase_code'";
        }
        else
        {
            $p_code = "";
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

        $item_barcode     = $this->input->post('item_barcode');
        if(!empty($item_barcode))
        {
            $i_barcode = "AND barcode = '$item_barcode'";
        }
        else
        {
            $i_barcode = "";
        }

        $start_date       = $this->input->post('start_date');
        $end_date         = $this->input->post('end_date');
        if (!empty($start_date) || !empty($end_date) )
        {
            if ($start_date == $end_date)
                $start_date = "AND DATE(packinglist_date) = '$start_date' ";
            else
            {
                if (!empty($start_date))
                    $start_date = "AND packinglist_date >= '$start_date'";
                if (!empty($end_date))
                    $end_date = "AND packinglist_date <= DATE(TO_DATE('$end_date', 'YYYY-MM-DD') + interval '1 day')";
            }
        }
        else {
            $start_date="";
            $end_date="";
        }

        $putaway_date1      = $this->input->post('putaway_date1');
        $putaway_date2        = $this->input->post('putaway_date2');
        
        if (!empty($putaway_date1) || !empty($putaway_date2) )
        {
            if ($putaway_date1 == $putaway_date2)
                $putaway_date1 = "AND DATE(packinglist_date) = '$putaway_date1' ";
            else
            {
                if (!empty($putaway_date1))
                    $putaway_date1 = "AND packinglist_date >= '$putaway_date1'";
                if (!empty($putaway_date2))
                    $putaway_date2 = "AND packinglist_date <= DATE(TO_DATE('$putaway_date2', 'YYYY-MM-DD') + interval '1 day')";
            }
        }
        else {
            $putaway_date1="";
            $putaway_date2="";
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
        $putaway       = " SELECT
                                program_name,
                                location_name,
                                packinglist_code, 
                                TO_CHAR(packinglist_date, 'mm/dd/YYYY HH24:MI') AS packinglist_date,
                                item_code,
                                item_name,
                                barcode,
                                category, 
                                brand, 
                                color, 
                                size, 
                                stock_type, 
                                putaway_quantity,
                                putaway_by,
                                grid,
                                item_information,
                                TO_CHAR(received_date, 'mm/dd/YYYY HH24:MI') AS received_date,
                                TO_CHAR(putaway_date, 'mm/dd/YYYY HH24:MI') AS putaway_date
                            FROM putaway
                            WHERE 1=1 
                            $location
                            $client
                            $p_code
                            $i_code
                            $i_name
                            $i_barcode
                            $start_date
                            $end_date
                            $putaway_date1
                            $putaway_date2";
        // echo $putaway;die;
        // $data['putawayinfo']  =  $this->db->query($putaway)->result();
        // $data['all_client']         = $this->input->post('all_client');
        // $data['all_location']        = $this->input->post('all_location');
        
        
        // $this->load->view('admin/reportinglist/export/exportputaway', $data);

        // file name 
        $filename = 'users_'.date('Ymd').'.csv'; 
        header("Content-Description: File Transfer"); 
        header('Content-Disposition: attachment;filename="'. $file_name .'.csv"'); 
        header("Content-Type: application/csv; ");
        
        // get data 
        $putawaydownload     =  $this->db->query($putaway)->result_array();
        // $usersData = $this->Main_model->getUserDetails();

        // file creation 
        $file = fopen('php://output', 'w');
        
        $header = array("Client Name",
                        "Location Name",
                        "Packinglist Code",
                        "Packinglist Date",
                        "Item SKU",
                        "Item Name",
                        "Barcode",
                        "Category",
                        "Brand",
                        "Color",
                        "Size",
                        "Stock Type",
                        "Putaway Qty",
                        "Putaway By",
                        "Grid",
                        "Item Information",
                        "Received Date",
                        "Putaway Date"
                    ); 
        fputcsv($file, $header);
        foreach ($putawaydownload as $row){ 
            fputcsv($file,$row);
        }
        fclose($file); 
        exit;
        // $putawayinfo  =  $this->db->query($putaway)->result();
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
        // ->setCellValue('C1', 'Packinglist Code')
        // ->setCellValue('D1', 'Packinglist Date')
        // ->setCellValue('E1', 'Item SKU')
        // ->setCellValue('F1', 'Item Name')
        // ->setCellValue('G1', 'Barcode')
        // ->setCellValue('H1', 'Category')
        // ->setCellValue('I1', 'Brand')
        // ->setCellValue('J1', 'Color')
        // ->setCellValue('K1', 'Size')
        // ->setCellValue('L1', 'Stock Type')
        // ->setCellValue('M1', 'Putaway Qty')
        // ->setCellValue('N1', 'Putaway By')
        // ->setCellValue('O1', 'Grid')
        // ->setCellValue('P1', 'Item Information')
        // ->setCellValue('Q1', 'Received Date')
        // ->setCellValue('R1', 'Putaway Date')

        // ;

        // // Miscellaneous glyphs, UTF-8
        // $i=2; foreach($putawayinfo as $data) {

        // $spreadsheet->setActiveSheetIndex(0)
        // ->setCellValue('A'.$i, $data->program_name)
        // ->setCellValue('B'.$i, $data->location_name)
        // ->setCellValue('C'.$i, "'".$data->packinglist_code)
        // ->setCellValue('D'.$i, $data->packinglist_date)
        // ->setCellValue('E'.$i, "'".$data->item_code)
        // ->setCellValue('F'.$i, $data->item_name)
        // ->setCellValue('G'.$i, "'".$data->barcode)
        // ->setCellValue('H'.$i, $data->category)
        // ->setCellValue('I'.$i, $data->brand)
        // ->setCellValue('J'.$i, $data->color)
        // ->setCellValue('K'.$i, $data->size)
        // ->setCellValue('L'.$i, $data->stock_type)
        // ->setCellValue('M'.$i, $data->putaway_quantity)
        // ->setCellValue('N'.$i, $data->putaway_by)
        // ->setCellValue('O'.$i, $data->grid)
        // ->setCellValue('P'.$i, $data->item_information)
        // ->setCellValue('Q'.$i, $data->received_date)
        // ->setCellValue('R'.$i, $data->putaway_date);
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

        // // Rename worksheet
        // $spreadsheet->getActiveSheet()->setTitle('Putaway '.date('Ymd'));

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