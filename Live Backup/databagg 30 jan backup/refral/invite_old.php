<?php
session_start();

if(!$_SESSION['user_id'])
header("Location:../login.php");

include("../connect.php");
$error="";
$fspace=1024;
if($_REQUEST['txt_first_name'])
{
$random_id_length = 20; 
$rnd_id = crypt(uniqid(rand(),1)); 
$rnd_id = strip_tags(stripslashes($rnd_id)); 
$rnd_id = str_replace(".","",$rnd_id); 
$rnd_id = strrev(str_replace("/","",$rnd_id)); 
$rnd_id = substr($rnd_id,0,$random_id_length); 


$fname=mysql_real_escape_string($_POST['txt_first_name']);
$lname=mysql_real_escape_string($_POST['txt_last_name']);
$email=mysql_real_escape_string($_POST['txt_email']);
$user=$_SESSION['user_id'];
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Databagg</title>

<link href="http://databagg.com/App_Theme/mainstyle.css" rel="stylesheet" type="text/css" />

<link href='http://fonts.googleapis.com/css?family=PT+Sans:400' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="mainpageheader">
  <div class="other-content">
    <div class="other-content-middle">
      <div class="availoth-n-text">
        
        <div class="databag-menu-login">
 <img src="http://databagg.com/images/loginlogo.png"  alt="" border="0" usemap="#Map"   />
  <map name="Map" id="Map">
    <area shape="circle" coords="376,49,23" href="../index.html" />
    <area shape="rect" coords="250,78,492,141" href="../index.html" />
  </map>
</div>
        <h2>
          <br />
          <br />
          Dear $fname 
        <name>,</h2>

<p>I am using DataBagg for storing my data online; and absolutely love the service!
Not only my data is auto-synchronized across all the devices at once, but its auto-backed up as well.</p>

<p>Why don't you try it? For free!</p>

<p>Please follow this link for free trial of DataBagg:</p> 
<p><a href="http://www.databagg.com/refral/accept_invite.php?invitedby=$user&uid=$rnd_id&useremail=$email" style="text-decoration:none; font-size:16px; color:#3366FF;">Accept Invitation</a></p>

<p>Have a great day!</p>


</div>
      <div style="clear:both"></div>
    </div>
    <div class="other-content-bottom"></div>
  
  <div style="clear:both"></div>
  
  </div>
    <div style="clear:both"></div>
</div>

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
$error="invitation  sent";
}
else
{ $error="invitation already sent";}

}
else
{ $error="Already Registered";}


}
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Databagg</title>

<link href='http://fonts.googleapis.com/css?family=PT+Sans:400' rel='stylesheet' type='text/css'>
<link href="../App_Theme/mainstyle.css" rel="stylesheet" type="text/css" />

</head>
<body>
<div class="mainpageheader">
<div class="databag-menu-login">
  <img src="../images/loginlogo.png" alt="" border="0" usemap="#Map"   />
  <map name="Map" id="Map">
    <area shape="circle" coords="376,49,23" href="../index.html" />
    <area shape="rect" coords="250,78,492,141" href="../index.html" />
  </map>
</div>
  
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="frm" name="frm">

  <div class="other-content">
  
    <div class="creataccount">
    
    <div class="creataccount-left"><img src="../images/creat-acc-left.png" width="113" height="633" alt="" /></div>
    <div class="creataccount-middle">
    <div class="creataccount-middle-t-text">
    
       <div class="creataccount-banner"><img src="../image/invite.png" width="525" height="105" alt="" /></div>
       
       <div class="other-content-login-area-mainrgsitere">     
     	<div class="other-content-login-area-leftregis">First Name</div>
        <div class="other-content-login-area-right"> <input type="text" id="txt_first_name" name="txt_first_name"  onfocus="this.select()" class="rightinput"  /><img src="../images/starIcon.png"/></div>
     
     </div>
       
    <center>
<span id="error_fname" class="error_validation" style="display: none;">
Please enter first name.
</span>
</center>  
 
       <div class="other-content-login-area-mainrgsitere">     
     	<div class="other-content-login-area-leftregis">Last Name</div>
        <div class="other-content-login-area-right"><input type="text" id="txt_last_name" name="txt_last_name"  onfocus="this.select()" class="rightinput" /><img src="../images/starIcon.png"/></div>
     
     </div>
	 <center>
<span id="error_lname" class="error_validation" style="display: none;">
Please enter  last name.
</span>
</center>
     
     <div class="other-content-login-area-mainrgsitere">     
     	<div class="other-content-login-area-leftregis">Email Address</div>
        <div class="other-content-login-area-right"><input type="text" id="txt_email" name="txt_email" onBlur="check_email(this.value);" onFocus="this.select()" class="rightinput" /><img src="../images/starIcon.png"/></div>
     
     </div>
	 
	 <center>
<span id="error_email" class="error_validation" style="display: none;">
Please enter email address.
</span>
</center>
     
     <div class="other-content-login-area-mainrgsitere">     
     	
        <div style="color:#F30; font-size:15px; margin-top:20px; font-family:Arial, Helvetica, sans-serif; text-align:center;"><?php if($error!=""){echo $error;} ?></div>
     
     </div>
    
	 
	 <div class="submit-lctt"><img src="../image/invite-button.png" width="151" height="56" alt="" onClick="validate();" style="cursor: pointer;" /></div>
    </div>
    
    
    
    
    </div>
    <div class="creataccount-right"><img src="../images/creat-acc-right.png" width="116" height="633" alt="" /></div>
    
    
    </div>
    
    
    
        
    
    
  <div style="clear:both"></div>
  
  </div>
   </form>
  
	
    <div style="clear:both"></div>
</div>














<div class="footer">

<div class="footer-in-top"> 
<ul>
<li><strong>Product</strong></li>
<li><a href="../pricing.html">Pricing</a></li>
<li><a href="../features.html">Features</a></li>
<li><a href="../how-works.html">How it works</a></li><li><a href="Download.html">Download</a></li>

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
 
   <div class="textfooter">Copyright &copy; 2012 <strong><a href="../index.html">Data Bagg</a></strong>, Inc. All rights reserved.</div>
   
   	<div class="textfooterimg-right"> <a href="../index.html"><img src="../images/bottomlogo.png" alt="" border="0" /></a></div>
</div>
</body>
</html>
<script>
function validate()
{
    document.getElementById("error_fname").style.display='none';
    document.getElementById("error_lname").style.display='none';
    document.getElementById("error_email").style.display='none';
 
    
    if(document.getElementById("txt_first_name").value=="")
    {
        document.getElementById("error_fname").style.display='block';
        document.getElementById("txt_first_name").focus();
        return false;
    }
    if(document.getElementById("txt_last_name").value=="")
    {
        document.getElementById("error_lname").style.display='block';
        document.getElementById("txt_last_name").focus();
        return false;
    }
    if(document.getElementById("txt_email").value=="")
    {
        document.getElementById("error_email").style.display='block';
        document.getElementById("txt_email").focus();
        return false;
    }
    if(document.getElementById("txt_email").value!="")
    {
        var x=document.getElementById("txt_email").value;
        var atpos=x.indexOf("@");
        var dotpos=x.lastIndexOf(".");
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
             {
                document.getElementById("error_email").style.display='block';
                document.getElementById("error_email").innerHTML="Please enater a valid email address.";
              document.getElementById("txt_email").focus();
                return false;
             }
    }
    

    document.frm.submit();
}

</script>
