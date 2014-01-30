<?php
include("../connect.php");
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

if($_REQUEST['invitedby']!="" && $_REQUEST['uid']!="" &&  $_REQUEST['email']!="" )
{

$maxfreespace=102400;
//$id=mysql_fetch_array(mysql_query("select int_id from tab_members where txt_email='".$_REQUEST['email']."'"));
//mysql_query("insert into member_storage (memberid,size) values ('".$id['int_id']."','5')");
	 $sql="select id from  invititation where invitedby='".$_REQUEST['invitedby']."' and uid='".$_REQUEST['uid']."' and uid_isused='0'";
	 $checkcode=mysql_num_rows(mysql_query($sql));
	if($checkcode>0)
	{
    //$sql="select size from member_storage where memberid='".$_REQUEST['invitedby']."'";
	//$sizes=mysql_fetch_array(mysql_query($sql));
	
	 /*$sql1="select int_space_allotted from tab_members where int_id='".$_REQUEST['invitedby']."'";
	$sizes1=mysql_fetch_array(mysql_query($sql1));
	
	
	if($sizes1['int_space_allotted']<107520)
	{
    //$size=$sizes['size']+1;	
   // $sql="update member_storage set size='".$size."' where memberid='".$_REQUEST['invitedby']."'";
	//mysql_query($sql);
    echo $size1=$sizes1['int_space_allotted']+1024;	
	mysql_query("update tab_members set int_space_allotted='".$size1."' where int_id='".$_REQUEST['invitedby']."'");
	mysql_query("update invititation set uid_isused='1' where uid='".$_REQUEST['uid']."'");
	}*/
	
	$sql1="select sum(free_space) as space from invititation where invitedby='".$_REQUEST['invitedby']."' and uid_isused='1'";
	$sizes1=mysql_fetch_array(mysql_query($sql1));
	
	$fspace=mysql_fetch_array(mysql_query("select free_space from invititation where email='".$_REQUEST['useremail']."'"));
	//if($sizes1['space']<$maxfreespace)
	//{
	
	$sql1="select int_space_allotted from tab_members where int_id='".$_REQUEST['invitedby']."'";
	$sizes1=mysql_fetch_array(mysql_query($sql1));
	$size1=$sizes1['int_space_allotted']+$fspace['free_space'];
	mysql_query("update tab_members set int_space_allotted='".$size1."' where int_id='".$_REQUEST['invitedby']."'");
	
	mysql_query("update invititation set uid_isused='1' where uid='".$_REQUEST['uid']."'");
	
	//}
	
	
		
	}
	mysql_query("update tab_members set int_verified='1' where txt_email='".$_REQUEST['email']."'");

	
$invitedby=mysql_fetch_array(mysql_query("select txt_first_name,txt_email from tab_members where int_id='".$_REQUEST['invitedby']."'"));
$refral=ucfirst($invitedby['txt_first_name']);
$email=$invitedby['txt_email'];

$person=mysql_fetch_array(mysql_query("select fname from  invititation where invitedby='".$_REQUEST['invitedby']."' and uid='".$_REQUEST['uid']."'"));
 $reperson=ucfirst($person['fname']);
	
	
	require 'PHPMailer/class.phpmailer.php';
$body= <<<EOF
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Databagg</title>

<style type="text/css">
body{padding:0px; margin:0px; font-size:12px; color:#666;}
a{ color:#159fc7;}
</style>
</head>

<body>

<table width="650" height="636" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td background="http://databagg.com/Newsletter/images/newsletter-bg.jpg" valign="top">
    
    
    <table width="470" border="0" cellspacing="0" cellpadding="5" align="center">
    <tr>
    <td>&nbsp;</td>
  </tr>
     <tr>
    <td>&nbsp;</td>
  </tr>
     <tr>
    <td>&nbsp;</td>
  </tr>
     <tr>
    <td>&nbsp;</td>
  </tr>
     <tr>
    <td>&nbsp;</td>
  </tr>


  <tr>
    <td><font color="#159fc7" size="4" face="Arial, Helvetica, sans-serif">Hi  $refral,</font></td>
  </tr>
  <tr>
    <td>We are pleased to inform you that your  friend $reperson has successfully subscribed to DataBagg. </td>
  </tr>
  <tr>
    <td>Thank you for your help in spreading the  word!</td>
  </tr>
  <tr>
    <td>As a token of appreciation, we are  providing you free 1 GB of storage, which would be automatically added in your  DataBagg account. </td>
  </tr>
  
  <tr>
    <td>If you refer us more friends, then you can  get more free space!</td>
  </tr>
  
  <tr>
    <td>In  case you have issues related with the usage of DataBagg, please feel free to  mail us at 
      <a href="mailto:support@databagg.com">support@databagg.com</a></td>
  </tr>
  <tr>
    <td><strong>With Best Regards,</strong><br />
Team DataBagg
</td>
  </tr>
</table>

    
    
    
    </td>
  </tr>
</table>


</body>
</html>

EOF;
$mail = new PHPMailer();
   $mail->IsSMTP(true);  // telling the class to use SMTP
	$mail->SMTPSecure = 'tls';
                    $mail->Host     = "103.10.189.48";  // SMTP server
                    $mail->Username="support@databagg.com";
                    $mail->Password="H24!@#IU*&//";

$mail->SetFrom("support@databagg.com","Databagg Team");
$mail->AddAddress($email);
$mail->Subject  =  "$reperson has joined DataBagg";
//$mail->SMTPDebug = 2;
$mail->IsHTML(true);
$mail->Body     = $body;
$mail->WordWrap = 50;

$mail->Send();
	
	

  header("Location:https://databagg.com/user/nindex.php");
    }

elseif($_REQUEST['email'])
{

$id=mysql_fetch_array(mysql_query("select int_id from tab_members where txt_email='".$_REQUEST['email']."'"));
//mysql_query("insert into member_storage (memberid,size) values ('".$id['int_id']."','5')");
mysql_query("update tab_members set int_verified='1' where txt_email='".$_REQUEST['email']."'");
header("Location:http://databagg.com/user/nindex.php");

}






?>