<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Databagg</title>

<link href="../App_Theme/mainstyle.css" rel="stylesheet" type="text/css" />
<link href="../App_Theme/help.css" rel="stylesheet" type="text/css" />

<link href='http://fonts.googleapis.com/css?family=PT+Sans:400' rel='stylesheet' type='text/css'>

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
<?php include('../topmenu.html');?>
  
  

  <div class="other-content">
  <div class="other-content-top"></div>
    <div class="other-content-middle"><br />
    
<div class="avail-text-help"><ul>
<li>Help Center</li>
<li>&raquo;</li>
<li class="active"><a href="download&installation.html">Download &amp; Installation</a></li>

</ul>
</div>
    
 
    <div class="feature-content">
    
       <div class="feature-help-left">
       
       <div class="container-accordsation">

	
    <h2 class="acc_trigger"><a href="#">
How do I install DataBagg?
<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
<p>To install DataBagg simply visits www.DataBagg.com/download click on and run the installer. Use your logins to complete the signup wizard and you are ready to back up.

</p>
<img src="../images/help/trydatabagn.png" width="601" height="218" alt="" /></div>

	</div>
	<h2 class="acc_trigger"><a href="#">How do I know DataBagg is installed?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
			<p>If you have successfully installed DataBagg onto your computer you will notice desktop icons. If you click on the desktop icon your application will open</p>

		<br /><br />
			<img src="../images/help/howinow.png"  alt="" /></div>

	</div>
	<h2 class="acc_trigger"><a href="#">What operating systems does DataBagg run on?<br />
    <span> </span>
    
    
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
	<h2 class="acc_trigger"><a href="#">How can I find out what version of DataBagg I have installed?<br />
    <span></span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
			<p>To find out versions of DataBagg you are running please open your desktop application and check out the version number in the center just below the Start Now tab.</p>
            
            <img src="../images/help/startn.png" width="352" height="229" /></div>

	</div>
	
	
	
    
    <h2 class="acc_trigger"><a href="#">What do I need to change my Firewall setting to in order to allow DataBagg?<br />
    <span></span>
    
    
    </a></h2>
	
    
    <div class="acc_container">
		<div class="block">
		
			<p>Firewall setting is not required as DataBagg application uses the same ports (web browser).Only thing is required and that is an internet connection. </p>

<p>If you are using a proxy than you need to enter proxy settings in the connection settings link.Or if firewall is blocking the application than add the application to the list of exceptions in the firewall.
</p>

<img src="../images/help/authenti.png" width="380" height="208" alt="" /></div>

	</div>
    
    
    
    <h2 class="acc_trigger"><a href="#">Can I run two versions of DataBagg on the same computer?<br />
    <span></span>
    
    
    </a></h2>
    
    
    <div class="acc_container">
		<div class="block">
		
			<p>You can only run a single version of the software at a time on any single device. </p>




		</div>

	</div>
    
    
	
</div></div>
        
    <?php include('../rightpannel.html');?>
    
      <div style="clear:both"></div>
    </div>
    
    
    
        
    
    
  <div style="clear:both"></div>
  
  </div>
  
  
	
    <div style="clear:both"></div>
</div>


  <?php include('../calling.html');?>
   <?php include('../footer.html');?>
   <?php include('../bottom.html');?>





<div style="clear:both;"></div>
</div>
</body>
</html>
