<?php
$pagename="faq.php";
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
	
<script>

//function showdivbylink(str)
//{   
// for(var i=1;  i<=59; i++)
  //{ 
  //var vaal="div"+i;
 // try{
	//document.getElementById(vaal).style.display='none';
	//}
	//catch(e)
	//{}
 // }
  //	document.getElementById(str).style.display='block';
  
//}


</script>

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
<li class="active"><a href="faq.php">FAQ'S</a></li>

</ul>
</div>
 <div class="fl browsetext">Browse by Categories</div>   
 
    <div class="feature-content">
    
       <div class="feature-help-left">
       
       <div class="container-accordsation">

	
    <h2 class="acc_trigger"><a href="#">How do I sync files between computers?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container" >
		<div class="block" id="div1">
		
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

	<div class="acc_container" >
		<div class="block"  id="div2">
		
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

	<div class="acc_container" >
		<div class="block" id="div3">
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
		<div class="block"  id="div4">
		
			<p>You can only run a single version of the software at a time on any single device.</p>



		</div>

	</div>
	 <h2 class="acc_trigger"><a href="#">
How do I install DataBagg?
<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block"  id="div5">
		
<p>To install DataBagg simply visits www.DataBagg.com/download click on and run the installer. Use your logins to complete the signup wizard and you are ready to back up.

</p>
<img src="../images/help/trydatabagn.png" width="601" height="218" alt="" /></div>

	</div>
	<h2 class="acc_trigger"><a href="#">How do I know DataBagg is installed?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container" >
		<div class="block"  id="div6">
		
			<p>If you have successfully installed DataBagg onto your computer you will notice desktop icons. If you click on the desktop icon your application will open</p>

		<br /><br />
			<img src="../images/help/howinow.png"  alt="" /></div>

	</div>
	<h2 class="acc_trigger"><a href="#">What operating systems does DataBagg run on?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container" >
		<div class="block"  id="div7">
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

	<div class="acc_container" >
		<div class="block" id="div8">
		
			<p>To find out versions of DataBagg you are running please open your desktop application and check out the version number in the center just below the Start Now tab.</p>
            
            <img src="../images/help/startn.png" width="352" height="229" /></div>

	</div>
	
	
	
    
    <h2 class="acc_trigger"><a href="#">What do I need to change my Firewall setting to in order to allow DataBagg?<br />
    <span></span>
    
    
    </a></h2>
	
    
    <div class="acc_container" >
		<div class="block" id="div9">
		
			<p>Firewall setting is not required as DataBagg application uses the same ports (web browser).Only thing is required and that is an internet connection. </p>

<p>If you are using a proxy than you need to enter proxy settings in the connection settings link.Or if firewall is blocking the application than add the application to the list of exceptions in the firewall.
</p>

<img src="../images/help/authenti.png" width="380" height="208" alt="" /></div>

	</div>
    
    
    
    <h2 class="acc_trigger"><a href="#">Can I run two versions of DataBagg on the same computer?<br />
    <span></span>
    
    
    </a></h2>
    
    
    <div class="acc_container" >
		<div class="block  id="div10"">
		
			<p>You can only run a single version of the software at a time on any single device. </p>




		</div>

	</div>
    
     <h2 class="acc_trigger"><a href="#">
How do I create a photo album
<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container" >
		<div class="block"  id="div11">
		
<p>Albums are the easiest way to organize and share a bunch of photos and videos in your DataBagg. Once you create an album, you can share it with friends, family, and colleagues—even if they don't have a DataBagg account.</p>
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

	<div class="acc_container" >
		<div class="block"  id="div12">
<p>You can easily share photos from DataBagg. Share a link to a single photo or an entire album you've created, such as for a special event. Anyone who receives the link can take a look, even if they don't have a DataBagg account.</p>
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
		<div class="block"   id="div13">
		
			<p>How do I add photos to an album?
You can add photos to an existing album on your Album page on the DataBagg website.</p>

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
	
    
    <div class="acc_container" >
		<div class="block"  id="div14">
		
			<p>You can remove photos from an existing album on your Album page. Removing photos from an album will not delete them from your account.</p>
            <ol>
<li>After signing in, click on My Album tab.</li>
<li>Click on List Allbutton.</li>
<li>Delete any photo.</li>
</ol>
            <img src="../images/help/creatalbum.png" width="634" height="665" alt="" /></div>

	</div>
    <h2 class="acc_trigger"><a href="#">
