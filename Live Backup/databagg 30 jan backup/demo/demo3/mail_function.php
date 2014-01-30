<?php
if(function_exists("date_default_timezone_set"))
	date_default_timezone_set("Asia/Calcutta");
error_reporting(E_ALL);
ini_set("display_errors",1);
//require_once("PHPMailer/class.phpmailer.php");

  //$mail = new PHPMailer();
                    $mail->IsSMTP();  // telling the class to use SMTP
                    $mail->SMTPAuth   = true; 
                    $mail->Host     = "121.242.207.100";  // SMTP server
                    $mail->Username="support@databagg.com";
                    $mail->Password="sd@#2WD#45";


function mail_error_query($query,$msg,$page)
{
    global $mail;
    $header  = "MIME-Version: 1.0\r\n";
 $header .= "Content-type: text/html; charset: utf8\r\n";
    $subject="Congratulations! Your Backup Is Complete..";
    $header.="from:Team Databagg <team@databagg.com>";
    $content="<br>";
    $content.="error in query - $query <br>  may be the error resion are - $msg <br> page info - $page";
    $content.="<br> <br>";


	$mail->SetFrom("support@databagg.com","DataBaGG");
	$mail->Subject  = "Something wrong in databagg";
	$mail->MsgHTML($content);

        $mail->AddAddress("saurav.suman@cyfuture.com");

	$mail->Send();
    
	$mail->ClearAllRecipients();
    
}

function mail_complete_setup($mail_id,$name)
{
    global $mail;
    $header  = "MIME-Version: 1.0\r\n";
 $header .= "Content-type: text/html; charset: utf8\r\n";
    $subject="Congratulations! Your Backup Is Complete..";
    $header.="from:Team Databagg <team@databagg.com>";
    $content="<br>";
$content.="<body style=\"background:#fafafa; margin:0; padding:0; font-family:Georgia, 'Times New Roman', Times, serif;text-align: justify;\">
<table width='100%' border='0' cellspacing='0' cellpadding='0' >

  <tr>
    <td>
    <table width='60%' border='0' cellspacing='0' cellpadding='0' align='center' style='background-color:#FFF; border:1px solid #eaeaea;   '>
    <tr>
<td style='background:url(https://www.databagg.com/mail_images/topborder.jpg) repeat-x; height:5px;'></td>
</tr>
  <tr>
    <td><table width='800' border='0' cellspacing='0' cellpadding='0'>
  <tr>

    
    <td width='100%' align='center' style=' padding:5px 0 5px 0; border-bottom:1px solid #e5e5e5;'><img src='https://www.databagg.com/mail_images/cartoon.jpg'  alt='#' /></td>
  </tr>
  
  <tr>
  <td style=\"font-size:13px; border-bottom:1px solid #e5e5e5; font-family:Georgia, 'Times New Roman', Times, serif; color:#333; line-height:22px; padding:15px;\">
  <p style='font-size:16px;   color:black;'>Hi <font style='font-size:16px;   color:#0092c6;font-weight: bold;'>$name,</font> </p> 
  Your DataBagg account is now almost ready.
In order to use maximum features, don&#8217; t forget to install DataBagg on your computer.


<br /><a  target='_blank' style='color:#db3c6e;text-decoration:none' href='https://www.databagg.com/user/download.php?path=databagg.zip'>Download Databagg</a> <br /> 
Once you upload your digital data using our application, it will be automatically backed-up and synchronized across all the connected devices: your personal computer, your office computer and even on our website!

<br /><br />
We make your data accessible globally and create a back-up so that it is always safe and secured. 
Thank you for choosing DataBagg. For any question or support, please feel free to mail us at <a  style='color:#ea4d0f;text-decoration:none' href='mailto:support@databagg.com'>support@databagg.com</a>.
<br>
  
  
  </td>
  
  </tr>
  
    <tr>
  <td style=\" font-size:13px; border-bottom:1px solid #e5e5e5; font-family:Georgia, 'Times New Roman', Times, serif; color:#333; line-height:22px; padding:15px;\">
   <font style='font-size:16px;   color:#0092c6;'> With best regards,</font> <br />

Team DataBagg<br />


  </td>
  
  </tr>
  
    <tr>
    <td >
   <table align='right' width='100'  border='0' cellspacing='0' cellpadding='0' >
  <tr>
  <td colspan='3'>
  <font size='1.5px' color='#00a7e2'>Connect with us</font>
  </td>
  </tr>
  <tr >
    
    <td style='padding-bottom:5px;'><a href='https://twitter.com/DataBagg' target='_blank'><img src='https://www.databagg.com/mail_images/twitter.png' width='16' height='16' alt='#' /></a></td>
     <td style='padding-bottom:5px;' ><a href='https://www.facebook.com/Databagg' target='_blank'><img src='https://www.databagg.com/mail_images/facebook.png' width='16' height='16' alt='#' /></a></td>
     <td style='padding-bottom:5px;'><a href='http://in.linkedin.com/pub/databagg/62/9b4/570' target='_blank'><img src='https://www.databagg.com/mail_images/linedin.png' width='16' height='16' alt='#' /></a></td>
  
  </tr>
  
</table>
  </td>
    </tr>
  
 
  
</table>
</td>
  </tr>
 
  <tr >
  <td >

    <table>
    
    <tr>
    <td  >
    <img src='https://www.databagg.com/mail_images/calling.jpg' />
    </td>
    
    </tr>
    </table>
  
  </td>
  
  
  
  </tr>
  
  
  
</table>

    
    </td>
  </tr>
</table>

</body>";


$content.="<br> <br>";


	$mail->SetFrom("support@databagg.com","DataBaGG");
	$mail->Subject  = "Complete your DataBagg setup";
	$mail->MsgHTML($content);

        $mail->AddAddress($mail_id);

	$mail->Send();
    
	$mail->ClearAllRecipients();
}


function mail_dedicated_manager($mail_id,$name,$mname)
{
    global $mail;
    $header  = "MIME-Version: 1.0\r\n";
 $header .= "Content-type: text/html; charset: utf8\r\n";
    $subject="Congratulations! Your Backup Is Complete..";
    $header.="from:Team Databagg <team@databagg.com>";
    $content="<br>";
$content.="<body style=\"background:#fafafa; margin:0; padding:0; font-family:Georgia, 'Times New Roman', Times, serif;text-align: justify;\">
<table width='100%' border='0' cellspacing='0' cellpadding='0' >

  <tr>
    <td>
    <table width='60%' border='0' cellspacing='0' cellpadding='0' align='center' style='background-color:#FFF; border:1px solid #eaeaea;   '>
    <tr>
<td style='background:url(https://www.databagg.com/mail_images/topborder.jpg) repeat-x; height:5px;'></td>
</tr>
  <tr>
    <td><table width='800' border='0' cellspacing='0' cellpadding='0'>
  <tr>

    
    <td width='100%' align='center' style=' padding:5px 0 5px 0; border-bottom:1px solid #e5e5e5;'><img src='https://www.databagg.com/mail_images/cartoon.jpg'  alt='#' /></td>
  </tr>
  
  <tr>
  <td style=\"font-size:13px; border-bottom:1px solid #e5e5e5; font-family:Georgia, 'Times New Roman', Times, serif; color:#333; line-height:22px; padding:15px;\">
  <p style='font-size:16px;   color:black;'>Hi <font style='font-size:16px;   color:#0092c6;font-weight: bold;'>$name,</font> </p> 
  Thanks for choosing DataBagg, my name is <font style='font-size:16px;   color:#0092c6;font-weight: bold;'> $mname </font> and I'll be your first point of contact if you need any help.


<br /> <br />
Very shortly you will realize that DataBagg is very simple to use, but so valuable in day-to-day life.
<br /> <br />

You can store your photos, files, music, reports and videos online, then access them at anytime from any computer or mobile device.
<br /> <br />
Me personally, I like just knowing I have a secure backup, so if anything happens to my computer or phone, I know DataBagg will restore all my data.
<br /> <br />
I had a external drive crash 2 years ago, before I worked for DataBagg and I lost my daughter all childhood photos. So believe me, I know firsthand how important a backup is.
<br /> <br />
  
  Anyway <font style='font-size:14px;   color:#0092c6;font-weight: bold;'>$name,</font> if you need anything just let me know.
  </td>
  
  </tr>
  
    <tr>
  <td style=\" font-size:13px; border-bottom:1px solid #e5e5e5; font-family:Georgia, 'Times New Roman', Times, serif; color:#333; line-height:22px; padding:15px;\">
   <font style='font-size:16px;   color:#0092c6;'> Regards,</font> <br />
$mname <br>
Personal Account Manager<br />
DataBagg <br />
<a  style='color:#ea4d0f;text-decoration:none' href='mailto:support@databagg.com'>support@databagg.com</a>


  </td>
  
  </tr>
  
    <tr>
    <td >
   <table align='right' width='100'  border='0' cellspacing='0' cellpadding='0' >
  <tr>
  <td colspan='3'>
  <font size='1.5px' color='#00a7e2'>Connect with us</font>
  </td>
  </tr>
  <tr >
    
   <td style='padding-bottom:5px;'><a href='https://twitter.com/DataBagg' target='_blank'><img src='https://www.databagg.com/mail_images/twitter.png' width='16' height='16' alt='#' /></a></td>
     <td style='padding-bottom:5px;' ><a href='https://www.facebook.com/Databagg' target='_blank'><img src='https://www.databagg.com/mail_images/facebook.png' width='16' height='16' alt='#' /></a></td>
     <td style='padding-bottom:5px;'><a href='http://in.linkedin.com/pub/databagg/62/9b4/570' target='_blank'><img src='https://www.databagg.com/mail_images/linedin.png' width='16' height='16' alt='#' /></a></td>
  
  </tr>
  
</table>
  </td>
    </tr>
  
 
  
</table>
</td>
  </tr>
 
  <tr >
  <td >

    <table>
    
    <tr>
    <td  >
    <img src='https://www.databagg.com/mail_images/calling.jpg' />
    </td>
    
    </tr>
    </table>
  
  </td>
  
  
  
  </tr>
  
  
  
</table>

    
    </td>
  </tr>
</table>

</body>";


$content.="<br> <br>";


	$mail->SetFrom("support@databagg.com","DataBaGG");
	$mail->Subject  = "Dedicated manager assigned";
	$mail->MsgHTML($content);

        $mail->AddAddress($mail_id);

	$mail->Send();
    
	$mail->ClearAllRecipients();
}

