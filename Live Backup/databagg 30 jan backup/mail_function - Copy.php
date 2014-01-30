<?php
if(function_exists("date_default_timezone_set"))
	date_default_timezone_set("Asia/Calcutta");
error_reporting(E_ALL);
//ini_set("display_errors",1);
require_once("PHPMailer/class.phpmailer.php");
	
    
    
                    $mail = new PHPMailer();
                    $mail->IsSMTP();  // telling the class to use SMTP
                    $mail->SMTPAuth   = true; 
                    $mail->Host     = "121.242.207.100";  // SMTP server
                    $mail->Username="support@databagg.com";
                    $mail->Password="sd@#2WD#45";

    

include "mail_function1.php";  
include "mail_function2.php";  
    
function mail_welcome($em_enc,$nm)
{
    global $mail;
   $headers = 'From: DATABAGG <team@databagg.com>' . "\r\n";
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $content="<br>";
    $content.="<div style='background:url(databagg.com/cnfrm_mail/batabagbg.jpg) no-repeat;width:100%!important' marginheight='0' marginwidth='0'>
<center >
<table width='600' cellspacing='0' cellpadding='0' border='0' >
<tbody><tr>
<td valign='top' align='center'>
<img style='max-width:600px' src='http://www.databagg.com/cnfrm_mail/loginlogo.png'>
</td>
</tr>
<tr>
<td valign='top' align='center'>
</td></tr></tbody></table><table width='600' cellspacing='0' cellpadding='0' border='0' >
<tbody><tr>
<td valign='top' align='center' colspan='3'>
<div style='padding-bottom:1em'>
<br />
<h1 style='font-family:Helvetica,Arial;font-size:30px;font-weight:300;margin:0;padding:0 1em'><span class='il'>Welcome</span> <b>$nm</b>!</h1>
<h2 style='font-family:Helvetica,Arial;font-size:30px;font-weight:300;color:#6d7276;margin:0;margin-bottom:18px;padding:0 1em'>
Congratulations on making a smart decision!</h2>


<p style='font-family:Helvetica,Arial;font-size:16px;line-height:21px;margin:1em 0;padding:0 1em'>
DataBagg is your one stop solution to back-up your digital data and access it anywhere and everywhere.<br> <br>
Once DataBagg is installed on your PC and a shared folder is created, it will automatically create backups of your data and save it forever.

</p>

<p style='font-family:Helvetica,Arial;font-size:16px;line-height:21px;margin:1em 0;padding:0 1em;color:#E85005'>
To view, open, download, or share your files just login to your online control panel. <br>

Control Panel: <a target='_blank' style='color:#db3c6e;text-decoration:none' href='http://www.databagg.com/login.php'>Click Here</a>

</p>
<h3 style='font-family:Helvetica,Arial;font-size:15px;line-height:21px;margin:1em 0;padding:0 1em'>Login details:</h3>
<p style='font-family:Helvetica,Arial;font-size:16px;line-height:21px;margin:1em 0;padding:0 1em'>
Email: <a target='_blank' style='color:#db3c6e;text-decoration:none' href='mailto:$em_enc'>$em_enc</a><br>
Password: <font color='#db3c6e'> chosen by you </font>

</p>
<p style='font-family:Helvetica,Arial;font-size:16px;line-height:21px;margin:1em 0;padding:0 1em'>
If you have not downloaded the DataBagg apps for your PC, then please use this link: <a target='_blank' style='color:#db3c6e;text-decoration:none' href='http://www.databagg.com/user/download.php?path=databagg.zip'>Click Here</a>
<br><br>
Remember to download the free DataBagg mobile apps as well!
<br><br>
If you experience any problems please contact <a target='_blank' style='color:#db3c6e;text-decoration:none' href='mailto:support@databagg.com'>support@databagg.com</a> and our friendly support team will assist you.

</p>
<p style='font-family:Helvetica,Arial;font-size:16px;line-height:21px;margin:1em 0;padding:0 1em'>Thank you for choosing DataBagg. </p>
<p style='font-family:Helvetica,Arial;font-size:16px;line-height:21px;margin:1em 0;padding:0 1em'>
<b>Ravish 
</b><br>
  Senior Manager- DataBagg<br>
 <br />

<br />

</p>
</div>



</td>
</tr>
<tr>


<td valign='top' align='center'>
<img style='max-width:600px'  src='http://www.databagg.com/cnfrm_mail/calling.jpg'>
</td>

</tr>
</tbody></table>



<br>



</center><div class='yj6qo'></div><div class='adL'>
</div></div>";
$content.="<br> <br>";
   
  

	$mail->SetFrom("support@databagg.com","DataBaGG");
	$mail->Subject  = "Welcome to Databagg";
	$mail->MsgHTML($content);

        $mail->AddAddress($em_enc);

	$mail->Send();
	$mail->ClearAllRecipients();
    
       //$mail_id="jnu.saurav@gmail.com";
       // mail($em_enc, $subject, $content, $header);

}
//mail_welcome("jnu.saurav@gmail.com","saurav");

