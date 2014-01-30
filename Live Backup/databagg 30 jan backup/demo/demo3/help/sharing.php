<?php
$pagename="sharing.php";
 ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="google-site-verification" content="zEL3MwzMYCf3OIz62XAEtXN1jPs8V6QLqibRye5fGEE" />
<title>Databagg</title>

<link href="../App_Theme/reset.css" rel="stylesheet" type="text/css" />
<link href="../App_Theme/newstyle.css" rel="stylesheet" type="text/css" />
<link href="../App_Theme/help.css" rel="stylesheet" type="text/css" />
<link href='https://fonts.googleapis.com/css?family=PT+Sans:400' rel='stylesheet' type='text/css'>

<!-- Accordation menu start -->


<script type="text/javascript" src="../js/jquery.min.js"></script>
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
	

<!-- Accordation menu start -->


</head>
<body>
<div class="mainpageheader">

  <div class="innerheader_fixed">
  <?php include('../inner-header.php');?>
  
</div>


  <div id="innerwrapper_container" style="padding-top:53px">
  
<div class="helpcontent_container">

  <div class="other-content">
 
    <div class="other-content-middle"><br />
    
<div class="avail-text-help"><ul>
<li><a href="index.php">Help</a></li>
<li>&raquo;</li>
<li class="active"><a href="sharing.php">Sharing</a></li>

</ul>
</div>
    
  <div class="fl browsetext">Browse by Categories</div>  
    <div class="feature-content">
    
       <div class="feature-help-left">
       
       <div class="container-accordsation">

	
    <h2 class="acc_trigger"><a href="#">
How do I share folders with other people?
<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
<p>DataBagg offers easy ways to share files or folders.</p>

<strong>Share a folder from the DataBagg</strong>
<ol>

<li>Sign in to the DataBagg website.</li>
<li>Go to your list of files and folders and select the folder you want to share</li> 
<li>Click on Share button</li></ol>

<img src="../images/help/sync1.png" width="601" height="245" alt="" /></div>

	</div>
	

	
	<h2 class="acc_trigger"><a href="#">Can I share files with non-DataBagg users?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
<p>You can share files with anyone, even non-DataBagg users, by getting a link to any file or folder. Once you get the link, you can send it by email, Facebook, Twitter, Linkedin, wherever you want. These links can be accessed by anyone, even without a DataBagg account. </p>


		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">Will joining someone else's shared folder use my quota?<br />
    <span></span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
			<p>No, someone else shared folder will not consume your quota.</p>
       
            
            </div>

	</div>
	
	
	
    
    <h2 class="acc_trigger"><a href="#">How can I tell if a file or folder is shared or private?<br />
    <span></span>
    
    
    </a></h2>
	
    
    <div class="acc_container">
		<div class="block">
		
			<p>By default, anything you store in your DataBagg is private and accessible only by you. However, you can invite other people to share folders with you. Shared folders are accessible only by those you invite. You can view your share data in Shared Tab.</p>

            <img src="../images/help/sync2.png" width="623" height="271" alt="" /></div>

	</div>
    
    
    
     <h2 class="acc_trigger"><a href="#">How do I unshare a shared folder?<br />
    <span></span>
    
    
    </a></h2>
	
    
    <div class="acc_container">
		<div class="block">
		
			<p>If you're the owner of a shared folder, you can unshare it at any time. </p>

<ol>
<li>Sign in to the DataBagg website.</li>
<li>Select the Sharing tab from the sidebar on the left.</li>
<li>Click Unshare folder.</li>


</ol>
<img src="../images/help/myshare.png" width="621" height="254" alt="" /></div>

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

</body>
</html>
