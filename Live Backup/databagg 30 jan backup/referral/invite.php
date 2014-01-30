<?php
error_reporting(0);
session_start();

if(!$_SESSION['user_id'])
header("Location:../login.php");

include("../connect.php");
$message="";
$fspace=1024;
if($_REQUEST['txt_first_name'])
{
$random_id_length = 20; 
$rnd_id = crypt(uniqid(rand(),1)); 
$rnd_id = strip_tags(stripslashes($rnd_id)); 
$rnd_id = str_replace(".","",$rnd_id); 
$rnd_id = strrev(str_replace("/","",$rnd_id)); 
$rnd_id = substr($rnd_id,0,$random_id_length); 


$fname=mysql_real_escape_string(ucfirst($_POST['txt_first_name']));
$lname=mysql_real_escape_string(ucfirst($_POST['txt_last_name']));
$email=mysql_real_escape_string($_POST['txt_email']);
$user=$_SESSION['user_id'];
$invitedby=mysql_fetch_array(mysql_query("select txt_first_name,txt_email from tab_members where int_id='".$user."'"));
$referdby=ucfirst($invitedby['txt_first_name']);
$refemail=$invitedby['txt_email'];

$count=mysql_num_rows(mysql_query("select txt_first_name from tab_members where txt_email='".$email."'"));
if($count<1)
{
$query=mysql_query("select fname from  invititation where email='".$email."' and invitedby='".$user."'");
$num=mysql_num_rows($query);
if($num<1)
{

$sql="INSERT INTO invititation  (
`id` ,
`invitedby` ,
`fname` ,
`lname` ,
`email` ,
`uid` ,
`free_space` ,
`uid_isused`
)
VALUES (
NULL , '".$user."' , '".$fname."' , '".$lname."' , '".$email."' , '".$rnd_id."' , '".$fspace."' , '0'
)";

mysql_query($sql);
require 'PHPMailer/class.phpmailer.php';
$body= <<<EOF
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Databagg</title>

<style type="text/css">
body{padding:0px; margin:0px; font-size:12px; color:#666;}
a{ color:#159fc7;}
</style>


</head>

<body>

<table width="650" height="636" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td background="https://databagg.com/Newsletter/images/newsletter-bg.jpg" valign="top">
    
    
    <table width="470" border="0" cellspacing="0" cellpadding="5" align="center">
    <tr>
    <td>&nbsp;</td>
  </tr>
     <tr>
    <td>&nbsp;</td>
  </tr>
     <tr>
    <td>&nbsp;</td>
  </tr>
     <tr>
    <td>&nbsp;</td>
  </tr>
     <tr>
    <td>&nbsp;</td>
  </tr>


  <tr>
    <td><font color="#159fc7" size="4" face="Arial, Helvetica, sans-serif">Hi  $fname,</font></td>
  </tr>
  <tr>
    <td>$referdby has recommended DataBagg for you and has invited you to get absolutely FREE 5GB storage right now.</td>
  </tr>
  <tr>
    <td>$referdby already uses DataBagg to store pictures, images, documents and every type of digital data under one roof. Once uploaded on DataBagg, your digital data can be accessed from anywhere and everywhere!</td>
  </tr>
  <tr>
    <td>Sign up today with DataBagg using the below link, and both you and <referral> will get an additional 1 GB storage, absolutely free!<br>
    <a href="https://www.databagg.com/refral/accept_invite.php?invitedby=$user&uid=$rnd_id&useremail=$email" style=" font-size:16px; ">Accept Invitation</a></td>
  </tr>
  
  <tr>
    <td>In case you have issues related with the usage of DataBagg, please feel free to mail us at support@databagg.com.</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>With Best Regards,</strong><br />
Team DataBagg
</td>
  </tr>
</table>

    
    
    
    </td>
  </tr>
</table>


</body>
</html>
EOF;
$mail = new PHPMailer();

   $mail->IsSMTP(true);  // telling the class to use SMTP
	$mail->SMTPSecure = 'tls';
                    $mail->Host     = "103.10.189.48";  // SMTP server
                    $mail->Username="support@databagg.com";
                    $mail->Password="H24!@#IU*&//";


$mail->SetFrom("support@databagg.com","Databagg Team");



$mail->AddAddress($email);
$mail->Subject  =  "Invitation from Databagg";
//$mail->SMTPDebug = 2;
$mail->IsHTML(true);
$mail->Body     = $body;
$mail->WordWrap = 50;

$mail->Send();


$bodyw= <<<EOF
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Databagg</title>

<style type="text/css">
body{padding:0px; margin:0px; font-size:12px; color:#666;}
a{ color:#159fc7;}
</style>
</head>

<body>

<table width="650" height="636" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td background="https://databagg.com/Newsletter/images/newsletter-bg.jpg" valign="top">
    
    
    <table width="470" border="0" cellspacing="0" cellpadding="5" align="center">
    <tr>
    <td>&nbsp;</td>
  </tr>
     <tr>
    <td>&nbsp;</td>
  </tr>
     <tr>
    <td>&nbsp;</td>
  </tr>
     <tr>
    <td>&nbsp;</td>
  </tr>
     <tr>
    <td>&nbsp;</td>
  </tr>


  <tr>
    <td><font color="#159fc7" size="4" face="Arial, Helvetica, sans-serif">Dear $referdby,</font></td>
  </tr>
  <tr>
    <td>We have successfully sent DataBagg  invitation to $fname.</td>
  </tr>
  <tr>
    <td><p>You can track the status of your referral here:</p>
      <p>My Setting >Bonus Space </p></td>
  </tr>
  <tr>
    <td>Once successfully accepted, you will receive absolutely FREE 1 GB of space on your DataBagg account.</td>
  </tr>
  
  <tr>
    <td><p>Keep referring and keep getting FREE space!</p></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>With Best Regards,</strong><br />
Team DataBagg
</td>
  </tr>
</table>

    
    
    
    </td>
  </tr>
</table>


</body>
</html>
EOF;
$mailw = new PHPMailer();
$mailw->IsSMTP(true);  // telling the class to use SMTP
	$mail->SMTPSecure = 'tls';
                    $mail->Host     = "103.10.189.48";  // SMTP server
                    $mail->Username="support@databagg.com";
                    $mail->Password="H24!@#IU*&//";

$mailw->SetFrom("support@databagg.com","Databagg Team");
$mailw->AddAddress($refemail);
$mailw->Subject  =  "Thank you for your referral – DataBaGG is proud of you!";
//$mail->SMTPDebug = 2;
$mailw->IsHTML(true);
$mailw->Body     = $bodyw;
$mailw->WordWrap = 50;

$mailw->Send();




if($mail->Send())
{
$message="invitation  sent";
}
}
else
{ $message="$referdby has gifted you 5GB FREE storage on DataBaGG";}

}
else
{ $message="Already Registered";}


}
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
     <head>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
     <title>Databagg</title>
     <link href='https://fonts.googleapis.com/css?family=PT+Sans:400' rel='stylesheet' type='text/css'>
     <link href="../App_Theme/newstyle.css" rel="stylesheet" type="text/css" />
     <link href="App_Theme/help.css" rel="stylesheet" type="text/css" />
     <!--[if IE 7]>
<link rel="stylesheet" href="../App_Theme/ie7.css" type="text/css" media="screen"/>
<![endif]-->

<!--[if IE 8]>
<link rel="stylesheet" href="../App_Theme/ie8.css" type="text/css" media="screen"/>
<![endif]-->
     <script src="../user/js/jquery.js" type="text/javascript"></script>

     </head>
     <body>
<div class="invitewrapper">
       <div class="mid_container">
    <div class="form_outoor">
    	
        <!--Refferal left content start here-->
        <div class="form_leftcontent2">
    <div class="createaccount_logo"><a href="../user/nindex.php"> <img src="../images/sign_logo.jpg" width="298" height="114" alt="#" /></a></div>
    <div class="inviteleft-content">Here is your chance to get free storage from DataBaGG!</div>
    <div class="invite_heading">
    <h2>
    On every successful invitation,
you get <br /><span>1 GB</span><br /> of free storage
from DataBaGG.
    </h2>
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
        <!--refferal left content end here-->
        
        
        <!--refferal right form section start here-->
        <div class="form_right">
       <h1>DATABAGG INVITATION</h1>
         <?php if($message!=""){ ?>
            <p style="background: #90ad0f; height:30px; margin-bottom:10px; position:absolute; top:-43px; left:0; font-size:13px; font-weight:bold;  text-align:center; padding-top:8px; color:#FFF; font-family: 'PT Sans', sans-serif; width:420px; font-size:15px;"><?php echo $message; ?> </p>
            <?php } ?>
            
            
           <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="frm" name="frm">
       <div class="formrows">
        <center>
<span style="display: none; top:0px; left:0px;" class="login_error" id="error_fname">
 <div class="arrow-left"></div>Enter first name
</span>
</center>
<input type="text" id="txt_first_name" name="txt_first_name" class="inputfirst" value="First Name"  onfocus="this.select()" class="rightinput-help" <?php if($_REQUEST['txt_first_name']!=""){ ?> value="<?php  echo $_REQUEST['txt_first_name'];  ?>" <?php } ?>  />
 
 <center>
<span style="display: none;top:0px; left:175px;" class="login_error" id="error_lname">
<div class="arrow-left"></div>Enter last name
</span>
</center>
 <input type="text" id="txt_last_name" value="Last Name" name="txt_last_name" class="inputlastname"   onfocus="this.select()" class="rightinput-help" <?php if($_REQUEST['txt_last_name']!=""){ ?> value="<?php echo $_REQUEST['txt_last_name'];  ?>" <?php } ?> />


 </div>
 <div class="formrows">
 <input type="text" id="txt_email" name="txt_email" value="Email Address" class="emailinput"  onFocus="this.select()" class="rightinput-help" <?php if($_REQUEST['txt_email']!=""){ ?> value="<?php echo $_REQUEST['txt_email'];  ?>" <?php } ?> />
  
 
 <center>
<span style="display:none; top:94px; left:53px;" class="login_error2" id="error_email">
<div class="arrow-left"></div>Enter your email
</span>
</center>
 <input type="button" class="invitebutton" onclick="return validate()" />
 

    </form>
     <div class="form_image"><img src="../images/trutee.jpg" width="223" height="76" alt="#" /></div>
            
        </div>
        <!--refferal right form section end here-->
        
     
     
    
    </div>
    <div style="clear:both"></div>
    <div class="footer-login">
<div class="footer-loginleft">
<div class="footerlogin_logo"><img alt="#" src="../images/loginfooter-logo.jpg"></div>
<div class="footerlogin-message">Go to <strong><a href="../user/nindex.php">Control Panel</a></strong></div>

</div>

<div class="footerlogin_right">
<div class="connect-img"><img width="165" height="61" alt="#" src="../images/connecttext.jpg"></div>
<ul class="social_link">

<li><a target="_blank" href="https://www.facebook.com/Databagg"><img width="30" height="30" alt="#" src="images/facebook.png"></a></li>
<li><a target="_blank" href="https://plus.google.com/117226672667714086519/posts?hl=en-GB"><img width="30" height="30" alt="#" src="images/gplus.png"></a></li>
<li><a target="_blank" href="https://twitter.com/DataBagg"><img width="30" height="30" alt="#" src="images/twitter.png"></a></li>
<li><a target="_blank" href="https://in.linkedin.com/pub/databagg/62/9b4/570"><img width="30" height="30" alt="#" src="images/in.png"></a></li>


</ul>
</div>


</div>
  </div>
     </div>

     <style>
.login_error {
	font-family: 'PT Sans', sans-serif;
	font-size:14px;
	
	background:url(../images/errorbg.jpg) repeat-x #3d85a5;
	color:#FFF;
	position:absolute;
	
	text-align:center;
     border: 2px solid #FFF;
	padding:10px 5px 10px 10px;
	min-width:200px;
	
	margin: 60px 0 0 200px;
	display:none;
   box-shadow:0 0 5px #9a9a9a;
}

.login_error2 {
	font-family: 'PT Sans', sans-serif;
	font-size:14px;
	
	background:url(../images/errorbg.jpg) repeat-x #3d85a5;
	color:#FFF;
	position:absolute;
	
	text-align:center;
     border: 2px solid #FFF;
	padding:10px 5px 10px 10px;
	min-width:250px;
	
	margin: 60px 0 0 200px;
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
</body>
</html>
<script>
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
    
    document.getElementById("error_fname").style.display='none';
    document.getElementById("error_lname").style.display='none';
    document.getElementById("error_email").style.display='none';
   
   
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
  
    
    
    
    
    if(trim_string_str(document.getElementById("txt_email").value)!="")
    {
       check_email(document.getElementById("txt_email").value);
    }
	document.frm.submit();
    
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