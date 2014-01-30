<?php
if(function_exists("date_default_timezone_set"))
	date_default_timezone_set("Asia/Calcutta");
//error_reporting(E_ALL);
//ini_set("display_errors",1);
require_once("PHPMailer/class.phpmailer.php");
function mail_welcome($em_enc,$nm)
{
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
Congratulations! You have successfully created your Databagg account.</h2>

<p style='font-family:Helvetica,Arial;font-size:16px;line-height:21px;margin:1em 0;padding:0 1em'>
  We just created a new account for your email address:<br>
<a target='_blank' style='color:#db3c6e;text-decoration:none' href='mailto:$em_enc'>$em_enc</a>
</p>
<h3 style='font-family:Helvetica,Arial;font-size:18px;line-height:21px;margin:1em 0;padding:0 1em'>Here's what happens next:</h3>
<p style='font-family:Helvetica,Arial;font-size:16px;line-height:21px;margin:1em 0;padding:0 1em'>
  Using the downloaded application, upload your data to DataBagg. You can upload your pictures, images, songs, videos, files, documents and everything else. <br /> <br /> 
  Once your data is uploaded on our Cloud at DataBagg, you can access it using any device: PC, Desktop, Mobile or Tablet. You can edit your data across different devices and it work on it.

<br /><br />DataBagg makes sharing of your data super easy. With just one click, you can share your data and information with your family, friends and relatives.

<br /><br />
DataBagg has some of the most advanced options which will surprise you, Get ready for surprises! 
</p>

<p style='font-family:Helvetica,Arial;font-size:16px;line-height:21px;margin:1em 0;padding:0 1em'>
<b>Sincerely,
</b><br>
  The Databagg team<br>
<a target='_blank' style='color:#db3c6e;text-decoration:none' href='mailto:support@databagg.com'>support@databagg.com</a> <br />

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
   
  
	$mail = new PHPMailer();
	$mail->IsSMTP(false);  // telling the class to use SMTP
	//$mail->Host     = "smtp.askpcexperts.com"; // SMTP server
	$mail->SetFrom("team@databagg.com","DATABAGG");
	$mail->Subject  = "Welcome to Databagg";
	$mail->MsgHTML($content);
	//$mail->WordWrap = 50;

	//$mail->AddAttachment("$fl");

		//$mail->AddAddress("ravish@cyfuture.com");
    //    $mail->AddAddress("Mitch.D@iolo.com");
    //    $mail->AddAddress("alex.marrache@iolo.com");
    //    $mail->AddAddress("nick.rocha@iolo.com");
    //    $mail->AddAddress("mark.stephens@iolo.com");
        $mail->AddAddress($em_enc);

	$mail->Send();
	$mail->ClearAllRecipients();
    
       //$mail_id="jnu.saurav@gmail.com";
       // mail($em_enc, $subject, $content, $header);

}


//end welcome mail

