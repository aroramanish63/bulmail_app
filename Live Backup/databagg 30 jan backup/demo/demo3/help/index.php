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

<!-- Accordation menu start -->


<script type="text/javascript" src="../Script/accordation/jquery-latest.js"></script>
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
<script type="text/javascript">
// Using jQuery.

$(function() {
    $('form').each(function() {
        $('input').keypress(function(e) {
            // Enter pressed?
            if(e.which == 10 || e.which == 13) {
                this.form.submit();
            }
        });

        $('input[type=submit]').hide();
    });
});
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
    
<div class="avail-text-help">
</div>
    
 
    <div class="feature-content">
    
    <div><div class="helpcol-one">
   
    
    <div class="bubbleright clborder">
          <img src="../images/help/video.png" alt="" />
                  <p><span><a href="video-tutorial.php">Video Tutorials</a></span><br />
Watch step by step video tutorials</p>
          </div>
          
          
          
          <div class="bubbleright">
          <img src="../images/help/download.png"  alt="" />
                  <p><span><a href="demo.php">Demo</a></span><br />
Get the letest app 
download</p>
          </div>
          
          <div class="bubbleright" style="border-bottom:1px solid #e0e0e0 !important;">
          <img src="../images/help/billing.png" alt="" />
                  <p><span><a href="billing.php">Billing</a></span><br />
Question about your
Data Bagg bill</p>
          </div>
          
          <div style="clear:both;"></div>
          </div>
    <div class="helpcol-two">
 
 <div class="center"><img src="../images/help/support-center.png" alt="" /></div>
 
 </div>
     <div class="helpcol-three">
     <div class="bubblen">
          <img src="../images/help/faqn.png" alt="" />
                  <p><span><a href="faq.php">FAQ</a></span><br />
Find answer to our FAQ's</p>
          </div>
          
          
          
          <div class="bubblen">
          <img src="../images/help/community.png"  alt="" />
                  <p><span><a href="community.php">Community</a></span><br />
Become involved with
Data Bagg</p>
          </div>
          
          <div class="bubblen" style="border-bottom:1px solid #e0e0e0 !important;">
          <img src="../images/help/referral.png" alt="" />
                  <p><span><a href="referral.php">Referrals</a></span><br />
How can I get more space</p>
          </div></div>
    
      <div style="clear:both"></div>
    </div>
    
    
      <div style="clear:both"></div>
       </div> 
       
       <div class="newtxti"><p>Stay up-to-date with product announcements, search for answers, watch our training videos, and share your suggestions with us and the community. </p>
<p>you can also submit a request and our friendly and knowledgeable support team members will be happy to assist you.
</p>
    </div>
    
    <div class="marbot15"><img src="../images/helpshadow.jpg" width="1002" height="68" alt="#" /></div>
    <div class="fivefaqmain">

    
    
    
    <div class="fivefaq">

    <h2>Top 5 Frequently Asked Questions</h2>
    <ul>
<li><a href="faq.php">What is DataBagg?</a></li>
<li><a href="faq.php">How to kick-start my Cloud journey with DataBagg?</a></li>
<li><a href="faq.php">What is Databagg USP – Unique Selling Proposition</a></li>
<li><a href="faq.php">Is my data safe with DataBagg</a></li>
<li><a href="faq.php">Who are the ideal users of DataBagg</a></li>
    </ul></div>
    
    
    <div class="fivefaq-col2">
    
    <h2>Other Resources</h2>
    <ul>
<li><a href="https://www.databagg.com/how-it-works.html">Find out how Databagg works</a></li>
<li><a href="#">Follow us on Twitter</a></li>
<li><a href="#">Become a Fan on Facebook</a></li>
    </ul></div>
    
    <div class="fivefaq-col3">
       
    <h2>Top 5 Watched Video Tutorials</h2>
    <ul>
<li><a href="https://www.databagg.com/coming.html">Backup Settings</a></li>
<li><a href="#">Selecting Files</a></li>
<li><a href="#">Managing your Account</a></li>
<li><a href="#">Restoring Files</a></li>
<li><a href="#">Checking for Updates</a></li>
    </ul></div>
    
    
    <div class="fivefaq-search">
    <div class="fivefaq-search-inside">
    <h2>Search the FAQs</h2>
    <strong>What do you need help with?</strong>
	<form name="loginBox" target="#here" method="post" action="search-result.php">
	
    <input name="shint" type="text" class="inputenec" />
	
	<input type="submit" />
</form>
	
	
     <h2>Contact Support</h2>
    <strong>Can't find an answer?</strong>
        
<div class="emailsupportbutton"><a href="mailto:support@databagg.com"><img src="../images/help/emailsupport.png"  alt="" border="0" /></a></div>
        
  
    </div>
    
    </div>
    
     <div style="clear:both"></div>    
    </div>
    
    
  <div style="clear:both"></div>
  
  </div>
  
  
	
    <div style="clear:both"></div>
</div>

</div>

  <?php include('../calling.html');?>
  </div>
   <?php include('../footer.php');?>
 



<div style="clear:both;"></div>
</div>
</body>
</html>
