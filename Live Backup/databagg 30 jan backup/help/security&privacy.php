<?php
$pagename="security&privacy.php";
 ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="google-site-verification" content="zEL3MwzMYCf3OIz62XAEtXN1jPs8V6QLqibRye5fGEE" />
<title>DataBaGG</title>

<link href="../App_Theme/reset.css" rel="stylesheet" type="text/css" />
<link href="../App_Theme/newstyle.css" rel="stylesheet" type="text/css" />
<link href="../App_Theme/help.css" rel="stylesheet" type="text/css" />

<link href='https://fonts.googleapis.com/css?family=PT+Sans:400' rel='stylesheet' type='text/css'>
<!--[if lt IE 7]>

        <div style=' clear: both; text-align:center; position: relative;'>
            <a href="https://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="https://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0"  alt="" /></a>
        </div>
	<![endif]-->
<!--[if lt IE 9]>
   		<script type="text/javascript" src="../js/html5.js"></script>
        <link rel="stylesheet" href="../App_Theme/ie.css" type="text/css" media="screen">
	<![endif]-->

<!-- Accordation menu start -->

<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../Script/accordation/jquery-latest.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
//Set default open/close settings
$('.acc_container').hide(); //Hide/close all containers
$('.acc_trigger:first').addClass('active').next().show(); //Add "active" class to first trigger, then show/open the immediate next container

//On Click
$('.acc_trigger').click(function(){
	if( $(this).next().is(':hidden') ) { //If immediate next container is closed...
		$('.acc_trigger').removeClass('active').next().slideUp(); //Remove all .acc_trigger classes and slide up the immediate next container
		$(this).toggleClass('active').next().slideDown(); //Add .acc_trigger class to clicked trigger and slide down the immediate next container
	}
	return false; //Prevent the browser jump to the link anchor
});

});
</script>
	
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-40639007-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>


<!-- Accordation menu start -->
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

</head>
<body>
<div class="mainpageheader">

<div class="innerheader_fixed">
  <?php include('../inner-header.php');?>
  
</div>

<div id="innerwrapper_container">
  
<div class="helpcontent_container">

  <div class="other-content">
  <div class="other-content-top"></div>
    <div class="other-content-middle"><br />
    
<div class="avail-text-help"><ul>
<li><a href="index.php">Help</a></li>
<li>&raquo;</li>
<li class="active"><a href="security&privacy.php">Security &amp; Privacy</a></li>

</ul>
</div>
    
 
    <div class="feature-content">
    
       <div class="feature-help-left">
       
       <div class="container-accordsation">

	
    <h2 class="acc_trigger"><a href="#">
How secure is my data?
<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
<p>DataBaGG takes the security and privacy of your data extremely seriously. DataBaGG stores all our own Data Center.Your data is also replicated within each data center</p>

<p>Currently, data is stored in Jaipur and Noida data centers only. </p>



</p>
</div>

	</div>
	<h2 class="acc_trigger"><a href="#">I have forgotten my password, how do I reset it?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
			<p>If you have forgotten your password please visit our forgotten password page here: https://www.databagg.com/user/forgot_password</p>

<p>Enter your email address at the forgot password page on the DataBaGG website. An email will be sent to your registered email address with your password.</p>

<p>If you are not able to locate your reset password email please check your SPAM and Junk folders before contacting us

</p>

		<br /><br />
		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">How long do you keep my files?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
<p>Once you have backed up files technically they will remain backed up forever. We do not delete files after a certain time or have any input on the up keep of your account, the only way files can be deleted is by yourself through the control panel.  </p>


		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">Can I specify my own private key for my DataBaGG?<br />
    <span></span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		<p>To ensure everyone has the ability to view and share files on the web painlessly, DataBaGG currently does not support the creation of your own private keys. However, allowing user control over this is something we might consider adding in the future.</p>
<p>Meanwhile, please know that DataBaGG takes the security of your files seriously. All files stored on DataBaGG servers are encrypted.</p>

            
            </div>

	</div>
	
	
	
    
    <h2 class="acc_trigger"><a href="#">Why should I use DataBaGG instead of an external hard drive?<br />
    <span></span>
    
    
    </a></h2>
	
    
    <div class="acc_container">
		<div class="block">
<p>There are some dangers in using an external hard drive for backup which do not exist when using a cloud service:</p>

<ul>

<li>External hard drives can be stolen, not only meaning your back up will be gone but your sensitive data will be available to the thief!</li>
<li>Just like a primary hard drive, external drives can and will one day fail</li>

<li>Experts recommend backed up data should be kept a minimum of 250 metres away from the original data in case of fire or water damage</li>

<li>External hard drives that don't require an extra plug all drain laptop batteries, those that do need a plug socket are cumbersome to use on the move</li>

<li>Backing up to an external drive requires input from you, our software is automated and means your data is kept up to date in the cloud</li></ul>

<p>We maintain secure data servers which cannot lose your data, your data is not only safe but also secure – it is encrypted and no one but you can access it.</p>


</div>

	</div>
    
    
    
    
    
	
</div></div>
        
      <?php include('../rightpannel.php');?>
    
      <div style="clear:both"></div>
    </div>
    
    
  <div style="clear:both"></div>
  
  </div>
  
  
	
    <div style="clear:both"></div>
</div>



  <?php include('../calling.html');?>
  </div></div>
   <?php include('../footer.php');?>
   

<div style="clear:both;"></div>
</div>
</body>
</html>
