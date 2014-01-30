<?php
session_start();

include("../connect.php");
include("../mail_function.php");
//include ("PHPMailer/class.phpmailer.php");


if(isset($_POST['txt_email']))
{
$email=$_POST['txt_email'];

}

if(isset($_POST['txt_first_name']))
{
$nm=$_POST['txt_first_name'];

}
if(isset($_SESSION['invitedby']))
{
$user=$_SESSION['invitedby'];

}
if(isset($_SESSION['uid']))
{
$rnd_id=$_SESSION['uid'];

}
if(isset($_SESSION['useremail']))
{
$useremail=$_SESSION['useremail'];

}


if(isset($email)!="" && $_SESSION['invitedby']!="")
{




//if not exist

//insert in to tab_members table

// insert in to member_storage table, first time 5 gb

//update  member_storage table, increase size by 1gb each time(for refral)

 $insert_detail="insert into tab_members (txt_first_name,txt_last_name,txt_email,txt_username,txt_usertype,txt_password,int_reg_date,int_verified) 
    values('".mysql_real_escape_string($_REQUEST['txt_first_name'])."','".mysql_real_escape_string($_REQUEST['txt_last_name'])."',
    '".mysql_real_escape_string($_REQUEST['txt_email'])."','".mysql_real_escape_string($_REQUEST['txt_email'])."',
    'free','".mysql_real_escape_string(base64_encode($_REQUEST['txt_password']))."','".time()."','0')";  
     mysql_query($insert_detail) or die(mysql_error());
	 
   mail_welcome($email,$nm);
	
$dest="https://www.databagg.com/refral/verify.php?invitedby=$user&uid=$rnd_id&email=$email&useremail=$useremail";
    $headers = 'From: DATABAGG <team@databagg.com>' . "\r\n";
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$content="<br>";
	 $content.="<body bgcolor='#ABE7FF'>
<div lang='en' style='background:#ABE7FF url(databagg.com/cnfrm_mail/cloud.jpg) repeat;padding:0;margin:0'>
<table width='100%' cellspacing='0' cellpadding='0' border='0'  style='background: url(databagg.com/cnfrm_mail/cloud.jpg) #ABE7FF>
 <tbody><tr>
 <td style='padding:20px 20px 40px'>
 <table width='620' cellspacing='0' cellpadding='0' border='0' align='center'>
 
 <tbody><tr>
 <td align='center' style='padding:0 0 40px'>
 <a target='_blank' style='border:none' title='Databagg.com' href='databagg.com'>
 <img width='550' height='150'  style='vertical-align:top;outline:none;border:none' src='databagg.com/cnfrm_mail/loginlogo.png'>
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
 <p style='font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:10px;color:#999999;line-height:1.35em;margin:0;padding:0'><span>&copy;</span>2013 Databagg <font style='color:#aaa;padding:0 2px'>|</font> All Rights Reserved<br><a target='_blank' style='color:#999;text-decoration:underline' href='https://www.databagg.com/privacy-policy.html'>Privacy Policy</a> <font style='color:#aaa;padding:0 2px'> |</font> <a target='_blank' style='color:#999;text-decoration:underline' href='https://www.databagg.com/features.html'>Features</a></p>
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
	   $mail->IsSMTP();  // telling the class to use SMTP
                    $mail->SMTPAuth   = true; 
	$mail->SMTPSecure = 'tls';
                    $mail->Host     = "103.10.189.48";  // SMTP server
                    $mail->Username="support@databagg.com";
                    $mail->Password="H24!@#IU*&//";

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
        $mail->AddAddress($email);

	$mail->Send();
	$mail->ClearAllRecipients();
	
$msg="Verification email sent to $email. Please verify your account";
 header("Location:https://www.databagg.com/login.php?msg=1");


}

