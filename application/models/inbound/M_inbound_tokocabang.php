<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    
class M_inbound_tokocabang extends CI_Model 
{
    public function getslaweektokocabang($date)
	{
        
        // // echo $_POST["date"];die;
        $tanggal = str_replace("+", " ", $date);
        $choose_month = "";
        $slatopclient = "SELECT 
                        'Toko Cabang' as parent,
                        a.location_name,
                        case when round(avg(a.ach_packed),2) > 100 then '100.00' else round(avg(a.ach_packed),2) end as ach_packed,
                        case when round(avg(a.ach_packed),2) < 99 then 'tomato' else '' end as color_packed,
                        case when round(avg(a.ach_rts),2) > 100 then '100.00' else round(avg(a.ach_rts),2) end as ach_rts,
                        case when round(avg(a.ach_rts),2) < 99 then 'tomato' else '' end as color_rts
                        --a.color_rts
                        from (
                            SELECT 
                                'Toko Cabang' as parent, 
                                location_name , 
                                order_created_date, 
                                round(avg(percentace_achievement), 2) as ach_packed ,
                                color as color_packed,
                                (select round(avg(s2.percentace_achievement), 2) 
                                    from slaoperationaltokocabangallclient s2 
                                    where s2.location_name  = slaoperationaltokocabangallclient.location_name
                                    and s2.order_created_date  = slaoperationaltokocabangallclient.order_created_date 
                                    -- and s2.program_parent_id = 1
                                    and s2.status_id  = 10
                                    group by s2.location_name,s2.percentace_achievement,s2.program_id limit 1
                                ) as ach_rts,
                                (select s1.color
                                    from slaoperationaltokocabangallclient s1 
                                    where s1.location_name  = slaoperationaltokocabangallclient.location_name
                                    and s1.order_created_date  = slaoperationaltokocabangallclient.order_created_date 
                                    -- and s1.program_parent_id = 1
                                    and s1.status_id  = 10
                                    group by s1.location_name,s1.percentace_achievement,s1.program_id, s1.color 
                                ) as color_rts
                            FROM slaoperationaltokocabangallclient 
                            WHERE 1 = 1 
                            AND status_id = 27
                            -- AND program_parent_id = 1 
                            and location_id not in (305, 329, 11)
                            and order_created_date between date_trunc('month', CURRENT_DATE) and current_date - interval '7 day' 
                            GROUP BY location_name, order_created_date,percentace_achievement, color
                            order by location_name asc
                        )a
                        group by a.location_name";
        $nilaislatopclient = $this->db->query($slatopclient)->result();
        return $nilaislatopclient;
    }