function mail_forgot($em_enc,$nm,$pass)
{
      global $mail;  
    $headers = 'From: DATABAGG <team@databagg.com>' . "\r\n";
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$content="<br>";
	 $content.="<body style=\"background:#fafafa; margin:0; padding:0; font-family:Georgia, 'Times New Roman', Times, serif;text-align: justify;\">
<table width='100%' border='0' cellspacing='0' cellpadding='0' >

  <tr>
    <td>
    <table width='60%' border='0' cellspacing='0' cellpadding='0' align='center' style='background-color:#FFF; border:1px solid #eaeaea;   '>
    <tr>
<td style='background:url(https://www.databagg.com/mail_images/topborder.jpg) repeat-x; height:5px;'></td>
</tr>
  <tr>
    <td><table width='800' border='0' cellspacing='0' cellpadding='0'>
  <tr>

    
    <td width='100%' align='center' style=' padding:5px 0 5px 0; border-bottom:1px solid #e5e5e5;'><img src='https://www.databagg.com/mail_images/cartoon.jpg'  alt='#' /></td>
  </tr>
  
  <tr>
  <td style=\"font-size:13px; border-bottom:1px solid #e5e5e5; font-family:Georgia, 'Times New Roman', Times, serif; color:#333; line-height:22px; padding:15px;\">
  <p style='font-size:16px;   color:black;'>Hi <font style='font-size:16px;   color:#0092c6;font-weight: bold;'>$em_enc,</font> </p> 
    
    Someone has requested a password reset on your DataBagg account. <br />

If this was you, please fine below your password  <br />

Your DataBagg account password is <font style='font-size:14px;   color:#0092c6;font-weight: bold;'>$pass</font>  <br /> <br />

<font style='font-size:10px;   color:#ea4d0f;font-weight: bold;'>If you did not initiate this change please ignore this email.</font>

    
    

  </td>
  
  </tr>
  
    <tr>
  <td style=\"font-size:13px; border-bottom:1px solid #e5e5e5; font-family:Georgia, 'Times New Roman', Times, serif; color:#333; line-height:22px; padding:15px;\">
   <font style='font-size:16px;   color:#0092c6;'> Thank you,</font> <br />

Team Databagg




  </td>
  
  </tr>
  
    <tr>
    <td >
   <table align='right' width='100'  border='0' cellspacing='0' cellpadding='0' >
  <tr>
  <td colspan='3'>
  <font size='1.5px' color='#00a7e2'>Connect with us</font>
  </td>
  </tr>
  <tr >
    
   <td style='padding-bottom:5px;'><a href='https://twitter.com/DataBagg' target='_blank'><img src='https://www.databagg.com/mail_images/twitter.png' width='16' height='16' alt='#' /></a></td>
     <td style='padding-bottom:5px;' ><a href='https://www.facebook.com/Databagg' target='_blank'><img src='https://www.databagg.com/mail_images/facebook.png' width='16' height='16' alt='#' /></a></td>
     <td style='padding-bottom:5px;'><a href='http://in.linkedin.com/pub/databagg/62/9b4/570' target='_blank'><img src='https://www.databagg.com/mail_images/linedin.png' width='16' height='16' alt='#' /></a></td>
  
  </tr>
  
</table>
  </td>
    </tr>
  
 
  
</table>
</td>
  </tr>
 
  <tr >
  <td >

    <table>
    
    <tr>
    <td  >
    <img src='https://www.databagg.com/mail_images/calling.jpg' />
    </td>
    
    </tr>
    </table>
  
  </td>
  
  
  
  </tr>
  
  
  
</table>

    
    </td>
  </tr>
</table>

</body>";
   
     $content.="<br>";
     
     
    $content.="<br> <br>";
	
//    
//	$mail = new PHPMailer();
//	$mail->IsSMTP();  // telling the class to use SMTP
//    $mail->SMTPAuth   = false; 
//	$mail->Host     = "192.168.100.7"; 
	$mail->SetFrom("support@databagg.com","DataBaGG");
	$mail->Subject  = "Have you forgotten your DataBagg password? Please find your password here";
	$mail->MsgHTML($content);

        $mail->AddAddress($em_enc);

	$mail->Send();
	$mail->ClearAllRecipients();

}
function mail_data_filled_all($mail_id,$name,$mname)
{
    global $mail;
    $header  = "MIME-Version: 1.0\r\n";
 $header .= "Content-type: text/html; charset: utf8\r\n";
    $subject="Congratulations! Your Backup Is Complete..";
    $header.="from:Team Databagg <team@databagg.com>";
    $content="<br>";
   $content.="<body style=\"background:#fafafa; margin:0; padding:0; font-family:Georgia, 'Times New Roman', Times, serif;text-align: justify;\">
<table width='100%' border='0' cellspacing='0' cellpadding='0' >

  <tr>
    <td>
    <table width='60%' border='0' cellspacing='0' cellpadding='0' align='center' style='background-color:#FFF; border:1px solid #eaeaea;   '>
    <tr>
<td style='background:url(https://www.databagg.com/mail_images/topborder.jpg) repeat-x; height:5px;'></td>
</tr>
  <tr>
    <td><table width='800' border='0' cellspacing='0' cellpadding='0'>
  <tr>

    
    <td width='100%' align='center' style=' padding:5px 0 5px 0; border-bottom:1px solid #e5e5e5;'><img src='https://www.databagg.com/mail_images/cartoon.jpg'  alt='#' /></td>
  </tr>
  
  <tr>
  <td style=\"font-size:13px; border-bottom:1px solid #e5e5e5; font-family:Georgia, 'Times New Roman', Times, serif; color:#333; line-height:22px; padding:15px;\">
  <p style='font-size:16px;   color:black;'>Hi <font style='font-size:16px;   color:#0092c6;font-weight: bold;'>$name,</font> </p> 
 You have fully consumed your DataBagg Storage. Upgrade and instantly get more space. <br /> <br />

 Please remember how important it is to back up all of your photos, music, files and documents. <br /> <br />

It takes just one random hard drive crash or one forgetful moment to lose all of your computer files forever. <br /> <br /> 

If you haven't already decided on a plan to upgrade to please email our sales team on <a  style='color:#ea4d0f;text-decoration:none' href='mailto:sales@databagg.com'>sales@databagg.com</a> and our team will be happy to advise you on the best plan for you.
 <br />

  </td>
  
  </tr>
  
    <tr>
  <td style=\" font-size:13px; border-bottom:1px solid #e5e5e5; font-family:Georgia, 'Times New Roman', Times, serif; color:#333; line-height:22px; padding:15px;\">
   <font style='font-size:16px;   color:#0092c6;'> Thank you,</font> <br />

$mname<br />
 DataBagg 



  </td>
  
  </tr>
  
    <tr>
    <td >
   <table align='right' width='100'  border='0' cellspacing='0' cellpadding='0' >
  <tr>
  <td colspan='3'>
  <font size='1.5px' color='#00a7e2'>Connect with us</font>
  </td>
  </tr>
  <tr >
    <td style='padding-bottom:5px;'><a href='https://twitter.com/DataBagg' target='_blank'><img src='https://www.databagg.com/mail_images/twitter.png' width='16' height='16' alt='#' /></a></td>
     <td style='padding-bottom:5px;' ><a href='https://www.facebook.com/Databagg' target='_blank'><img src='https://www.databagg.com/mail_images/facebook.png' width='16' height='16' alt='#' /></a></td>
     <td style='padding-bottom:5px;'><a href='http://in.linkedin.com/pub/databagg/62/9b4/570' target='_blank'><img src='https://www.databagg.com/mail_images/linedin.png' width='16' height='16' alt='#' /></a></td>
  
  </tr>
  
</table>
  </td>
    </tr>
  
 
  
</table>
</td>
  </tr>
 
  <tr >
  <td >

    <table>
    
    <tr>
    <td  >
    <img src='https://www.databagg.com/mail_images/calling.jpg' />
    </td>
    
    </tr>
    </table>
  
  </td>
  
  
  
  </tr>
  
  
  
</table>

    
    </td>
  </tr>
</table>

</body>";
$content.="<br> <br>";

	$mail->SetFrom("support@databagg.com","DataBaGG");
	$mail->Subject  = "Great work! You have fully utilized your DataBagg Storage";
	$mail->MsgHTML($content);

        $mail->AddAddress($mail_id);

	$mail->Send();
	$mail->ClearAllRecipients();
}


