<?php
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

$sql="INSERT INTO `databagg_data`.`invititation` (
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
    <td background="http://databagg.com/Newsletter/images/newsletter-bg.jpg" valign="top">
    
    
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
    <a href="http://www.databagg.com/refral/accept_invite.php?invitedby=$user&uid=$rnd_id&useremail=$email" style=" font-size:16px; ">Accept Invitation</a></td>
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
$mail->IsSMTP();  // telling the class to use SMTP
$mail->SMTPAuth   = false; 
$mail->Host     = "192.168.100.7"; // SMTP server
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
    <td background="http://databagg.com/Newsletter/images/newsletter-bg.jpg" valign="top">
    
    
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
$mailw->IsSMTP();  // telling the class to use SMTP
$mailw->SMTPAuth   = false; 
$mailw->Host     = "192.168.100.7"; // SMTP server
$mailw->SetFrom("support@databagg.com","Databagg Team");
$mailw->AddAddress($refemail);
$mailw->Subject  =  "Thank you for your referral – DataBagg is proud of you!";
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
{ $message="$referdby has gifted you 5GB FREE storage on DataBagg";}

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

<link href='http://fonts.googleapis.com/css?family=PT+Sans:400' rel='stylesheet' type='text/css'>
<link href="App_Theme/mainstyle.css" rel="stylesheet" type="text/css" />
<link href="App_Theme/help.css" rel="stylesheet" type="text/css" />
<script src="../user/js/jquery.js" type="text/javascript"></script>
  
    <style>
     .login_error { width:211px; height:30px;  top:380px; margin-left:-50px; color:#FFF;
      font-family:Verdana, Geneva, sans-serif; padding:5px 0 0 0; background:url(../image/errorrmess-img.png) no-repeat; position: absolute;  }
     </style>
	 
	 <script>
function loadXMLDoc()
{

var email= document.getElementById("txt_email").value;
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","emailvalidate/test.php?email="+email,true);
xmlhttp.send();
}
</script>
</head>
<body>
<div class="mainpageheader">
<div class="databag-menu-login">
  <img src="images/loginlogo.png"  alt="" border="0" usemap="#Map" />
  <map name="Map" id="Map">
    <area shape="circle" coords="376,48,17" href="../index.php" />
    <area shape="rect" coords="248,77,498,147" href="../index.php" />
  </map>
</div>
  

  

  <div class="invite-content">
   <div class="invite-content-top"></div>
      <div class="invite-content-middle">
    <div class="invite-content-middle-text">
    <div class="invite-content-middle-text-inside">
  <p><em>Here is your chance to get free storage from DataBagg!</em></p>
    
    <div class="help-box">On every successful invitation, <br />
you get <span>1 GB of free </span>storage <br />
from DataBagg.<br />


</div>

<p><em>Tell your friends, family and relatives and spread<br /> 
the word..</em></p>

<h4>Need help deciding? Call 1-800-491-3022 or mail to <a href="mailto:sales@databagg.com">sales@databagg.com</a></h4>

    </div>
    
    
    
    
    
    <div class="invite-content-middle-text-insideRight">
	<?php if($message!=""){ ?><p style="background: #E9E9E9; height:30px; font-weight:bold;  text-align:center; padding-top:8px; color:#FF6600; font-family:Arial, Helvetica, sans-serif;"><?php echo $message; ?> </p><?php } ?>
    <div class="imagen"><img src="images/help/Data-bagg-layout-invite-user.png" alt="" /></div>
    
     <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="frm" name="frm">
    
    <label for="firstName">First Name</label>
 

 <input type="text" id="txt_first_name" name="txt_first_name"  onfocus="this.select()" class="rightinput-help" <?php if($_REQUEST['txt_first_name']!=""){ ?> value="<?php echo $_REQUEST['txt_first_name'];  ?>" <?php } ?>  />
 
 <center>
<span id="error_fname" class="login_error" style="display: none;">
 Enter first name
</span>
</center>
 

 
<label for="LastName">Last Name</label>

 <input type="text" id="txt_last_name" name="txt_last_name"  onfocus="this.select()" class="rightinput-help" <?php if($_REQUEST['txt_last_name']!=""){ ?> value="<?php echo $_REQUEST['txt_last_name'];  ?>" <?php } ?> />
 
 <center>
<span id="error_lname" class="login_error" style="display: none;top:445px;">
Enter last name
</span>
</center>
 

 <label for="emailaddress">Email Address</label><div id="myDiv"></div>
<input type="text" id="txt_email" name="txt_email"  onFocus="this.select()"    class="rightinput-help" <?php if($_REQUEST['txt_email']!=""){ ?> value="<?php echo $_REQUEST['txt_email'];  ?>" <?php } ?> />

