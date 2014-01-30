<?php


if(function_exists("date_default_timezone_set"))
	date_default_timezone_set("Asia/Calcutta");
error_reporting(E_ALL);
//ini_set("display_errors",1);
require_once("PHPMailer/class.phpmailer.php");
	$mail = new PHPMailer();
	$mail->IsSMTP();  // telling the class to use SMTP
   $mail->SMTPAuth   = false; 
	$mail->Host     = "192.168.100.7"; // SMTP server


function mail_data_filled($mail_id,$name,$percent,$mname)
{
    global $mail;
    $header  = "MIME-Version: 1.0\r\n";
 $header .= "Content-type: text/html; charset: utf8\r\n";
    $subject="Congratulations! Your Backup Is Complete..";
    $header.="from:Team Databagg <team@databagg.com>";
    $content="<br>";
   $content.="<div style='background:url(databagg.com/cnfrm_mail/batabagbg.jpg) no-repeat;width:100%!important' marginheight='0' marginwidth='0'>
<center >
<table width='600' cellspacing='0' cellpadding='0' border='0' >
<tbody><tr>
<td valign='top' align='center'>
<img style='max-width:600px' src='databagg.com/cnfrm_mail/loginlogo.png'>
</td>
</tr>
<tr>
<td valign='top' align='center'>
</td></tr></tbody></table><table width='600' cellspacing='0' cellpadding='0' border='0' >
<tbody><tr>
<td valign='top' align='center' colspan='3'>
<div style='padding-bottom:1em'>
<br />
<h1 style='font-family:Helvetica,Arial;font-size:30px;font-weight:300;margin:0;padding:0 1em'><span class='il'>Hi</span> <b>$name</b>,</h1>
<h2 style='font-family:Helvetica,Arial;font-size:22px;font-weight:300;color:#6d7276;margin:0;margin-bottom:18px;padding:0 1em'>
You have consumed $percent  of your available space. Upgrade and instantly get more space.</h2>


<p style='font-family:Helvetica,Arial;font-size:16px;line-height:21px;margin:1em 0;padding:0 1em'>
$name , Please remember how important it is to back up all of your photos, music, files and documents.<br><br> It takes just one random hard drive crash or one forgetful moment to lose all of your computer files forever. 

</p>

<p style='font-family:Helvetica,Arial;font-size:16px;line-height:21px;margin:1em 0;padding:0 1em;color:#E85005'>

<br>
If you haven't already decided on a plan to upgrade to please email our sales team on  <a target='_blank' style='color:#db3c6e;text-decoration:none' href='mailto:sales@databagg.com'>sales@databagg.com</a> and our team will be happy to advise you on the best plan for you.

</p>
<p style='font-family:Helvetica,Arial;font-size:16px;line-height:21px;margin:1em 0;padding:0 1em'>Thank you for choosing DataBagg. </p>
<p style='font-family:Helvetica,Arial;font-size:16px;line-height:21px;margin:1em 0;padding:0 1em'>
<b>$mname
</b><br>
 Personal Account Manager<br>
 <br />

<br />

</p>
</div>
</td>
</tr>
<tr>


<td valign='top' align='center'>
<img style='max-width:600px'  src='databagg.com/cnfrm_mail/calling.jpg'>
</td>

</tr>
</tbody></table>



<br>



</center><div class='yj6qo'></div><div class='adL'>
</div></div>";
$content.="<br> <br>";

	$mail->SetFrom("support@databagg.com","DATABAGG");
	$mail->Subject  = "$percent data consumed";
	$mail->MsgHTML($content);

        $mail->AddAddress($mail_id);

	$mail->Send();
	$mail->ClearAllRecipients();
}


