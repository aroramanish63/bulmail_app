<?php
session_start();


include("../connect.php");
include("../function.php");
//session_start();

if($_REQUEST['cat_id'])
{
    $data="";
    $count=0;
    
    $select_list_data="select * from users_data where int_fid in(".$_REQUEST['cat_id'].") and int_del_status='0'";
    
    
    $result_list_data=mysql_query($select_list_data) or die(mysql_error());
    
   
    $data.="<br>";
    $data.="<table style='width: 270px;' id='alternatecolor' class='altrowstable1'  >";
    while($fetch_list_data=mysql_fetch_array($result_list_data))
    { $count++;
    $imgsrc="../".$fetch_list_data['txt_real_path'];
  
      
            
            
          

     $data.="<tr >";
     
      $data.="<td  style='padding-left:5px;'>";
      
      $data.="<div style='width:240px;overflow:hidden;'>".$fetch_list_data['txt_file_name']."</div>";
      
       $data.="</td>";
        
        $data.="<td >";
        $data.="<img src='images/play-icon.png'  style='cursor:pointer;' title='Play Item' onclick='go(\"$imgsrc\");'>";
        $data.="</td>";
      $data.="</tr>";
    
       
       
        //$main_data="<a href='javascript:load_data(\"".$fetch_list_data['txt_file_name']."\");'>".$fetch_list_data['txt_file_name']."</a>";
        //$data=$data.$main_data;
        //$data.="</br></br>";
        
    }
     $data.="</table>";
    echo $data;
    
}


?>