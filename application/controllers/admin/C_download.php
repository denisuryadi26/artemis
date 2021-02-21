<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_download extends CI_Controller {
	// public function __construct()
 //    {
 //        parent::__construct();
 //        $this->load->model(["M_download"]);
 //    }

	public function download_all_status()
    {
        include APPPATH.'third_party/PHPExcel/PHPExcel.php';
 
        // membuat obyek dari class PHPExcel
        $objPHPExcel = new PHPExcel();
        // memberi nama sheet pertama dengan nama 'Sheet 1'
        $objPHPExcel->getSheet(0)->setTitle('Status');

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

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "DATA STATUS");
        $objPHPExcel->getActiveSheet()->mergeCells('A1:I1');    
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($center);

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', "STATUS ID");  
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B3', "CODE");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', "NAME");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D3', "COLOR");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E3', "DESCRIPTION");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F3', "CREATED DATE");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G3', "MODIFIED DATE");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H3', "CREATED BY");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I3', "MODIFIED BY");

        $objPHPExcel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);

        
        $sql_prof       = "     SELECT *
                                FROM status";
        // $sum_prof       = "     SELECT SUM(total) AS total
        //                             FROM 
        //                             (
        //                                 SELECT 
        //                                     c.`name` as description, 
        //                                     SUM(quantity) AS quantity, 
        //                                     ROUND(SUM(total_price)/SUM(quantity),0) AS cost, 
        //                                     SUM(total_price) AS total
        //                                 FROM proformadetailtokocabang a
        //                                     JOIN componentclient cc ON cc.`component_client_id` = a.`component_client_id`
        //                                     JOIN component c ON c.`component_id` = cc.`component_id`
        //                                 WHERE proforma_tokocabang_id = '" . $where['proforma_tokocabang_id'] . "'
        //                                     AND c.component_id <> '1'
        //                                     GROUP BY c.name
        //                             ) a";
        // $sum_prof_tot =  $this->db->query($sum_prof)->result_array();
        // $tot_prof     =  json_decode($sum_prof_tot[0]['total']);
        // $count_prof   =  $this->db->query($sql_prof)->num_rows();
        // echo $count_prof;die;
        $status  =  $this->db->query($sql_prof)->result();
        $no           =  1;
        $numrow       =  4;
        
        foreach($status as $data_status){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $data_status->status_id);     
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data_status->code);      
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data_status->name);      
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data_status->color);      
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data_status->description);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data_status->created_date);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data_status->modified_date);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data_status->created_by);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data_status->modified_by);

            $objPHPExcel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($center);
            $objPHPExcel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($right);
            $objPHPExcel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($right);
            $no++;
            $numrow++;
        }

        // $ppn              = $tot_prof * (10 / 100);
        // $total_end        = $tot_prof + $ppn;
        // $numrow_total     = $count_prof + 4;
        // $numrow_ppn       = $count_prof + 1 + 4;
        // $numrow_total_end = $count_prof + 1 + 1 + 4;

        // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$numrow_total, "TOTAL");
        // $objPHPExcel->getActiveSheet()->mergeCells('A'.$numrow_total.':D'.$numrow_total);
        // $objPHPExcel->getActiveSheet()->getStyle('A'.$numrow_total)->applyFromArray($right);
        // $objPHPExcel->getActiveSheet()->getStyle('A'.$numrow_total.':D'.$numrow_total)->applyFromArray($border);
        // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$numrow_total, $this->rupiah($tot_prof));
        // $objPHPExcel->getActiveSheet()->getStyle('E'.$numrow_total)->applyFromArray($border);
        // $objPHPExcel->getActiveSheet()->getStyle('E'.$numrow_total)->applyFromArray($right);

        // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$numrow_ppn, "PPN (10%)");
        // $objPHPExcel->getActiveSheet()->mergeCells('A'.$numrow_ppn.':D'.$numrow_ppn);
        // $objPHPExcel->getActiveSheet()->getStyle('A'.$numrow_ppn)->applyFromArray($right);
        // $objPHPExcel->getActiveSheet()->getStyle('A'.$numrow_ppn.':D'.$numrow_ppn)->applyFromArray($border);
        // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$numrow_ppn, $this->rupiah($ppn));
        // $objPHPExcel->getActiveSheet()->getStyle('E'.$numrow_ppn)->applyFromArray($border);
        // $objPHPExcel->getActiveSheet()->getStyle('E'.$numrow_ppn)->applyFromArray($right);

        // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$numrow_total_end, "GRAND TOTAL");
        // $objPHPExcel->getActiveSheet()->mergeCells('A'.$numrow_total_end.':D'.$numrow_total_end);
        // $objPHPExcel->getActiveSheet()->getStyle('A'.$numrow_total_end)->applyFromArray($right);
        // $objPHPExcel->getActiveSheet()->getStyle('A'.$numrow_total_end.':D'.$numrow_total_end)->applyFromArray($border);
        // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$numrow_total_end, $this->rupiah($total_end));
        // $objPHPExcel->getActiveSheet()->getStyle('E'.$numrow_total_end)->applyFromArray($border);
        // $objPHPExcel->getActiveSheet()->getStyle('E'.$numrow_total_end)->applyFromArray($right);
        

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);

        // mengeset sheet yang aktif
        $objPHPExcel->setActiveSheetIndex(0);
        
       
        // output file dengan nama file 'contoh.xls'
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="status.xlsx"');
        header('Cache-Control: max-age=0');
         
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }

}

/* End of file download.php */
/* Location: ./application/controllers/admin/download.php */