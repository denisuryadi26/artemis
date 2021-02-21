<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    
class M_performanceperday_opr extends CI_Model {
    public function getordercompletionperhourblue()
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

        if($_POST["view_wh_in"] == 'alllocation')
			$choose_location = "";
		else
            $choose_location = "    AND location_id = $location_id";

        if($_POST["view_cl_in"] == 'allclient')
			$choose_client = "";
		else
            $choose_client = "  AND program_id = $program_id";
		$ordercompletionperdayblue = "  SELECT        
                                            'Complete' as status,
                                            sum(nilai) as nilai
                                        FROM ordercompletionperday
                                        WHERE 1=1
                                        AND status_id in ( 11, 10 ) -- shipped & RTS
                                        AND DATE(order_created_date) = CURRENT_DATE
                                        $choose_location
                                        $choose_client";
        $nilaiordercompletionperdayblue = $this->db->query($ordercompletionperdayblue)->result();
        return $nilaiordercompletionperdayblue;
    }
    
    public function getordercompletionperhouryellow()
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
        if($_POST["view_wh_in"] == 'alllocation')
			$choose_location = "";
		else
            $choose_location = "    AND location_id = $location_id";

        if($_POST["view_cl_in"] == 'allclient')
			$choose_client = "";
		else
            $choose_client = "  AND program_id = $program_id";
        $ordercompletionperdayyellow = "    SELECT   
                                                'Not Complete' as status,
                                                sum(nilai) as nilai
                                            FROM ordernotcompletionperday
                                            WHERE 1=1
                                            -- AND status_id IN ( 8, 24, 26, 9, 25, 27 )-- Ready To Picked s/d Packed
                                            AND DATE(order_created_date) = CURRENT_DATE
                                            $choose_location
                                            $choose_client";
        $nilaiordercompletionperdayyellow = $this->db->query($ordercompletionperdayyellow)->result();
        return $nilaiordercompletionperdayyellow;
    }

    public function getOperationLeadTime()
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

        if($_POST["view_wh_in"] == 'alllocation')
			$choose_location = "";
		else
            $choose_location = "    AND location_id = $location_id";

        if($_POST["view_cl_in"] == 'allclient')
			$choose_client = "";
		else
            $choose_client = "  AND program_id = $program_id";
        $operationleadtime = "  SELECT
                                    'AVG LT RTS' AS status,
                                    AVG ( avg_lt_rts :: TIME )  as avg
                                FROM
                                    operationleadtimebefore4pm
                                WHERE
                                    1 = 1 
                                    $choose_location
                                    $choose_client
                                
                                UNION ALL
                                SELECT
                                    'AVG LT Packed' AS status,
                                    AVG ( avg_lt_packed :: TIME )  as avg
                                FROM
                                    operationleadtimebefore4pm
                                WHERE
                                    1 = 1 
                                    $choose_location
                                    $choose_client
                                    
                                UNION ALL
                                SELECT
                                    'AVG LT Picker & Checker' AS status,
                                    AVG ( avg_lt_picker_checker :: TIME )  as avg
                                FROM
                                    operationleadtimebefore4pm
                                WHERE
                                    1 = 1 
                                    $choose_location
                                    $choose_client
                                    
                                UNION ALL
                                SELECT
                                    'AVG LT ATP' AS status,
                                    AVG ( avg_lt_atp :: TIME )  as avg
                                FROM
                                    operationleadtimebefore4pm
                                WHERE
                                    1 = 1 
                                    $choose_location
                                    $choose_client
                                    
                                UNION ALL
                                SELECT
                                    'AVG LT Printed' AS status,
                                    AVG ( avg_printed :: TIME )  as avg
                                FROM
                                    operationleadtimebefore4pm
                                WHERE
                                    1 = 1 
                                    $choose_location
                                    $choose_client";
        $nilaioperationleadtime = $this->db->query($operationleadtime)->result();
        return $nilaioperationleadtime;
    }

    public function getordermonitoringperday()
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

        $choose_location = "";
		if($_POST["view_wh_in"] == 'alllocation')
            $choose_location = "";
		else
            $choose_location = "    AND location_id = $location_id";

        $choose_client = "";
		if($_POST["view_cl_in"] == 'allclient')
            $choose_client = "";
		else
            $choose_client = "  AND program_id = $program_id";
        $ordermonitoringperday = "  SELECT
                                        'Cancel' AS status,
                                        SUM ( nilai ) AS nilai 
                                    FROM
                                        ordercompletionperday 
                                    WHERE
                                        1 = 1 
                                        AND status_id = 14 -- Cancel
                                        AND DATE ( order_created_date ) = CURRENT_DATE 
                                    $choose_location
                                    $choose_client
                                    
                                    
                                    UNION ALL
                                    SELECT
                                        'Shipping Complete' AS status,
                                        SUM ( nilai ) AS nilai 
                                    FROM
                                        ordercompletionperday 
                                    WHERE
                                        1 = 1 
                                        AND status_id = 11 -- Shipped
                                        AND DATE ( order_created_date ) = CURRENT_DATE 
                                    $choose_location
                                    $choose_client
                                        
                                    UNION ALL
                                    SELECT
                                        'RTS Complete' AS status,
                                        SUM ( nilai ) AS nilai 
                                    FROM
                                        ordercompletionperday 
                                    WHERE
                                        1 = 1 
                                        AND status_id = 10 -- RTS
                                        AND DATE ( order_created_date ) = CURRENT_DATE 
                                    $choose_location
                                    $choose_client
                                    
                                    UNION ALL
                                    SELECT
                                        'Order Packed' AS status,
                                        SUM ( nilai ) AS nilai 
                                    FROM
                                        ordercompletionperday 
                                    WHERE
                                        1 = 1 
                                        AND status_id = 27 -- Packed
                                        AND DATE ( order_created_date ) = CURRENT_DATE 
                                    $choose_location
                                    $choose_client

                                    UNION ALL
                                    SELECT
                                        'Pending Order Before 4 PM' AS status,
                                        COALESCE (SUM(nilai),0) as nilai
                                    FROM
                                        ordermonitoringperhour 
                                    WHERE
                                        1 = 1 
                                        AND TO_CHAR( order_created_date, 'YYYY-mm-dd HH24:MI:SS' ) BETWEEN to_char( CURRENT_TIMESTAMP, 'YYYY-mm-dd 00:00:00' ) 
                                        AND to_char( CURRENT_TIMESTAMP, 'YYYY-mm-dd 15:59:59' )
                                    $choose_location
                                    $choose_client";
        $nilaiordermonitoringperday = $this->db->query($ordermonitoringperday)->result();
        return $nilaiordermonitoringperday;
    }
    

}