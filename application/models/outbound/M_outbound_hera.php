<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    
class M_outbound_hera extends CI_Model 
{
    public function getslaweekhera($date)
	{
        
        // // echo $_POST["date"];die;
        $tanggal = str_replace("+", " ", $date);
        $choose_month = "";
        $slaweektopclient = "   SELECT 
                                a.program_name,
                                a.location_name,
                                case when round(avg(a.ach_packed),2) > 100 then '100.00' else round(avg(a.ach_packed),2) end as ach_packed,
                                case when round(avg(a.ach_packed),2) < 99 then 'tomato' else '' end as color_packed,
                                case when round(avg(a.ach_rts),2) > 100 then '100.00' else round(avg(a.ach_rts),2) end as ach_rts,
                                case when round(avg(a.ach_rts),2) < 99 then 'tomato' else '' end as color_rts
                                from (
                                    SELECT 
                                        program_name,
                                        location_name , 
                                        order_created_date, 
                                        round(avg(percentace_achievement), 2) as ach_packed ,
                                        color as color_packed,
                                        (select round(avg(s2.percentace_achievement), 2) 
                                            from slaoperational s2
                                            where s2.location_name  = slaoperational.location_name
                                            and s2.order_created_date  = slaoperational.order_created_date 
                                            and program_id in ('1491', '795','1275','767','1357','1443','1485','739','1333','35','641','105','1153','1211','563','1331','1261','1259')
                                            and s2.status_id  = 10
                                --			group by s2.location_name,s2.percentace_achievement,s2.program_id 
                                        ) as ach_rts,
                                        (select s1.color
                                            from slaoperational s1 
                                            where s1.location_name  = slaoperational.location_name
                                            and s1.order_created_date  = slaoperational.order_created_date 
                                            and program_id in ('1491', '795','1275','767','1357','1443','1485','739','1333','35','641','105','1153','1211','563','1331','1261','1259')
                                            and s1.status_id  = 10
                                --			group by s1.program_name, s1.location_name,s1.percentace_achievement,s1.order_created_date, s1.color 
                                        ) as color_rts
                                    FROM slaoperational
                                    WHERE 1 = 1 
                                    AND status_id = 27
                                    and program_id in ('1491', '795','1275','767','1357','1443','1485','739','1333','35','641','105','1153','1211','563','1331','1261','1259')
                                    and order_created_date between date_trunc('month', CURRENT_DATE) and current_date - interval '7 day' 
                                    GROUP BY program_name, location_name, order_created_date,percentace_achievement, color
                                    order by program_name asc
                                )a
                                group by a.location_name,a.program_name
                                order by a.program_name asc";
        $nilaislaweektopclient = $this->db->query($slaweektopclient)->result();
        return $nilaislaweektopclient;
    }

