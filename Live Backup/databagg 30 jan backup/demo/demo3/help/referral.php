<?php
$pagename="referral.php";
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
<div class="mid_container padtop20">
  <div class="other-content">
  <div class="other-content-top"></div>
    <div class="other-content-middle"><br />
    
<div class="avail-text-help" style="float:left;"><ul>
<li><a href="index.php">Help</a></li>
<li>&raquo;</li>
<li class="active"><a href="referral.php">Referral</a></li>

</ul>
</div>
<div class="fl browsetext">Browse by Categories</div>
    
 
    <div class="feature-content">
    
       <div class="feature-help-left">
       
       <div class="container-accordsation">

	
    <h2 class="acc_trigger"><a href="#">
How much free referral space can I earn?
<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
<p>Each friend you refer to DataBagg yields 1GB of free space. DataBagg user can earn up to 100 GB by referral,</p> 
<p>To get started, simply invite your friends to Databagg from the referral page. All your friends have to do is use the link you send them to create an account via the DataBagg desktop application. Once you do, you get 1GB of free space automatically added to your accounts.


</p>
</div>

	</div>
	<h2 class="acc_trigger"><a href="#">How do I earn bonus space for referring friends to Databagg?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
			<p>You can get extra space by inviting your friends to try out DataBagg. If a friend uses your invitation to sign up for an account and signs in as well as verify the account, you will receive bonus space of 1GB.</p>
<p>You can track the status of your referrals from the bonus space tab of your account settings.
</p>

		<br /><br />
	</div>

	</div>
	<h2 class="acc_trigger"><a href="#">What happens if my referral signs up with a different email address?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
<p>DataBagg will track that user anyway and will ensure that you are credited accordingly. If a friend receives multiple invitations from different users, the most recently clicked invitation will get the credit. </p>


		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">Where can I find the status of the invitations I've sent out for referrals?<br />
    <span></span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
			<p>Keep track of all the friends you have invited and their referral status from the view the status of your referrals tab of your Referral page.</p>
        <ul>    
<li>Sign in to the DataBagg website (if you haven't already)</li>
<li>Click on your My Setting page</li>
<li>Click on view the status of your Bonus Tab</li>
</ul>
</p>
         
         <img src="../images/help/refferal-status.png" width="575" height="438" alt="" /></div>

	</div>
	
	
	
    
    <h2 class="acc_trigger"><a href="#">What do each of the referral statuses mean?<br />
    <span></span>
    
    
    </a></h2>
	
    
    <div class="acc_container">
		<div class="block">
		
			<p>Once you invite your friends to join DataBagg, you can check the status of your referrals from the view the status of your referrals tab of your Referral page. There are four different referral statuses:</p>

<ul>
<li>Pending registration means that your friend has been invited to use DataBagg but hasn't registered yet.</li>

<li> Space Earned means that your friend has successfully sing in and confirmed the email address.</li>

</ul>

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
 </div>
   <?php include('../footer.php');?>




<div style="clear:both;"></div>
</div>
</div>
</body>
</html>