function mail_data_filled($mail_id,$name,$percent,$mname)
{
    global $mail;
    $header  = "MIME-Version: 1.0\r\n";
 $header .= "Content-type: text/html; charset: utf8\r\n";
    $subject="Congratulations! Your Backup Is Complete..";
    $header.="from:Team Databagg <team@databagg.com>";
    $content="<br>";
   $content.="<body style=\"background:#fafafa; margin:0; padding:0; font-family:Georgia, 'Times New Roman', Times, serif;text-align: justify;\">
<table width='100%' border='0' cellspacing='0' cellpadding='0' >

  <tr>
    <td>
    <table width='60%' border='0' cellspacing='0' cellpadding='0' align='center' style='background-color:#FFF; border:1px solid #eaeaea;   '>
    <tr>
<td style='background:url(https://www.databagg.com/mail_images/topborder.jpg) repeat-x; height:5px;'></td>
</tr>
  <tr>
    <td><table width='800' border='0' cellspacing='0' cellpadding='0'>
  <tr>

    
    <td width='100%' align='center' style=' padding:5px 0 5px 0; border-bottom:1px solid #e5e5e5;'><img src='https://www.databagg.com/mail_images/cartoon.jpg'  alt='#' /></td>
  </tr>
  
  <tr>
  <td style=\"font-size:13px; border-bottom:1px solid #e5e5e5; font-family:Georgia, 'Times New Roman', Times, serif; color:#333; line-height:22px; padding:15px;\">
  <p style='font-size:16px;   color:black;'>Welcome <font style='font-size:16px;   color:#0092c6;font-weight: bold;'>$name,</font> </p> 
  You have consumed <font style='font-size:14px;   color:#0092c6;font-weight: bold;'>$percent </font> of your available space. Upgrade and instantly get more space.

 Please remember how important it is to back up all of your photos, music, files and documents.

It takes just one random hard drive crash or one forgetful moment to lose all of your computer files forever. 

<br/><br /> If you haven't already decided on a plan to upgrade to please email our sales team on <a  style='color:#ea4d0f;text-decoration:none' href='mailto:sales@databagg.com'>sales@databagg.com</a> and our team will be happy to advise you on the best plan for you.

  
  
  </td>
  
  </tr>
  
    <tr>
  <td style=\" font-size:13px; border-bottom:1px solid #e5e5e5; font-family:Georgia, 'Times New Roman', Times, serif; color:#333; line-height:22px; padding:15px;\">
   <font style='font-size:16px;   color:#0092c6;'> Thank you,</font> <br />

$mname <br />
DataBagg

  </td>
  
  </tr>
  
    <tr>
    <td >
   <table align='right' width='100'  border='0' cellspacing='0' cellpadding='0' >
  <tr>
  <td colspan='3'>
  <font size='1.5px' color='#00a7e2'>Connect with us</font>
  </td>
  </tr>
  <tr >
    
     <td style='padding-bottom:5px;'><a href='https://twitter.com/DataBagg' target='_blank'><img src='https://www.databagg.com/mail_images/twitter.png' width='16' height='16' alt='#' /></a></td>
     <td style='padding-bottom:5px;' ><a href='https://www.facebook.com/Databagg' target='_blank'><img src='https://www.databagg.com/mail_images/facebook.png' width='16' height='16' alt='#' /></a></td>
     <td style='padding-bottom:5px;'><a href='http://in.linkedin.com/pub/databagg/62/9b4/570' target='_blank'><img src='https://www.databagg.com/mail_images/linedin.png' width='16' height='16' alt='#' /></a></td>
  
  </tr>
  
</table>
  </td>
    </tr>
  
 
  
</table>
</td>
  </tr>
 
  <tr >
  <td >

    <table>
    
    <tr>
    <td  >
    <img src='https://www.databagg.com/mail_images/calling.jpg' />
    </td>
    
    </tr>
    </table>
  
  </td>
  
  
  
  </tr>
  
  
  
</table>

    
    </td>
  </tr>
</table>

</body>";
$content.="<br> <br>";


	$mail->SetFrom("support@databagg.com","DataBaGG");
	$mail->Subject  = "Your DataBagg Storage is $percent consumed";
	$mail->MsgHTML($content);

        $mail->AddAddress($mail_id);

	$mail->Send();
	$mail->ClearAllRecipients();
}



