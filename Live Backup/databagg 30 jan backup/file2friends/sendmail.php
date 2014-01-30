<?php
error_reporting(0);
session_start();
if(function_exists("date_default_timezone_set"))
	date_default_timezone_set("Asia/Calcutta");
	error_reporting(E_ALL);
	ini_set("display_errors",0);
	require_once("PHPMailer/class.phpmailer.php");

  	$mail = new PHPMailer();
	$mail->IsSMTP();  // telling the class to use SMTP
	$mail->SMTPAuth   = true; 
	$mail->SMTPSecure = 'tls';
	$mail->Host     = "103.10.189.48";  // SMTP server
	$mail->Username = "support@databagg.com";
	$mail->Password = "H24!@#IU*&//";

function send_mail($subject,$message,$email)
{
    global $mail;
    $subject = $subject;
    $content = $message;
	//$file = 'images/logo.png';

	$mail->SetFrom("support@databagg.com","DataBaGG");
	$mail->Subject  = $subject;
	$mail->MsgHTML($content);
	
	//$mail->AddAttachment('myfile.csv');      // attachment
	if (isset($_FILES['uploaded_file']) && $_FILES['uploaded_file']['error'] == UPLOAD_ERR_OK) 
	{
		$mail->AddAttachment($_FILES['uploaded_file']['tmp_name'], $_FILES['uploaded_file']['name']);
	}
	
    $mail->AddAddress($email);

	$mail->Send();
    
	$mail->ClearAllRecipients();
    
}

//if(mail_error_query("Test file with attachment","Hello message","pankajkumargrg@gmail.com"))
if(isset($_POST['submit']))
{
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	
	if ($_FILES['email_csv']['size'] > 0)
	{
		//get the csv file
		$csv_file = $_FILES['email_csv']['tmp_name'];
		$csvfile = fopen($csv_file, 'r');
			//loop through the csv file and insert into database
			do 
			{
				if ($data[0]) 
				{
					$email = $data[1];
					send_mail($subject,$message,$email); // call to send_mail function
					$success = true;	
				}
			} 
			while ($data = fgetcsv($csvfile,1000,",","'"));
	}
	
	if($success)
	{
		$_SESSION['message'] = 'success';
		header("location:sendmail.php");
		die;
	}
		
}
?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/validation4sendmail.js"></script>
<style type="text/css">
.error{
	color:#FF0000;
	font-size: 14px;
	font-weight:bold;
}
</style>
<form name="form1" id="form1" action="" enctype="multipart/form-data" method="post">
<table width="400" border="0" cellpadding="5" cellspacing="5" align="center" style="border:1px #CCC solid;">
<?php
if(isset($_SESSION['message']) && $_SESSION['message'] == "success")
{
?>
  <tr>
    <td colspan="2" align="center" style="color:#090"><strong>Sent successfully.</strong></td>
  </tr>
  <?php
  unset($_SESSION['message']);
}
  ?>
  <tr>
    <td colspan="2" align="center"><strong>Send Mail</strong></td>
  </tr>
  <tr>
    <td width="119" valign="top">Choose Email List:</td>
    <td width="244"><input type="file" name="email_csv" id="email_csv"><br>
	<!--Click <a href="emaillist.csv">here</a> to download email format-->
    <span id="emailInfo"></span>
    </td>
  </tr>
  <tr>
    <td width="119" valign="top">Subject:</td>
    <td width="244"><input type="text" name="subject" id="subject" size="30"><br>
    <span id="subjectInfo"></span></td>
  </tr>
  <tr>
    <td width="119" valign="top">Message:</td>
    <td width="244"><textarea name="message" id="message" cols="23"></textarea><br>
    <span id="messageInfo"></span></td>
  </tr>
  <tr>
    <td valign="top">Attach a file:</td>
    <td><input type="file" name="uploaded_file" id="uploaded_file"><br>
    <span id="fileInfo"></span></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="submit" value="Send"></td>
  </tr>
</table>
</form>
