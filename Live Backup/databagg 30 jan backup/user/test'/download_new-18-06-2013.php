<?php
include "../connect.php";
 $select_file_info="select * from users_data where int_fid='".$_REQUEST['id']."'";
$result_info=mysql_query($select_file_info);
if(mysql_num_rows($result_info)>0)
{
    $fetch_info=mysql_fetch_array($result_info);
    //echo crypt($fetch_info['txt_local_path'],ENC_KEY);
    //echo "<br>".$_REQUEST['path'];
    if(crypt($fetch_info['txt_file_name'],ENC_KEY)==$_REQUEST['path'])
    {
        
        
        //echo date("M:d:y",time());
$expire=60*60*24*1;
$path ="../".$fetch_info['txt_real_path'];
//$file = basename($path);

$str1=explode("/",$path);
$c=count($str1);

$file=$fetch_info['txt_file_name'];


header ("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"$file\"");

header('Content-Transfer-Encoding: binary');

header('Expires: ' . gmdate('D, d M Y H:i:s', time()-$expire) . ' GMT');

if(isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') )) {
  header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
  header('Pragma: public');
} 



readfile($path);
        
        
    }
    else
    {
         echo "<script>alert('No such file are available for download.');</script>";
    }
    
    
}
else
{
    echo "<script>alert('No such file are available for download.');</script>";
}


?> 