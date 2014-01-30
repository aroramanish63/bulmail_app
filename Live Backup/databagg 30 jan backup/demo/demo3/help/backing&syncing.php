<?php
$pagename="backing&syncing.php";
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

<link href='http://fonts.googleapis.com/css?family=PT+Sans:400' rel='stylesheet' type='text/css'>

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
<li class="active"><a href="backing&syncing.php">Backing up and Syncing</a></li>

</ul>
</div>
    
 
    <div class="feature-content">
    
       <div class="feature-help-left">
       
       <div class="container-accordsation">

	
    <h2 class="acc_trigger"><a href="#">Where is the Sync Folder?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
<p>Once you have installed the DataBagg application on a Windows computer the DataBagg icon will appear on your desktop. Once you will login on Databagg, the first tab you will see will be SYNC Folder.</p>
<div style="width:440px; height:552px; margin:auto;"><img src="../images/databagg-sycro.jpg" width="400" height="551" alt=""  /></div>

		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">How do I sync files between computers?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
			<p>If you have multiple computers you can sync your files between them using the DataBagg Sync Folder.

<p>All you have to do to sync files between computers is to download the DataBagg desktop application using the same logins as your main computer. There are no limits to the number of computers you can do this on.</p>

<p>Once you have the desktop application installed on more than one computer you are ready to start syncing. All you need to do add that folder or files you want to sync into the Sync Folder.</p>

<p>Once these files and folders have been synced they will instantly appear in the corresponding folder on your second computer. Any future desktops that you install the application on will automatically retrieve existing synced files.</p>

<p>DataBagg will automatically sync files in the Sync Folder without you having to do anything. There is no start sync button or any extra settings, everything will happen automatically for you.
</p>



		
			
		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">What is the difference between sync and backup?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
<p>File syncing and computer backup are two very different features. It is important to not confuse the two.</p>

<p><strong>Backup:</strong> takes a copy of the file and uploads it to our servers for safe keeping, you can get your files back at any time if you accidentally delete or lose a file by downloading from the online control panel or restoring via the desktop application.</p>

<p><strong>Sync:</strong> Allows you to sync the same files between multiple computers, syncing mirrors a folder on one computer on another.</p>

<p>The two features are very different. 

</p>


		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">What do I do if DataBagg is stuck syncing?<br />
    <span></span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
<p>If your DataBagg Sync Folder appears to be stuck mid sync, and has been in this state for over 24 hours, it is possible that youranti virus or firewall is blocking the software from functioning correctly.</p>

<p>Please ensure that you whitelist DataBagg with your anti virus provider and temporarily disable your firewall.
</p>

			

		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">
How do I know when my files are syncing?
<br />
    <span></span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
<p>Inside your DataBagg Sync Folder there are 2 notifiers on icons that are used to denote the status of your files. If there is a blue and orange  syncing symbol your file is in the process of syncing between our servers and your additional computers. If you see a green tick  symbol it means that file is successfully synced to our servers and your other computers. 


 </p>
		</div>

	</div>
	
    
    <h2 class="acc_trigger"><a href="#">What files are backed up?<br />
<span></span> </a></h2>

	<div class="acc_container">
		<div class="block">
	
			
			<p>As the recommended selection DataBagg will automatically backup files stored inside your 'My Data Bagg' folder. </p>




		</div>
	</div>
	
	<h2 class="acc_trigger"><a href="#">How can I sync a single file, and not an entire folder?<br />
    <span></span></a>
    
    </h2>
	<div class="acc_container">
		<div class="block">

		
			
			<p>DataBagg associates each file with a folder. And when you sync a folder, all files in the folder are added to the cloud; there's no way to exclude specific files.</p>
<p>However, there is a ways to sync certain files:</p>
<p>Create a new sync folder. If there are just a few files that you want synced in a specific location on your computer, create a new folder and then drag and drop these files to that folder. Then, sync that folder</p>

</p>
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
  </div></div>
   <?php include('../footer.php');?>
   


<div style="clear:both;"></div>
</div>
</body>
</html>
