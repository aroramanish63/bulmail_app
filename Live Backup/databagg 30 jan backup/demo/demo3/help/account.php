<?php
$pagename="account.php";
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
<li class="active"><a href="account.php">Account Questions</a></li>

</ul>
</div>
    
 
    <div class="feature-content">
    
       <div class="feature-help-left">
       
       <div class="container-accordsation">

	
    <h2 class="acc_trigger"><a href="#">How do I change my password ?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
<p>You can change your password from the account settings page on the DataBagg website. To access the account settings page.
Change your password from the Databagg website:-</p>
<ol>
<li>Sign in to the DataBagg website.</li>
<li>Click on your name from the top of any page </li>
<li>Select the Change Password tab.</li>
<li>Change your password by clicking Change password.</li>
</ol><br /><br />
<img src="../images/help/account-setting.png"  alt="" />

		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">Forgot your password?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
			<p>Enter your email address at the forgot password page on the DataBagg website. An email will be sent to your registered email address with your password. </p>

<br /><br />

		    <img src="../images/help/fotgetpass.png" width="601" height="292" alt="" />
            <br /><br />
            
            </div>

	</div>
	<h2 class="acc_trigger"><a href="#">How do I change my account settings?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
<p>
You can change your account settings, by visiting the account settings page from the DataBagg website.
Change account settings from the website</p>
<ol>
<li>Sign in to the DataBagg website (if you haven't already)</li>
<li>Click on My Setting Tab</li>
<li>Update your changedSettings</li></ol>
<br /><br />
<img src="../images/help/Data-bagg-layout-help-account.png" width="607" height="497" alt="" /></div>

	</div>
	<h2 class="acc_trigger"><a href="#">How do I unlink my Facebook or Twitter account?<br />
    <span></span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
<p>Unlinking DataBagg from your Facebook account</p>
<ol>
<li>Log in to your Facebook account from www.facebook.com</li>
<li>Click on the arrow at the top right of the screen next to Home</li>
<li>Click on Account Settings from the resulting drop menu</li>
<li>Select Apps from the sidebar on the left. Click the X to the right of DataBaggto unlink your account
</li>
</ol>
<p>For more information on adding or removing apps, see Facebook's Help Center.</p>
<p>Once you disconnect from Facebook and/or Twitter, you will no longer be able to send messages or access your friends from the Shared folder dialog or through the Referral page. You will also no longer be able to use DataBaggto share files with Facebook groups you belong to.</p>

			

		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">
How do I edit the phone number on my account?
<br />
    <span></span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
<p>You can change your phone number, by visiting the account settings page from the DataBagg website.</p>
<p>Change phone number from the website</p>
<ol>

<li>Sign in to the DataBagg website (if you haven't already)</li>
<li>Click on My Setting Tab</li>
<li>Update your new phone number</li>
</ol>

<img src="../images/help/phof.png" width="628" height="190" alt="" /></div>

	</div>
	
    
    <h2 class="acc_trigger"><a href="#">How do I know when new updates are available?<br />
<span></span> </a></h2>

	<div class="acc_container">
		<div class="block">
	
			
			<p>The Databagg desktop software automatically detects updates, for the updates to take effect you just need to restart your computer.</p>

<p>For major releases DataBagg will email you about the new features in the release and what else to expect. You can also keep up with us by following us on Twitter, Facebook or checking out our blog. 
</p>


		</div>
	</div>
	
	<h2 class="acc_trigger"><a href="#">What do I need to change my Firewall setting to in order to allow DataBagg?<br />
    <span></span></a>
    
    </h2>
	<div class="acc_container">
		<div class="block">

		
			
			<p>If firewall is blocking the application than add the application to the list of exceptions in the firewall.

</p>
		</div>
	</div>
	
	
	
	<h2 class="acc_trigger"><a href="#">
I've not received my account logins, what do I do?
<br />
    <span></span></a>
    
    </h2>
	<div class="acc_container">
		<div class="block">

		
			
<p>We advise checking all of your email inbox folders including SPAM for this, however if it still can't be found please email <a href="mailto:support@databagg.com">support@databagg.com</a> and they will be happy to assist. </p>




		</div>
	</div>
    
    <h2 class="acc_trigger"><a href="#">How long do you keep my files?<br />
    <span></span></a>
    
    </h2>
	<div class="acc_container">
		<div class="block">	
			
<p>Once you have backed up files technically they will remain backed up forever. We do not delete files after a certain time or have any input on the up keep of your account, the only way files can be deleted is by yourself through the control panel. </p>


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
   <?php include('../footer.html');?>
   <?php include('../bottom.html');?>
<div style="clear:both;"></div>
</div>
</body>
</html>
