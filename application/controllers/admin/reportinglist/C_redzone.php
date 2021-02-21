<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    // Load library phpspreadsheet
    require('./excel/vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\Helper\Sample;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    // End load library phpspreadsheet

class C_redzone extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("M_nav");
    }

	//Halaman Redzone
	public function index()
	{
		$data['navlocation'] = $this->M_nav->getNav();
		$data['title'] = 'Redzone';
		$this->load->view('admin/layout/v_head',$data);
		$this->load->view('admin/layout/v_header');
		$this->load->view('admin/layout/v_nav',$data);
		$this->load->view('admin/reportinglist/v_redzone');
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

        if(!empty($all_location))
                $file_name = "redzone_all_location_".date("Ymd")."_".date("His");
            else
                $file_name = "redzone_".strtolower(str_replace(' ', '_', $program_name))."_".date("Ymd")."_".date("His");

        $start_date_field       = $this->input->post('start_date');
        $end_date_field         = $this->input->post('end_date');
        if (!empty($start_date_field) || !empty($end_date_field) )
        {
            if ($start_date_field == $end_date_field)
            {
                $start_date = "AND DATE(redzone_created_date) = '$start_date_field' ";
                $end_date   = "";
            }
            else
            {
                if (!empty($start_date_field)){
                    $start_date = "AND redzone_created_date >= '$start_date_field'";
                }
                else{
                    $start_date = "";
                }
                if (!empty($end_date_field)){
                    $end_date = "AND redzone_created_date <= DATE(TO_DATE('$end_date_field', 'YYYY-MM-DD') + interval '1 day')";
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
        $redzone       = " SELECT
                                location_name,
                                redzone_code, 
                                TO_CHAR(arrival_date, 'mm/dd/YYYY HH24:MI') AS arrival_date,
                                reason,
                                purchase_order, 
                                item_name, 
                                quantity,
                                uom,
                                location,
                                courier,
                                driver_name,
                                driver_phone,
                                vehicle,
                                police_number, 
                                status,
                                TO_CHAR(redzone_created_date, 'mm/dd/YYYY HH24:MI') AS redzone_created_date,
                                TO_CHAR(close_date, 'mm/dd/YYYY HH24:MI') AS close_date,
                                remark,
                                aging
                            FROM redzone
                            WHERE 1=1
                            $location
                            $start_date
                            $end_date";
        // echo $redzone;die;
        // $data['redzoneinfo']  =  $this->db->query($redzone)->result();
        // $data['all_client']         = $this->input->post('all_client');
        // $data['all_location']        = $this->input->post('all_location');
        
        
        // $this->load->view('admin/reportinglist/export/exportredzone', $data);
        // file name 
        $filename = 'users_'.date('Ymd').'.csv'; 
        header("Content-Description: File Transfer"); 
        header('Content-Disposition: attachment;filename="'. $file_name .'.csv"'); 
        header("Content-Type: application/csv; ");
        
        // get data 
        $redzonedownload     =  $this->db->query($redzone)->result_array();
        // $usersData = $this->Main_model->getUserDetails();

        // file creation 
        $file = fopen('php://output', 'w');
        
        $header = array("Location Name",
                        "Redzone Code",
                        "Arrival Date",
                        "Reason",
                        "Purchase Order",
                        "Item Name",
                        "Quantity",
                        "UOM",
                        "Location",
                        "Courier",
                        "Driver Name",
                        "Driver Phone",
                        "Vehicle",
                        "Police Number",
                        "Status",
                        "Create Date",
                        "Close Date",
                        "Remark",
                        "Aging (Day)"
                    ); 
        fputcsv($file, $header);
        foreach ($redzonedownload as $row){ 
            fputcsv($file,$row);
        }
        fclose($file); 
        exit;
        // $redzoneinfo  =  $this->db->query($redzone)->result();
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
        // ->setCellValue('B1', 'Redzone Code')
        // ->setCellValue('C1', 'Arrival Date')
        // ->setCellValue('D1', 'Reason')
        // ->setCellValue('E1', 'Purchase Order')
        // ->setCellValue('F1', 'Item Name')
        // ->setCellValue('G1', 'Quantity')
        // ->setCellValue('H1', 'UOM')
        // ->setCellValue('I1', 'Location')
        // ->setCellValue('J1', 'Courier')
        // ->setCellValue('K1', 'Driver Name')
        // ->setCellValue('L1', 'Driver Phone')
        // ->setCellValue('M1', 'Vehicle')
        // ->setCellValue('N1', 'Police Number')
        // ->setCellValue('O1', 'Status')
        // ->setCellValue('P1', 'Create Date')
        // ->setCellValue('Q1', 'Close Date')
        // ->setCellValue('R1', 'Remark')
        // ->setCellValue('S1', 'Aging (Day)')

        // ;

        // // Miscellaneous glyphs, UTF-8
        // $i=2; foreach($redzoneinfo as $data) {

        // $spreadsheet->setActiveSheetIndex(0)
        // ->setCellValue('A'.$i, $data->location_name)
        // ->setCellValue('B'.$i, $data->redzone_code)
        // ->setCellValue('C'.$i, $data->arrival_date)
        // ->setCellValue('D'.$i, $data->reason)
        // ->setCellValue('E'.$i, "'".$data->purchase_order)
        // ->setCellValue('F'.$i, "'".$data->item_name)
        // ->setCellValue('G'.$i, $data->quantity)
        // ->setCellValue('H'.$i, $data->uom)
        // ->setCellValue('I'.$i, $data->location)
        // ->setCellValue('J'.$i, $data->courier)
        // ->setCellValue('K'.$i, $data->driver_name)
        // ->setCellValue('L'.$i, $data->driver_phone)
        // ->setCellValue('M'.$i, $data->vehicle)
        // ->setCellValue('N'.$i, $data->police_number)
        // ->setCellValue('O'.$i, $data->status)
        // ->setCellValue('P'.$i, $data->redzone_created_date)
        // ->setCellValue('Q'.$i, $data->close_date)
        // ->setCellValue('R'.$i, $data->remark)
        // ->setCellValue('S'.$i, $data->aging);
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

        // // Rename worksheet
        // $spreadsheet->getActiveSheet()->setTitle('Redzone '.date('Ymd'));

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