How much free referral space can I earn?
<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block"   id="div15">
		
<p>Each friend you refer to DataBagg yields 1GB of free space. DataBagg user can earn up to 100 GB by referral,</p> 
<p>To get started, simply invite your friends to Databagg from the referral page. All your friends have to do is use the link you send them to create an account via the DataBagg desktop application. Once you do, you get 1GB of free space automatically added to your accounts.


</p>
</div>

	</div>
	<h2 class="acc_trigger"><a href="#">How do I earn bonus space for referring friends to Databagg?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container" >
		<div class="block"  id="div16">
		
			<p>You can get extra space by inviting your friends to try out DataBagg. If a friend uses your invitation to sign up for an account and signs in as well as verify the account, you will receive bonus space of 1GB.</p>
<p>You can track the status of your referrals from the bonus space tab of your account settings.
</p>

		<br /><br />
	</div>

	</div>
	<h2 class="acc_trigger"><a href="#">What happens if my referral signs up with a different email address?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container" >
		<div class="block" id="div17">
<p>DataBagg will track that user anyway and will ensure that you are credited accordingly. If a friend receives multiple invitations from different users, the most recently clicked invitation will get the credit. </p>


		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">Where can I find the status of the invitations I've sent out for referrals?<br />
    <span></span>
    
    
    </a></h2>

	<div class="acc_container" >
		<div class="block" id="div18">
		
			<p>Keep track of all the friends you have invited and their referral status from the view the status of your referrals tab of your Referral page.</p>
        <ul>    
