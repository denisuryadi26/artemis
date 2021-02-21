<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    // Load library phpspreadsheet
    require('./excel/vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\Helper\Sample;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    // End load library phpspreadsheet

class C_arrival extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("M_nav");
    }

	//Halaman Purchase
	public function index()
	{
		$data['navlocation'] = $this->M_nav->getNav();
		$location_id = $this->session->userdata('location_id');
        $program_id = $this->session->userdata('program_id');
		$data['title'] = 'Arrival';
		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav',$data);
		$this->load->view('admin/reportinglist/v_arrival');
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
                $file_name = "arrival_all_client_".date("Ymd")."_".date("His");
            else
                $file_name = "arrival_".strtolower(str_replace(' ', '_', $program_name))."_".date("Ymd")."_".date("His");

        $purchase_code    = $this->input->post('purchase_code');
        if(!empty($purchase_code))
        {
            $p_code = "AND purchase_code = '$purchase_code'";
        }
        else
        {
            $p_code = "";
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
                if (!empty($end_date_field)){
                    $end_date = "AND order_created_date <= DATE(TO_DATE('$end_date_field', 'YYYY-MM-DD') + interval '1 day')";
                }
            }
        }
        else {
            $start_date="";
            $end_date="";
        }

        
        $start_date_field1       = $this->input->post('start_date');
        $end_date_field1         = $this->input->post('end_date');
        if (!empty($start_date_field1) || !empty($end_date_field1) )
        {
            if ($start_date_field1 == $end_date_field1)
            {
                $start_date = "AND DATE(order_created_date) = '$start_date_field1' ";
                $end_date   = "";
            }
            else
            {
                if (!empty($start_date_field1)){
                    $start_date = "AND order_created_date >= '$start_date_field1'";
                }
                if (!empty($end_date_field1)){
                    $end_date = "AND order_created_date <= DATE(TO_DATE('$end_date_field1', 'YYYY-MM-DD') + interval '1 day')";
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
        
        $arrival       = " SELECT
                                program_name,
                                location_name,
                                purchase_code,
                                purchase_date,
                                arrival_code,
                                arrival_date,
                                courier_name,
                                driver_name,
                                driver_phone,
                                vehicle,
                                police_number
                            FROM arrival
                            WHERE 1=1 
                            $location
                            $client
                            $p_code
                            $start_date
                            $end_date
                            $start_date1
                            $end_date1
                            ";
        // echo $arrival;die;
        // $data['arrivalinfo']  =  $this->db->query($arrival)->result();
        // $data['all_client']         = $this->input->post('all_client');
        // $data['all_location']        = $this->input->post('all_location');
        
        
        // $this->load->view('admin/reportinglist/export/exportarrival', $data);

        header("Content-Description: File Transfer"); 
        header('Content-Disposition: attachment;filename="'. $file_name .'.csv"'); 
        header("Content-Type: application/csv; ");
        
        // get data 
        $arrivaldownload     =  $this->db->query($arrival)->result_array();
        // $usersData = $this->Main_model->getUserDetails();

        // file creation 
        $file = fopen('php://output', 'w');
        
        $header = array("Client Name",
                        "Location Name",
                        "Purchase Code",
                        "Purchase Date",
                        "Arrival Code",
                        "Arrival Date",
                        "Courier Name",
                        "Driver Name",
                        "Driver Phone",
                        "Vehicle",
                        "Police Number",
                    ); 
        fputcsv($file, $header);
        foreach ($arrivaldownload as $row){ 
            fputcsv($file,$row);
        }
        fclose($file); 
        exit;


        // $arrivalinfo  =  $this->db->query($arrival)->result();
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
        // ->setCellValue('C1', 'Purchase Code')
        // ->setCellValue('D1', 'Purchase Date')
        // ->setCellValue('E1', 'Arrival Code')
        // ->setCellValue('F1', 'Arrival Date')
        // ->setCellValue('G1', 'Courier Name')
        // ->setCellValue('H1', 'Driver Name')
        // ->setCellValue('I1', 'Driver Phone')
        // ->setCellValue('J1', 'Vehicle')
        // ->setCellValue('K1', 'Police Number')

        // ;

        // // Miscellaneous glyphs, UTF-8
        // $i=2; foreach($arrivalinfo as $data) {

        // $spreadsheet->setActiveSheetIndex(0)
        // ->setCellValue('A'.$i, $data->program_name)
        // ->setCellValue('B'.$i, $data->location_name)
        // ->setCellValue('C'.$i, "'".$data->purchase_code)
        // ->setCellValue('D'.$i, $data->purchase_date)
        // ->setCellValue('E'.$i, $data->arrival_code)
        // ->setCellValue('F'.$i, $data->arrival_date)
        // ->setCellValue('G'.$i, $data->courier_name)
        // ->setCellValue('H'.$i, $data->driver_name)
        // ->setCellValue('I'.$i, $data->driver_phone)
        // ->setCellValue('J'.$i, $data->vehicle)
        // ->setCellValue('K'.$i, $data->police_number);
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

        // // Rename worksheet
        // $spreadsheet->getActiveSheet()->setTitle('Arrival '.date('Ymd'));

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