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
        $_SESSION['user_mail_for_feed']=$_REQUEST['txt_email'];
        $_SESSION['user_fname_for_feed']=$fetch_detail['txt_first_name'];
        if($fetch_detail['int_verified']==1)
        $_SESSION['verified']='true';
        
        // here we are checking if user has seleted any plan for upgrade plan
            if(isset($_SESSION['planid'])){
                 header("Location: confirm_plan.php");
            }
        else
        $_SESSION['verified']='false';
        ?>
        
        <script>
        location.href="user/nindex.php";
        </script>
        <?php
    }
    else
    $err_msg="Invalid e-mail and password.";
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" /> 
<link rel="shortcut icon" type="image/x-icon" href="images/favicon_gif.gif" />
<link rel="shortcut icon" type="image/png" href="images/favicon_png.png" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="google-site-verification" content="zEL3MwzMYCf3OIz62XAEtXN1jPs8V6QLqibRye5fGEE" />

<title>Databagg</title>

<link href='https://fonts.googleapis.com/css?family=PT+Sans:400' rel='stylesheet' type='text/css'>
<link href="App_Theme/newstyle.css" rel="stylesheet" type="text/css" />
<link href="App_Theme/help.css" rel="stylesheet" type="text/css" />







</head>
<body <?php if($err_msg) { ?> onload = "autoHide();" <?php } ?>">
<div class="loginpage">

<div class="mid_container">
<div class="form_outoor">
	<div class="form_leftsection">
    <div class="form_logo"><a href="index.php"> <img src="images/form-logo.jpg"  alt="#" /></a></div>
    <!--<div class="form_social"><a href="#"><img src="images/login-fb.jpg" width="201" height="41" alt="#" /></a></div>
     <div class="form_social"><a href="#"><img src="images/login-twitter.jpg" width="201" height="41" alt="#" /></a></div>-->
     </div>
     
     <div class="form_right">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="frm" name="frm">
    
 
<div id="error_email" class="login_error" style="display:none; margin:auto;">
&nbsp;Please enter your e-mail
</div>
   
 
  <input  type="text" id="txt_email" name="txt_email" onKeyPress="if(event.keyCode==13) {validate();}" value="e-mail address" onClick="if(this.value=='e-mail address')javascript:this.value='';" onFocus="this.select()"
 class="emailinput" /><br /><br />
 
 <div id="error_password" class="login_error" style="display: none;top:200px; left:130px;">
&nbsp; Please enter password
</div>
 
 
 
  <input type="password" id="txt_password" name="txt_password" onKeyPress="if(event.keyCode==13) {validate();}" value="Your Password" onClick="if(this.value=='Your Password')javascript:this.value='';" onFocus="this.select()"
 class="password" />
 
<div class="forget-help"><a href="user/forgot_password.php">Forgot Password</a></div><br />

<div class="submit-lnform-help">
     
     <div class="submit-l-help"><img src="images/loginin.png"  alt="" onKeyPress="if(event.keyCode==13) {validate();}" onClick="validate();" style="cursor: pointer;" /></div>
     
     
     <div class="submit-lnewtext-help">
     
     <div style="float:left; width:16px; height:16px; margin-top:2px;"><input name="" type="checkbox" value="" /></div>
     <div style="float:left; width:180px; height:16px; margin-left:10px;">Keep me logged in</div>
     
     </div>  
     
     
     <div style="clear:both;"></div>
     
     </div>
     <div class="form_image"><img src="images/trutee.jpg" width="223" height="76" alt="#" /></div>

    </form>
     
     
     </div>


</div>

<div class="footer-login">
<div class="footer-loginleft">
<div class="footerlogin_logo"><img src="images/loginfooter-logo.jpg"  alt="#" /></div>
<div class="footerlogin-message">Not a Member yet? Click here to <a href="registration.php">sign up</a> for free</div>
</div>

<div class="footerlogin_right">
<div class="connect-img"><img src="images/connecttext.jpg" width="165" height="61" alt="#" /></div>
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

 <?php include('footer.html');?>
 <?php include('bottom.html');?>
</body>
</html>






<script>
function autoHide()
{  //hide after 5 seconds
   setTimeout(function(){document.getElementById('error_container').style.display='none';},10000);
   setTimeout(function(){document.getElementById('error_container1').style.display='none';},10000);
}
function validate()
{
    document.getElementById("error_email").style.display='none';
    document.getElementById("error_password").style.display='none';
    
    if(document.getElementById("txt_email").value=="" || document.getElementById("txt_email").value=="e-mail address")
    {
   
        $('#error_email').fadeIn('slow');
        //document.getElementById("error_email").style.display='block';
        document.getElementById("txt_email").focus();
        return false;
    }
     if(document.getElementById("txt_password").value=="" || document.getElementById("txt_password").value=="Your password")
    {
        $('#error_password').fadeIn('slow');
        //document.getElementById("error_password").style.display='block';
        document.getElementById("txt_password").focus();
        return false;
    }
    document.frm.submit();
    }
    
     <?php
       if(isset($_REQUEST['msg']))
     { ?>
     
    window.open("user/databagg.zip","Download","width=200,height=200");
    <?php
    }
    ?>
    </script>
    
    
    
 
    
    