function mail_share($mail_id,$cd,$fnm,$lnm,$mid)
{
    global $mail;
     $headers = 'From: DATABAGG <team@databagg.com>' . "\r\n";
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $dest="http://www.databagg.com/user/files/share/?code=$cd";
    
   $content="<br>";
	 $content.="<body style=\"background:#fafafa; margin:0; padding:0; font-family:Georgia, 'Times New Roman', Times, serif;text-align: justify;\">
<table width='100%' border='0' cellspacing='0' cellpadding='0' >

  <tr>
    <td>
    <table width='60%' border='0' cellspacing='0' cellpadding='0' align='center' style='background-color:#FFF; border:1px solid #eaeaea;   '>
    <tr>
<td style='background:url(https://www.databagg.com/mail_images/topborder.jpg) repeat-x; height:5px;'></td>
</tr>
  <tr>
    <td><table width='800' border='0' cellspacing='0' cellpadding='0'>
  <tr>

    
    <td width='100%' align='center' style=' padding:5px 0 5px 0; border-bottom:1px solid #e5e5e5;'><img src='https://www.databagg.com/mail_images/cartoon.jpg'  alt='#' /></td>
  </tr>
  
  <tr>
  <td style=\"font-size:13px; border-bottom:1px solid #e5e5e5; font-family:Georgia, 'Times New Roman', Times, serif; color:#333; line-height:22px; padding:15px;\">
  <p style='font-size:16px;   color:black;'>Hi <font style='font-size:16px;   color:#0092c6;font-weight: bold;'>$mail_id,</font> </p> 
    
   $fnm $lnm has sent file to you.  <br /> <br />
<a href='$dest' target='_blank' style='font-size:14px;   color:#ea4d0f;font-weight: bold;'>View File </a>
<br /> <br />
View shared file by clicking on 'View File' or create your own free DataBagg account <br />

If you think you are receiving this email in error, please inform us at <a  style='color:#ea4d0f;text-decoration:none' href='mailto:support@databagg.com'>support@databagg.com</a>. 


    
    

  </td>
  
  </tr>
  
    <tr>
  <td style=\"font-size:13px; border-bottom:1px solid #e5e5e5; font-family:Georgia, 'Times New Roman', Times, serif; color:#333; line-height:22px; padding:15px;\">
   

Enjoy!<br />
Team Databagg 



  </td>
  
  </tr>
  
    <tr>
    <td >
   <table align='right' width='100'  border='0' cellspacing='0' cellpadding='0' >
  <tr>
  <td colspan='3'>
  <font size='1.5px' color='#00a7e2'>Connect with us</font>
  </td>
  </tr>
  <tr >
    
   <td style='padding-bottom:5px;'><a href='https://twitter.com/DataBagg' target='_blank'><img src='https://www.databagg.com/mail_images/twitter.png' width='16' height='16' alt='#' /></a></td>
     <td style='padding-bottom:5px;' ><a href='https://www.facebook.com/Databagg' target='_blank'><img src='https://www.databagg.com/mail_images/facebook.png' width='16' height='16' alt='#' /></a></td>
     <td style='padding-bottom:5px;'><a href='http://in.linkedin.com/pub/databagg/62/9b4/570' target='_blank'><img src='https://www.databagg.com/mail_images/linedin.png' width='16' height='16' alt='#' /></a></td>
  
  </tr>
  
</table>
  </td>
    </tr>
  
 
  
</table>
</td>
  </tr>
 
  <tr >
  <td >

    <table>
    
    <tr>
    <td  >
    <img src='https://www.databagg.com/mail_images/calling.jpg' />
    </td>
    
    </tr>
    </table>
  
  </td>
  
  
  
  </tr>
  
  
  
</table>

    
    </td>
  </tr>
</table>

</body>";
   
     $content.="<br>";
     
     
    $content.="<br> <br>";
    
    
    
    //	$mail = new PHPMailer();
//		$mail->IsSMTP();  // telling the class to use SMTP
//    $mail->SMTPAuth   = false; 
//	$mail->Host     = "192.168.100.7"; 
	$mail->SetFrom("support@databagg.com","DataBaGG");
	$mail->Subject  = "$fnm $lnm shared a file with you!";
	$mail->MsgHTML($content);

        $mail->AddAddress($mail_id);

	$mail->Send();
	$mail->ClearAllRecipients();
}





function mail_share_category($mail_id,$cd,$fnm,$lnm,$mid)
{
    global $mail;
     $headers = 'From: DATABAGG <team@databagg.com>' . "\r\n";
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $dest="http://www.databagg.com/user/category/share/?code=$cd";
    
   $content="<br>";
	 $content.="<body style=\"background:#fafafa; margin:0; padding:0; font-family:Georgia, 'Times New Roman', Times, serif;text-align: justify;\">
<table width='100%' border='0' cellspacing='0' cellpadding='0' >

  <tr>
    <td>
    <table width='60%' border='0' cellspacing='0' cellpadding='0' align='center' style='background-color:#FFF; border:1px solid #eaeaea;   '>
    <tr>
<td style='background:url(https://www.databagg.com/mail_images/topborder.jpg) repeat-x; height:5px;'></td>
</tr>
  <tr>
    <td><table width='800' border='0' cellspacing='0' cellpadding='0'>
  <tr>

    
    <td width='100%' align='center' style=' padding:5px 0 5px 0; border-bottom:1px solid #e5e5e5;'><img src='https://www.databagg.com/mail_images/cartoon.jpg'  alt='#' /></td>
  </tr>
  
  <tr>
  <td style=\"font-size:13px; border-bottom:1px solid #e5e5e5; font-family:Georgia, 'Times New Roman', Times, serif; color:#333; line-height:22px; padding:15px;\">
  <p style='font-size:16px;   color:black;'>Hi <font style='font-size:16px;   color:#0092c6;font-weight: bold;'>$mail_id,</font> </p> 
    
   $fnm $lnm has sent music playlist to you.  <br /> <br />
<a href='$dest' target='_blank' style='font-size:14px;   color:#ea4d0f;font-weight: bold;'>Listen Playlist</a>
<br /> <br />
Listen shared playlist by clicking on 'Listen Playlist' or create your own free DataBagg account <br />

If you think you are receiving this email in error, please inform us at <a  style='color:#ea4d0f;text-decoration:none' href='mailto:support@databagg.com'>support@databagg.com</a>. 


    
    

  </td>
  
  </tr>
  
    <tr>
  <td style=\"font-size:13px; border-bottom:1px solid #e5e5e5; font-family:Georgia, 'Times New Roman', Times, serif; color:#333; line-height:22px; padding:15px;\">
   

Enjoy!<br />
Team Databagg 



  </td>
  
  </tr>
  
    <tr>
    <td >
   <table align='right' width='100'  border='0' cellspacing='0' cellpadding='0' >
  <tr>
  <td colspan='3'>
  <font size='1.5px' color='#00a7e2'>Connect with us</font>
  </td>
  </tr>
  <tr >
    
   <td style='padding-bottom:5px;'><a href='https://twitter.com/DataBagg' target='_blank'><img src='https://www.databagg.com/mail_images/twitter.png' width='16' height='16' alt='#' /></a></td>
     <td style='padding-bottom:5px;' ><a href='https://www.facebook.com/Databagg' target='_blank'><img src='https://www.databagg.com/mail_images/facebook.png' width='16' height='16' alt='#' /></a></td>
     <td style='padding-bottom:5px;'><a href='http://in.linkedin.com/pub/databagg/62/9b4/570' target='_blank'><img src='https://www.databagg.com/mail_images/linedin.png' width='16' height='16' alt='#' /></a></td>
  
  </tr>
  
</table>
  </td>
    </tr>
  
 
  
</table>
</td>
  </tr>
 
  <tr >
  <td >

    <table>
    
    <tr>
    <td  >
    <img src='https://www.databagg.com/mail_images/calling.jpg' />
    </td>
    
    </tr>
    </table>
  
  </td>
  
  
  
  </tr>
  
  
  
</table>

    
    </td>
  </tr>
</table>

</body>";
   
     $content.="<br>";
     
     
    $content.="<br> <br>";
    
    
    
//    	$mail = new PHPMailer();
//		$mail->IsSMTP();   //telling the class to use SMTP
//    $mail->SMTPAuth   = false; 
//	$mail->Host     = "192.168.100.7";  //SMTP server
	$mail->SetFrom("support@databagg.com","DataBaGG");
	$mail->Subject  = "$fnm $lnm shared a music file with you!";
	$mail->MsgHTML($content);

        $mail->AddAddress($mail_id);

	$mail->Send();
	$mail->ClearAllRecipients();
}



