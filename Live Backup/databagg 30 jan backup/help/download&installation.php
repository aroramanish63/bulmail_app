<?php
$pagename="download&installation.php";
 ?>
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<li class="active"><a href="download&installation.php">Download &amp; Installation</a></li>

</ul>
</div>
    <div class="fl browsetext">Browse by Categories</div>
 
    <div class="feature-content">
    
       <div class="feature-help-left">
       
       <div class="container-accordsation">

	
    <h2 class="acc_trigger"><a href="#">
How do I install DataBaGG?
<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
<p>To install DataBaGG simply visits www.databagg.com/download click on and run the installer. Use your logins to complete the signup wizard and you are ready to back up.

</p>
<img src="../images/help/trydatabagn.png" width="601" height="218" alt="" /></div>

	</div>
	<h2 class="acc_trigger"><a href="#">How do I know DataBaGG is installed?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
			<p>If you have successfully installed DataBaGG onto your computer you will notice desktop icons. If you click on the desktop icon your application will open</p>

		<br /><br />
			<img src="../images/help/howinow.png"  alt="" /></div>

	</div>
	<h2 class="acc_trigger"><a href="#">What operating systems does DataBaGG run on?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
<p>DataBaGG works on the following operating systems:</p>

<ul>
<li>Windows 8</li>
<li>Windows 8 RT</li>
<li>Windows 7</li>
<li>Windows Vista</li>
<li>Windows XP</li>
</ul>



		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">How can I find out what version of DataBaGG I have installed?<br />
    <span></span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
			<p>To find out versions of DataBaGG you are running please open your desktop application and check out the version number in the center just below the Start Now tab.</p>
            
            <img src="../images/help/startn.png" width="352" height="229" /></div>

	</div>
	
	
	
    
    <h2 class="acc_trigger"><a href="#">What do I need to change my Firewall setting to in order to allow DataBaGG?<br />
    <span></span>
    
    
    </a></h2>
	
    
    <div class="acc_container">
		<div class="block">
		
			<p>Firewall setting is not required as DataBaGG application uses the same ports (web browser).Only thing is required and that is an internet connection. </p>

<p>If you are using a proxy than you need to enter proxy settings in the connection settings link.Or if firewall is blocking the application than add the application to the list of exceptions in the firewall.
</p>

<img src="../images/help/authenti.png" width="380" height="208" alt="" /></div>

	</div>
    
    
    
    <h2 class="acc_trigger"><a href="#">Can I run two versions of DataBaGG on the same computer?<br />
    <span></span>
    
    
    </a></h2>
    
    
    <div class="acc_container">
		<div class="block">
		
			<p>You can only run a single version of the software at a time on any single device. </p>




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
