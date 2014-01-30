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
          
          <div class="bubbleright" style="height:89px !important;">
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
          
          <div class="bubblen" style="height:90px !important;">
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
<li><a href="faq.php#ans3">How do I install DataBaGG?</a></li>
<li><a href="faq.php#ans2">How secure is my data?</a></li>
<li><a href="faq.php#ans1">How do I know DataBaGG is installed?</a></li>
<li><a href="faq.php#ans4">What operating systems does DataBaGG run on?</a></li>
<li><a href="faq.php#ans5">Who are the ideal users of DataBaGG</a></li>
    </ul></div>
    
    
    <div class="fivefaq-col2">
    
    <h2>Other Resources</h2>
    <ul>
<li><a href="https://www.databagg.com/index.php?id=1">Find out how DataBaGG works</a></li>
<li><a href="https://twitter.com/DataBagg" target="_blank">Follow us on Twitter</a></li>
<li><a href="https://www.facebook.com/Databagg" target="_blank">Become a Fan on Facebook</a></li>
    </ul></div>
    
    <div class="fivefaq-col3">
       
    <h2>Top 5 Watched Video Tutorials</h2>
    <ul>
<li><a href="video-tutorial.php">Backup Settings</a></li>
<li><a href="video-tutorial.php">Selecting Files</a></li>
<li><a href="video-tutorial.php">Managing your Account</a></li>
<li><a href="video-tutorial.php">Restoring Files</a></li>
<li><a href="video-tutorial.php">Checking for Updates</a></li>
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