function mail_share_category_photo($mail_id,$cd,$fnm,$lnm,$mid)
{
    global $mail;
     $headers = 'From: DATABAGG <team@databagg.com>' . "\r\n";
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $dest="http://www.databagg.com/user/category/ishare/?code=$cd";
    
   $content="<br>";
	 $content.="<body style=\"background:#fafafa; margin:0; padding:0; font-family:Georgia, 'Times New Roman', Times, serif;text-align: justify;\">
<table width='100%' border='0' cellspacing='0' cellpadding='0' >

  <tr>
    <td>
    <table width='60%' border='0' cellspacing='0' cellpadding='0' align='center' style='background-color:#FFF; border:1px solid #eaeaea;   '>
    <tr>
<td style='background:url(https://www.databagg.com/mail_images/topborder.jpg) repeat-x; height:5px;'></td>
</tr>
  <tr>
    <td><table width='800' border='0' cellspacing='0' cellpadding='0'>
  <tr>

    
    <td width='100%' align='center' style=' padding:5px 0 5px 0; border-bottom:1px solid #e5e5e5;'><img src='https://www.databagg.com/mail_images/cartoon.jpg'  alt='#' /></td>
  </tr>
  
  <tr>
  <td style=\"font-size:13px; border-bottom:1px solid #e5e5e5; font-family:Georgia, 'Times New Roman', Times, serif; color:#333; line-height:22px; padding:15px;\">
  <p style='font-size:16px;   color:black;'>Hi <font style='font-size:16px;   color:#0092c6;font-weight: bold;'>$mail_id,</font> </p> 
    
   $fnm $lnm has sent image gallery to you.  <br /> <br />
<a href='$dest' target='_blank' style='font-size:14px;   color:#ea4d0f;font-weight: bold;'>View Gallery</a>
<br /> <br />
View shared gallery by clicking on 'View Gallery' or create your own free DataBagg account <br />

If you think you are receiving this email in error, please inform us at <a  style='color:#ea4d0f;text-decoration:none' href='mailto:support@databagg.com'>support@databagg.com</a>. 


    
    

  </td>
  
  </tr>
  
    <tr>
  <td style=\"font-size:13px; border-bottom:1px solid #e5e5e5; font-family:Georgia, 'Times New Roman', Times, serif; color:#333; line-height:22px; padding:15px;\">
   

Enjoy!<br />
Team Databagg 



  </td>
  
  </tr>
  
    <tr>
    <td >
   <table align='right' width='100'  border='0' cellspacing='0' cellpadding='0' >
  <tr>
  <td colspan='3'>
  <font size='1.5px' color='#00a7e2'>Connect with us</font>
  </td>
  </tr>
  <tr >
    
   <td style='padding-bottom:5px;'><a href='https://twitter.com/DataBagg' target='_blank'><img src='https://www.databagg.com/mail_images/twitter.png' width='16' height='16' alt='#' /></a></td>
     <td style='padding-bottom:5px;' ><a href='https://www.facebook.com/Databagg' target='_blank'><img src='https://www.databagg.com/mail_images/facebook.png' width='16' height='16' alt='#' /></a></td>
     <td style='padding-bottom:5px;'><a href='http://in.linkedin.com/pub/databagg/62/9b4/570' target='_blank'><img src='https://www.databagg.com/mail_images/linedin.png' width='16' height='16' alt='#' /></a></td>
  
  </tr>
  
</table>
  </td>
    </tr>
  
 
  
</table>
</td>
  </tr>
 
  <tr >
  <td >

    <table>
    
    <tr>
    <td  >
    <img src='https://www.databagg.com/mail_images/calling.jpg' />
    </td>
    
    </tr>
    </table>
  
  </td>
  
  
  
  </tr>
  
  
  
</table>

    
    </td>
  </tr>
</table>

</body>";
   
     $content.="<br>";
     
     
    $content.="<br> <br>";
    
    
    //
//    	$mail = new PHPMailer();
//		$mail->IsSMTP();  // telling the class to use SMTP
//    $mail->SMTPAuth   = false; 
//	$mail->Host     = "192.168.100.7"; 
	$mail->SetFrom("support@databagg.com","DataBaGG");
	$mail->Subject  = "$fnm $lnm shared an image with you!";
	$mail->MsgHTML($content);

        $mail->AddAddress($mail_id);

	$mail->Send();
	$mail->ClearAllRecipients();
}





function mail_share_category_video($mail_id,$cd,$fnm,$lnm,$mid)
{
    global $mail;
     $headers = 'From: DATABAGG <team@databagg.com>' . "\r\n";
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $dest="http://www.databagg.com/user/category/vshare/?code=$cd";
    
   $content="<br>";
	 $content.="<body style=\"background:#fafafa; margin:0; padding:0; font-family:Georgia, 'Times New Roman', Times, serif;text-align: justify;\">
<table width='100%' border='0' cellspacing='0' cellpadding='0' >

  <tr>
    <td>
    <table width='60%' border='0' cellspacing='0' cellpadding='0' align='center' style='background-color:#FFF; border:1px solid #eaeaea;   '>
    <tr>
<td style='background:url(https://www.databagg.com/mail_images/topborder.jpg) repeat-x; height:5px;'></td>
</tr>
  <tr>
    <td><table width='800' border='0' cellspacing='0' cellpadding='0'>
  <tr>

    
    <td width='100%' align='center' style=' padding:5px 0 5px 0; border-bottom:1px solid #e5e5e5;'><img src='https://www.databagg.com/mail_images/cartoon.jpg'  alt='#' /></td>
  </tr>
  
  <tr>
  <td style=\"font-size:13px; border-bottom:1px solid #e5e5e5; font-family:Georgia, 'Times New Roman', Times, serif; color:#333; line-height:22px; padding:15px;\">
  <p style='font-size:16px;   color:black;'>Hi <font style='font-size:16px;   color:#0092c6;font-weight: bold;'>$mail_id,</font> </p> 
    
   $fnm $lnm has sent video gallery to you.  <br /> <br />
<a href='$dest' target='_blank' style='font-size:14px;   color:#ea4d0f;font-weight: bold;'>View Gallery</a>
<br /> <br />
View shared gallery by clicking on 'View Gallery' or create your own free DataBagg account <br />

If you think you are receiving this email in error, please inform us at <a  style='color:#ea4d0f;text-decoration:none' href='mailto:support@databagg.com'>support@databagg.com</a>. 


    
    

  </td>
  
  </tr>
  
    <tr>
  <td style=\"font-size:13px; border-bottom:1px solid #e5e5e5; font-family:Georgia, 'Times New Roman', Times, serif; color:#333; line-height:22px; padding:15px;\">
   

Enjoy!<br />
Team Databagg 



  </td>
  
  </tr>
  
    <tr>
    <td >
   <table align='right' width='100'  border='0' cellspacing='0' cellpadding='0' >
  <tr>
  <td colspan='3'>
  <font size='1.5px' color='#00a7e2'>Connect with us</font>
  </td>
  </tr>
  <tr >
    
   <td style='padding-bottom:5px;'><a href='https://twitter.com/DataBagg' target='_blank'><img src='https://www.databagg.com/mail_images/twitter.png' width='16' height='16' alt='#' /></a></td>
     <td style='padding-bottom:5px;' ><a href='https://www.facebook.com/Databagg' target='_blank'><img src='https://www.databagg.com/mail_images/facebook.png' width='16' height='16' alt='#' /></a></td>
     <td style='padding-bottom:5px;'><a href='http://in.linkedin.com/pub/databagg/62/9b4/570' target='_blank'><img src='https://www.databagg.com/mail_images/linedin.png' width='16' height='16' alt='#' /></a></td>
  
  </tr>
  
</table>
  </td>
    </tr>
  
 
  
</table>
</td>
  </tr>
 
  <tr >
  <td >

    <table>
    
    <tr>
    <td  >
    <img src='https://www.databagg.com/mail_images/calling.jpg' />
    </td>
    
    </tr>
    </table>
  
  </td>
  
  
  
  </tr>
  
  
  
</table>

    
    </td>
  </tr>
</table>

</body>";
   
     $content.="<br>";
     
     
    $content.="<br> <br>";
    
    
    //
//    	$mail = new PHPMailer();
//		$mail->IsSMTP();  // telling the class to use SMTP
//    $mail->SMTPAuth   = false; 
//	$mail->Host     = "192.168.100.7"; 
	$mail->SetFrom("support@databagg.com","DataBaGG");
	$mail->Subject  = " $fnm $lnm shared a video with you!";
	$mail->MsgHTML($content);

        $mail->AddAddress($mail_id);

	$mail->Send();
	$mail->ClearAllRecipients();
}