//end welcome mail

//Email verify function
function mail_verify($em_enc,$nm)
{
    global $mail;
         $ml=$em_enc;
        $em_enc=base64_encode($em_enc);
        $dest="www.databagg.com/verify.php?code=".$em_enc;
    $headers = 'From: DATABAGG <team@databagg.com>' . "\r\n";
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$content="<br>";
	 $content.="<body bgcolor='#ABE7FF' background=\"http://www.databagg.com/cnfrm_mail/cloud.jpg\">
<div lang='en' style='background:#ABE7FF url(databagg.com/cnfrm_mail/cloud.jpg) repeat;padding:0;margin:0'>
<table width='100%' cellspacing='0' cellpadding='0' border='0'  style='background: url(databagg.com/cnfrm_mail/cloud.jpg) #ABE7FF>
 <tbody><tr>
 <td style='padding:20px 20px 40px'>
 <table width='620' cellspacing='0' cellpadding='0' border='0' align='center'>
 
 <tbody><tr>
 <td align='center' style='padding:0 0 40px'>
 <a target='_blank' style='border:none' title='Databagg.com' href='databagg.com'>
 <img width='550' height='150'  style='vertical-align:top;outline:none;border:none' src='http://www.databagg.com/cnfrm_mail/loginlogo.png'>
 </a>
 </td>
 </tr>
 
 
 <tr>
 <td  align='center'>
 <table cellspacing='0' cellpadding='0' border='0' align='center'>
 <tbody><tr>
 <td  >
 <h1 style='font-family:georgia,serif;font-weight:normal;font-size:22px;line-height:21px;color:#211922!important;margin:0;padding:0 20px'>
 
 
 Hi, $nm!
 
 
 </h1>
 </td>
 </tr>
 </tbody></table>
 </td>
 </tr>
 

 
 
 
 <tr>
 <td style='padding:30px 0'>
 <table cellspacing='0' cellpadding='0' style='border:3px solid #00ABE6'>
 <tbody><tr>
 <td width='1' style='background-color:#eceaeb'></td>
 <td style='background-color:#ffffff;padding:0px;'>
 <table cellspacing='0' cellpadding='0' border='0'>
 <tbody><tr>
 <td>
 <table width='618' cellspacing='0' cellpadding='0' border='0'>
 <tbody><tr>
 
 
 <td width='358'>
 <p style='font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:14px;color:#211922;line-height:20px;margin:0;padding:0 0 0 20px'>

 
 Thank you for signing up with  Databagg.<br>
 

 Verify your e-Mail address by clicking on 'Confirm Email' <br>
 </p>
 </td>
 
 
 
 
 
<td width='140' align='right' style='padding:20px'>
 <td width='140' align='right' style='padding:20px'>
 
 <a  href=\"https://www.databagg.com/verify.php?code=$em_enc\" >
 
 Confirm Emails
 
 </a>

</td>
 </tr>
 </tbody></table>
 </td>
 </tr>
 </tbody></table>
 </td>
 <td width='1' style='background-color:#eceaeb'></td>
 </tr>
 
 </tbody></table>
 </td>
 </tr>

 <tr>
 <td align='center'>
 <p style='font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:10px;color:#999999;line-height:1.35em;margin:0;padding:0'><span>&copy;</span>2013 Databagg <font style='color:#aaa;padding:0 2px'>|</font> All Rights Reserved<br><a target='_blank' style='color:#999;text-decoration:underline' href='http://www.databagg.com/privacy-policy.html'>Privacy Policy</a> <font style='color:#aaa;padding:0 2px'> |</font> <a target='_blank' style='color:#999;text-decoration:underline' href='http://www.databagg.com/features.html'>Features</a></p>
 </td>
 </tr>
 
 </tbody></table>
 </td>
 </tr>
</tbody></table>

</div></body>";
   
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
	$mail->Subject  = "Please Confirm Your Email";
	$mail->MsgHTML($content);

        $mail->AddAddress($ml);

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
	 $content.="<body bgcolor='#ABE7FF' background=\"http://www.databagg.com/cnfrm_mail/cloud.jpg\">
<div width='100%' height='100%' lang='en' style='padding:0;margin:0;background-image: url(http://www.databagg.com/cnfrm_mail/cloud.jpg);' >
<table width='100%' cellspacing='0' cellpadding='0' border='0' background=\"http://www.databagg.com/cnfrm_mail/cloud.jpg\"  >
 <tbody><tr>
 <td style='padding:20px 20px 40px'>
 <table width='620' cellspacing='0' cellpadding='0' border='0' align='center'>
 
 <tbody><tr>
 <td align='center' style='padding:0 0 40px'>
 <a target='_blank' style='border:none' title='Databagg.com' href='databagg.com'>
 <img width='550' height='150'  style='vertical-align:top;outline:none;border:none' src='http://www.databagg.com/cnfrm_mail/loginlogo.png'>
 </a>
 </td>
 </tr>
 
 
 <tr>
 <td  align='center'>
 <table cellspacing='0' cellpadding='0' border='0' align='center'>
 <tbody><tr>
 <td  >
 <h1 style='font-family:georgia,serif;font-weight:normal;font-size:22px;line-height:21px;color:#211922!important;margin:0;padding:0 20px'>
 
 
 Hi, $nm!
 
 
 </h1>
 </td>
 </tr>
 </tbody></table>
 </td>
 </tr>
 

 
 
 
 <tr>
 <td style='padding:30px 0'>
 <table cellspacing='0' cellpadding='0' style='border:3px solid #00ABE6'>
 <tbody><tr>
 <td width='1' style='background-color:#eceaeb'></td>
 <td style='background-color:#ffffff;padding:0px;'>
 <table cellspacing='0' cellpadding='0' border='0'>
 <tbody><tr>
 <td>
 <table width='618' cellspacing='0' cellpadding='0' border='0'>
 <tbody><tr>
 
 
 <td width='358'>
 <p style='font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:14px;color:#211922;line-height:20px;margin:0;padding:0 0 0 20px'>

 
 <b> Your Databagg Account Password is $pass . </b>
 

  <br>
 </p>
 </td>
 
 
 
 
 
<td width='140' align='right' style='padding:20px'>

</td>

 
 
 </tr>
 </tbody></table>
 </td>
 </tr>
 </tbody></table>
 </td>
 <td width='1' style='background-color:#eceaeb'></td>
 </tr>
 
 </tbody></table>
 </td>
 </tr>

 <tr>
 <td align='center'>
 <p style='font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:10px;color:#999999;line-height:1.35em;margin:0;padding:0'><span>&copy;</span>2013 Databagg <font style='color:#aaa;padding:0 2px'>|</font> All Rights Reserved<br><a target='_blank' style='color:#999;text-decoration:underline' href='http://www.databagg.com/privacy-policy.html'>Privacy Policy</a> <font style='color:#aaa;padding:0 2px'> |</font> <a target='_blank' style='color:#999;text-decoration:underline' href='http://www.databagg.com/features.html'>Features</a></p>
 </td>
 </tr>
 
 </tbody></table>
 </td>
 </tr>
</tbody></table>

</div></body>";
   
     $content.="<br>";
     
     
    $content.="<br> <br>";
	//echo $msg;
//    
//	$mail = new PHPMailer();
//	$mail->IsSMTP();  // telling the class to use SMTP
//    $mail->SMTPAuth   = false; 
//	$mail->Host     = "192.168.100.7"; 
	$mail->SetFrom("support@databagg.com","DataBaGG");
	$mail->Subject  = "Databagg Password";
	$mail->MsgHTML($content);

        $mail->AddAddress($em_enc);

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
	 $content.="<body bgcolor='#ABE7FF' background=\"http://www.databagg.com/cnfrm_mail/cloud.jpg\">
<div lang='en' style='background:#ABE7FF url(databagg.com/cnfrm_mail/cloud.jpg) repeat;padding:0;margin:0'>
<table width='100%' cellspacing='0' cellpadding='0' border='0'  style='background: url(databagg.com/cnfrm_mail/cloud.jpg) #ABE7FF>
 <tbody><tr>
 <td style='padding:20px 20px 40px'>
 <table width='620' cellspacing='0' cellpadding='0' border='0' align='center'>
 
 <tbody><tr>
 <td align='center' style='padding:0 0 40px'>
 <a target='_blank' style='border:none' title='Databagg.com' href='databagg.com'>
 <img width='550' height='150'  style='vertical-align:top;outline:none;border:none' src='http://www.databagg.com/cnfrm_mail/loginlogo.png'>
 </a>
 </td>
 </tr>
 
 
 <tr>
 <td  align='center'>
 <table cellspacing='0' cellpadding='0' border='0' align='center'>
 <tbody><tr>
 <td  >
 <h1 style='font-family:georgia,serif;font-weight:normal;font-size:22px;line-height:21px;color:#211922!important;margin:0;padding:0 20px'>
 
 
 Hi there,
 
 
 </h1>
 </td>
 </tr>
 </tbody></table>
 </td>
 </tr>
 

 
 
 
 <tr>
 <td style='padding:30px 0'>
 <table cellspacing='0' cellpadding='0' style='border:3px solid #00ABE6'>
 <tbody><tr>
 <td width='1' style='background-color:#eceaeb'></td>
 <td style='background-color:#ffffff;padding:0px;'>
 <table cellspacing='0' cellpadding='0' border='0'>
 <tbody><tr>
 <td>
 <table width='618' cellspacing='0' cellpadding='0' border='0'>
 <tbody><tr>
 
 
 <td width='358'>
 <p style='font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:14px;color:#211922;line-height:20px;margin:0;padding:0 0 0 20px'>

 
 $fnm  $lnm  ($mid) shared a file with you.<br>
 

 view shared file by clicking on 'View File' <br>
 </p>
 </td>
 
 
 
 
 
<td width='140' align='right' style='padding:20px'>
 <table cellspacing='0' cellpadding='0' border='0'>
 <tbody><tr>
 <td  background='databagg.com/cnfrm_mail/button_borderless.gif' align='center' style='padding:5px;background-repeat:repeat-x;border-radius:5px;background-color:#d43638;border:1px solid #910101;white-space:nowrap;min-height:34px'>
 <a target='_blank' title='View File' style='color:#fcf9f9;text-align:center;text-decoration:none;vertical-align:baseline' href='$dest'>
 
 <span style='padding:9px 15px;color:#fcf9f9;text-decoration:none;color:#fcf9f9;font-family:'helvetica neue',helvetica,arial,sans-serif;font-weight:bold;font-size:18px;line-height:18px;white-space:nowrap'>View File</span>
 
 </a>
 </td>
 </tr>
 </tbody></table>
</td>

 
 
 </tr>
 </tbody></table>
 </td>
 </tr>
 </tbody></table>
 </td>
 <td width='1' style='background-color:#eceaeb'></td>
 </tr>
 
 </tbody></table>
 </td>
 </tr>

 <tr>
 <td align='center'>
 <p style='font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:10px;color:#999999;line-height:1.35em;margin:0;padding:0'><span>&copy;</span>2013 Databagg <font style='color:#aaa;padding:0 2px'>|</font> All Rights Reserved<br><a target='_blank' style='color:#999;text-decoration:underline' href='http://www.databagg.com/privacy-policy.html'>Privacy Policy</a> <font style='color:#aaa;padding:0 2px'> |</font> <a target='_blank' style='color:#999;text-decoration:underline' href='http://www.databagg.com/features.html'>Features</a></p>
 </td>
 </tr>
 
 </tbody></table>
 </td>
 </tr>
</tbody></table>

</div></body>";
   
     $content.="<br>";
     
     
    $content.="<br> <br>";
    
    
    
    //	$mail = new PHPMailer();
//		$mail->IsSMTP();  // telling the class to use SMTP
//    $mail->SMTPAuth   = false; 
//	$mail->Host     = "192.168.100.7"; 
	$mail->SetFrom("support@databagg.com","DataBaGG");
	$mail->Subject  = "Databagg File Share";
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
	 $content.="<body bgcolor='#ABE7FF' background=\"http://www.databagg.com/cnfrm_mail/cloud.jpg\">
<div lang='en' style='background:#ABE7FF url(databagg.com/cnfrm_mail/cloud.jpg) repeat;padding:0;margin:0'>
<table width='100%' cellspacing='0' cellpadding='0' border='0'  style='background: url(databagg.com/cnfrm_mail/cloud.jpg) #ABE7FF>
 <tbody><tr>
 <td style='padding:20px 20px 40px'>
 <table width='620' cellspacing='0' cellpadding='0' border='0' align='center'>
 
 <tbody><tr>
 <td align='center' style='padding:0 0 40px'>
 <a target='_blank' style='border:none' title='Databagg.com' href='databagg.com'>
 <img width='550' height='150'  style='vertical-align:top;outline:none;border:none' src='http://www.databagg.com/cnfrm_mail/loginlogo.png'>
 </a>
 </td>
 </tr>
 
 
 <tr>
 <td  align='center'>
 <table cellspacing='0' cellpadding='0' border='0' align='center'>
 <tbody><tr>
 <td  >
 <h1 style='font-family:georgia,serif;font-weight:normal;font-size:22px;line-height:21px;color:#211922!important;margin:0;padding:0 20px'>
 
 
 Hi there,
 
 
 </h1>
 </td>
 </tr>
 </tbody></table>
 </td>
 </tr>
 

 
 
 
 <tr>
 <td style='padding:30px 0'>
 <table cellspacing='0' cellpadding='0' style='border:3px solid #00ABE6'>
 <tbody><tr>
 <td width='1' style='background-color:#eceaeb'></td>
 <td style='background-color:#ffffff;padding:0px;'>
 <table cellspacing='0' cellpadding='0' border='0'>
 <tbody><tr>
 <td>
 <table width='618' cellspacing='0' cellpadding='0' border='0'>
 <tbody><tr>
 
 
 <td width='358'>
 <p style='font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:14px;color:#211922;line-height:20px;margin:0;padding:0 0 0 20px'>

 
 $fnm  $lnm  ($mid) shared a  Playlist  with you.<br>
 

 Listen to the Playlist by clicking on 'Listen Now' <br>
 </p>
 </td>
 
 
 
 
 
<td width='140' align='right' style='padding:20px'>
 <table cellspacing='0' cellpadding='0' border='0'>
 <tbody><tr>
 <td  background='databagg.com/cnfrm_mail/button_borderless.gif' align='center' style='padding:5px;background-repeat:repeat-x;border-radius:5px;background-color:#d43638;border:1px solid #910101;white-space:nowrap;min-height:34px'>
 <a target='_blank' title='View File' style='color:#fcf9f9;text-align:center;text-decoration:none;vertical-align:baseline' href='$dest'>
 
 <span style='padding:9px 15px;color:#fcf9f9;text-decoration:none;color:#fcf9f9;font-family:'helvetica neue',helvetica,arial,sans-serif;font-weight:bold;font-size:18px;line-height:18px;white-space:nowrap'>Listen Now</span>
 
 </a>
 </td>
 </tr>
 </tbody></table>
</td>

 
 
 </tr>
 </tbody></table>
 </td>
 </tr>
 </tbody></table>
 </td>
 <td width='1' style='background-color:#eceaeb'></td>
 </tr>
 
 </tbody></table>
 </td>
 </tr>

 <tr>
 <td align='center'>
 <p style='font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:10px;color:#999999;line-height:1.35em;margin:0;padding:0'><span>&copy;</span>2013 Databagg <font style='color:#aaa;padding:0 2px'>|</font> All Rights Reserved<br><a target='_blank' style='color:#999;text-decoration:underline' href='http://www.databagg.com/privacy-policy.html'>Privacy Policy</a> <font style='color:#aaa;padding:0 2px'> |</font> <a target='_blank' style='color:#999;text-decoration:underline' href='http://www.databagg.com/features.html'>Features</a></p>
 </td>
 </tr>
 
 </tbody></table>
 </td>
 </tr>
</tbody></table>

</div></body>";
   
     $content.="<br>";
     
     
    $content.="<br> <br>";
    
    
    
//    	$mail = new PHPMailer();
//		$mail->IsSMTP();   //telling the class to use SMTP
//    $mail->SMTPAuth   = false; 
//	$mail->Host     = "192.168.100.7";  //SMTP server
	$mail->SetFrom("support@databagg.com","DataBaGG");
	$mail->Subject  = "Databagg Music Share";
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
	 $content.="<body bgcolor='#ABE7FF' background=\"http://www.databagg.com/cnfrm_mail/cloud.jpg\">
<div lang='en' style='background:#ABE7FF url(databagg.com/cnfrm_mail/cloud.jpg) repeat;padding:0;margin:0'>
<table width='100%' cellspacing='0' cellpadding='0' border='0'  style='background: url(databagg.com/cnfrm_mail/cloud.jpg) #ABE7FF>
 <tbody><tr>
 <td style='padding:20px 20px 40px'>
 <table width='620' cellspacing='0' cellpadding='0' border='0' align='center'>
 
 <tbody><tr>
 <td align='center' style='padding:0 0 40px'>
 <a target='_blank' style='border:none' title='Databagg.com' href='databagg.com'>
 <img width='550' height='150'  style='vertical-align:top;outline:none;border:none' src='http://www.databagg.com/cnfrm_mail/loginlogo.png'>
 </a>
 </td>
 </tr>
 
 
 <tr>
 <td  align='center'>
 <table cellspacing='0' cellpadding='0' border='0' align='center'>
 <tbody><tr>
 <td  >
 <h1 style='font-family:georgia,serif;font-weight:normal;font-size:22px;line-height:21px;color:#211922!important;margin:0;padding:0 20px'>
 
 
 Hi there,
 
 
 </h1>
 </td>
 </tr>
 </tbody></table>
 </td>
 </tr>
 

 
 
 
 <tr>
 <td style='padding:30px 0'>
 <table cellspacing='0' cellpadding='0' style='border:3px solid #00ABE6'>
 <tbody><tr>
 <td width='1' style='background-color:#eceaeb'></td>
 <td style='background-color:#ffffff;padding:0px;'>
 <table cellspacing='0' cellpadding='0' border='0'>
 <tbody><tr>
 <td>
 <table width='618' cellspacing='0' cellpadding='0' border='0'>
 <tbody><tr>
 
 
 <td width='358'>
 <p style='font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:14px;color:#211922;line-height:20px;margin:0;padding:0 0 0 20px'>

 
 $fnm  $lnm  ($mid) shared a  Image Gallery  with you.<br>
 

 Open  the Gallery by clicking on 'View Gallery' <br>
 </p>
 </td>
 
 
 
 
 
<td width='140' align='right' style='padding:20px'>
 <table cellspacing='0' cellpadding='0' border='0'>
 <tbody><tr>
 <td  background='databagg.com/cnfrm_mail/button_borderless.gif' align='center' style='padding:5px;background-repeat:repeat-x;border-radius:5px;background-color:#d43638;border:1px solid #910101;white-space:nowrap;min-height:34px'>
 <a target='_blank' title='View File' style='color:#fcf9f9;text-align:center;text-decoration:none;vertical-align:baseline' href='$dest'>
 
 <span style='padding:9px 15px;color:#fcf9f9;text-decoration:none;color:#fcf9f9;font-family:'helvetica neue',helvetica,arial,sans-serif;font-weight:bold;font-size:18px;line-height:18px;white-space:nowrap'>View Gallery</span>
 
 </a>
 </td>
 </tr>
 </tbody></table>
</td>

 
 
 </tr>
 </tbody></table>
 </td>
 </tr>
 </tbody></table>
 </td>
 <td width='1' style='background-color:#eceaeb'></td>
 </tr>
 
 </tbody></table>
 </td>
 </tr>

 <tr>
 <td align='center'>
 <p style='font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:10px;color:#999999;line-height:1.35em;margin:0;padding:0'><span>&copy;</span>2013 Databagg <font style='color:#aaa;padding:0 2px'>|</font> All Rights Reserved<br><a target='_blank' style='color:#999;text-decoration:underline' href='http://www.databagg.com/privacy-policy.html'>Privacy Policy</a> <font style='color:#aaa;padding:0 2px'> |</font> <a target='_blank' style='color:#999;text-decoration:underline' href='http://www.databagg.com/features.html'>Features</a></p>
 </td>
 </tr>
 
 </tbody></table>
 </td>
 </tr>
</tbody></table>

</div></body>";
   
     $content.="<br>";
     
     
    $content.="<br> <br>";
    
    
    //
//    	$mail = new PHPMailer();
//		$mail->IsSMTP();  // telling the class to use SMTP
//    $mail->SMTPAuth   = false; 
//	$mail->Host     = "192.168.100.7"; 
	$mail->SetFrom("support@databagg.com","DataBaGG");
	$mail->Subject  = "Databagg Image Gallery Share";
	$mail->MsgHTML($content);

        $mail->AddAddress($mail_id);

	$mail->Send();
	$mail->ClearAllRecipients();
}

