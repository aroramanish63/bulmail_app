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
<div class="databag-menu">
    	<div class="databag-menu-left">
   <div class="underlinemenu-left">     
    <div class="underlinemenu">
<ul>
<li><a href="../features.html" style="background:none;">Features</a></li>

<li><a href="../free-trial.html">Free Trial</a></li>
</ul>
</div>
<div style="clear:both;"></div>
</div>
</div>
        <div class="databag-menu-middle">
        <div class="home"><a href="../index.php"><img src="../images/home.png" width="35" height="36" border="0" alt="" /></a></div>
        
</div>
        <div class="databag-menu-right">
        	<div class="underlinemenu-right-top">            
 <div class="login"><a href="../login.html"><img src="../images/login.png" alt="" width="81" height="36" border="0" /></a></div>
           <div class="loginsign"><a href="../signuup.html"><img src="../images/signup.png" alt=""  width="91" height="36" border="0" /></a></div> 
            </div>
        
        <div class="underlinemenu-right">     
    <div class="underlinemenu">
<ul>
<li><a href="../pricing.php" style="background:none;">Pricing</a></li>
<li><a href="../how-works.html">How it Works</a></li>
</ul>
</div>
<div style="clear:both;"></div>
</div>
</div>
  </div>
  
  

  <div class="other-content">
  <div class="other-content-top"></div>
    <div class="other-content-middle"><br />
    
<div class="avail-text-help"><ul>
<li>Help Center</li>
<li>&raquo;</li>
<li class="active"><a href="faq.html">FAQ's</a></li>

</ul>
</div>
    
 
    <div class="feature-content">
    
    <div><div class="helpcol-one">
   
    
    <div class="bubbleright clborder">
          <img src="../images/help/video.jpg" alt="" />
                  <p><span>Video Tutorials</span><br />
Watch step by step video tutorials</p>
          </div>
          
          
          
          <div class="bubbleright">
          <img src="../images/help/download&amp;ins.jpg"  alt="" />
                  <p><span>Demo</span><br />
Get the letest app 
download</p>
          </div>
          
          <div class="bubbleright">
          <img src="../images/help/billing.jpg" alt="" />
                  <p><span>Billing</span><br />
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
                  <p><span>FAQ's</span><br />
Find answer to our FAQ's</p>
          </div>
          
          
          
          <div class="bubblen">
          <img src="../images/help/community.jpg"  alt="" />
                  <p><span>Community</span><br />
Become involved with
Data Bagg</p>
          </div>
          
          <div class="bubblen">
          <img src="../images/help/referral.jpg" alt="" />
                  <p><span>Referrals</span><br />
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
    
    
    <div class="fivefaqmain">

    
    
    
    <div class="fivefaq">

    <h2>Top 5 Frequently Asked Questions</h2>
    <ul>
<li><a href="#">Is there an iPhone or iPad app?</a></li>
<li><a href="#">How do I update to the latest version?</a></li>
<li><a href="#">How do I restore my files?</a></li>
<li><a href="#">How do I update my credit card?</a></li>
<li><a href="#">I chose the wrong plan</a></li>
    </ul></div>
    
    
    <div class="fivefaq-col2">
    
    <h2>Other Resources</h2>
    <ul>
<li><a href="#">Find out how JustCloud works</a></li>
<li><a href="#">Follow us on Twitter</a></li>
<li><a href="#">Become a Fan on Facebook</a></li>
    </ul></div>
    
    <div class="fivefaq-col3">
       
    <h2>Top 5 Watched Video Tutorials</h2>
    <ul>
<li><a href="#">Backup Settings</a></li>
<li><a href="#">Selecting Files</a></li>
<li><a href="#">Managing your Account</a></li>
<li><a href="#">Restoring Files</a></li>
<li><a href="#">Checking for Updates</a></li>
    </ul></div>
    
    
    <div class="fivefaq-search">
    <div class="fivefaq-search-inside">
    <h2>Search the FAQs</h2>
    <strong>What do you need help with?</strong>
    <input name="" type="text" class="inputenec" />
     <h2>Contact Support</h2>
    <strong>Can't find an answer?</strong>
        
<input type="text" value="@ Email Support" name="Email" id="Email"
 onblur="if (this.value == '') {this.value = '@ Email Support';}"
 onfocus="if (this.value == '@ Email Support') {this.value = '';}" class="emailsupport" />
        
  
    </div>
    
    </div>
    
     <div style="clear:both"></div>    
    </div>
    
    
  <div style="clear:both"></div>
  
  </div>
  
  
	
    <div style="clear:both"></div>
</div>




<div class="callinimh"><img src="../images/calling.jpg" alt="" width="1000" height="189" border="0" usemap="#Map" />
  <map name="Map" id="Map">
    <area shape="rect" coords="579,114,891,145" href="mailto:sales@databagg.com" />
  </map>
</div>









<div class="footer">

<div class="footer-in-top"> 
<ul>
<li><strong>Product</strong></li>
<li><a href="pricing.html">Pricing</a></li>
<li><a href="features.html">Features</a></li>
<li><a href="how-works.html">How it works</a></li><li><a href="Download.html">Download</a></li>

</ul>


<ul>
<li><strong>Company</strong></li>
<li><a href="about-us.html">About Us</a></li>               
<li><a href="blogs.html">Blogs</a></li>                       
<li><a href="news.html">News</a></li> 
<li><a href="press-release.html">Press Release</a></li>        

</ul>


<ul>
<li><strong>Learn More</strong></li>
<li><a href="support.html">Support</a></li>
<li><a href="faqs.html">FAQs</a></li>
<li><a href="tutorial.html">Tutorial</a></li>
<li><a href="privacy-policy.html">Privacy Policy</a></li>
</ul>




<div class="social-media">
<h2>Connect with us</h2>
	<div class="social-media-t">
    	
        <div class="social-media-t-l">
        	<div class="social-media-t-l-img"><img src="../images/facebook.png" alt=""  /></div>
            	<div class="social-media-t-l-text"><a href="http://www.facebook.com/Databagg">Facebook</a></div>
        
        </div>
    
    
    
    <div class="social-media-t-r">
        	<div class="social-media-t-l-img"><img src="../images/twitter.png" alt=""  /></div>
            	<div class="social-media-t-l-text"><a href="https://twitter.com/DataBagg">Twitter</a></div>
        
        </div>
    </div>
    
    
    
    
    
    <div class="social-media-b">
    	
        <div class="social-media-t-l">
        	<div class="social-media-t-l-img"><img src="../images/gplus.png" alt=""  /></div>
            	<div class="social-media-t-l-text"><a href="https://plus.google.com/117226672667714086519/posts?hl=en-GB">Google+</a></div>
        
        </div>
    
    
    
    <div class="social-media-t-r">
        	<div class="social-media-t-l-img"><img src="../images/in.png"  alt="" /></div>
            	<div class="social-media-t-l-text"><a href="http://in.linkedin.com/pub/databagg/62/9b4/570">Linkdin</a></div>
        
        </div>
    
    
    
    </div>
</div>

</div>
<div style="clear:both;"></div>
</div>


<div class="footer-in-bottom">    
 
   <div class="textfooter">Copyright &copy; 2012 <strong><a href="index.php">Data Bagg</a></strong>, Inc. All rights reserved.</div>
   
   	<div class="textfooterimg-right"> <a href="index.php"><img src="../images/bottomlogo.png" alt="" border="0" /></a></div>
</div>

<div style="clear:both;"></div>
</div>
</body>
</html>