/*elseif($email)
{

//if not exist

//insert in to tab_members table

// insert in to member_storage table, first time 5 gb


 $insert_detail="insert into tab_members (txt_first_name,txt_last_name,txt_email,txt_username,txt_usertype,txt_password,int_reg_date,int_verified) 
    values('".mysql_real_escape_string($_REQUEST['txt_first_name'])."','".mysql_real_escape_string($_REQUEST['txt_last_name'])."',
    '".mysql_real_escape_string($_REQUEST['txt_email'])."','".mysql_real_escape_string($_REQUEST['txt_email'])."',
    'free','".mysql_real_escape_string(base64_encode($_REQUEST['txt_password']))."','".time()."','0')";
    
    mysql_query($insert_detail) or die(mysql_error());

	
$dest="www.databagg.com/refral/verify.php?email=$email";
    $headers = 'From: DATABAGG <team@databagg.com>' . "\r\n";
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$content="<br>";
	 $content.="<body bgcolor='#ABE7FF'>
<div lang='en' style='background:#ABE7FF url(databagg.com/cnfrm_mail/cloud.jpg) repeat;padding:0;margin:0'>
<table width='100%' cellspacing='0' cellpadding='0' border='0'  style='background: url(databagg.com/cnfrm_mail/cloud.jpg) #ABE7FF>
 <tbody><tr>
 <td style='padding:20px 20px 40px'>
 <table width='620' cellspacing='0' cellpadding='0' border='0' align='center'>
 
 <tbody><tr>
 <td align='center' style='padding:0 0 40px'>
 <a target='_blank' style='border:none' title='Databagg.com' href='databagg.com'>
 <img width='550' height='150'  style='vertical-align:top;outline:none;border:none' src='databagg.com/cnfrm_mail/loginlogo.png'>
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
 <p style='font-family:'helvetica neue',helvetica,arial,sans-serif;font-size:10px;color:#999999;line-height:1.35em;margin:0;padding:0'><span>&copy;</span>2013 Databagg <font style='color:#aaa;padding:0 2px'>|</font> All Rights Reserved<br><a target='_blank' style='color:#999;text-decoration:underline' href='https://www.databagg.com/privacy-policy.html'>Privacy Policy</a> <font style='color:#aaa;padding:0 2px'> |</font> <a target='_blank' style='color:#999;text-decoration:underline' href='https://www.databagg.com/features.html'>Features</a></p>
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
	$mail->IsSMTP(true);  // telling the class to use SMTP
	$mail->SMTPSecure = 'tls';
                    $mail->Host     = "103.10.189.48";  // SMTP server
                    $mail->Username="support@databagg.com";
                    $mail->Password="H24!@#IU*&//";

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
        $mail->AddAddress($email);

	$mail->Send();
	$mail->ClearAllRecipients();
	
	//header("Location:https://databagg.com/user/nindex.php");
     $msg="Verification email sent to $email. Please verify your account";

}*/


 ?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Databagg</title>

<link href='https://fonts.googleapis.com/css?family=PT+Sans:400' rel='stylesheet' type='text/css'>
 <link href="../App_Theme/newstyle.css" rel="stylesheet" type="text/css" />
 <link href="../App_Theme/help.css" rel="stylesheet" type="text/css" />
     <!--[if IE 7]>
<link rel="stylesheet" href="../App_Theme/ie7.css" type="text/css" media="screen"/>
<![endif]-->

<!--[if IE 8]>
<link rel="stylesheet" href="../App_Theme/ie8.css" type="text/css" media="screen"/>
<![endif]-->

</head>
<body>
<div class="invitewrapper">
       <div class="mid_container">

  
    <div class="form_outoor">
    
    <!--form left section start here-->
    <div class="form_leftcontent2">
    <div class="createaccount_logo"><a href="../user/nindex.php"> <img width="298" height="114" alt="#" src="../images/sign_logo.jpg"></a></div>
    <div class="feature-text">
<h3>Features of Our Free Account</h3>

