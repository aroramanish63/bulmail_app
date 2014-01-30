<?php
$pagename="photo&video.php";
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
<li class="active"><a href="photo&video.php">Photo &amp; Video</a></li>

</ul>
</div>
  <div class="fl browsetext">Browse by Categories</div>  
 
    <div class="feature-content">
    
       <div class="feature-help-left">
       
       <div class="container-accordsation">

	
    <h2 class="acc_trigger"><a href="#">
How do I create a photo album
<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
<p>Albums are the easiest way to organize and share a bunch of photos and videos in your DataBaGG. Once you create an album, you can share it with friends, family, and colleagues—even if they don't have a DataBaGG account.</p>
<ol>
<li>After signing in, click on My Albumstab.</li>
<li>Click on Create Album button.</li>
<li>Provide Album name and Select photos for the album.</li>
<li>Click on Create Album</li>
</ol>


<img src="../images/help/videoalbum.png" width="623" height="298" alt="" /></div>

	</div>
	

	
	<h2 class="acc_trigger"><a href="#">How do I share photos with other people?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
<p>You can easily share photos from DataBaGG. Share a link to a single photo or an entire album you've created, such as for a special event. Anyone who receives the link can take a look, even if they don't have a DataBaGG account.</p>
<ul>
<li>After signing in, click on My Data Baggtab</li>.
<li>Select your photo and click on Share button.</li>
</ul>

<img src="../images/help/howinsta.png" width="634" height="461" alt="" /></div>

	</div>
	<h2 class="acc_trigger"><a href="#">How do I add photos to an album?<br />
    <span></span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
			<p>
You can add photos to an existing album on your Album page on the DataBaGG website.</p>

<ol>
<li>After signing in, click on My Albumtab.</li>
<li>Click on Add More button.</li>
<li>Add your selected photo.</li>
</ol>    
<p>Adding photos to an album does not take up additional space in your account, nor does it change the locations of your files.</p>

<img src="../images/help/addalbum.png" width="624" height="330" alt="" /></div>

	</div>
	
	
	
    
    <h2 class="acc_trigger"><a href="#">How do I remove photos from an album?<br />
    <span></span>
    
    
    </a></h2>
	
    
    <div class="acc_container">
		<div class="block">
		
			<p>You can remove photos from an existing album on your Album page. Removing photos from an album will not delete them from your account.</p>
            <ol>
<li>After signing in, click on My Album tab.</li>
<li>Click on List Allbutton.</li>
<li>Delete any photo.</li>
</ol>
            <img src="../images/help/creatalbum.png" width="634" height="665" alt="" /></div>

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