function mail_first_sync($mail_id,$name,$pc)
{
    global $mail;
    $header  = "MIME-Version: 1.0\r\n";
 $header .= "Content-type: text/html; charset: utf8\r\n";
    $subject="Congratulations! Your Backup Is Complete..";
    $header.="from:Team Databagg <team@databagg.com>";
    $content="<br>";
    $content.="<body style=\"background:#fafafa; margin:0; padding:0; font-family:Georgia, 'Times New Roman', Times, serif;text-align: justify;\">
<table width='100%' border='0' cellspacing='0' cellpadding='0' >

  <tr>
    <td>
    <table width='60%' border='0' cellspacing='0' cellpadding='0' align='center' style='background-color:#FFF; border:1px solid #eaeaea;   '>
    <tr>
<td style='background:url(https://www.databagg.com/mail_images/topborder.jpg) repeat-x; height:5px;'></td>
</tr>
  <tr>
    <td><table width='800' border='0' cellspacing='0' cellpadding='0'>
  <tr>

    
    <td width='100%' align='center' style=' padding:5px 0 5px 0; border-bottom:1px solid #e5e5e5;'><img src='https://www.databagg.com/mail_images/cartoon.jpg'  alt='#' /></td>
  </tr>
  
  <tr>
  <td style=\"font-size:13px; border-bottom:1px solid #e5e5e5; font-family:Georgia, 'Times New Roman', Times, serif; color:#333; line-height:22px; padding:15px;\">
  <p style='font-size:16px;   color:black;'>Hi <font style='font-size:16px;   color:#0092c6;font-weight: bold;'>$name,</font> </p> 
  DataBagg has just completed your first data backup.<br />
To view all the files which have been backed-up on <font style='font-size:14px;   color:#0092c6;font-weight: bold;'> $name-$pc, </font> please click this link: 

<a  style='color:#ea4d0f;text-decoration:none' href='https://www.databagg.com/login.php' target='_blank'>Click here</a> 

 <br />
$name note here that we can only take the back-up of the folder which has been synchronized on DataBagg. If you wish to take back-up of more data, then synchronize more folders on our platform. 
<br/>You can access your account by clicking here: <a  style='color:#ea4d0f;text-decoration:none' href='https://www.databagg.com/login.php' target='_blank'> Login to databagg </a>  <br />
If you have any questions related with DataBagg, please don&#8217;t hesitate to reply directly over here. 
<br />
Thank you for choosing DataBagg.
  </td>
  
  </tr>
  
    <tr>
  <td style=\"font-size:13px; border-bottom:1px solid #e5e5e5; font-family:Georgia, 'Times New Roman', Times, serif; color:#333; line-height:22px; padding:15px;\">
   <font style='font-size:16px;   color:#0092c6;'> Regards,</font> <br />

Ravish<br />
Senior Manager - DataBagg <br />



  </td>
  
  </tr>
  
    <tr>
    <td >
   <table align='right' width='100'  border='0' cellspacing='0' cellpadding='0' >
  <tr>
  <td colspan='3'>
  <font size='1.5px' color='#00a7e2'>Connect with us</font>
  </td>
  </tr>
  <tr >
    
   <td style='padding-bottom:5px;'><a href='https://twitter.com/DataBagg' target='_blank'><img src='https://www.databagg.com/mail_images/twitter.png' width='16' height='16' alt='#' /></a></td>
     <td style='padding-bottom:5px;' ><a href='https://www.facebook.com/Databagg' target='_blank'><img src='https://www.databagg.com/mail_images/facebook.png' width='16' height='16' alt='#' /></a></td>
     <td style='padding-bottom:5px;'><a href='http://in.linkedin.com/pub/databagg/62/9b4/570' target='_blank'><img src='https://www.databagg.com/mail_images/linedin.png' width='16' height='16' alt='#' /></a></td>
  
  </tr>
  
</table>
  </td>
    </tr>
  
 
  
</table>
</td>
  </tr>
 
  <tr >
  <td >

    <table>
    
    <tr>
    <td  >
    <img src='https://www.databagg.com/mail_images/calling.jpg' />
    </td>
    
    </tr>
    </table>
  
  </td>
  
  
  
  </tr>
  
  
  
</table>

    
    </td>
  </tr>
</table>

</body>";
$content.="<br> <br>";



	$mail->SetFrom("support@databagg.com","DataBaGG");
	$mail->Subject  = "Congratulations! Your backup is complete..";
	$mail->MsgHTML($content);

        $mail->AddAddress($mail_id);

	$mail->Send();
	$mail->ClearAllRecipients();
}

function mail_verify($em_enc,$nm)
{
    global $mail;
         $ml=$em_enc;
        $em_enc=base64_encode($em_enc);
        $dest="https://www.databagg.com/verify.php?code=".$em_enc;
    $headers = 'From: DATABAGG <team@databagg.com>' . "\r\n";
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$content="<br>";
	 $content.="<body style=\"background:#fafafa; margin:0; padding:0; font-family:Georgia, 'Times New Roman', Times, serif;text-align: justify;\">
<table width='100%' border='0' cellspacing='0' cellpadding='0' >

  <tr>
    <td>
    <table width='60%' border='0' cellspacing='0' cellpadding='0' align='center' style='background-color:#FFF; border:1px solid #eaeaea;   '>
    <tr>
<td style='background:url(https://www.databagg.com/mail_images/topborder.jpg) repeat-x; height:5px;'></td>
</tr>
  <tr>
    <td><table width='800' border='0' cellspacing='0' cellpadding='0'>
  <tr>

    
    <td width='100%' align='center' style=' padding:5px 0 5px 0; border-bottom:1px solid #e5e5e5;'><img src='https://www.databagg.com/mail_images/cartoon.jpg'  alt='#' /></td>
  </tr>
  
  <tr>
  <td style=\"font-size:13px; border-bottom:1px solid #e5e5e5; font-family:Georgia, 'Times New Roman', Times, serif; color:#333; line-height:22px; padding:15px;\">
  <p style='font-size:16px;   color:black;'>Hi <font style='font-size:16px;   color:#0092c6;font-weight: bold;'>$nm,</font> </p> 
    
   Thank you for signing up with DataBagg <br />
Just one more step before we deliver your personalized and secured cloud storage: <br /><br />
Verify your e-mail address by clicking on 'Confirm Email'.
<a href='$dest' target='_blank' style='color: #0092c6;'>Confirm Email</a> <br /> <br />

 If you have any questions, contact us at <a  style='color:#ea4d0f;text-decoration:none' href='mailto:support@databagg.com'>support@databagg.com</a>



    
    

  </td>
  
  </tr>
  
    <tr>
  <td style=\"font-size:13px; border-bottom:1px solid #e5e5e5; font-family:Georgia, 'Times New Roman', Times, serif; color:#333; line-height:22px; padding:15px;\">
   

Welcome to Databagg!<br />
Team Databagg 



  </td>
  
  </tr>
  
    <tr>
    <td >
   <table align='right' width='100'  border='0' cellspacing='0' cellpadding='0' >
  <tr>
  <td colspan='3'>
  <font size='1.5px' color='#00a7e2'>Connect with us</font>
  </td>
  </tr>
  <tr >
    
    <td style='padding-bottom:5px;'><a href='https://twitter.com/DataBagg' target='_blank'><img src='https://www.databagg.com/mail_images/twitter.png' width='16' height='16' alt='#' /></a></td>
     <td style='padding-bottom:5px;' ><a href='https://www.facebook.com/Databagg' target='_blank'><img src='https://www.databagg.com/mail_images/facebook.png' width='16' height='16' alt='#' /></a></td>
     <td style='padding-bottom:5px;'><a href='http://in.linkedin.com/pub/databagg/62/9b4/570' target='_blank'><img src='https://www.databagg.com/mail_images/linedin.png' width='16' height='16' alt='#' /></a></td>
  
  </tr>
  
</table>
  </td>
    </tr>
  
 
  
</table>
</td>
  </tr>
 
  <tr >
  <td >

    <table>
    
    <tr>
    <td  >
    <img src='https://www.databagg.com/mail_images/calling.jpg' />
    </td>
    
    </tr>
    </table>
  
  </td>
  
  
  
  </tr>
  
  
  
</table>

    
    </td>
  </tr>
</table>

</body>";
   
     $content.="<br>";
     
     
    $content.="<br> <br>";
    
    
	//echo $msg;
    
//	$mail = new PHPMailer();
////	 echo "Mailer Error: " . $mail->ErrorInfo;
//   
//   	$mail->IsSMTP();  // telling the class to use SMTP
//   $mail->SMTPAuth   = false; 
//	$mail->Host     = "192.168.100.7"; 
	$mail->SetFrom("support@databagg.com","DataBaGG");
	$mail->Subject  = "You're almost done! We just need to verify your account";
	$mail->MsgHTML($content);

        $mail->AddAddress($ml);

	$mail->Send();
	$mail->ClearAllRecipients();

}

