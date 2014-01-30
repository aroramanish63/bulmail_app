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
<li class="active"><a href="desktop.html">Desktop</a></li>

</ul>
</div>
    
 
    <div class="feature-content">
    
       <div class="feature-help-left">
       
       <div class="container-accordsation">

	
    <h2 class="acc_trigger"><a href="#">How do I sync files between computers?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
<p>If you have multiple computers you can sync your files between them using the DataBagg Sync Folder.</p>

<p>All you have to do to sync files between computers is to download the DataBagg desktop application using the same logins as your main computer. There are no limits to the number of computers you can do this on.</p>

<p>Once you have the desktop application installed on more than one computer you are ready to start syncing. All you need to do add that folder or files you want to sync into the Sync Folder.</p>

<p>Once these files and folders have been synced they will instantly appear in the corresponding folder on your second computer. Any future desktops that you install the application on will automatically retrieve existing synced files.</p>

<p>DataBagg will automatically sync files in the Sync Folder without you having to do anything. There is no start sync button or any extra settings, everything will happen automatically for you.</p>
		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">How do I upgrade to the latest version of the Databagg application?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
			<p>If you want to have the latest stable version of DataBagg, you don't have to do anything! DataBagg will silently update itself in the background.
To find out versions of DataBagg you are running please open your desktop application and check out the version number in the center just below the Start Now tab.</p>
<br /><br />
<img src="../images/help/desktop-app.jpg" width="395" height="548" alt="" /> 
<br /><br />
		
			
		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">How do I uninstall DataBagg?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
<p>To uninstall DataBagg please do the following:</p>

<p>Windows XP<br /> 
From the Start menu, select Control Panel > Add/Remove Programs >DataBagg. Click Uninstall. DataBagg will be completely removed from your system. <br /> 

Windows Vista and Windows 7 <br /> 
From the Start menu, select Control Panel > Programs>DataBagg. Click Uninstall/Change. DataBagg will be completely removed from your system. 
</p> 

		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">Can I run two versions of DataBagg on the same computer?<br />
    <span></span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
			<p>You can only run a single version of the software at a time on any single device.</p>



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
