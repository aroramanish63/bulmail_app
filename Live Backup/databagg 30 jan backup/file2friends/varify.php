<?php
error_reporting(0);
session_start();
include("include/config.php");
include("include/functions.php");
if(isset($_REQUEST['uid']) && !empty($_REQUEST['uid']) && isset($_REQUEST['varify']) && !empty($_REQUEST['varify']))
{
	$uid = $_REQUEST['uid'];
	$varification_code = $_REQUEST['varify'];
	//echo "select * from users_register where id=$userid and varification_code='$varification_code'";
	$file_data_row = mysql_fetch_array(mysql_query("select * from users_register where id=$uid and varification_code='$varification_code'"));
	$userid = $file_data_row['id'];
	$useremail = $file_data_row['email'];
	if($file_data_row)
	{
		if(mysql_query("update users_register set status='1', varification_code='' where id=$userid"))
		{
			$_SESSION['user_id'] = $userid;
			$_SESSION['user_email'] = $useremail;
			$_SESSION['statusmsg'] = "Thank You!! Your account has been activated, now process the following step.";
			
			$to = $useremail;
		 	$subject = "Registration Successfull.";
								
			$body = '<html>
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
						  <td style="font-family:Georgia, \'Times New Roman\', Times, serif; color:#333; font-size:22px; font-weight:normal; padding:0 0 5px 0;">Welcome to <span style="color:#0096cf;">DataBagg</span>
							</td>
						</tr>
						<tr>
						  <td style="font-family:Georgia, \'Times New Roman\', Times, serif; color:#333; font-size:14px; font-weight:normal; padding:10px 0 5px 0;">
							The fastest and easiest way to send large files to anyone.<br><br>
			Thank you for signing up with DataBagg!  As a user of DataBagg, you have access to our secure DataBagg website for sending files that are too large to email. From DataBagg, you can:
							</td>
						</tr>
						<tr>
						  <td style="padding:10px 0 5px 0; text-align:left;"><ul>
						  <li>Customization</li>
						  <li>5 GB Transfers </li>
						  <li>No File Expiration</li> 
						  <li>File History</li>
						  <li>Your Own Domain</li>
						  </ul></td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						</tr>
						 <tr>
						  <td style="padding:5px 0 5px 0px;">If you have any questions, contact us at support@databagg.com</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						</tr>
						 <tr>
						  <td>Welcome to DataBagg!</td>
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
				</html>';
			
			mail_error_query($subject,$body,$to); // Send Mail by PHPMailer
			
			header("location: payment.php");
			die();
		}
	}
	else
	{
		$_SESSION['errormsg'] = "The url is either invalid or you already have activated your account.";
		header("location: registration.php");
		die();	
	}
}
?>