function mail_done_hard_work($mail_id,$name,$mname)
{
    global $mail;
    $header  = "MIME-Version: 1.0\r\n";
 $header .= "Content-type: text/html; charset: utf8\r\n";
    $subject="Congratulations! Your Backup Is Complete..";
    $header.="from:Team Databagg <team@databagg.com>";
    $content="<br>";
 $content.="<div style='background:url(databagg.com/cnfrm_mail/batabagbg.jpg) no-repeat;width:100%!important' marginheight='0' marginwidth='0'>
<center >
<table width='600' cellspacing='0' cellpadding='0' border='0' >
<tbody><tr>
<td valign='top' align='center'>
<img style='max-width:600px' src='databagg.com/cnfrm_mail/loginlogo.png'>
</td>
</tr>
<tr>
<td valign='top' align='center'>
</td></tr></tbody></table><table width='600' cellspacing='0' cellpadding='0' border='0' >
<tbody><tr>
<td valign='top' align='center' colspan='3'>
<div style='padding-bottom:1em'>
<br />
<h1 style='font-family:Helvetica,Arial;font-size:30px;font-weight:300;margin:0;padding:0 1em'><span class='il'>Hi</span> <b>$name</b>,</h1>
<h2 style='font-family:Helvetica,Arial;font-size:18px;font-weight:300;color:#6d7276;margin:0;margin-bottom:18px;padding:0 1em'>
<br>Hope you are going well. I was reading about Data Protection and I came to know few interesting observation that:-</h2>


<p style='font-family:Helvetica,Arial;font-size:16px;line-height:21px;margin:1em 14px;padding:0 1em;text-align:left;'>
-A hard drive crashes every 15 seconds <br>
-32% of data loss is caused by human error <br>
-31% of PC users have lost all of their PC files to events beyond their control. <br>
-25% of lost data is due to the failure of a portable drive. <br>
-44% of data loss caused by mechanical failures. <br>
-15% or more of laptops are stolen or suffer hard drive failures. <br>
-1 in 5 computers suffer a fatal hard drive crash during their lifetime. <br> <br>

</p>

<p style='font-family:Helvetica,Arial;font-size:16px;line-height:21px;margin:1em 0;padding:0 1em;'>
This is true, but i never thought of it like that before. That's why it's so vitally important in this digital age to be keeping a backup,
 because if you're hard drive does crash the chances of salvaging any data is low, and I know this as it happened to me remember.
<br>
<br>
You have done the hard work already by installing the application, now just upgrade DataBagg and let DataBagg do the hard work, 
so you can rest assured knowing you never have to worry about the above reasons.
<br>
</p>
<p style='font-family:Helvetica,Arial;font-size:16px;line-height:21px;margin:1em 0;padding:0 1em;color:#E85005''>
Please email me with any questions you have and I will be happy to advise you on the best plan for you.
</p>
<p style='font-family:Helvetica,Arial;font-size:16px;line-height:21px;margin:1em 0;padding:0 1em'>Thank you for choosing DataBagg. </p>
<p style='font-family:Helvetica,Arial;font-size:16px;line-height:21px;margin:1em 0;padding:0 1em'>
<b>$mname
</b><br>
  Personal Account Manager<br>
 <br />

<br />

</p>
</div>
</td>
</tr>
<tr>


<td valign='top' align='center'>
<img style='max-width:600px'  src='databagg.com/cnfrm_mail/calling.jpg'>
</td>

</tr>
</tbody></table>



<br>



</center><div class='yj6qo'></div><div class='adL'>
</div></div>";
$content.="<br> <br>";

	$mail->SetFrom("support@databagg.com","DATABAGG");
	$mail->Subject  = "You've done the hard work";
	$mail->MsgHTML($content);

        $mail->AddAddress($mail_id);

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
    $content.="<div style='background:url(databagg.com/cnfrm_mail/batabagbg.jpg) no-repeat;width:100%!important' marginheight='0' marginwidth='0'>
<center >
<table width='600' cellspacing='0' cellpadding='0' border='0' >
<tbody><tr>
<td valign='top' align='center'>
<img style='max-width:600px' src='databagg.com/cnfrm_mail/loginlogo.png'>
</td>
</tr>
<tr>
<td valign='top' align='center'>
</td></tr></tbody></table><table width='600' cellspacing='0' cellpadding='0' border='0' >
<tbody><tr>
<td valign='top' align='center' colspan='3'>
<div style='padding-bottom:1em'>
<br />
<h1 style='font-family:Helvetica,Arial;font-size:30px;font-weight:300;margin:0;padding:0 1em'><span class='il'>Hi</span> <b>$name</b>,</h1>
<h2 style='font-family:Helvetica,Arial;font-size:22px;font-weight:300;color:#6d7276;margin:0;margin-bottom:18px;padding:0 1em'>
Your DataBagg account is now almost ready.</h2>


<p style='font-family:Helvetica,Arial;font-size:16px;line-height:21px;margin:1em 0;padding:0 1em'>
In order to use maximum features, don’t forget to install DataBagg on your computer. <a target='_blank' style='color:#db3c6e;text-decoration:none' href='http://www.databagg.com/user/download.php?path=databagg.zip'>Download</a>
<br>
<br>
Once you upload your digital data using our application, it will be automatically backed-up and synchronized across all the connected devices: your personal computer, your office computer and even on our website!
</p>

<p style='font-family:Helvetica,Arial;font-size:16px;line-height:21px;margin:1em 0;padding:0 1em;color:#E85005'>

<br>
We make your data accessible globally and create a back-up so that it is always safe and secured. 
Thank you for choosing DataBagg. For any question or support, please feel free to mail us at   <a target='_blank' style='color:#db3c6e;text-decoration:none' href='mailto:sales@databagg.com'>sales@databagg.com</a> .

</p>
<p style='font-family:Helvetica,Arial;font-size:16px;line-height:21px;margin:1em 0;padding:0 1em'>Thank you for choosing DataBagg. </p>
<p style='font-family:Helvetica,Arial;font-size:16px;line-height:21px;margin:1em 0;padding:0 1em'>
<b>Ravish Sharma
</b><br>
  Cofounder - DataBagg<br>
 <br />

<br />

</p>
</div>
</td>
</tr>
<tr>


<td valign='top' align='center'>
<img style='max-width:600px'  src='databagg.com/cnfrm_mail/calling.jpg'>
</td>

</tr>
</tbody></table>



<br>



</center><div class='yj6qo'></div><div class='adL'>
</div></div>";
$content.="<br> <br>";

	$mail->SetFrom("support@databagg.com","DATABAGG");
	$mail->Subject  = "Complete Your DataBagg Setup";
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
   $content.="<div style='background:url(databagg.com/cnfrm_mail/batabagbg.jpg) no-repeat;width:100%!important' marginheight='0' marginwidth='0'>
<center >
<table width='600' cellspacing='0' cellpadding='0' border='0' >
<tbody><tr>
<td valign='top' align='center'>
<img style='max-width:600px' src='databagg.com/cnfrm_mail/loginlogo.png'>
</td>
</tr>
<tr>
<td valign='top' align='center'>
</td></tr></tbody></table><table width='600' cellspacing='0' cellpadding='0' border='0' >
<tbody><tr>
<td valign='top' align='center' colspan='3'>
<div style='padding-bottom:1em'>
<br />
<h1 style='font-family:Helvetica,Arial;font-size:30px;font-weight:300;margin:0;padding:0 1em'><span class='il'>Hi</span> <b>$name</b>,</h1>
<h2 style='font-family:Helvetica,Arial;font-size:18px;font-weight:300;color:#6d7276;margin:0;margin-bottom:18px;padding:0 1em'>
<br>Thanks for choosing DataBagg, my name is $mname and I'll be your first point of contact if you need any help.</h2>


<p style='font-family:Helvetica,Arial;font-size:16px;line-height:21px;margin:1em 0;padding:0 1em'>
Very shortly you will realize that DataBagg is very simple to use, but so valuable in day-to-day life. <br> <br>
You can store your photos, files, music, reports and videos online, then access them at anytime from any computer or mobile device. <br> <br>
Me personally, I like just knowing I have a secure backup, so if anything happens to my computer or phone, I know DataBagg will restore all my data. <br><br>
I had a external drive crash 2 years ago, before I worked for DataBagg and I lost my daughter all childhood photos. So believe me, I know firsthand how important a backup is.
<br>

<br>
<br>
Once you upload your digital data using our application, it will be automatically backed-up and synchronized across all the connected devices: your personal computer, your office computer and even on our website!
</p>

<p style='font-family:Helvetica,Arial;font-size:16px;line-height:21px;margin:1em 0;padding:0 1em;color:#E85005'>

<br>
Anyway Saurav, if you need anything just let me know.
</p>
<p style='font-family:Helvetica,Arial;font-size:16px;line-height:21px;margin:1em 0;padding:0 1em'>Thank you for choosing DataBagg. </p>
<p style='font-family:Helvetica,Arial;font-size:16px;line-height:21px;margin:1em 0;padding:0 1em'>
<b>$mname
</b><br>
  Personal Account Manager<br>
 <br />

<br />

</p>
</div>
</td>
</tr>
<tr>


<td valign='top' align='center'>
<img style='max-width:600px'  src='databagg.com/cnfrm_mail/calling.jpg'>
</td>

</tr>
</tbody></table>



<br>



</center><div class='yj6qo'></div><div class='adL'>
</div></div>";
$content.="<br> <br>";

	$mail->SetFrom("support@databagg.com","DATABAGG");
	$mail->Subject  = "Dedicated Manager assigned";
	$mail->MsgHTML($content);

        $mail->AddAddress($mail_id);

	$mail->Send();
	$mail->ClearAllRecipients();
}


mail_data_filled("jnu.saurav@gmail.com","saurav","80%","Chiipa jee");
mail_data_filled("jnu.saurav@gmail.com","saurav","90%","Chiipa jee");
mail_data_filled("jnu.saurav@gmail.com","saurav","95%","Chiipa jee");
mail_data_filled("jnu.saurav@gmail.com","saurav","All","Chiipa jee");
mail_done_hard_work("jnu.saurav@gmail.com","saurav","Chiipa jee");
mail_complete_setup("jnu.saurav@gmail.com","saurav");
mail_dedicated_manager("jnu.saurav@gmail.com","saurav","Chiipa jee");




?>