function mail_welcome($em_enc,$nm)
{
    global $mail;
   $headers = 'From: DATABAGG <team@databagg.com>' . "\r\n";
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $content="<br>";
    $content.="<body style=\"background:#fafafa; margin:0; padding:0; font-family:Georgia, 'Times New Roman', Times, serif;text-align: justify;\">
<table width='100%' border='0' cellspacing='0' cellpadding='0' >

  <tr>
    <td>
    <table width='60%' border='0' cellspacing='0' cellpadding='0' align='center' style='background-color:#FFF; border:1px solid #eaeaea;   '>
    <tr>
<td style='background:url(https://www.databagg.com/mail_images/topborder.jpg) repeat-x; height:5px;'></td>
</tr>
  <tr>
    <td><table width='800' border='0' cellspacing='0' cellpadding='0'>
 <tr>

    
  <td>
  <table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
      <td width='100%' align='center' style=' padding:5px 0 5px 0; border-bottom:1px solid #e5e5e5;'><img src='https://www.databagg.com/mail_images/cartoon.jpg'  alt='#' /></td>
 
 <td style='padding:10px 0 10px 0;'><img src='https://www.databagg.com/mail_images/welcome.jpg' width='44' height='177' alt='#' /></td>
  </tr>
</table>

  
  </td>
   
  </tr>
  
  <tr>
  <td style=\"font-size:13px; border-bottom:1px solid #e5e5e5; font-family:Georgia, 'Times New Roman', Times, serif; color:#333; line-height:22px; padding:15px;\">
  <p style='font-size:16px;   color:black;'>Welcome <font style='font-size:16px;   color:#0092c6;font-weight: bold;'>$nm,</font> </p> 
Congratulations on making a smart decision! <br /> <br />
DataBagg is your one stop solution to back-up your digital data and access it anywhere and everywhere. <br /><br />
Once DataBagg is installed on your PC and a shared folder is created, it will automatically create backups of your data and save it forever. <br /><br />
To view, open, download, or share your files just login to your online control panel. <br />

Control Panel: <a href='https://www.databagg.com/login.php' target='_blank' style='font-size:14px;   color:#ea4d0f;font-weight: bold;'>Click here</a>
<br /><br />
Login Details:
Email: <font style='font-size:14px;   color:#0092c6;font-weight: bold;'>$em_enc</font> <br />
Password: <font style='font-size:14px;   color:#0092c6;font-weight: bold;'>chosen by you</font>
<br /><br />
If you have not downloaded the DataBagg apps for your PC, then please use this link: <a href='https://www.databagg.com/user/download.php?path=databagg.zip' style='font-size:12px;   color:#ea4d0f;font-weight: bold;'>Download databagg</a> <br />

Remember to download the free DataBagg mobile apps as well!  <br />

If you experience any problems please contact <a  style='color:#ea4d0f;text-decoration:none' href='mailto:support@databagg.com'>support@databagg.com</a> and our friendly support team will assist you.

<br /><br />
Thank you for choosing DataBagg.
  </td>
  
  </tr>
  
    <tr>
  <td style=\"font-size:13px; border-bottom:1px solid #e5e5e5; font-family:Georgia, 'Times New Roman', Times, serif; color:#333; line-height:22px; padding:15px;\">
   <font style='font-size:16px;   color:#0092c6;'> Best wishes,</font> <br />

Ravish<br />
Senior manager - Databagg 



  </td>
  
  </tr>
  
    <tr>
    <td >
   <table align='right' width='100'  border='0' cellspacing='0' cellpadding='0' >
  <tr>
  <td colspan='3'>
  <font size='1.5px' color='#00a7e2'>Connect with us</font>
  </td>
  </tr>
  <tr >
    


    <td style='padding-bottom:5px;'><a href='https://twitter.com/DataBagg' target='_blank'><img src='https://www.databagg.com/mail_images/twitter.png' width='16' height='16' alt='#' /></a></td>
     <td style='padding-bottom:5px;' ><a href='https://www.facebook.com/Databagg' target='_blank'><img src='https://www.databagg.com/mail_images/facebook.png' width='16' height='16' alt='#' /></a></td>
     <td style='padding-bottom:5px;'><a href='http://in.linkedin.com/pub/databagg/62/9b4/570' target='_blank'><img src='https://www.databagg.com/mail_images/linedin.png' width='16' height='16' alt='#' /></a></td>
  </tr>
  
</table>
  </td>
    </tr>
  
 
  
</table>
</td>
  </tr>
 
  <tr >
  <td >

    <table>
    
    <tr>
    <td  >
    <img src='https://www.databagg.com/mail_images/calling.jpg' />
    </td>
    
    </tr>
    </table>
  
  </td>
  
  
  
  </tr>
  
  
  
</table>

    
    </td>
  </tr>
</table>

</body>";
$content.="<br> <br>";
   
  

	$mail->SetFrom("support@databagg.com","DataBaGG");
	$mail->Subject  = "Welcome to DataBagg – We’re Glad You’re Here";
	$mail->MsgHTML($content);

        $mail->AddAddress($em_enc);

	$mail->Send();
	$mail->ClearAllRecipients();
    
       //$mail_id="jnu.saurav@gmail.com";
       // mail($em_enc, $subject, $content, $header);

}

function mail_download_databagg($em_enc,$nm)
{
    global $mail;
   $headers = 'From: DATABAGG <team@databagg.com>' . "\r\n";
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $content="<br>";
    $content.="<body style=\"background:#fafafa; margin:0; padding:0; font-family:Georgia, 'Times New Roman', Times, serif;text-align: justify;\">
<table width='100%' border='0' cellspacing='0' cellpadding='0' >

  <tr>
    <td>
    <table width='60%' border='0' cellspacing='0' cellpadding='0' align='center' style='background-color:#FFF; border:1px solid #eaeaea;   '>
    <tr>
<td style='background:url(https://www.databagg.com/mail_images/topborder.jpg) repeat-x; height:5px;'></td>
</tr>
  <tr>
    <td><table width='800' border='0' cellspacing='0' cellpadding='0'>
  <tr>

    
    <td width='100%' align='center' style=' padding:5px 0 5px 0; border-bottom:1px solid #e5e5e5;'><img src='https://www.databagg.com/mail_images/cartoon.jpg'  alt='#' /></td>
  </tr>
  
  <tr>
  <td style=\"font-size:13px; border-bottom:1px solid #e5e5e5; font-family:Georgia, 'Times New Roman', Times, serif; color:#333; line-height:22px; padding:15px;\">
  <p style='font-size:16px;   color:black;'>Hi <font style='font-size:16px;   color:#0092c6;font-weight: bold;'>$nm,</font> </p> 
Congratulations on making a smart decision! <br /> <br />
DataBagg is your one stop solution to back-up your digital data and access it anywhere and everywhere. <br /><br />
Once DataBagg is installed on your PC and a shared folder is created, it will automatically create backups of your data and save it forever. <br /><br />
To view, open, download, or share your files just login to your online control panel. <br />

Control Panel: <a href='https://www.databagg.com/login.php' target='_blank' style='font-size:14px;   color:#ea4d0f;font-weight: bold;'>Click here</a>
<br /><br />
Login Details:
Email: <font style='font-size:14px;   color:#0092c6;font-weight: bold;'>$em_enc</font> <br />
Password: <font style='font-size:14px;   color:#0092c6;font-weight: bold;'>chosen by you</font>
<br /><br />
If you have not downloaded the DataBagg apps for your PC, then please use this link: <a href='https://www.databagg.com/user/download.php?path=databagg.zip' style='font-size:12px;   color:#ea4d0f;font-weight: bold;'>Download databagg</a> <br />

Remember to download the free DataBagg mobile apps as well!  <br />

If you experience any problems please contact <a  style='color:#ea4d0f;text-decoration:none' href='mailto:support@databagg.com'>support@databagg.com</a> and our friendly support team will assist you.

<br /><br />
Thank you for choosing DataBagg.
  </td>
  
  </tr>
  
    <tr>
  <td style=\"font-size:13px; border-bottom:1px solid #e5e5e5; font-family:Georgia, 'Times New Roman', Times, serif; color:#333; line-height:22px; padding:15px;\">
   <font style='font-size:16px;   color:#0092c6;'> Best wishes,</font> <br />

Ravish<br />
Senior manager - Databagg 



  </td>
  
  </tr>
  
    <tr>
    <td >
   <table align='right' width='100'  border='0' cellspacing='0' cellpadding='0' >
  <tr>
  <td colspan='3'>
  <font size='1.5px' color='#00a7e2'>Connect with us</font>
  </td>
  </tr>
  <tr >
    
    <td style='padding-bottom:5px;'><a href='https://twitter.com/DataBagg' target='_blank'><img src='https://www.databagg.com/mail_images/twitter.png' width='16' height='16' alt='#' /></a></td>
     <td style='padding-bottom:5px;' ><a href='https://www.facebook.com/Databagg' target='_blank'><img src='https://www.databagg.com/mail_images/facebook.png' width='16' height='16' alt='#' /></a></td>
     <td style='padding-bottom:5px;'><a href='http://in.linkedin.com/pub/databagg/62/9b4/570' target='_blank'><img src='https://www.databagg.com/mail_images/linedin.png' width='16' height='16' alt='#' /></a></td>
  
  </tr>
  
</table>
  </td>
    </tr>
  
 
  
</table>
</td>
  </tr>
 
  <tr >
  <td >

    <table>
    
    <tr>
    <td  >
    <img src='https://www.databagg.com/mail_images/calling.jpg' />
    </td>
    
    </tr>
    </table>
  
  </td>
  
  
  
  </tr>
  
  
  
</table>

    
    </td>
  </tr>
</table>

</body>";
$content.="<br> <br>";
   
  

	$mail->SetFrom("support@databagg.com","DataBaGG");
	$mail->Subject  = "Thank you for downloading DataBagg";
    //$mail->AddAttachment('DataBagg-Quick-Start.pdf','DataBagg-Quick-Start.pdf');
	$mail->MsgHTML($content);
    
        $mail->AddAddress($em_enc);

	$mail->Send();
	$mail->ClearAllRecipients();
    
       //$mail_id="jnu.saurav@gmail.com";
       // mail($em_enc, $subject, $content, $header);

}

