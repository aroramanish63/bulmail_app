<?php
function total_space_used_for_sync($member_id,$f)
{
       // $select_total_used="select sum(int_file_size) as total from users_data where int_uid='".$member_id."' and int_del_status=0";
//        $result_total=mysql_query($select_total_used);
//        $fetch_total=mysql_fetch_array($result_total);
        //$f='../nas/uploads/' . $member_id . '/sync';
        $bytes = 0;
        if(file_exists($f))
        {
        $output = exec('du -sk ' . $f);
        $bytes = trim(str_replace($f, '', $output)) * 1024;
        }
        // $tot=$fetch_total['total']+$bytes;
        $total_mb=($bytes/1024)/1024;
    
        
        update_size_for_sync($total_mb,$member_id);
            

      //  return number_format($total_mb,2,'.', '');
}

function update_size_for_sync($total_mb,$member_id)
{
    
  $update_space="update tab_members set int_space_consumed='".$total_mb."' where int_id='".$member_id."'";  
  mysql_query($update_space);
    
}

function get_total_consumed_space($member_id)
{
 $select_total_used1="select sum(int_file_size) as total_my_data from users_data where int_uid='".$member_id."' and int_del_status=0";
    $result_total1=mysql_query($select_total_used1);
    $fetch_total1=mysql_fetch_array($result_total1);  
     
    $total_my_data_bagg=$fetch_total1['total_my_data'];
    
    $select_total_sync="select int_space_consumed from tab_members where int_id='".$member_id."'";
    $reult_total_sync=mysql_query($select_total_sync) ;
    $fetch_total_sync=mysql_fetch_array($reult_total_sync);
    
    $total_sync_size=$fetch_total_sync['int_space_consumed']+($total_my_data_bagg/(1024*1024));
    
    return $total_sync_size;
    
    
}


?>