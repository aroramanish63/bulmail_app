<?php
function mail_first_sync($mail_id,$name,$pc)
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
DataBagg has just completed your first data backup.</h2>


<p style='font-family:Helvetica,Arial;font-size:16px;line-height:21px;margin:1em 0;padding:0 1em'>
$name , note here that we can only take the back-up of the folder which has been synchronized on DataBagg. If you wish to take back-up of more data,<br> then synchronize more folders on our platform. 

</p>

<p style='font-family:Helvetica,Arial;font-size:16px;line-height:21px;margin:1em 0;padding:0 1em;color:#E85005'>
To view all the files which have been backed-up on $name-$pc, just login to your online control panel. 

Control Panel: <a target='_blank' style='color:#db3c6e;text-decoration:none' href='http://www.databagg.com/login.php'>Click Here</a>

</p>

<p style='font-family:Helvetica,Arial;font-size:16px;line-height:21px;margin:1em 0;padding:0 1em'>

Remember to download the free DataBagg mobile apps as well!
<br><br>
If you have any questions related with DataBagg, please don’t hesitate. contact <a target='_blank' style='color:#db3c6e;text-decoration:none' href='mailto:support@databagg.com'>support@databagg.com</a> and our friendly support team will assist you.

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
	$mail->Subject  = "Congratulations! Your Backup Is Complete..";
	$mail->MsgHTML($content);

        $mail->AddAddress($mail_id);

	$mail->Send();
	$mail->ClearAllRecipients();
}


function mail_download_databagg($em_enc,$nm)
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
<b>Ravish Sharma
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
   
  

	$mail->SetFrom("support@databagg.com","DATABAGG");
	$mail->Subject  = "Thank you for downloading DataBagg";
    //$mail->AddAttachment('DataBagg-Quick-Start.pdf','DataBagg-Quick-Start.pdf');
	$mail->MsgHTML($content);
    
        $mail->AddAddress($em_enc);

	$mail->Send();
	$mail->ClearAllRecipients();
    
       //$mail_id="jnu.saurav@gmail.com";
       // mail($em_enc, $subject, $content, $header);

}

?>