function mail_done_hard_work($mail_id,$name,$mname)
{
    global $mail;
    $header  = "MIME-Version: 1.0\r\n";
 $header .= "Content-type: text/html; charset: utf8\r\n";
    $subject="Congratulations! Your Backup Is Complete..";
    $header.="from:Team Databagg <team@databagg.com>";
    $content="<br>";
 $content.="<body style=\"background:#fafafa; margin:0; padding:0; font-family:Georgia, 'Times New Roman', Times, serif;text-align: justify;\">
<table width='100%' border='0' cellspacing='0' cellpadding='0' >

  <tr>
    <td>
    <table width='60%' border='0' cellspacing='0' cellpadding='0' align='center' style='background-color:#FFF; border:1px solid #eaeaea;   '>
    <tr>
<td style='background:url(https://www.databagg.com/mail_images/topborder.jpg) repeat-x; height:5px;'></td>
</tr>
  <tr>
    <td><table width='800' border='0' cellspacing='0' cellpadding='0'>
  <tr>

    
    <td width='100%' align='center' style=' padding:5px 0 5px 0; border-bottom:1px solid #e5e5e5;'><img src='https://www.databagg.com/mail_images/cartoon.jpg'  alt='#' /></td>
  </tr>
  
  <tr>
  <td style=\"font-size:13px; border-bottom:1px solid #e5e5e5; font-family:Georgia, 'Times New Roman', Times, serif; color:#333; line-height:22px; padding:15px;\">
  <p style='font-size:16px;   color:black;'>Hi <font style='font-size:16px;   color:#0092c6;font-weight: bold;'>$name,</font> </p> 
 Hope you are going well. I was reading about Data Protection and I came to know few interesting observation that:- <br /> <br />
-A hard drive crashes every 15 seconds <br />
-32% of data loss is caused by human error <br />
-31% of PC users have lost all of their PC files to events beyond their control. <br />
-25% of lost data is due to the failure of a portable drive. <br />
-44% of data loss caused by mechanical failures <br />
-15% or more of laptops are stolen or suffer hard drive failures <br />
-1 in 5 computers suffer a fatal hard drive crash during their lifetime. <br /><br />

This is true, but i never thought of it like that before. That's why it's so vitally important in this digital age to be keeping a backup, because if you're hard drive does crash the chances of salvaging any data is low, and I know this as it happened to me remember.<br />

You have done the hard work already by installing the application, now just upgrade DataBagg and let DataBagg do the hard work, so you can rest assured knowing you never have to worry about the above reasons. <br />

Please email me with any questions you have and I will be happy to advise you on the best plan for you.

  </td>
  
  </tr>
  
    <tr>
  <td style=\"font-size:13px; border-bottom:1px solid #e5e5e5; font-family:Georgia, 'Times New Roman', Times, serif; color:#333; line-height:22px; padding:15px;\">
   <font style='font-size:16px;   color:#0092c6;'> Best wishes,</font> <br />

$mname<br />
Personal Account Manager<br /> DataBagg 



  </td>
  
  </tr>
  
    <tr>
    <td >
   <table align='right' width='100'  border='0' cellspacing='0' cellpadding='0' >
  <tr>
  <td colspan='3'>
  <font size='1.5px' color='#00a7e2'>Connect with us</font>
  </td>
  </tr>
  <tr >
     <td style='padding-bottom:5px;'><a href='https://twitter.com/DataBagg' target='_blank'><img src='https://www.databagg.com/mail_images/twitter.png' width='16' height='16' alt='#' /></a></td>
     <td style='padding-bottom:5px;' ><a href='https://www.facebook.com/Databagg' target='_blank'><img src='https://www.databagg.com/mail_images/facebook.png' width='16' height='16' alt='#' /></a></td>
     <td style='padding-bottom:5px;'><a href='http://in.linkedin.com/pub/databagg/62/9b4/570' target='_blank'><img src='https://www.databagg.com/mail_images/linedin.png' width='16' height='16' alt='#' /></a></td>
  
  </tr>
  
</table>
  </td>
    </tr>
  
 
  
</table>
</td>
  </tr>
 
  <tr >
  <td >

    <table>
    
    <tr>
    <td  >
    <img src='https://www.databagg.com/mail_images/calling.jpg' />
    </td>
    
    </tr>
    </table>
  
  </td>
  
  
  
  </tr>
  
  
  
</table>

    
    </td>
  </tr>
</table>

</body>";


	$mail->SetFrom("support@databagg.com","DataBaGG");
	$mail->Subject  = "You've done the hard work";
	$mail->MsgHTML($content);

        $mail->AddAddress($mail_id);

	$mail->Send();
	$mail->ClearAllRecipients();
}





//mail_welcome("Jaipurtest5@yahoo.com","saurav");
//mail_verify("Jaipurtest5@yahoo.com","saurav");
//mail_forgot("Jaipurtest5@yahoo.com","saurav","Pass");
//mail_share("Jaipurtest5@yahoo.com","code","saurav","suman","saurav.suman@cyfuture.com");
//mail_share_category("Jaipurtest5@yahoo.com","code","saurav","suman","saurav.suman@cyfuture.com");
//mail_share_category_photo("Jaipurtest5@yahoo.com","code","saurav","suman","saurav.suman@cyfuture.com");
//mail_share_category_video("Jaipurtest5@yahoo.com","code","saurav","suman","saurav.suman@cyfuture.com");
//
//mail_download_databagg("Jaipurtest5@yahoo.com","saurav");
//mail_data_filled("Jaipurtest5@yahoo.com","saurav","80%","Chiipa jee");
//mail_data_filled_all("Jaipurtest5@yahoo.com","saurav","Chiipa jee");
//mail_done_hard_work("Jaipurtest5@yahoo.com","saurav","Chiipa jee");
//mail_complete_setup("Jaipurtest5@yahoo.com","saurav");
//mail_dedicated_manager("Jaipurtest5@yahoo.com","saurav","Manager");
//mail_first_sync("Jaipurtest5@yahoo.com","saurav","PC123");
?>