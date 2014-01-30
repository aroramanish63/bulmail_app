<?php
$pagename="basic.php";
 ?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="google-site-verification" content="zEL3MwzMYCf3OIz62XAEtXN1jPs8V6QLqibRye5fGEE" />
<title>Databagg</title>

<link href="../App_Theme/reset.css" rel="stylesheet" type="text/css" />
<link href="../App_Theme/newstyle.css" rel="stylesheet" type="text/css" />
<link href="../App_Theme/help.css" rel="stylesheet" type="text/css" />

<link href='https://fonts.googleapis.com/css?family=PT+Sans:400' rel='stylesheet' type='text/css'>
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
	

<!-- Accordation menu start -->


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
		
<p>The fastest way to check how much space you have left on your DataBagg is from right side moving panel</p>
<ol>
<li>Sign in to the DataBagg website</li>
<li>Click on right hand side moving panel</li></ol>
<img src="../images/help/space.png" alt="" />

		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">How do I add or upload files to my DataBagg?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
			<p>It's easy to add files to DataBagg. Move your files into your DataBagg by dragging and dropping them into your DataBagg folder. That's it. The files in your DataBagg folder will automatically be synced online and to your other computers. You don't have to do anything.You can also upload data. </p>
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
	<h2 class="acc_trigger"><a href="#">How do I install DataBagg?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
<p>To install DataBagg, just head to the DataBagg download page.</p>
<p>To get the most out of DataBagg, you'll want to install DataBagg on all of your computers. Once it's installed, you'll see a DataBagg icon on your computer. Upload your stuff in your DataBagg and it will automatically upload for availability on all of your computers, phones, and tablets. It's called syncing, and it'll revolutionize the way you use computers.</p>
<p>For more about how DataBagg works, check out our Demo pages.</p> 

		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">What operating systems does DataBagg run on?<br />
    <span></span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
			<p>DataBagg works on the following operating systems:</p>

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
Why is DataBagg better than other company's product?
<br />
    <span></span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
			<p>DataBagg provides a unique combination of online backup, file syncing, file sharing and online storage. Not only this but DataBagg does all of this for the price of a standard backup only service. </p>


 </p>
		</div>

	</div>
	
    
    <h2 class="acc_trigger"><a href="#">Is DataBagg going to offer URL file sharing?<br />
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
	
	
	
	<h2 class="acc_trigger"><a href="#">Can I run two versions of DataBagg on the same computer?<br />
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

		
			
<p>DataBagg stores all our own Data Center.Your data is also replicated within each data center</p>

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