<center>
<span id="error_email" class="login_error" style="display: none;top:510px;">
Enter your email
</span>
</center>

 
 <input type="button" class="inviteuserbutton" onclick="return validate()" />
    </form>
    </div>
    
       <div style="clear:both"></div>
    </div>     
      
       <div style="clear:both"></div>
      </div>
         <div class="invite-content-bottom"></div>
  
  
  
 <div style="clear:both"></div>
  </div>
  
  
	
  <div style="clear:both"></div>
</div>














<div class="footer">

<div class="footer-in-top"> 
<ul>
<li><strong>Product</strong></li>
<li><a href="../pricing.html">Pricing</a></li>
<li><a href="../features.html">Features</a></li>
<li><a href="../how-works.html">How it works</a></li><li><a href="../download.html">Download</a></li>

</ul>


<ul>
<li><strong>Company</strong></li>
<li><a href="../about-us.html">About Us</a></li>               
<li><a href="../blogs.html">Blogs</a></li>                       
<li><a href="../news.html">News</a></li> 
<li><a href="../press-release.html">Press Release</a></li>        

</ul>


<ul>
<li><strong>Learn More</strong></li>
<li><a href="../support.html">Support</a></li>
<li><a href="../faqs.html">FAQs</a></li>
<li><a href="../tutorial.html">Tutorial</a></li>
<li><a href="../privacy-policy.html">Privacy Policy</a></li>
</ul>




<div class="social-media">
<h2>Connect with us</h2>
	<div class="social-media-t">
    	
        <div class="social-media-t-l">
        	<div class="social-media-t-l-img"><img src="images/facebook.png" alt=""  /></div>
            	<div class="social-media-t-l-text"><a href="http://www.facebook.com/Databagg">Facebook</a></div>
        
        </div>
    
    
    
    <div class="social-media-t-r">
        	<div class="social-media-t-l-img"><img src="images/twitter.png" alt=""  /></div>
            	<div class="social-media-t-l-text"><a href="https://twitter.com/DataBagg">Twitter</a></div>
        
        </div>
    </div>
    
    
    
    
    
    <div class="social-media-b">
    	
        <div class="social-media-t-l">
        	<div class="social-media-t-l-img"><img src="images/gplus.png" alt=""  /></div>
            	<div class="social-media-t-l-text"><a href="https://plus.google.com/117226672667714086519/posts?hl=en-GB">Google+</a></div>
        
        </div>
    
    
    
    <div class="social-media-t-r">
        	<div class="social-media-t-l-img"><img src="images/in.png"  alt="" /></div>
            	<div class="social-media-t-l-text"><a href="http://in.linkedin.com/pub/databagg/62/9b4/570">Linkdin</a></div>
        
        </div>
    
    
    
    </div>
</div>

</div>
<div style="clear:both;"></div>
</div>


<div class="footer-in-bottom">    
 
   <div class="textfooter">Copyright &copy; 2012 <strong><a href="index.html">Data Bagg</a></strong>, Inc. All rights reserved.</div>
   
   	<div class="textfooterimg-right"> <a href="index.html"><img src="images/bottomlogo.png" alt="" border="0" /></a></div>
</div>
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
    document.getElementById("error_fname").style.display='none';
    document.getElementById("error_lname").style.display='none';
    document.getElementById("error_email").style.display='none';
  
    
    if(trim_string_str(document.getElementById("txt_first_name").value)=="")
    {
        //document.getElementById("error_fname").style.display='block';
       $('#error_fname').fadeIn('slow');
        document.getElementById("txt_first_name").focus();
        return false;
    }
    if(!specialcharecter(document.getElementById("txt_first_name").value))
    {
         //document.getElementById("error_fname").style.display='block';
         $('#error_fname').fadeIn('slow');
         document.getElementById("error_fname").innerHTML="Only Alphabets allowed."
        document.getElementById("txt_first_name").focus();
        return false;
    }
    if(trim_string_str(document.getElementById("txt_last_name").value)=="")
    {
        //document.getElementById("error_lname").style.display='block';
        $('#error_lname').fadeIn('slow');
        document.getElementById("txt_last_name").focus();
        return false;
    }
     if(!specialcharecter(document.getElementById("txt_last_name").value))
    {
         //document.getElementById("error_lname").style.display='block';
          $('#error_lname').fadeIn('slow');
         document.getElementById("error_lname").innerHTML="Only Alphabets allowed."
        document.getElementById("txt_last_name").focus();
        return false;
    }
    if(trim_string_str(document.getElementById("txt_email").value)=="")
    {
         $('#error_email').fadeIn('slow');
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
                //document.getElementById("error_email").style.display='block';
                document.getElementById("error_email").innerHTML="Enter valid email.";
              document.getElementById("txt_email").focus();
                return false;
             }
    }
    if(!specialcharecterforemail(document.getElementById("txt_email").value))
    {
          $('#error_email').fadeIn('slow');
         //document.getElementById("error_email").style.display='block';
         document.getElementById("error_email").innerHTML="Remove special chars"
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

