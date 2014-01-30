<?php
if(function_exists("date_default_timezone_set"))
	date_default_timezone_set("Asia/Calcutta");
	error_reporting(E_ALL);
	ini_set("display_errors",0);
	require_once("../PHPMailer/class.phpmailer.php");

  	$mail = new PHPMailer();
	$mail->IsSMTP();  // telling the class to use SMTP
	$mail->SMTPAuth   = true; 
	$mail->SMTPSecure = 'tls';
	$mail->Host     = "103.10.189.48";  // SMTP server
	$mail->Username = "support@databagg.com";
	$mail->Password = "H24!@#IU*&//";


function mail_error_query($subject,$message,$email)
{
    global $mail;
    $header  = "MIME-Version: 1.0\r\n";
 	$header .= "Content-type: text/html; charset: utf8\r\n";
    $header .= "from:Team Databagg <team@databagg.com>";
    $subject = $subject;
    $content = $message;

	$mail->SetFrom("support@databagg.com","DataBaGG");
	$mail->Subject  = $subject;
	$mail->MsgHTML($content);

    $mail->AddAddress($email);

	$mail->Send();
    
	$mail->ClearAllRecipients();
    
}

function sendmail($randomstring,$root,$fmail_list){
	$code = $randomstring;
	$sql = "select * from filedata where filecode='$code'";
	$query = mysql_query($sql);
	$row = mysql_fetch_array($query);
	$sendermail  = $row['sendermail'];
	$sentmessage = $row['message'];
	$sqldate = $row['expiry_date'];
	$sqldate_connvrt = strtotime($sqldate);
	
	// subject
	$subject = $sendermail.' sent you a file.';
	
	$basepath = $root;
	
	$expirydate = date('M d,Y \a\t H:i A \I\S\T',$sqldate_connvrt);
	
	$sql1 = "select * from tbl_files where filescode='$code'";
	$query1 = mysql_query($sql1);
	$count_files = mysql_num_rows($query1);
	$file_record = "";
	while($row1 = mysql_fetch_array($query1))
	{
		//$file_record .= "<tr><td><li>".$row1['file_name']."</li></td><td> - ".$row1['file_size']." KB"."</td><td><a href='".$basepath."/shares.php?code=".$code."'>Download</a></td></tr>";
		
		$file_record .= "<tr><td style=\"max-width:200px;\">".$row1['file_name']."</td><td>".$row1['file_size']." KB"."</td><td><div style=\"width:90px; background:#0096CF; color:#FFF; text-align:center; border-radius:5px; padding:5px 0 5px 0;\"><a href='".$basepath."/shares.php?code=".$code."' style=\"color:#fff; text-decoration:none;\">Download</a></div></td></tr>	";	
	}
	
	$message = '<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	
	<body style="background:#fafafa; margin:0; padding:0; font-family:Georgia, \'Times New Roman\', Times, serif;text-align: justify;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:url(https://www.databagg.com/file2friends/images/loginbg.png) #FFF no-repeat; border:1px solid #eaeaea;" >
	  <tr>
		<td><table width="80%" border="0" cellspacing="0" cellpadding="0" align="center" >
			<tr>
			  <td style="text-align:center; padding-top:30px;"><img src="https://www.databagg.com/file2friends/images/logo.png"/></td>
			</tr>
			<tr>
			  <td style="padding-top:50px;">&nbsp;</td>
			</tr>
			<tr>
			  <td style="font-family:Georgia, \'Times New Roman\', Times, serif; color:#333; font-size:22px; font-weight:normal; padding:0 0 5px 0;"><span style="color:#0096cf;">'.$row['sendermail'].'</span> sent you '.$count_files.' file(s)
				</td>
			</tr>
            <tr>
			  <td style="font-family:Georgia, \'Times New Roman\', Times, serif; color:#333; font-size:14px; font-weight:normal; padding:10px 0 5px 0;">
				You have been sent '.$count_files.' file(s) through DataBagg. If you were not expecting to receive any files, please use caution before downloading anything to your computer.
                </td>
			</tr>
			<tr>
			  <td style="padding-top:10px;"><table width="100%" cellpadding="10">
			  '.$file_record.'
			  </table></td>
			</tr>
			<tr>
			  <td style="padding-top:20px;"><strong>Link Expires:-</strong> '.$expirydate.'</td>
			</tr>
			<tr>
			<tr>
			  <td>&nbsp;</td>
			</tr>
            <tr>
			  <td><strong>Message from sender:-</strong></td>
			</tr>
             <tr>
			  <td style="padding:8px 0 5px 0px;">'.$sentmessage.'</td>
			</tr>
            <tr>
			  <td>&nbsp;</td>
			</tr>
			<tr>
			  <td style=" font-size:13px; border-bottom:1px solid #e5e5e5; font-family:Georgia, \'Times New Roman\', Times, serif; color:#333; line-height:22px; padding-bottom:10px"><font style="font-size:16px; color:#0092c6;"> Regards</font> <br />
				Team - Databagg </td>
			</tr>
			<tr>
			  <td ></td>
			</tr>
		  </table></td>
	  </tr>
	  <tr >
		<td ></td>
	  </tr>
	</table>
	</td>
	</tr>
	</table>
	</body>
	</html>
	';
	
	foreach($fmail_list as $key => $value) 
	{
		//mail($value,$subject,$message,$headers);
		mail_error_query($subject,$message,$value); // Here $value is email address
	}
	//die;
}