    public function getsladayindomall($date)
	{
        
        // // echo $_POST["date"];die;
        $tanggal = str_replace("+", " ", $date);
        $choose_month = "";
        $sladayindomall = "SELECT
                                a.program_id,
                                a.program_name,
                                a.location_id,
                                a.location_name,
                                -- a.percentace_achievement
                                (select percentace_achievement from slaoperationalindonesiamall
                                where 1=1
                                and order_created_date = current_date - interval '6 day'
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as packed_1,
                                (select case when percentace_achievement < 99 then 'tomato' else '' end as color_packed 
                                from slaoperationalindonesiamall
                                where 1=1
                                and order_created_date = current_date - interval '6 day'
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as color_packed_1,
                                (select percentace_achievement from slaoperationalindonesiamall
                                where 1=1
                                and order_created_date = current_date - interval '6 day'
                                and status_id = 10
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as rts_1,
                                (select case when percentace_achievement < 99 then 'tomato' else '' end as color_rts 
                                from slaoperationalindonesiamall
                                where 1=1
                                and order_created_date = current_date - interval '6 day'
                                and status_id = 10
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as color_rts_1,
                                (select percentace_achievement from slaoperationalindonesiamall
                                where 1=1
                                and order_created_date = current_date - interval '5 day'
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as packed_2,
                                (select case when percentace_achievement < 99 then 'tomato' else '' end as color_packed 
                                from slaoperationalindonesiamall
                                where 1=1
                                and order_created_date = current_date - interval '5 day'
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as color_packed_2,
                                (select percentace_achievement from slaoperationalindonesiamall
                                where 1=1
                                and order_created_date = current_date - interval '5 day'
                                and status_id = 10
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as rts_2,
                                (select case when percentace_achievement < 99 then 'tomato' else '' end as color_rts 
                                from slaoperationalindonesiamall
                                where 1=1
                                and order_created_date = current_date - interval '5 day'
                                and status_id = 10
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as color_rts_2,
                                (select percentace_achievement from slaoperationalindonesiamall
                                where 1=1
                                and order_created_date = current_date - interval '4 day'
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as packed_3,
                                (select case when percentace_achievement < 99 then 'tomato' else '' end as color_packed 
                                from slaoperationalindonesiamall
                                where 1=1
                                and order_created_date = current_date - interval '4 day'
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as color_packed_3,
                                (select percentace_achievement from slaoperationalindonesiamall
                                where 1=1
                                and order_created_date = current_date - interval '4 day'
                                and status_id = 10
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as rts_3,
                                (select case when percentace_achievement < 99 then 'tomato' else '' end as color_rts 
                                from slaoperationalindonesiamall
                                where 1=1
                                and order_created_date = current_date - interval '4 day'
                                and status_id = 10
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as color_rts_3,
                                (select percentace_achievement from slaoperationalindonesiamall
                                where 1=1
                                and order_created_date = current_date - interval '3 day'
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as packed_4,
                                (select case when percentace_achievement < 99 then 'tomato' else '' end as color_packed 
                                from slaoperationalindonesiamall
                                where 1=1
                                and order_created_date = current_date - interval '3 day'
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as color_packed_4,
                                (select percentace_achievement from slaoperationalindonesiamall
                                where 1=1
                                and order_created_date = current_date - interval '3 day'
                                and status_id = 10
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as rts_4,
                                (select case when percentace_achievement < 99 then 'tomato' else '' end as color_rts 
                                from slaoperationalindonesiamall
                                where 1=1
                                and order_created_date = current_date - interval '3 day'
                                and status_id = 10
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as color_rts_4,
                                (select percentace_achievement from slaoperationalindonesiamall
                                where 1=1
                                and order_created_date = current_date - interval '2 day'
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as packed_5,
                                (select case when percentace_achievement < 99 then 'tomato' else '' end as color_packed 
                                from slaoperationalindonesiamall
                                where 1=1
                                and order_created_date = current_date - interval '2 day'
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as color_packed_5,
                                (select percentace_achievement from slaoperationalindonesiamall
                                where 1=1
                                and order_created_date = current_date - interval '2 day'
                                and status_id = 10
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as rts_5,
                                (select case when percentace_achievement < 99 then 'tomato' else '' end as color_rts 
                                from slaoperationalindonesiamall
                                where 1=1
                                and order_created_date = current_date - interval '2 day'
                                and status_id = 10
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as color_rts_5,
                                (select percentace_achievement from slaoperationalindonesiamall
                                where 1=1
                                and order_created_date = current_date - interval '1 day'
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as packed_6,
                                (select case when percentace_achievement < 99 then 'tomato' else '' end as color_packed 
                                from slaoperationalindonesiamall
                                where 1=1
                                and order_created_date = current_date - interval '1 day'
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as color_packed_6,
                                (select percentace_achievement from slaoperationalindonesiamall
                                where 1=1
                                and order_created_date = current_date - interval '1 day'
                                and status_id = 10
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as rts_6,
                                (select case when percentace_achievement < 99 then 'tomato' else '' end as color_rts 
                                from slaoperationalindonesiamall
                                where 1=1
                                and order_created_date = current_date - interval '1 day'
                                and status_id = 10
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as color_rts_6,
                                (select percentace_achievement from slaoperationalindonesiamall
                                where 1=1
                                and order_created_date = current_date
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as packed_7,
                                (select case when percentace_achievement < 99 then 'tomato' else '' end as color_packed 
                                from slaoperationalindonesiamall
                                where 1=1
                                and order_created_date = current_date
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as color_packed_7,
                                (select percentace_achievement from slaoperationalindonesiamall
                                where 1=1
                                and order_created_date = current_date
                                and status_id = 10
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as rts_7,
                                (select case when percentace_achievement < 99 then 'tomato' else '' end as color_rts 
                                from slaoperationalindonesiamall
                                where 1=1
                                and order_created_date = current_date
                                and status_id = 10
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as color_rts_7
                                FROM slaoperationalindonesiamall a
                                where program_id = 395
                                group by a.program_id, a.program_name, a.location_id, a.location_name
                                order by a.program_name asc, a.location_name asc";
                                // date_trunc('month', CURRENT_DATE)
        $nilaisladayindomall = $this->db->query($sladayindomall)->result();
        return $nilaisladayindomall;
    }

    public function getslaweekindomall($date)
	{
        
        // // echo $_POST["date"];die;
        $tanggal = str_replace("+", " ", $date);
        $choose_month = "";
        $slaweekindomall = "   SELECT 
                                a.program_name,
                                a.location_name,
                                case when round(avg(a.ach_packed),2) > 100 then '100.00' else round(avg(a.ach_packed),2) end as ach_packed,
                                case when round(avg(a.ach_packed),2) < 99 then 'tomato' else '' end as color_packed,
                                case when round(avg(a.ach_rts),2) > 100 then '100.00' else round(avg(a.ach_rts),2) end as ach_rts,
                                case when round(avg(a.ach_rts),2) < 99 then 'tomato' else '' end as color_rts
                                from (
                                    SELECT 
                                        program_name,
                                        location_name , 
                                        order_created_date, 
                                        round(avg(percentace_achievement), 2) as ach_packed ,
                                        color as color_packed,
                                        (select round(avg(s2.percentace_achievement), 2) 
                                            from slaoperationalindonesiamall s2
                                            where s2.location_name  = slaoperationalindonesiamall.location_name
                                            and s2.order_created_date  = slaoperationalindonesiamall.order_created_date 
                                            and program_id = 395
                                            and s2.status_id  = 10
                                --			group by s2.location_name,s2.percentace_achievement,s2.program_id 
                                        ) as ach_rts,
                                        (select s1.color
                                            from slaoperationalindonesiamall s1 
                                            where s1.location_name  = slaoperationalindonesiamall.location_name
                                            and s1.order_created_date  = slaoperationalindonesiamall.order_created_date 
                                            and program_id = 395
                                            and s1.status_id  = 10
                                --			group by s1.program_name, s1.location_name,s1.percentace_achievement,s1.order_created_date, s1.color 
                                        ) as color_rts
                                    FROM slaoperationalindonesiamall
                                    WHERE 1 = 1 
                                    AND status_id = 27
                                    and program_id = 395
                                    and order_created_date between date_trunc('month', CURRENT_DATE) and current_date - interval '7 day' 
                                    GROUP BY program_name, location_name, order_created_date,percentace_achievement, color
                                    order by program_name asc
                                )a
                                group by a.location_name,a.program_name
                                order by a.program_name asc";
        $nilaislaweekindomall = $this->db->query($slaweekindomall)->result();
        return $nilaislaweekindomall;
    }

    public function getsladayhera($date)
	{
        
        // // echo $_POST["date"];die;
        $tanggal = str_replace("+", " ", $date);
        $choose_month = "";
        $sladaytopclienthera = "SELECT
                                a.program_id,
                                a.program_name,
                                a.location_id,
                                a.location_name,
                                -- a.percentace_achievement
                                (select order_created_date from slaoperational
                                where 1=1
                                and order_created_date = current_date - interval '6 day'
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as order_created_date_1,
                                (select percentace_achievement from slaoperational
                                where 1=1
                                and order_created_date = current_date - interval '6 day'
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as packed_1,
                                (select case when percentace_achievement < 99 then 'tomato' else '' end as color_packed 
                                from slaoperational
                                where 1=1
                                and order_created_date = current_date - interval '6 day'
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as color_packed_1,
                                (select percentace_achievement from slaoperational
                                where 1=1
                                and order_created_date = current_date - interval '6 day'
                                and status_id = 10
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as rts_1,
                                (select case when percentace_achievement < 99 then 'tomato' else '' end as color_rts 
                                from slaoperational
                                where 1=1
                                and order_created_date = current_date - interval '6 day'
                                and status_id = 10
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as color_rts_1,

                                (select order_created_date from slaoperational
                                where 1=1
                                and order_created_date = current_date - interval '5 day'
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as order_created_date_2,

                                (select percentace_achievement from slaoperational
                                where 1=1
                                and order_created_date = current_date - interval '5 day'
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as packed_2,
                                (select case when percentace_achievement < 99 then 'tomato' else '' end as color_packed 
                                from slaoperational
                                where 1=1
                                and order_created_date = current_date - interval '5 day'
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as color_packed_2,
                                (select percentace_achievement from slaoperational
                                where 1=1
                                and order_created_date = current_date - interval '5 day'
                                and status_id = 10
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as rts_2,
                                (select case when percentace_achievement < 99 then 'tomato' else '' end as color_rts 
                                from slaoperational
                                where 1=1
                                and order_created_date = current_date - interval '5 day'
                                and status_id = 10
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as color_rts_2,

                                (select order_created_date from slaoperational
                                where 1=1
                                and order_created_date = current_date - interval '4 day'
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as order_created_date_3,


                                (select percentace_achievement from slaoperational
                                where 1=1
                                and order_created_date = current_date - interval '4 day'
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as packed_3,
                                (select case when percentace_achievement < 99 then 'tomato' else '' end as color_packed 
                                from slaoperational
                                where 1=1
                                and order_created_date = current_date - interval '4 day'
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as color_packed_3,
                                (select percentace_achievement from slaoperational
                                where 1=1
                                and order_created_date = current_date - interval '4 day'
                                and status_id = 10
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as rts_3,
                                (select case when percentace_achievement < 99 then 'tomato' else '' end as color_rts 
                                from slaoperational
                                where 1=1
                                and order_created_date = current_date - interval '4 day'
                                and status_id = 10
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as color_rts_3,

                                (select order_created_date from slaoperational
                                where 1=1
                                and order_created_date = current_date - interval '3 day'
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as order_created_date_4,

                                (select percentace_achievement from slaoperational
                                where 1=1
                                and order_created_date = current_date - interval '3 day'
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as packed_4,
                                (select case when percentace_achievement < 99 then 'tomato' else '' end as color_packed 
                                from slaoperational
                                where 1=1
                                and order_created_date = current_date - interval '3 day'
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as color_packed_4,
                                (select percentace_achievement from slaoperational
                                where 1=1
                                and order_created_date = current_date - interval '3 day'
                                and status_id = 10
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as rts_4,
                                (select case when percentace_achievement < 99 then 'tomato' else '' end as color_rts 
                                from slaoperational
                                where 1=1
                                and order_created_date = current_date - interval '3 day'
                                and status_id = 10
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as color_rts_4,

                                (select order_created_date from slaoperational
                                where 1=1
                                and order_created_date = current_date - interval '2 day'
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as order_created_date_5,

                                (select percentace_achievement from slaoperational
                                where 1=1
                                and order_created_date = current_date - interval '2 day'
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as packed_5,
                                (select case when percentace_achievement < 99 then 'tomato' else '' end as color_packed 
                                from slaoperational
                                where 1=1
                                and order_created_date = current_date - interval '2 day'
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as color_packed_5,
                                (select percentace_achievement from slaoperational
                                where 1=1
                                and order_created_date = current_date - interval '2 day'
                                and status_id = 10
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as rts_5,
                                (select case when percentace_achievement < 99 then 'tomato' else '' end as color_rts 
                                from slaoperational
                                where 1=1
                                and order_created_date = current_date - interval '2 day'
                                and status_id = 10
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as color_rts_5,

                                (select order_created_date from slaoperational
                                where 1=1
                                and order_created_date = current_date - interval '1 day'
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as order_created_date_6,


                                (select percentace_achievement from slaoperational
                                where 1=1
                                and order_created_date = current_date - interval '1 day'
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as packed_6,
                                (select case when percentace_achievement < 99 then 'tomato' else '' end as color_packed 
                                from slaoperational
                                where 1=1
                                and order_created_date = current_date - interval '1 day'
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as color_packed_6,
                                (select percentace_achievement from slaoperational
                                where 1=1
                                and order_created_date = current_date - interval '1 day'
                                and status_id = 10
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as rts_6,
                                (select case when percentace_achievement < 99 then 'tomato' else '' end as color_rts 
                                from slaoperational
                                where 1=1
                                and order_created_date = current_date - interval '1 day'
                                and status_id = 10
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as color_rts_6,

                                (select order_created_date from slaoperational
                                where 1=1
                                and order_created_date = current_date
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as order_created_date_7,


                                (select percentace_achievement from slaoperational
                                where 1=1
                                and order_created_date = current_date
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as packed_7,
                                (select case when percentace_achievement < 99 then 'tomato' else '' end as color_packed 
                                from slaoperational
                                where 1=1
                                and order_created_date = current_date
                                and status_id = 27
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as color_packed_7,
                                (select percentace_achievement from slaoperational
                                where 1=1
                                and order_created_date = current_date
                                and status_id = 10
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as rts_7,
                                (select case when percentace_achievement < 99 then 'tomato' else '' end as color_rts 
                                from slaoperational
                                where 1=1
                                and order_created_date = current_date
                                and status_id = 10
                                and program_id = a.program_id
                                and location_id = a.location_id
                                ) as color_rts_7
                                FROM slaoperational a
                                where program_id in ('1491', '795','1275','767','1357','1443','1485','739','1333','35','641','105','1153','1211','563','1331','1261','1259')
                                group by a.program_id, a.program_name, a.location_id, a.location_name
                                order by a.program_name asc, a.location_name asc";
                                // date_trunc('month', CURRENT_DATE)
        $nilaisladaytopclienthera = $this->db->query($sladaytopclienthera)->result();
        return $nilaisladaytopclienthera;
    }
}