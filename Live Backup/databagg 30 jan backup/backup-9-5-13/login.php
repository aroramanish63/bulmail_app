<?php
session_start();
include("connect.php");
error_reporting(0);
if($_REQUEST['txt_email'])
{
    $check_user="select * from tab_members where txt_email='".mysql_real_escape_string($_REQUEST['txt_email'])."' and 
    txt_password='".mysql_real_escape_string(base64_encode($_REQUEST['txt_password']))."'";
    $result_check_user=mysql_query($check_user) or die(mysql_error());
    if(mysql_num_rows($result_check_user)==1)
    {
        $fetch_detail=mysql_fetch_array($result_check_user);
        $_SESSION['user_id']=$fetch_detail['int_id'];
        $_SESSION['user_mail_for_feed']=$_REQUEST['txt_email'];
        $_SESSION['user_fname_for_feed']=$fetch_detail['txt_first_name'];
        if($fetch_detail['int_verified']==1)
        $_SESSION['verified']='true';
        
        // here we are checking if user has seleted any plan for upgrade plan
            if(isset($_SESSION['planid'])){
                 header("Location: confirm_plan.php");
            }
        else
        $_SESSION['verified']='false';
        ?>
        
        <script>
        location.href="user/nindex.php";
        </script>
        <?php
    }
    else
    $err_msg="Invalid user name and password.";
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" type="image/x-icon" href