    public function getsladaytokocabang($date)
	{
        
        // // echo $_POST["date"];die;
        $tanggal = str_replace("+", " ", $date);
        $choose_month = "";
        $sladaytopclient = "SELECT
                            'Toko Cabang' as parent,
                            a.location_id,
                            a.location_name,
                            -- a.percentace_achievement
                            (select order_created_date from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date - interval '6 day'
                            and status_id = 27
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as order_created_date_1,
                            (select percentace_achievement from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date - interval '6 day'
                            and status_id = 27
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as packed_1,
                            (select case when percentace_achievement < 99 then 'tomato' else '' end as color_packed 
                            from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date - interval '6 day'
                            and status_id = 27
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as color_packed_1,
                            (select percentace_achievement from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date - interval '6 day'
                            and status_id = 10
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as rts_1,
                            (select case when percentace_achievement < 99 then 'tomato' else '' end as color_rts 
                            from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date - interval '6 day'
                            and status_id = 10
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as color_rts_1,
                            (select order_created_date from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date - interval '5 day'
                            and status_id = 27
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as order_created_date_2,
                            (select percentace_achievement from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date - interval '5 day'
                            and status_id = 27
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as packed_2,
                            (select case when percentace_achievement < 99 then 'tomato' else '' end as color_packed 
                            from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date - interval '5 day'
                            and status_id = 27
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as color_packed_2,
                            (select percentace_achievement from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date - interval '5 day'
                            and status_id = 10
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as rts_2,
                            (select case when percentace_achievement < 99 then 'tomato' else '' end as color_rts 
                            from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date - interval '5 day'
                            and status_id = 10
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as color_rts_2,
                            (select order_created_date from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date - interval '4 day'
                            and status_id = 27
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as order_created_date_3,
                            (select percentace_achievement from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date - interval '4 day'
                            and status_id = 27
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as packed_3,
                            (select case when percentace_achievement < 99 then 'tomato' else '' end as color_packed 
                            from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date - interval '4 day'
                            and status_id = 27
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as color_packed_3,
                            (select percentace_achievement from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date - interval '4 day'
                            and status_id = 10
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as rts_3,
                            (select case when percentace_achievement < 99 then 'tomato' else '' end as color_rts 
                            from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date - interval '4 day'
                            and status_id = 10
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as color_rts_3,
                            (select order_created_date from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date - interval '3 day'
                            and status_id = 27
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as order_created_date_4,
                            (select percentace_achievement from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date - interval '3 day'
                            and status_id = 27
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as packed_4,
                            (select case when percentace_achievement < 99 then 'tomato' else '' end as color_packed 
                            from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date - interval '3 day'
                            and status_id = 27
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as color_packed_4,
                            (select percentace_achievement from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date - interval '3 day'
                            and status_id = 10
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as rts_4,
                            (select case when percentace_achievement < 99 then 'tomato' else '' end as color_rts 
                            from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date - interval '3 day'
                            and status_id = 10
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as color_rts_4,
                            (select order_created_date from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date - interval '2 day'
                            and status_id = 27
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as order_created_date_5,
                            (select percentace_achievement from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date - interval '2 day'
                            and status_id = 27
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as packed_5,
                            (select case when percentace_achievement < 99 then 'tomato' else '' end as color_packed 
                            from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date - interval '2 day'
                            and status_id = 27
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as color_packed_5,
                            (select percentace_achievement from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date - interval '2 day'
                            and status_id = 10
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as rts_5,
                            (select case when percentace_achievement < 99 then 'tomato' else '' end as color_rts 
                            from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date - interval '2 day'
                            and status_id = 10
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as color_rts_5,
                            (select order_created_date from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date - interval '1 day'
                            and status_id = 27
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as order_created_date_6,
                            (select percentace_achievement from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date - interval '1 day'
                            and status_id = 27
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as packed_6,
                            (select case when percentace_achievement < 99 then 'tomato' else '' end as color_packed 
                            from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date - interval '1 day'
                            and status_id = 27
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as color_packed_6,
                            (select percentace_achievement from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date - interval '1 day'
                            and status_id = 10
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as rts_6,
                            (select case when percentace_achievement < 99 then 'tomato' else '' end as color_rts 
                            from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date - interval '1 day'
                            and status_id = 10
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as color_rts_6,
                            (select order_created_date from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date
                            and status_id = 27
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as order_created_date_7,
                            (select percentace_achievement from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date
                            and status_id = 27
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as packed_7,
                            (select case when percentace_achievement < 99 then 'tomato' else '' end as color_packed 
                            from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date
                            and status_id = 27
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as color_packed_7,
                            (select percentace_achievement from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date
                            and status_id = 10
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as rts_7,
                            (select case when percentace_achievement < 99 then 'tomato' else '' end as color_rts 
                            from slaoperationaltokocabangallclient
                            where 1=1
                            and order_created_date = current_date
                            and status_id = 10
                            -- and program_parent_id = 1
                            and location_id not in (305, 329, 11)
                            and location_id = a.location_id
                            ) as color_rts_7
                            FROM slaoperationaltokocabangallclient a
                            where 1=1
                            -- and program_parent_id = 1 
                            and location_id not in (305, 329, 11)
                            group by a.location_id, a.location_name
                            order by a.location_name asc";
                                // date_trunc('month', CURRENT_DATE)
        $nilaisladaytopclient = $this->db->query($sladaytopclient)->result();
        return $nilaisladaytopclient;
    }
}