<ul>
<li><span><img src="images/help/user.png" alt=""></span>1 User</li>
<li><span><img src="images/help/webstorage.png" alt=""></span>5 GB+ of web-storage</li>
<li><span><img src="images/help/filesize.png" alt=""></span>2 GB file size limit</li>
<li><span><img src="images/help/sync.png" alt=""></span>Sync desktop files</li>
<li><span><img src="images/help/sharing.png" alt=""></span>Simple sharing and collaboration </li>
</ul>

</div>

<div class="callus">
<span>Need help deciding? Call</span> <br>
1-888-885-4570
</div>

<div class="mailus">
<span>MAIL TO </span><br>
<a href="mailto:sales@databagg.com">sales@databagg.com</a>
</div>
    <!--<div class="form_social"><a href="#"><img src="images/login-fb.jpg" width="201" height="41" alt="#" /></a></div>
     <div class="form_social"><a href="#"><img src="images/login-twitter.jpg" width="201" height="41" alt="#" /></a></div>-->
     </div>
    <!--form left section end here-->
    
    <script src="../user/js/jquery.js" type="text/javascript"></script>
  <style>
     div.hint {
	font-family: 'PT Sans', sans-serif;
	font-size:14px;
	
	background:url(../images/errorbg.jpg) repeat-x #3d85a5;
	color:#FFF;
	position:absolute;
	
	text-align:center;
     border: 2px solid #FFF;
	padding:10px 5px 10px 10px;
	min-width:200px;
	
	margin: 10px 0 0 210px;
	display:none;
   box-shadow:0 0 5px #9a9a9a;
}
div.hint1 {
	font-family: 'PT Sans', sans-serif;
	font-size:14px;
	
	background:url(../images/errorbg.jpg) repeat-x #3d85a5;
	color:#FFF;
	position:absolute;
	
	text-align:center;
     border: 2px solid #FFF;
	padding:10px 5px 10px 10px;
	min-width:200px;
	position:absolute;
	margin: 0px 0 0 210px;
	display:none;
    box-shadow:0 0 5px #9a9a9a;
}
div.hint2 {
		font-family: 'PT Sans', sans-serif;
	font-size:14px;
	
	background:url(../images/errorbg.jpg) repeat-x #3d85a5;
	color:#FFF;
	position:absolute;
	
	text-align:center;
     border: 2px solid #FFF;
	padding:10px 5px 10px 10px;
	min-width:200px;
	position:absolute;
	margin: 70px 0 0 210px;
	display:none;
     box-shadow:0 0 5px #9a9a9a;
}
div.hint3 {
		font-family: 'PT Sans', sans-serif;
	font-size:14px;
	
	background:url(../images/errorbg.jpg) repeat-x #3d85a5;
	color:#FFF;
	position:absolute;
	
	text-align:center;
     border: 2px solid #FFF;
	padding:10px 5px 10px 10px;
	min-width:200px;
	position:absolute;
	margin: 130px 0 0 210px;
	display:none;
     box-shadow:0 0 5px #9a9a9a;
}
.arrow-left {
   /* border-bottom: 10px solid transparent;
    border-right: 10px solid #4089a8;
    border-top: 10px solid transparent;*/
	background:url(../images/arrowbg.png) no-repeat left;
	width:13px;
	height:17px;
   float:left;
   position:absolute;
   top:10px;
   left:7px;
	margin:0 0 0 -20px;
}

     </style>   
<!--Form right section start here-->
<div style="width: 470px;" class="form_right">
     <h1>CREATE AN ACCOUNT</h1>
        <form name="frm" id="frm" action="/registration.php" method="post">
       <div class="formrows">
        <center>

</center>
<input type="text" id="txt_first_name" name="txt_first_name"  class="inputfirst" value="First Name" onFocus="checkEmptyValue(this,'First Name')" />
  
 <center>

