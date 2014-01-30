<?php
session_start();
$prev_path=$_SERVER['HTTP_REFERER'];
if(!isset($_SESSION['sync_userid']))
header("Location:login.php");
else if($_SESSION["sync_usertype"]=="Admin")
{
$_SESSION['user_id']=base64_decode($_REQUEST['data']);
header("Location:user/dashboard.php");
}
else
header("Location:$prev_path");
?>