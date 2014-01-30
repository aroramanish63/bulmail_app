<?php
session_start();
error_reporting(0);
include("include/config.php");
include("include/functions.php");

$site_root = $_SERVER['SERVER_NAME'];
if($_POST)
{	
	$errcnt=0;
	if(!get_magic_quotes_gpc())
	{
		$fullname=str_replace("$","\$",addslashes($_POST["firstname"]));
		$email=str_replace("$","\$",addslashes($_POST["email"]));
		$password=str_replace("$","\$",addslashes($_POST["password"]));
	}
	else
	{
		$fullname=str_replace("$","\$",$_POST["firstname"]);
		$email=str_replace("$","\$",$_POST["email"]);
		$password=str_replace("$","\$",$_POST["password"]);
	}
	
	$currentDate = date("Y-m-d H:i:s");
	
	if ( strlen(trim($fullname)) == 0 )
	{
		$errs[$errcnt]="Full name is required field.";
		$errcnt++;
	}
	elseif(preg_match ("/[;<>&]/", $_POST["firstname"]))
	{
		$errs[$errcnt]="Full name can not have any special character (e.g. & ; < >)";
		$errcnt++;
	}
	
	if ( !isset($_POST["email"]) || (strlen(trim($_POST["email"])) == 0) )
	{
		$errs[$errcnt]="Email address is required field.";
		$errcnt++;
	}
	elseif(preg_match ("/[;<>&]/", $_POST["email"]))
	{
		$errs[$errcnt]="Email can not have any special character (e.g. & ; < >)";
		$errcnt++;
	}
	elseif(mysql_num_rows(mysql_query("select * from users_register where email='$email'"))!= 0)
	{
		$errs[$errcnt]="Member with same Email Address already exists.";
		$errcnt++;
	}
	
	if ( !isset( $_POST["password"] ) || (strlen(trim($_POST["password"])) == 0) )
	{
		$errs[$errcnt]="Password is required field.";
		$errcnt++;
	}
	elseif( strcmp($_POST["password"],$_POST["cpassword"]) != 0)
	{
		$errs[$errcnt]="Retyped Password does not match the Password";
		$errcnt++;
	}
	
	if($errcnt==0)
	{
		$password = md5($password);
		$confirmation_code = md5(uniqid(rand())); 
		if(mysql_query("insert into users_register(fullname,email,password,registered_on,varification_code) values('$fullname','$email','$password','$currentDate','$confirmation_code')"))
		{
			$sbq_maxid="select max(id) as max_id from users_register where 1"; // Get the Max id
			$sbrow_maxid=mysql_fetch_array(mysql_query($sbq_maxid));
			$max_id=$sbrow_maxid["max_id"];
			
			$sbq_fullname="select fullname from users_register where id=$max_id";
			$sbrow_fullname=mysql_fetch_array(mysql_query($sbq_fullname));
			$fullname = $sbrow_fullname["fullname"];
			
			$varification_link = $root."/varify.php?uid=$max_id&varify=$confirmation_code";
			
			//$_SESSION['user_id'] = $max_id;
			
			//$from = "support@databagg.com";
			$to = $email;
		 	$subject = "Verify Your Account";
								
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
					  <td style="font-family:Georgia, \'Times New Roman\', Times, serif; color:#333; font-size:22px; font-weight:normal; padding:0 0 5px 0;">Hi <span style="color:#0096cf;">'.$fullname.'</span>
						</td>
					</tr>
					<tr>
					  <td style="font-family:Georgia, \'Times New Roman\', Times, serif; color:#333; font-size:14px; font-weight:normal; padding:10px 0 5px 0;">
						Thank you for registering with DataBagg!  To complete your registration and verify your email address, please click the following link to complete your registration:
						</td>
					</tr>
					<tr>
					  <td style="padding:15px 0 5px 0; text-align:left;"><a href="'.$varification_link.'">'.$varification_link.'</a></td>
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
					  		
			//$header = "From:" . $from . "\r\n" ."Reply-To:". $from  ;
			//$header .= "\r\nMIME-Version: 1.0";
			//$header .= "\r\nContent-type: text/html; charset=iso-8859-1\r\n";
			
		 	//echo "--from:-$from----to:-$to---sub:-$subject----head:-$header----";
			//echo "<pre>$body</pre>";
			//die();
			//mail($to,$subject,$body,$header);
			
			mail_error_query($subject,$body,$to); // Send Mail by PHPMailer
			
			//header("location: login.php?success");
			header("location: registration.php?success");
			die();
		}
		else
		{
			echo "<font color='red'>Sorry!! Some Error Occur. Try Again!</font>";	
		}
	}	
}

?>

<?php
	include("include/header.php");
?>
<!--==== Check Valid Email and Email Availability ===-->
<script type="text/javascript" src="js/checkemail.js"></script>
<!--================ End Check email ================-->

      <!--form right section start here-->
      <div class="form_rightsection">
        <div class="form_topbg"><img src="images/fromtopbg.png" width="772" height="40" alt="#" /></div>
        <div class="form_midbg">
          <div class="form_contentcontainer">
          
      <?php
	 	if(isset($_SESSION['statusmsg']) && $_SESSION['statusmsg']!="")
		{
			echo "<div class=\"successdiv\">".$_SESSION['statusmsg']."</div>";
			unset($_SESSION['statusmsg']);	
		}
		else if(isset($_SESSION['errormsg']) && $_SESSION['errormsg']!="")
		{
			echo "<div class=\"errordiv\">".$_SESSION['errormsg']."</div>";
			unset($_SESSION['errormsg']);	
		}
	  
	  	if(isset($_REQUEST['success']))
		{
			echo "<h1><span>Thank you for registering with DataBagg!</span></h1><br />";
			echo "A link is sent to you at your email address. To verify your account, Please check your Inbox.";
		}
		else
		{
		?>
            <form action="" method="post" id="form_regis" name="form_regis">
                <h1><span>Register a new account</span></h1>
				 <?php
					if($errcnt!=0)
					{
						?>
                        <table style="margin: 10px 0 0 0px; color:#C00">
                        <?php
						for($i=0;$i<$errcnt;$i++)
						{
							echo "<tr><td>".$errs[$i]."</td></tr>";
						}
						?>
						</table>
					<?php	
					}
					?>
                <label>Your Full Name </label>
                <input type="text" name="firstname" id="firstname" value="" class="inputbg" placeholder="Your name" />
                <span id="nameInfo"></span>
                
                <label for="email" id="checkmail">Your Email </label>
                <input type="text" name="email" id="email" value="" class="inputbg" placeholder="Your email" />
                <span id="emailInfo"></span>
                
                <label>Password</label>
                <input type="password" name="password" id="password" value="" class="inputbg" placeholder="Password" />
                <span id="pass1Info"></span>
                
                <label>Confirm Password</label>
                <input type="password" name="cpassword" id="cpassword" value="" class="inputbg" placeholder="Retype password" />
                <span id="pass2Info"></span>
                
                <div style="clear:both;"></div>
                
                <input type="submit" name="submit" class="nextbutton" value=""/>
			</form>
        <?php
		}
		?>
          </div>
        </div>
        <div class="form_topbg"><img src="images/bottombg.png" width="772" height="230" alt="#" /></div>
      </div>
      <!--form right section end here--> 
      
    </div>
  </div>
</div>
</body>
</html>
