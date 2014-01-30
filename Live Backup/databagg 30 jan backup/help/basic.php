<?php
$pagename="basic.php";
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
<script type="text/javascript" src="../js/jquery.min.js"></script>
<!-- Accordation menu start -->


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
<li class="active"><a href="basic.php">Basic</a></li>

</ul>
</div>
    
 
    <div class="feature-content">
    
       <div class="feature-help-left">
       
       <div class="container-accordsation">

	
    <h2 class="acc_trigger"><a href="#">How much space does my DataBag have?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
<p>The fastest way to check how much space you have left on your DataBaGG is from right side moving panel</p>
<ol>
<li>Sign in to the DataBaGG website</li>
<li>Click on right hand side moving panel</li></ol>
<img src="../images/help/space.png" alt="" />

		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">How do I add or upload files to my DataBaGG?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
			<p>It's easy to add files to DataBaGG. Move your files into your DataBaGG by dragging and dropping them into your DataBaGG folder. That's it. The files in your DataBaGG folder will automatically be synced online and to your other computers. You don't have to do anything.You can also upload data. </p>
<ol>
<li><strong>Drag and drop your file</strong><br />
<br />
<img src="../images/help/drag3.png" alt="" />

</li>

<li><strong>You can upload files by using 'Upload' Button</strong><br /><br />
  <img src="../images/help/uploadbag.png" width="609" height="254" alt="" /> <br />
</li>
</ol>
		
			
		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">How do I install DataBaGG?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
<p>To install DataBaGG, just head to the DataBaGG download page.</p>
<p>To get the most out of DataBaGG, you'll want to install DataBaGG on all of your computers. Once it's installed, you'll see a DataBaGG icon on your computer. Upload your stuff in your DataBaGG and it will automatically upload for availability on all of your computers, phones, and tablets. It's called syncing, and it'll revolutionize the way you use computers.</p>
<p>For more about how DataBaGG works, check out our Demo pages.</p> 

		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">What operating systems does DataBaGG run on?<br />
    <span></span>
    
    
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
	<h2 class="acc_trigger"><a href="#">
Why is DataBaGG better than other company's product?
<br />
    <span></span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
			<p>DataBaGG provides a unique combination of online backup, file syncing, file sharing and online storage. Not only this but DataBaGG does all of this for the price of a standard backup only service. </p>


 </p>
		</div>

	</div>
	
    
    <h2 class="acc_trigger"><a href="#">Is DataBaGG going to offer URL file sharing?<br />
<span></span> </a></h2>

	<div class="acc_container">
		<div class="block">
	
			
			<p>Yes, we provide URL file sharing facility.</p>


		</div>
	</div>
	
	<h2 class="acc_trigger"><a href="#">How do I update to the latest version?<br />
    <span></span></a>
    
    </h2>
	<div class="acc_container">
		<div class="block">

		
			
			<p>When you open the application it should auto-update if there is an update available. You can also visit:<a href="mailto:support@databagg.com">support@databagg.com</a>

</p>
		</div>
	</div>
	
	
	
	<h2 class="acc_trigger"><a href="#">Can I run two versions of DataBaGG on the same computer?<br />
    <span></span></a>
    
    </h2>
	<div class="acc_container">
		<div class="block">

		
			
<p>You can only run a single version of the software at a time on any single device. </p>




		</div>
	</div>
    
    <h2 class="acc_trigger"><a href="#">Where is my data stored?<br />
    <span></span></a>
    
    </h2>
	<div class="acc_container">
		<div class="block">

		
			
<p>DataBaGG stores all our own Data Center.Your data is also replicated within each data center</p>

<p>Currently, data is stored in Jaipur and Noida data centers only. 
</p>




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
