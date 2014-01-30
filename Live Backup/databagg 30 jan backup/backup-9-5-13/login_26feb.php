<?php
session_start();
include("connect.php");
error_reporting(0);
if($_REQUEST['txt_email'])
{
    $check_user="select * from tab_members where txt_email='".mysql_real_escape_string($_REQUEST['txt_email'])."' and 
    txt_password='".mysql_real_escape_string(base64_encode($_REQUEST['txt_password']))."'";
    $result_check_user=mysql_query($check_user) or die(mysql_error());
    if(mysql_num_rows($result_check_user)==1)
    {
        $fetch_detail=mysql_fetch_array($result_check_user);
        $_SESSION['user_id']=$fetch_detail['int_id'];
        ?>
        
        <script>
        location.href="user/dashboard.php";
        </script>
        <?php
    }
    else
    $err_msg="Invalid user name and password.";
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Databagg</title>

<link href='http://fonts.googleapis.com/css?family=PT+Sans:400' rel='stylesheet' type='text/css'>
<link href="App_Theme/mainstyle.css" rel="stylesheet" type="text/css" />

</head>
<body <?php if($err_msg || $_REQUEST['msg']) { ?> onload = "autoHide();" <?php } ?>">
<div class="mainpageheader">
<div class="databag-menu-login">
  <img src="images/loginlogo.png"  alt="" border="0" usemap="#Map" />
  <map name="Map" id="Map">
    <area shape="circle" coords="376,48,17" href="index.html" />
    <area shape="rect" coords="248,77,498,147" href="index.html" />
  </map>
</div>
  

  

  <div class="other-content">
  
  
    <div class="other-content-login">
     <div class="other-content-login-t"></div>
     
     
     <div class="other-content-login-m">
     
     <div class="other-content-login-areawelcom"><img src="images/welcomelogin-n.png"  alt="" /></div>
    <center>
     <?php
     if($err_msg)
     {
        ?>
        <div class="error" id="error_container">
         <strong>&times;</strong> <?php echo $err_msg; ?>

        </div>
        <?php
     }
     ?>
      <?php
       if($_REQUEST['msg'])
     {
        ?>
        <div class="success" id="error_container1">
         <strong>&radic;</strong> Registration Successfull, Please login with your email-id and password. 

        </div>
        <?php
     }
     ?>
     </center>
     <br />
     <div class="other-content-login-area">
     
     
     
     <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="frm" name="frm">

 
<label for="emailaddress">Email Address:  </label>
 <input type="text" id="txt_email" name="txt_email" value="Your Email Address" onclick="if(this.value=='Your Email Address')javascript:this.value='';" onfocus="this.select()" class="rightinput" />
<img src="images/starIcon.png"/>
<center>
<span id="error_email" class="error_validation" style="display: none;">
Please enter your e-mail
</span>
</center>
<br />
<label for="emailaddress">Password: </label>
<input type="password" id="txt_password" name="txt_password" value="Your Password" onclick="if(this.value=='Your Password')javascript:this.value='';" onfocus="this.select()" class="rightinput" />
 <img src="images/starIcon.png"/>
 <center>
<span id="error_password" class="error_validation" style="display: none;">
Please enter your password
</span>
</center>


 
<div class="forget"><a href="#">Forget Password</a></div><br />
 
     <div class="submit-lnform">
     
     <div class="submit-l"><img src="images/loginin.jpg" width="149" height="50" alt="" onclick="validate();" style="cursor: pointer;" /></div>
     
     
     <div class="submit-lnewtext">
     
     <div style="float:left; width:16px; height:16px; margin-top:2px;"><input name="" type="checkbox" value="" /></div>
     <div style="float:left; width:180px; height:16px; margin-left:10px;">Keep me logged in</div>
     
     </div>  
     
     
     <div style="clear:both;"></div>
     
     </div>
      <div class="other-content-login-accountnmk">  
     Don't have an account? <strong><a href="registration.php">Sign up</a></strong> for free</div>
     
      

</form>
       
     
     
     </div>
     </div>
     <div class="other-content-login-b">   </div>
    
    
    
    </div>
    
    
    
        
    
    
  <div style="clear:both"></div>
  
  </div>
  
  
	
  <div style="clear:both"></div>
</div>














<div class="footer">

<div class="footer-in-top"> 
<ul>
<li><strong>Product</strong></li>
<li><a href="pricing.php">Pricing</a></li>
<li><a href="features.html">Features</a></li>
<li><a href="how-works.html">How it works</a></li><li><a href="Download.html">Download</a></li>

</ul>


<ul>
<li><strong>Company</strong></li>
<li><a href="about-us.html">About Us</a></li>               
<li><a href="blogs.html">Blogs</a></li>                       
<li><a href="news.html">News</a></li> 
<li><a href="press-release.html">Press Release</a></li>        

</ul>


<ul>
<li><strong>Learn More</strong></li>
<li><a href="support.html">Support</a></li>
<li><a href="faqs.html">FAQs</a></li>
<li><a href="tutorial.html">Tutorial</a></li>
<li><a href="privacy-policy.html">Privacy Policy</a></li>
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
function autoHide()
{  //hide after 5 seconds
   setTimeout(function(){document.getElementById('error_container').style.display='none';},5000);
   setTimeout(function(){document.getElementById('error_container1').style.display='none';},5000);
}
function validate()
{
    document.getElementById("error_email").style.display='none';
    document.getElementById("error_password").style.display='none';
    
    if(document.getElementById("txt_email").value=="" || document.getElementById("txt_email").value=="Your Email Address")
    {
        document.getElementById("error_email").style.display='block';
        document.getElementById("txt_email").focus();
        return false;
    }
     if(document.getElementById("txt_password").value=="" || document.getElementById("txt_password").value=="Your Password")
    {
        document.getElementById("error_password").style.display='block';
        document.getElementById("txt_password").focus();
        return false;
    }
    document.frm.submit();
    }
    
    
    </script>