//mail_forgot("jnu.saurav@gmail.com","saurav","asas");
//mail_share_category_photo("jnu.saurav@gmail.com","saurav","asas","asas","a");
//mail_share("jnu.saurav@gmail.com","saurav","asas","asas","a");
//mail_welcome("jnu.saurav@gmail.com","saurav");
//mail_verify("jnu.saurav@gmail.com","saurav");
//mail_first_sync("jnu.saurav@gmail.com","saurav","PC-NAME");



function mail_share_category_video($mail_id,$cd,$fnm,$lnm,$mid)
{
    global $mail;
     $headers = 'From: DATABAGG <team@databagg.com>' . "\r\n";
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $dest="http://www.databagg.com/user/category/vshare/?code=$cd";
    
   $content="<br>";
	 $content.="<body bgcolor='#ABE7FF' background=\"http://www.databagg.com/cnfrm_mail/cloud.jpg\">
<div lang='en' style='background:#ABE7FF url(databagg.com/cnfrm_mail/cloud.jpg) repeat;padding:0;margin:0'>
<table width='100%' cellspacing='0' cellpadding='0' border='0'  style='background: url(databagg.com/cnfrm_mail/cloud.jpg) #ABE7FF>
 <tbody><tr>
 <td style='padding:20px 20px 40px'>
 <table width='620' cellspacing='0' cellpadding='0' border='0' align='center'>
 
 <tbody><tr>
 <td align='center' style='padding:0 0 40px'>
 <a target='_blank' style='border:none' title='Databagg.com' href='databagg.com'>
 <img width='550' height='150'  style='vertical-align:top;outline:none;border:none' src='http://www.databagg.com/cnfrm_mail/loginlogo.png'>
 </a>
 </td>
 </tr>
 
 
 <tr>
 <td  align='center'>
 <table cellspacing='0' cellpadding='0' border='0' align='center'>
 <tbody><tr>
 <td  >
 <h1 style='font-family:georgia,serif;font-weight:normal;font-size:22px;line-height:21px;color:#211922!important;margin:0;padding:0 20px'>
 
 
 Hi there,
 
 
 </h1>
 </td>
 </tr>
 </tbody></table>
 </td>
 </tr>
 

 
 
 
 <tr>
 <td style='padding:30px 0'>
 <table cellspacing='0' cellpadding='0' style='border:3px solid #00ABE6'>
 <tbody><tr>
 <td width='1' style='background-color:#eceaeb'></td>
 <td style='background-color:#ffffff;padding:0px;'>
 <table cellspacing='0' cellpadding='0' border='0'>
 <tbody><tr>
 <td>
 <table width='618' cellspacing='0' cellpadding='0' border='0'>
 <tbody><tr>
 
 
 <td width='358'>
 <p style='font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:14px;color:#211922;line-height:20px;margin:0;padding:0 0 0 20px'>

 
 $fnm  $lnm  ($mid) shared a  Video Gallery  with you.<br>
 

 Open  the Gallery by clicking on 'View Gallery' <br>
 </p>
 </td>
 
 
 
 
 
<td width='140' align='right' style='padding:20px'>
 <table cellspacing='0' cellpadding='0' border='0'>
 <tbody><tr>
 <td  background='databagg.com/cnfrm_mail/button_borderless.gif' align='center' style='padding:5px;background-repeat:repeat-x;border-radius:5px;background-color:#d43638;border:1px solid #910101;white-space:nowrap;min-height:34px'>
 <a target='_blank' title='View File' style='color:#fcf9f9;text-align:center;text-decoration:none;vertical-align:baseline' href='$dest'>
 
 <span style='padding:9px 15px;color:#fcf9f9;text-decoration:none;color:#fcf9f9;font-family:'helvetica neue',helvetica,arial,sans-serif;font-weight:bold;font-size:18px;line-height:18px;white-space:nowrap'>View Gallery</span>
 
 </a>
 </td>
 </tr>
 </tbody></table>
</td>

 
 
 </tr>
 </tbody></table>
 </td>
 </tr>
 </tbody></table>
 </td>
 <td width='1' style='background-color:#eceaeb'></td>
 </tr>
 
 </tbody></table>
 </td>
 </tr>

 <tr>
 <td align='center'>
 <p style='font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:10px;color:#999999;line-height:1.35em;margin:0;padding:0'><span>&copy;</span>2013 Databagg <font style='color:#aaa;padding:0 2px'>|</font> All Rights Reserved<br><a target='_blank' style='color:#999;text-decoration:underline' href='http://www.databagg.com/privacy-policy.html'>Privacy Policy</a> <font style='color:#aaa;padding:0 2px'> |</font> <a target='_blank' style='color:#999;text-decoration:underline' href='http://www.databagg.com/features.html'>Features</a></p>
 </td>
 </tr>
 
 </tbody></table>
 </td>
 </tr>
</tbody></table>

</div></body>";
   
     $content.="<br>";
     
     
    $content.="<br> <br>";
    
    
    //
//    	$mail = new PHPMailer();
//		$mail->IsSMTP();  // telling the class to use SMTP
//    $mail->SMTPAuth   = false; 
//	$mail->Host     = "192.168.100.7"; 
	$mail->SetFrom("support@databagg.com","DataBaGG");
	$mail->Subject  = "Databagg Video Gallery Share";
	$mail->MsgHTML($content);

        $mail->AddAddress($mail_id);

	$mail->Send();
	$mail->ClearAllRecipients();
}
?>