<li>Sign in to the DataBagg website (if you haven't already)</li>
<li>Click on your Referral page</li>
<li>Click on view the status of your referrals button</li>
</ul>
</p>
            
            </div>

	</div>
	
	
	
    
    <h2 class="acc_trigger"><a href="#">What do each of the referral statuses mean?<br />
    <span></span>
    
    
    </a></h2>
	
    
    <div class="acc_container" >
		<div class="block" id="div19">
		
			<p>Once you invite your friends to join DataBagg, you can check the status of your referrals from the view the status of your referrals tab of your Referral page. There are four different referral statuses:</p>

<ul>
<li>Invited means that your friend has been invited to use DataBagg but hasn't registered yet.</li>
<li>Joined means that they have registered but not confirmed the email address.</li>
<li> Completed means that your friend has successfully sing in and confirmed the email address.</li>

</ul>

</div>

	</div>
     <h2 class="acc_trigger"><a href="#">
How secure is my data?
<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block"   id="div20">
		
<p>DataBagg takes the security and privacy of your data extremely seriously. DataBagg stores all our own Data Center.Your data is also replicated within each data center</p>

<p>Currently, data is stored in Jaipur and Noida data centers only. </p>



</p>
</div>

	</div>
	<h2 class="acc_trigger"><a href="#">I have forgotten my password, how do I reset it?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container" >
		<div class="block"  id="div21">
		
			<p>If you have forgotten your password please visit our forgotten password page here: http://www.databagg.com/user/forgot_password</p>

<p>Enter your email address at the forgot password page on the DataBagg website. An email will be sent to your registered email address with your password.</p>

<p>If you are not able to locate your reset password email please check your SPAM and Junk folders before contacting us

</p>

		<br /><br />
        
        <img src="../images/help/forgetpassword.png" width="619" height="309" alt="" /></div>

	</div>
	<h2 class="acc_trigger"><a href="#">What happens if my referral signs up with a different email address?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container" >
		<div class="block"  id="div22">
<p>DataBagg will track that user anyway and will ensure that you are credited accordingly. If a friend receives multiple invitations from different users, the most recently clicked invitation will get the credit. </p>


		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">Where can I find the status of the invitations I've sent out for referrals?<br />
    <span></span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block"   id="div23">
		
			<p>Keep track of all the friends you have invited and their referral status from the view the status of your referrals tab of your Referral page.</p>
        <ul>    
<li>Sign in to the DataBagg website (if you haven't already)</li>
<li>Click on your Referral page</li>
<li>Click on view the status of your referrals button</li>
</ul>
</p>
            
            </div>

	</div>
	
	
	
    
    <h2 class="acc_trigger"><a href="#">What do each of the referral statuses mean?<br />
    <span></span>
    
    
    </a></h2>
	
    
    <div class="acc_container" >
		<div class="block"  id="div24">
		
			<p>Once you invite your friends to join DataBagg, you can check the status of your referrals from the view the status of your referrals tab of your Referral page. There are four different referral statuses:</p>

<ul>
<li>Invited means that your friend has been invited to use DataBagg but hasn't registered yet.</li>
<li>Joined means that they have registered but not confirmed the email address.</li>
<li> Completed means that your friend has successfully sing in and confirmed the email address.</li>

</ul>

</div>

	</div>
    <h2 class="acc_trigger"><a href="#">
How do I share folders with other people?
<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block"  id="div25">
		
<p>DataBagg offers easy ways to share files or folders. Shared folders are ideal for groups of people who work on the same files together. When you create a shared folder and add other people to it, its files will appear in their DataBagg just as they do in yours. Any member of the folder can add, delete, or edit files within that folder.</p>

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
		<div class="block"  id="div26">
<p>You can share files with anyone, even non-DataBagg users, by getting a link to any file or folder. Once you get the link, you can send it by email, Facebook, Twitter, Linkedin, wherever you want. These links can be accessed by anyone, even without a DataBagg account. </p>


		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">Will joining someone else's shared folder use my quota?<br />
    <span></span>
    
    
    </a></h2>

	<div class="acc_container" >
		<div class="block"  id="div27">
		
			<p>No, someone else shared folder will not consume your quota.</p>
       
            
            </div>

	</div>
	
	
	
    
    <h2 class="acc_trigger"><a href="#">How can I tell if a file or folder is shared or private?<br />
    <span></span>
    
    
    </a></h2>
	
    
    <div class="acc_container" >
		<div class="block" id="div28">
		
			<p>By default, anything you store in your DataBagg is private and accessible only by you. However, you can invite other people to share folders with you. Shared folders are accessible only by those you invite. You can view your share data in Shared Tab.</p>

            <img src="../images/help/sync2.png" width="623" height="271" alt="" /></div>

	</div>
    
    
    
     <h2 class="acc_trigger"><a href="#">How do I unshare a shared folder?<br />
    <span></span>
    
    
    </a></h2>
	
    
    <div class="acc_container" >
		<div class="block"  id="div29">
		
			<p>If you're the owner of a shared folder, you can unshare it at any time. </p>

<ol>
<li>Sign in to the DataBagg website.</li>
<li>Select the Sharing tab from the sidebar on the left.</li>
<li>Click Unshare folder.</li>


</ol>
<img src="../images/help/myshare.png" width="621" height="254" alt="" /></div>

	</div>
    <h2 class="acc_trigger"><a href="#">
How do I cancel my account?
<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container" >
		<div class="block" id="div30">
		
<p>To cancel your account please email our cancellation team at <a href="mailto:Support@DataBagg.com">Support@DataBagg.com</a> outlining the reasons for your cancellation and they will do their best to help you quickly and efficiently.</p>

</div>

	</div>
	

	
	<h2 class="acc_trigger"><a href="#">How do I uninstall DataBagg?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container" >
		<div class="block" id="div31">
<p>To uninstall DataBagg please do the following:</p>

<p><strong>Windows XP </strong><br />
From the Start menu, select Control Panel > Add/Remove Programs >DataBagg. Click Uninstall. DataBagg will be completely removed from your system.</p> 

<p><strong>Windows Vista and Windows 7 </strong><br />
From the Start menu, select Control Panel > Programs>DataBagg. Click Uninstall/Change. DataBagg will be completely removed from your system.</p> 

<img src="../images/help/unin.png" width="605" height="239" alt="" /></div>

	</div>
	<h2 class="acc_trigger"><a href="#">I have unrecognized or unauthorized charges relating to DataBagg, who can I speak to?<br />
    <span></span>
    
    
    </a></h2>

	<div class="acc_container" >
		<div class="block" id="div32">
		
			<p>If you have received a charge from DataBagg that is unrecognized, unauthorized or completely unfamiliar to you, rest assured, we are more than happy to refund it back to you and investigate how it could have occurred.

You can email us <a href="mailto:Support@DataBagg.com">Support@DataBagg.com</a> or, if you would prefer, can call us on:1-888-885-4570
</p>
       
            
            </div>

	</div>
	
	
	
    
    <h2 class="acc_trigger"><a href="#">I have been overcharged, who can I speak to?<br />
    <span></span>
    
    
    </a></h2>
	
    
    <div class="acc_container" >
		<div class="block" id="div33">
		
			<p>We are trying to help our customers by offering a cheaper price for a longer commitment. We are happy to refund any users who feel they have been overcharged.
The telephone support team is able to provide help with billing, unrecognized charges and renewal enquiries on :- 1-888-885-4570
Or please contact <a href="mailto:Support@DataBagg.com">Support@DataBagg.com</a> 
</p>
</div>

	</div>
    
    
    <h2 class="acc_trigger"><a href="#">How much does DataBagg cost?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block"  id="div34">
		
<p>DataBagg offers different plans depending on how much space is required.</p>

<p>We offer 2 year, 1 year, semi-annual and monthly pricing plans. The longer you sign up for though the cheaper it works out in the long run.</p>

<p class="redtext">Not able to see the price. I Will update this once information will be available.</p>

<p>Please contact <a href="mailto:support@databagg.com">support@databagg.com</a> for a full breakdown of prices and any current discounts available. </p>

		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">Why is DataBagg better than other backup/storage companies?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container" >
		<div class="block"id="div35">
		
			<p>DataBagg provides a unique combination of online backup, file syncing, file sharing and online storage. Not only this but DataBagg does all of this for the price of a standard backup only service. </p>		
			
		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">What payment methods do you accept?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container" >
		<div class="block" id="div36">
		
			<p>We accept payment through Paypal and Avangate. </p> 
<p>If you get a decline message it would be worth contacting your card provider to query the reason why the payment did not go through</p>.

<p>Our support team can be contacted via email <a href="mailto:support@databagg.com">support@databagg.com</a>
</p>
		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">Can I have an invoice for my DataBagg Subscription?<br />
    <span></span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block"  id="div37">
		
			<p>You certainly can. When you first signed up for your DataBagg Subscription an invoice would have been emailed to the email address you signed up with, please be sure to check your junk folders.</p>
			

		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">I chose the wrong plan<br />
    <span></span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block"  id="div38">
		
			<p>Please don't worry if you have accidentally purchased the wrong plan. Just contact our support team and we will immediately upgrade or downgrade you to the correct plan and if necessary refund the difference back to you.</p>

<p>We try to make this as clear as possible and are trying to help our customers by offering a cheaper price for a longer commitment.

<p>Or call us on:- 1-888-885-4570</p>

 </p>
		</div>

	</div>
	
    
    <h2 class="acc_trigger"><a href="#">I only wanted to pay monthly<br />
<span></span> </a></h2>

	<div class="acc_container" >
		<div class="block" id="div39">
	
			
			<p>We understand that sometimes users accidentally select the wrong payment plan.</p>

<p>If you wish to convert your account to monthly billing, this is not a problem. We will happily refund you the difference and move you to a monthly plan.</p>

<p>Simply email <a href="mailto:support@databagg.com">support@databagg.com</a>
</p>
		</div>
	</div>
	
	<h2 class="acc_trigger"><a href="#">How do I transfer my license to a new computer?<br />
    <span></span></a>
    
    </h2>
	<div class="acc_container">
		<div class="block"  id="div40">

		
			
			<p class="redtext">Waiting</p>
		</div>
	</div>
	
	
	
	<h2 class="acc_trigger"><a href="#">How do I update my credit card?<br />
    <span></span></a>
    
    </h2>
	<div class="acc_container">
		<div class="block"  id="div41">

		
			
			<p class="redtext">To update your payment method details please login to http://DataBagg.com and click My Account from the top tabs, then from the sub tabs click Billing and you will see a button titled Update payment information. Clicking the button will bring up a new window where credit card details and payment address details can be added. 

</p>

<p>The payment method should then become the default payment method on your account. </p>

<p>We accept payment through Paypal and Avangate.</p>

<p>If you have any queries relating to billing please email Support@DataBagg.com. 
</p>


		</div>
	</div>
    
    <h2 class="acc_trigger"><a href="#">Can I call you?<br />
    <span></span></a>
    
    </h2>
	<div class="acc_container">
		<div class="block"  id="div42">

		
			
<p>No technical support can be given over the phone. The telephone support team is able to provide help with billing, unrecognized charges and renewal enquiries. </p>

<p>Call us on:-1-888-885-4570.</p>

<p>If you require technical assistance please email <a href="mailto:support@databagg.com">support@databagg.com</a></p> 


		</div>
	</div>
    
    
    
    
    <h2 class="acc_trigger"><a href="#">How do I cancel my account?<br />
    <span></span></a>
    
    </h2>
	<div class="acc_container" >
		<div class="block"  id="div43">

		
			
			<p>
            To cancel your account please email our  team at <a href="mailto:support@databagg.com">support@databagg.com</a> outlining the reasons for your cancellation and they will do their best to help you quickly and efficiently. 

</p>
		</div>
	</div>
    
    
    
    
    
    
    
    <h2 class="acc_trigger"><a href="#">Where is the Sync Folder?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block"  id="div44">
		
<p>Once you have installed the DataBagg application on a Windows computer the DataBagg icon will appear on your desktop. Once you will login on Databagg, the first tab you will see will be SYNC Folder.</p>

		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">How do I sync files between computers?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block"  id="div45">
		
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

	<div class="acc_container" >
		<div class="block" id="div46">
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
		<div class="block" id="div47">
		
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
		<div class="block"  id="div48">
		
<p>Inside your DataBagg Sync Folder there are 2 notifiers on icons that are used to denote the status of your files. If there is a blue and orange  syncing symbol your file is in the process of syncing between our servers and your additional computers. If you see a green tick  symbol it means that file is successfully synced to our servers and your other computers. 


 </p>
		</div>

	</div>
	
    
    <h2 class="acc_trigger"><a href="#">What files are backed up?<br />
<span></span> </a></h2>

	<div class="acc_container">
		<div class="block"  id="div49">
	
			
			<p>As the recommended selection DataBagg will automatically backup files stored inside your 'My Data Bagg' folder. </p>




		</div>
	</div>
	
	<h2 class="acc_trigger"><a href="#">How can I sync a single file, and not an entire folder?<br />
    <span></span></a>
    
    </h2>
	<div class="acc_container">
		<div class="block"  id="div50">

		
			
			<p>DataBagg associates each file with a folder. And when you sync a folder, all files in the folder are added to the cloud; there's no way to exclude specific files.</p>
<p>However, there is a ways to sync certain files:</p>
<p>Create a new sync folder. If there are just a few files that you want synced in a specific location on your computer, create a new folder and then drag and drop these files to that folder. Then, sync that folder</p>

</p>
		</div>
	</div>
	
    
    <h2 class="acc_trigger"><a href="#">How do I change my password ?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block"  id="div51">
		
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
		<div class="block"  id="div52">
		
			<p>Enter your email address at the forgot password page on the DataBagg website. An email will be sent to your registered email address with your password. </p>

<br /><br />

		    <img src="../images/help/fotgetpass.png" width="601" height="292" alt="" />
            <br /><br />
            
            </div>

	</div>
	<h2 class="acc_trigger"><a href="#">How do I change my account settings?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container" >
		<div class="block" id="div53">
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
		<div class="block" id="div54">
		
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
		<div class="block"  id="div55">
		
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
		<div class="block"  id="div56">
	
			
			<p>The Databagg desktop software automatically detects updates, for the updates to take effect you just need to restart your computer.</p>

<p>For major releases DataBagg will email you about the new features in the release and what else to expect. You can also keep up with us by following us on Twitter, Facebook or checking out our blog. 
</p>


		</div>
	</div>
	
	<h2 class="acc_trigger"><a href="#">What do I need to change my Firewall setting to in order to allow DataBagg?<br />
    <span></span></a>
    
    </h2>
	<div class="acc_container">
		<div class="block"  id="div57">

		
			
			<p>If firewall is blocking the application than add the application to the list of exceptions in the firewall.

</p>
		</div>
	</div>
	
	
	
	<h2 class="acc_trigger"><a href="#">
I've not received my account logins, what do I do?
<br />
    <span></span></a>
    
    </h2>
	<div class="acc_container" >
		<div class="block" id="div58">

		
			
<p>We advise checking all of your email inbox folders including SPAM for this, however if it still can't be found please email <a href="mailto:Support@DataBagg.com">Support@DataBagg.com</a> and they will be happy to assist. </p>




		</div>
	</div>
    
    <h2 class="acc_trigger"><a href="#">How long do you keep my files?<br />
    <span></span></a>
    
    </h2>
	<div class="acc_container" >
		<div class="block" id="div59">	
			
<p>Once you have backed up files technically they will remain backed up forever. We do not delete files after a certain time or have any input on the up keep of your account, the only way files can be deleted is by yourself through the control panel. </p>


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
 </div>
   <?php include('../footer.php');?>
 
<div style="clear:both;"></div>
</div>

<script>
//var param='<?php //echo $_REQUEST['param']; ?>';
//if(param!="")
//{
	//showdivbylink(param);
//}
</script>
</body>

</html>
