<?php
error_reporting(0);
session_start();


include("../connect.php");
include("../function.php");

if($_REQUEST['cat_id'])
{
    $data="";
    $count=0;
    
    $select_list_data="select * from users_data where int_fid in(".$_REQUEST['cat_id'].") and int_del_status='0'";
    
    
    $result_list_data=mysql_query($select_list_data) or die(mysql_error());
    $data="";
    while($fetch_list_data=mysql_fetch_array($result_list_data))
    { $count++;
    $imgsrc="../".$fetch_list_data['txt_real_path'];
    
       
       if ($_SESSION['page_type']=="gallary") 
       $data.="<img src='$imgsrc' height='400px' width='400px'> "; 

}
}
echo $data;

?>