</center>

 <input type="text" id="txt_last_name" name="txt_last_name"  class="inputlastname" value="Last Name" onFocus="checkEmptyValue(this,'Last Name')" />

 </div>
 <div id="error_fname"  class="hint">
 <div class="arrow-left"></div>Please enter your first name.
</div>
<div id="error_lname"  class="hint1">
<div class="arrow-left"></div>Please enter your last name.
</div>
 <div class="formrows">
  <input type="text" id="txt_email" name="txt_email" class="emailinput" value="Email Address" onFocus="checkEmptyValue(this,'Email Address')" /></div>
 <div id="error_email"  class="hint2">
<div class="arrow-left"></div>Please enter your email address
</div>

 
 <div class="formrows-content">
 
    <input type="password" id="txt_password" name="txt_password" onKeyPress="if(event.keyCode==13) {validate();}" value="Your Password"  onfocus="checkEmptyValue(this,'Your Password')"
 class="passinput" />
 </div>
 <center>
<div id="error_password" class="hint3">
<div class="arrow-left"></div>Please enter a password.
</div>
</center>

 <div class="formrows-content">
<div class="submit-lchre-help"><span><input name="" id="check_agreement" type="checkbox"  value="" checked="checked" /></span> <span> I agree to the <a href="privacy-policy.php"><strong>Data Bagg Policy</strong></a><strong></strong></span> </div></div>


 <div class="submit-but"><img src="images/signin.png" width="151" height="56" alt="" onClick="validate();" style="cursor: pointer;" /></div>

    </form>
     
     <div class="form_image"><img src="../images/trutee.jpg" width="223" height="76" alt="#" /></div>
     </div>
<!--Form right section end here-->
  </div>
	
    <div style="clear:both"></div>
    
    <div class="footer-login">
<div class="footer-loginleft">
<div class="footerlogin_logo"><img src="../images/loginfooter-logo.jpg"  alt="#" /></div>
<div class="footerlogin-message">Already have an account? <strong><a href="https://www.databagg.com/login.php">Sign in</a></strong></div>

</div>

<div class="footerlogin_right">
<div class="connect-img"><img src="../images/connecttext.jpg" width="165" height="61" alt="#" /></div>
<ul class="social_link">

<li><a href="https://www.facebook.com/Databagg" target="_blank"><img src="images/facebook.png" width="30" height="30" alt="#" /></a></li>
<li><a href="https://plus.google.com/117226672667714086519/posts?hl=en-GB" target="_blank"><img src="images/gplus.png" width="30" height="30" alt="#" /></a></li>
<li><a href="https://twitter.com/DataBagg" target="_blank"><img src="images/twitter.png" width="30" height="30" alt="#" /></a></li>
<li><a href="https://in.linkedin.com/pub/databagg/62/9b4/570" target="_blank"><img src="images/in.png" width="30" height="30" alt="#" /></a></li>


</ul>
</div>


</div>
      
</div>

</div>
















</body>
</html>








<script>

function checkEmptyValue(obj,defval)
	{
	if(obj.value.toLowerCase()==defval.toLowerCase())
		obj.value="";
	else
		obj.select()
	}
    
function specialcharecter(val)
{
re = /^[A-Za-z]+$/;
if(re.test(val))
{
return true;
}
else
{
return false;

}

}
//function specialcharecter(val)
//
//            {
//                val=val.toLowerCase();
//
//                var iChars = "abcdefghijklmnopqrstuvwxyz";   
//
//                var data = val;
//
//                for (var i = 0; i < data.length; i++)
//
//                {      
//
//                    if (iChars.indexOf(data.charAt(i)) != -1)
//
//                    {    
//
//                     return false; 
//
//                    } 
//
//                }
//                return true;
//
//            }
            
            function specialcharecterforemail(val)

            {
                
                var ck_email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i 
                if (!ck_email.test(val)) 
                return false;
                else
                return true

              //  var iChars = "!`#$%^&*()+=-[]\\\';,/{}|\":<>?~";   
//
//                var data = val;
//
//                for (var i = 0; i < data.length; i++)
//
//                {      
//
//                    if (iChars.indexOf(data.charAt(i)) != -1)
//
//                    {    
//
//                     return false; 
//
//                    } 
//
//                }
//                return true;

            }