function sendmailtosender($randomstring,$root,$fmail_list){
	$code = $randomstring;
	$sql = "select * from filedata where filecode='$code'";
	$query = mysql_query($sql);
	$row = mysql_fetch_array($query);
	$sendermail  = $row['sendermail'];
	$sentmessage = $row['message'];
	$sqldate = $row['expiry_date'];
	$sqldate_connvrt = strtotime($sqldate);
	
	// subject
	$subject = 'File Sent Successfully';
	
	$basepath = $root;
	
	$sharelink = $basepath."/shares.php?code=".$code;
	
	$expirydate = date('M d,Y \a\t H:i A \I\S\T',$sqldate_connvrt);
	
	$sql1 = "select * from tbl_files where filescode='$code'";
	$query1 = mysql_query($sql1);
	$file_record = "";
	while($row1 = mysql_fetch_array($query1))
	{
		//$file_record .= "<tr><td><li>".$row1['file_name']."</li></td><td> - ".$row1['file_size']." KB"."</td><td><a href='".$basepath."/shares.php?code=".$code."'>Download</a></td></tr>";
		
		$file_record .= "<tr><td style=\"max-width:200px;\">".$row1['file_name']."</td><td>".$row1['file_size']." KB"."</td></tr>	";	
	}
	
	$email_record = "";
	foreach($fmail_list as $key => $value) 
	{
		$email_record .= "<li>".$value."</li>";
	}
	
	$message = '<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	
	<body style="background:#fafafa; margin:0; padding:0; font-family:Georgia, \'Times New Roman\', Times, serif;text-align: justify;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:url(https://www.databagg.com/file2friends/images/loginbg.png) #FFF no-repeat; border:1px solid #eaeaea;" >
	  <tr>
		<td><table width="80%" border="0" cellspacing="0" cellpadding="0" align="center" >
			<tr>
			  <td style="text-align:center; padding-top:30px;"><img src="https://www.databagg.com/file2friends/images/logo.png"/></td>
			</tr>
			<tr>
			  <td style="padding-top:50px;">&nbsp;</td>
			</tr>
			<tr>
			  <td style="font-family:Georgia, \'Times New Roman\', Times, serif; color:#333; font-size:22px; font-weight:normal; padding:0 0 5px 0;"> Your Transfer has been sent!
				</td>
			</tr>
            <tr>
			  <td style="font-family:Georgia, \'Times New Roman\', Times, serif; color:#333; font-size:14px; font-weight:normal; padding:10px 0 5px 0;">
				Your transfer has been sent to the recipients below. If you chose to receive download notifications, you will be sent an email whenever one of your recipients downloads a file. 
                </td>
			</tr>
            <tr>
			  <td>&nbsp;</td>
			</tr>
            <tr>
			  <td><strong>File Detais:</strong></td>
			</tr>
			<tr>
			  <td style="padding-top:5px;"><table width="100%" cellpadding="5">
			  '.$file_record.'
			  </table></td>
			</tr>
			<tr>
			  <td>&nbsp;</td>
			</tr>
            <tr>
			  <td><strong>Recipients:</strong></td>
			</tr>
			<tr>
			  <td><ul>
			  '.$email_record.'
			  </ul>
			  </td>
			</tr>
			<tr>
			  <td style="padding:15px 0 10px 0;"><strong>Here is a public link to your transfer to share:-</strong></td>
			</tr>
			<tr>
			<tr>
			  <td style="text-align:left;"><a href="'.$sharelink.'">'.$sharelink.'</a></td>
			</tr>
            <tr>
			  <td>&nbsp;</td>
			</tr>
            <tr>
			  <td style="padding-top:20px;"><strong>Link Expires:-</strong> '.$expirydate.'</td>
			</tr>
            <tr>
			  <td>&nbsp;</td>
			</tr>
			<tr>
			  <td style=" font-size:13px; border-bottom:1px solid #e5e5e5; font-family:Georgia, \'Times New Roman\', Times, serif; color:#333; line-height:22px; padding-bottom:10px"><font style="font-size:16px; color:#0092c6;"> Regards</font> <br />
				Team - Databagg </td>
			</tr>
			<tr>
			  <td ></td>
			</tr>
		  </table></td>
	  </tr>
	  <tr >
		<td ></td>
	  </tr>
	</table>
	</td>
	</tr>
	</table>
	</body>
	</html>
	';

	mail_error_query($subject,$message,$sendermail); // Here $sendermail is email address
}

?>