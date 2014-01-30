<?php
session_start();
if(isset($_SESSION["user_id"]))
header("Location:user/nindex.php");
include("connect.php");
include("function.php");
error_reporting(0);
if($_REQUEST['txt_email'])
{
    $check_user="select * from tab_members where txt_email='".mysql_real_escape_string($_REQUEST['txt_email'])."' and 
    txt_password='".mysql_real_escape_string(base64_encode($_REQUEST['txt_password']))."'";
    $result_check_user=mysql_query($check_user) or die(mysql_error());
    if(mysql_num_rows($result_check_user)>0)
    {
       
       
        
        $fetch_detail=mysql_fetch_array($result_check_user);
        
            if($fetch_detail['int_verified']==1)
	        $_SESSION['verified']='true';
        else
        {
	       
            $_SESSION['verified']='false'; 
            $curr_date=time();
            $diff = $curr_date-$fetch_detail['int_reg_date'];
            $main_dif= $diff/(60*60*24);
            if($main_dif>3)
            {
                echo "<script>window.location.href='verify-account.php';</script>";
                die();
            }
        
        }
        
        
        $_SESSION['user_id']=$fetch_detail['int_id'];
        $_SESSION['user_mail_for_feed']=$_REQUEST['txt_email'];
        $_SESSION['user_fname_for_feed']=$fetch_detail['txt_first_name'];
        
        update_login_entry($fetch_detail['int_id']);
        
        
        
    
        // here we are checking if user has seleted any plan for upgrade plan
            if(isset($_SESSION['planid']))
		{
	                 header("Location: confirm_plan.php");
		die();
	            }
        ?>
        
        <script>
        location.href="user/nindex.php";
        </script>
        <?php
    }
    else
    $err_msg="Invalid e-mail or password.";
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
<script src="user/js/jquery.js" type="text/javascript"></script>


<!--[if IE 7]>
<link rel="stylesheet" href="App_Theme/ie7.css" type="text/css" media="screen"/>
<![endif]-->

<!--[if IE 8]>
<link rel="stylesheet" href="App_Theme/ie8.css" type="text/css" media="screen"/>
<![endif]-->
<style>
     div.hint {
	font-family: 'PT Sans', sans-serif;
	font-size:14px;
	
	background:url(images/errorbg.jpg) repeat-x #3d85a5;
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
	
	background:url(images/errorbg.jpg) repeat-x #3d85a5;
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
.arrow-left {
   /* border-bottom: 10px solid transparent;
    border-right: 10px solid #4089a8;
    border-top: 10px solid transparent;*/
	background:url(images/arrowbg.png) no-repeat left;
	width:13px;
	height:17px;
   float:left;
   position:absolute;
   top:10px;
   left:7px;
	margin:0 0 0 -20px;
}
</style>

<script type="text/javascript">
  var __lc = {};
  __lc.license = 1373462;
  __lc.skill = 3;

  (function() {
    var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
    lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
  })();
</script>


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-45624857-1', 'databagg.com');
  ga('send', 'pageview');

</script>

</head>
<body <?php if($err_msg) { ?><?php } ?>>
<div class="loginpage">

<div class="mid_container">
<div class="form_outoor">
	<div class="form_leftsection">
    <div class="form_logo"><a href="index.php"> <img src="images/form-logo.jpg"  alt="#" /></a></div>
    <!--<div class="form_social"><a href="#"><img src="images/login-fb.jpg" width="201" height="41" alt="#" /></a></div>
     <div class="form_social"><a href="#"><img src="images/login-twitter.jpg" width="201" height="41" alt="#" /></a></div>-->
     </div>
     
     
     
         <center>
     <?php
     if(isset($_REQUEST['err_sess']))
     {
        ?>
        <div class="error" id="error_container">
          <?php echo "Session expired, please login again"; ?>

        </div>
        <?php
     }
     ?>
     <?php
     if($err_msg)
     {
        ?>
        <div class="error" id="error_container">
          <?php echo $err_msg; ?>

        </div>
        <?php
     }
     ?>
      <?php
       if($_REQUEST['msg'])
     {
        ?>
        <div class="success" id="error_container1">
          Registration Successfull, A verification e-mail is sended on your email, Please login . 
       
        </div>
        <?php
     }
     ?>
     <?php
       if($_REQUEST['msg_fp'])
     {
        ?>
        <div class="success1" id="error_container1">
         Please check your e-mail for further instructions.

        </div>
        <?php
     }
     ?>
      <?php
       if($_REQUEST['msg_ver'])
     {
        ?>
        <div class="success" id="error_container1">
          e-mail verified successfully! Please login with your e-mail and password. 

        </div>
        <?php
     }
     ?>
     </center>
     
       <script src="user/js/jquery.js" type="text/javascript"></script>
     <style>
     .login_error {width:228px; text-align:center; font-size:15px; height:35px;  top:300px; left:130px;  color:#000;
      font-family:Verdana, Geneva, sans-serif; padding:5px 0 0 0; background:url(image/errorrmess-img.png) no-repeat; position: absolute;  }
     </style>
     
     
     <div class="form_right">
     
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="frm" name="frm">
    
 
<div id="error_email" class="hint" >
<div class="arrow-left"></div>Please enter your e-mail
</div>
   
 
  <input  type="text" id="txt_email" name="txt_email" onKeyPress="if(event.keyCode==13) {validate();}" value="E-mail address" onClick="if(this.value=='E-mail address')javascript:this.value='';" onFocus="this.select()"
 class="emailinput" /><br /><br />
 
 <div id="error_password" class="hint1">
<div class="arrow-left"></div> Please enter password
</div>
 
 
 
  <input type="password" id="txt_password" name="txt_password" onKeyPress="if(event.keyCode==13) {validate();}" value="Your Password" onClick="if(this.value=='Your Password')javascript:this.value='';" onFocus="this.select()"
 class="password" />
 
<div class="forget-help"><a href="user/forgot_password.php">Forgot Password</a></div><br />

<div class="submit-lnform-help">
     
     <div class="submit-l-help"><img src="images/loginin.png"  alt="" onKeyPress="if(event.keyCode==13) {validate();}" onClick="validate();" style="cursor: pointer;" /></div>
     
     
     <div class="submit-lnewtext-help">
     
     <div style="float:left; width:16px; height:16px; margin-top:6px;"><input name="" type="checkbox" value="" /></div>
     <div style="float:left; width:180px; height:16px; margin-left:3px;">Keep me logged in</div>
     
     </div>  
     
     
     <div style="clear:both;"></div>
     
     </div>
     <img src="images/login-fb.jpg" style="margin-top: 15px;cursor: pointer;" onClick="window.location.href='fb_saurav/login_databagg.php';" />
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

</body>
</html>






<script>
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
function autoHide()
{  //hide after 5 seconds
   setTimeout(function(){document.getElementById('error_container').style.display='none';},10000);
   setTimeout(function(){document.getElementById('error_container1').style.display='none';},10000);
}
function validate()
{
    $( '#error_email' ).animate({"left":"-150px"}, "slow");
    $( '#error_password' ).animate({"left":"-150px"}, "slow");
    document.getElementById("error_email").style.display='none';
    document.getElementById("error_password").style.display='none';
    
     if(trim_string_str( document.getElementById("txt_email").value)=="E-mail address")
    {
        document.getElementById("txt_email").value="";
        
    }
    
    if(document.getElementById("txt_email").value=="" )
    {
   
        $('#error_email').fadeIn('slow');
        $( '#error_email' ).animate({"left":"150px"}, "slow");
        //document.getElementById("error_email").style.display='block';
        document.getElementById("txt_email").focus();
        return false;
    }
      if(trim_string_str( document.getElementById("txt_password").value)=="Your Password")
    {
        document.getElementById("txt_password").value="";
        
    }
     if(document.getElementById("txt_password").value==""  )
    {
        $('#error_password').fadeIn('slow');
        $( '#error_password' ).animate({"left":"150px"}, "slow");
        //document.getElementById("error_password").style.display='block';
        document.getElementById("txt_password").focus();
        return false;
    }
    document.frm.submit();
    }
    
     <?php
       if(isset($_REQUEST['msg']))
     { ?>
     
    window.open("databagg.zip","Download","width=200,height=200");
    <?php
    }
    ?>
    </script>
    
    
    
 
    
    