function trim_string_str(str1) {
     var ichar, icount;
     var strValue = str1
     ichar = strValue.length - 1;
     icount = -1;
     while (strValue.charAt(ichar)==' ' && ichar > icount)
         --ichar;
     if (ichar!=(strValue.length-1))
         strValue = strValue.slice(0,ichar+1);
     ichar = 0;
     icount = strValue.length - 1;
     while (strValue.charAt(ichar)==' ' && ichar < icount)
         ++ichar;
     if (ichar!=0)
         strValue = strValue.slice(ichar,strValue.length);
     return strValue;
 }
function validate()
{
    $( '#error_fname' ).animate({"left":"-150px"}, "slow");
    $( '#error_lname' ).animate({"left":"-150px"}, "slow");
    $( '#error_email' ).animate({"left":"-150px"}, "slow");
    $( '#error_password' ).animate({"left":"-150px"}, "slow");
    document.getElementById("error_fname").style.display='none';
    document.getElementById("error_lname").style.display='none';
    document.getElementById("error_email").style.display='none';
    document.getElementById("error_password").style.display='none';
   
    if(trim_string_str(document.getElementById("txt_first_name").value)=="First Name")
    {
        document.getElementById("txt_first_name").value="";
        
    }
    
    if(trim_string_str(document.getElementById("txt_first_name").value)=="")
    {
        //document.getElementById("error_fname").style.display='block';
      
       $('#error_fname').fadeIn('slow');
       $( '#error_fname' ).animate({"left":"150px"}, "slow");
        document.getElementById("txt_first_name").focus();
        return false;
    }
    if(!specialcharecter(document.getElementById("txt_first_name").value))
    {
         //document.getElementById("error_fname").style.display='block';
         $('#error_fname').fadeIn('slow');
         $( '#error_fname' ).animate({"left":"150px"}, "slow");
         document.getElementById("error_fname").innerHTML="<div class='arrow-left'></div>Please enter alphabetic characters only."
        document.getElementById("txt_first_name").focus();
        return false;
    }
    
    if(trim_string_str(document.getElementById("txt_first_name").value).length>25  )
    {
      
     $('#error_fname').fadeIn('slow');
     $( '#error_fname' ).animate({"left":"150px"}, "slow");
         document.getElementById("error_fname").innerHTML="<div class='arrow-left'></div>First name must be less than 25 characters.";
        document.getElementById("txt_first_name").focus();
        return false;
    }
     if(trim_string_str(document.getElementById("txt_last_name").value)=="Last Name")
    {
        document.getElementById("txt_last_name").value="";
        
    }
    
     if(trim_string_str(document.getElementById("txt_last_name").value)=="")
    {
        //document.getElementById("error_lname").style.display='block';
        $('#error_lname').fadeIn('slow');
        $( '#error_lname' ).animate({"left":"150px"}, "slow");
        document.getElementById("txt_last_name").focus();
        return false;
    }
    
     if(!specialcharecter(document.getElementById("txt_last_name").value))
    {
         //document.getElementById("error_lname").style.display='block';
          $('#error_lname').fadeIn('slow');
           $( '#error_lname' ).animate({"left":"150px"}, "slow");
         document.getElementById("error_lname").innerHTML="<div class='arrow-left'></div>Please enter alphabetic characters only.";
        document.getElementById("txt_last_name").focus();
        return false;
    }
    
     if(trim_string_str(document.getElementById("txt_last_name").value).length>25  )
    {
      
      $('#error_lname').fadeIn('slow');
       $( '#error_lname' ).animate({"left":"150px"}, "slow");
         document.getElementById("error_lname").innerHTML="<div class='arrow-left'></div>Last name must be less than 25 characters.";
        document.getElementById("txt_last_name").focus();
        return false;
    }
    if(trim_string_str(document.getElementById("txt_email").value)=="")
    {
         $('#error_email').fadeIn('slow');
         $( '#error_email' ).animate({"left":"150px"}, "slow");
        //document.getElementById("error_email").style.display='block';
        document.getElementById("txt_email").focus();
        return false;
    }
     if(trim_string_str(document.getElementById("txt_email").value)!="")
    {
        var x=document.getElementById("txt_email").value;
        var atpos=x.indexOf("@");
        var dotpos=x.lastIndexOf(".");
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
             {
                 $('#error_email').fadeIn('slow');
                  $( '#error_email' ).animate({"left":"150px"}, "slow");
                //document.getElementById("error_email").style.display='block';
                document.getElementById("error_email").innerHTML="<div class='arrow-left'></div>Please enter a valid email address.";
              document.getElementById("txt_email").focus();
                return false;
             }
    }
    if(!specialcharecterforemail(document.getElementById("txt_email").value))
    {
          $('#error_email').fadeIn('slow');
           $( '#error_email' ).animate({"left":"150px"}, "slow");
         //document.getElementById("error_email").style.display='block';
         document.getElementById("error_email").innerHTML="<div class='arrow-left'></div>Please enter a valid email address."
        document.getElementById("txt_email").focus();
        return false;
    }
  
    if(trim_string_str(document.getElementById("txt_password").value)=="Your Password")
    {
        document.getElementById("txt_password").value="";
        
    }
    
    
    
    if(trim_string_str(document.getElementById("txt_password").value)=="")
    {
        $('#error_password').fadeIn('slow');
        $( '#error_password' ).animate({"left":"150px"}, "slow");
        document.getElementById("error_password").style.display='block';
        document.getElementById("txt_password").focus();
        return false;
    }
     if(trim_string_str(document.getElementById('txt_password').value).length<8 || trim_string_str(document.getElementById('txt_password').value).length>21 )
    {
      
     $('#error_password').fadeIn('slow');
     $( '#error_password' ).animate({"left":"150px"}, "slow");
    document.getElementById('error_password').innerHTML="<div class='arrow-left'></div>Please enter a password between 8 and 20 characters.";
    
        document.getElementById("txt_password").focus();
        return false;
    
       }
    if(document.getElementById("check_agreement").checked==false)
    {
        alert("Please agree to the terms of service");
        document.getElementById("check_agreement").focus();
        return false;
    }
    if(trim_string_str(document.getElementById("txt_email").value)!="")
    {
       check_email(document.getElementById("txt_email").value);
    }
    
}
function validatemail()
{

}
</script>
<script>
	var xmlhttp;
function testXML(){

	if(window.XMLHttpRequest)
  {
	//code for IE7 and hiegher version
	xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=ActiveXObject("Microsoft.XMLHTTP");
	}
return xmlhttp;	
}

function check_email(str)
{
		var strURL="../ajax_email_check.php?add="+str;
   // alert(strURL);
		var req = testXML();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					
					// only if "OK"
					if (req.status == 200) {
					
						
                        if(req.responseText.match(/failed/gi))
                        {
                            //alert(req.responseText);
                        //document.getElementById("error_email").style.display='block';
                        $('#error_email').fadeIn('slow');
                          $( '#error_email' ).animate({"left":"150px"}, "slow");
                         document.getElementById("error_email").innerHTML="Email already exists."; 
                        document.getElementById('txt_email').focus();
                        return false;
                        
                        }
                        else
                        {
                            document.frm.submit();
                            document.getElementById("error_fname").style.display='none';
                            document.getElementById("error_lname").style.display='none';
                            document.getElementById("error_email").style.display='none';
                            document.getElementById("error_password").style.display='none';
                            document.getElementById('long_pass').style.display="none";
                        }
                       				
						
					} else {
					//	alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	
}


</script>