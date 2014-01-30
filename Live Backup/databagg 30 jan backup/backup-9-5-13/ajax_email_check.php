<?php
include("connect.php");
include("function.php");

if($_REQUEST['add'])
{
    $check_exists_email="select * from tab_members where txt_email='".$_REQUEST['add']."'";
    $result_check=mysql_query($check_exists_email) or die(mysql_error());
    if(mysql_num_rows($result_check)==0)
    echo "success";
    else
    echo "failed";
}

?>