//Email verify function
function mail_verify($em_enc,$nm)
{
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
 

 verify your E-Mail address by clicking on 'Confirm Email' <br>
 </p>
 </td>
 
 
 
 
 
<td width='140' align='right' style='padding:20px'>
 <table cellspacing='0' cellpadding='0' border='0'>
 <tbody><tr>
 <td  background='databagg.com/cnfrm_mail/button_borderless.gif' align='center' style='padding:5px;background-repeat:repeat-x;border-radius:5px;background-color:#d43638;border:1px solid #910101;white-space:nowrap;min-height:34px'>
 <a target='_blank' title='Confirm Email' style='color:#fcf9f9;text-align:center;text-decoration:none;vertical-align:baseline' href='$dest'>
 
 <span style='padding:9px 15px;color:#fcf9f9;text-decoration:none;color:#fcf9f9;font-family:'helvetica neue',helvetica,arial,sans-serif;font-weight:bold;font-size:18px;line-height:18px;white-space:nowrap'>Confirm Email</span>
 
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
	//echo $msg;
    
	$mail = new PHPMailer();
//	 echo "Mailer Error: " . $mail->ErrorInfo;
   
    $mail->IsSMTP(false);  // telling the class to use SMTP
	//$mail->Host     = "smtp.askpcexperts.com"; // SMTP server
	$mail->SetFrom("team@databagg.com","DATABAGG");
	$mail->Subject  = "Please Confirm Your Email";
	$mail->MsgHTML($content);
	//$mail->WordWrap = 50;

	//$mail->AddAttachment("$fl");

		//$mail->AddAddress("ravish@cyfuture.com");
    //    $mail->AddAddress("Mitch.D@iolo.com");
    //    $mail->AddAddress("alex.marrache@iolo.com");
    //    $mail->AddAddress("nick.rocha@iolo.com");
    //    $mail->AddAddress("mark.stephens@iolo.com");
        $mail->AddAddress($ml);

	$mail->Send();
	$mail->ClearAllRecipients();
    //$ml=$em_enc;
//    $em_enc=base64_encode($em_enc);
//    $dest="www.databagg.com/verify.php?code=".$em_enc;
//   
//     $header  = "MIME-Version: 1.0\r\n";
// $header .= "Content-type: text/html; charset: utf8\r\n";
//    $subject="Please Confirm Your Email";
//    $header.="from:Team Databagg <team@databagg.com>";
//    $content="<br>";
   
   
       //$mail_id=$ml;
        //mail($mail_id, $subject, $content, $header);
}



function mail_forgot($em_enc,$nm,$pass)
{
        
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
    
	$mail = new PHPMailer();
	$mail->IsSMTP(false);  // telling the class to use SMTP
	//$mail->Host     = "smtp.askpcexperts.com"; // SMTP server
	$mail->SetFrom("team@databagg.com","DATABAGG");
	$mail->Subject  = "Databagg Password";
	$mail->MsgHTML($content);
	//$mail->WordWrap = 50;

	//$mail->AddAttachment("$fl");

		//$mail->AddAddress("ravish@cyfuture.com");
    //    $mail->AddAddress("Mitch.D@iolo.com");
    //    $mail->AddAddress("alex.marrache@iolo.com");
    //    $mail->AddAddress("nick.rocha@iolo.com");
    //    $mail->AddAddress("mark.stephens@iolo.com");
        $mail->AddAddress($em_enc);

	$mail->Send();
	$mail->ClearAllRecipients();
    //$ml=$em_enc;
//    $em_enc=base64_encode($em_enc);
//    $dest="www.databagg.com/verify.php?code=".$em_enc;
//   
//     $header  = "MIME-Version: 1.0\r\n";
// $header .= "Content-type: text/html; charset: utf8\r\n";
//    $subject="Please Confirm Your Email";
//    $header.="from:Team Databagg <team@databagg.com>";
//    $content="<br>";
    
   
   
       //$mail_id=$ml;
        //mail($mail_id, $subject, $content, $header);
}















//mail("jnu.saurav@gmail.com", "test","hlo");

//mail_welcome("manishsharma1978@rediffmail.com","manish");
//if(mail_verify("jnu.saurav@gmail.com","manish"))
//echo "scss";
//else
//echo "fail";

function mail_share($mail_id,$subject,$content,$header)
{
    
     $headers = 'From: DATABAGG <team@databagg.com>' . "\r\n";
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    
    	$mail = new PHPMailer();
	$mail->IsSMTP(false);  // telling the class to use SMTP
	//$mail->Host     = "smtp.askpcexperts.com"; // SMTP server
	$mail->SetFrom("team@databagg.com","DATABAGG");
	$mail->Subject  = "Databagg File Share";
	$mail->MsgHTML($content);
	//$mail->WordWrap = 50;

	//$mail->AddAttachment("$fl");

		//$mail->AddAddress("ravish@cyfuture.com");
    //    $mail->AddAddress("Mitch.D@iolo.com");
    //    $mail->AddAddress("alex.marrache@iolo.com");
    //    $mail->AddAddress("nick.rocha@iolo.com");
    //    $mail->AddAddress("mark.stephens@iolo.com");
        $mail->AddAddress($mail_id);

	$mail->Send();
	$mail->ClearAllRecipients();
}
?>



