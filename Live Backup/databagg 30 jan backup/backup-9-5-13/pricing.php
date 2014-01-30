<?php
session_start();
unset($_SESSION['planid']);
?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Databagg</title>

<link href="App_Theme/mainstyle.css" rel="stylesheet" type="text/css" />

<link href='http://fonts.googleapis.com/css?family=PT+Sans:400' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="mainpageheader">
<div class="databag-menu">
    	<div class="databag-menu-left">
   <div class="underlinemenu-left">     
    <div class="underlinemenu">
<ul>
<li><a href="features.html" style="background:none;">Features</a></li>
<li><a href="free-trial.html">Free Trial</a></li>
</ul>
</div>
<div style="clear:both;"></div>
</div>
</div>
        <div class="databag-menu-middle">
        <div class="home"><a href="index.php"><img src="images/home.png" width="35" height="36" border="0" alt="" /></a></div>
        
</div>
        <div class="databag-menu-right">
        	<div class="underlinemenu-right-top">
		<?php if(!isset($_SESSION['user_id'])) {  ?>   
		<div class="login"><a href="login.html"><img src="images/login.png" alt="" width="81" height="36" border="0" /></a></div>
		<div class="loginsign"><a href="signuup.html"><img src="images/signup.png" alt=""  width="91" height="36" border="0" /></a>
		</div>
		<?php } ?>
            </div>
        
        <div class="underlinemenu-right">     
    <div class="underlinemenu">
<ul>
<li><a href="pricing.php" style="background:none;">Pricing</a></li>
<li><a href="how-works.html">How it Works</a></li>
</ul>
</div>
<div style="clear:both;"></div>
</div>
</div>
  </div> 
  <div class="other-content">
  <div class="other-content-top"></div>
    <div class="other-content-middle">
   <div class="avail"><img src="images/avail.png" width="941" height="87" alt="" /></div>
   <div class="freetrial">
    
    	<div class="freetrial-left-pricing">
        
        <h2>Personal</h2>
       
       <div class="pricing-new-top"></div>
       <div class="pricing-new-middle">
       
       <div class="freetrial-right-pricing-clmun-o">
       <div align="center" class="gbspace">
          <img src="images/100gb.png" alt="" /></div>
          <div class="gbspace-price">
          Monthly<br />
         $7.95
          <div class="buynowln"><a href="confirm_plan.php?planid=1"><img src="images/upgrade.png" alt="" border="0" /></a></div>
          
          </div>
          
          <div class="gbspace-price">
          
          Yearly<br />
         $79.95
          <div class="buynowln"><a href="confirm_plan.php?planid=2"><img src="images/upgrade.png" alt="" border="0" /></a></div>
          
          </div>
          
          </div>
       	<div class="freetrial-right-pricing-clmun-t">
        
        <div align="center" class="gbspace">
          <img src="images/250gb.png" alt="" /></div> 
        <div class="gbspace-price">
          Monthly<br />
         $16.95
          <div class="buynowln"><a href="confirm_plan.php?planid=3"><img src="images/upgrade.png" alt="" border="0" /></a></div>
          
          </div>
          
          
          
          <div class="gbspace-price">
         Yearly<br />
         $169.95
          <div class="buynowln"><a href="confirm_plan.php?planid=4"><img src="images/upgrade.png" alt="" border="0" /></a></div>
          
          </div>
        </div>
        
        <div class="freetrial-right-pricing-clmun-th">
        <div align="center" class="gbspace">
          <img src="images/100gb.png" alt="" /></div>
        
        <div class="gbspace-price">
          Monthly<br />
         $29.95
          <div class="buynowln"><a href="confirm_plan.php?planid=5"><img src="images/upgrade.png" alt="" border="0" /></a></div>
          
          </div>
          <div class="gbspace-price">
        Yearly<br />
         $299.95 
          <div class="buynowln"><a href="confirm_plan.php?planid=6"><img src="images/upgrade.png" alt="" border="0" /></a></div>
          
          </div>
        
        </div>
       
       
       </div>
       <div class="pricing-new-bottom"></div>
       
        <div style="clear:both"></div>
        </div> 
        	
            
            <div class="freetrial-right-pricing">
               <h2>Small Business</h2>
               <div class="h2last">Enterprise</div>
               
          <div class="freetrial-right-pricing-top"></div>
          <div class="freetrial-right-pricing-middle"> 
          <div class="freetrial-right-pricing-clmun-o">
          
          <div align="center" class="gbspace">
          <img src="images/5tb.png" alt="" /></div>
        
        <div class="gbspace-price">
          Monthly<br />
         $69.95
          <div class="buynowln"><a href="confirm_plan.php?planid=7"><img src="images/upgrade2.png" alt="" border="0" /></a></div>
          
          </div>
          <div class="gbspace-price">
        Yearly<br />
         $699.95
          <div class="buynowln"><a href="confirm_plan.php?planid=8"><img src="images/upgrade2.png" alt="" border="0" /></a></div>
          
          </div>
          
          
          </div>
       	<div class="freetrial-right-pricing-clmun-t">
       	  <div align="center" class="gbspace">
          <img src="images/unlimiteso-off.png" alt="" /></div>
        
        <div class="gbspace-price">
          Monthly<br />
         $99.95
          <div class="buynowln"><a href="confirm_plan.php?planid=9"><img src="images/upgrade3.png" alt="" border="0" /></a></div>
          
          </div>
          <div class="gbspace-price">
        Yearly<br />
         $999.95
          <div class="buynowln"><a href="confirm_plan.php?planid=10"><img src="images/upgrade3.png" alt="" border="0" /></a></div>
          
          </div></div>
      
       </div>
          <div class="freetrial-right-pricing-bottom"></div>
            <div style="clear:both"></div>
            </div>
    
    </div>
   <div style="clear:both"></div>
    </div>
    <div class="other-content-bottom"></div>
    <div style="clear:both"></div>
  
  </div>
  
  
	
    <div style="clear:both"></div>
</div>




<div class="callinimh"><img src="images/calling.jpg" alt="" width="1000" height="189" border="0" usemap="#Map" />
  <map name="Map" id="Map">
    <area shape="rect" coords="579,114,891,145" href="mailto:sales@databagg.com" />
  </map>
</div>









<div class="footer">

<div class="footer-in-top"> 
<ul>
<li><strong>Product</strong></li>
<li><a href="pricing.php">Pricing</a></li>
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
<li><a href="help/index.php">Help</a></li>
<li><a href="tutorial.html">Tutorial</a></li>
<li><a href="privacy-policy.html">Privacy Policy</a></li>
</ul>




<div class="social-media">
<h2>Connect with us</h2>
	<div class="social-media-t">
    	
        <div class="social-media-t-l">
        	<div class="social-media-t-l-img"><img src="images/facebook.png" alt=""  /></div>
            	<div class="social-media-t-l-text"><a href="http://www.facebook.com/Databagg">Facebook</a></div>
        
        </div>
    
    
    
    <div class="social-media-t-r">
        	<div class="social-media-t-l-img"><img src="images/twitter.png" alt=""  /></div>
            	<div class="social-media-t-l-text"><a href="https://twitter.com/DataBagg">Twitter</a></div>
        
        </div>
    </div>
    
    
    
    
    
    <div class="social-media-b">
    	
        <div class="social-media-t-l">
        	<div class="social-media-t-l-img"><img src="images/gplus.png" alt=""  /></div>
            	<div class="social-media-t-l-text"><a href="https://plus.google.com/117226672667714086519/posts?hl=en-GB">Google+</a></div>
        
        </div>
    
    
    
    <div class="social-media-t-r">
        	<div class="social-media-t-l-img"><img src="images/in.png"  alt="" /></div>
            	<div class="social-media-t-l-text"><a href="http://in.linkedin.com/pub/databagg/62/9b4/570">Linkdin</a></div>
        
        </div>
    
    
    
    </div>
</div>

</div>
<div style="clear:both;"></div>
</div>


<div class="footer-in-bottom">    
 
   <div class="textfooter">Copyright &copy; 2012 <strong><a href="index.php">Data Bagg</a></strong>, Inc. All rights reserved.</div>
   
   	<div class="textfooterimg-right"> <a href="index.php"><img src="images/bottomlogo.png" alt="" border="0" /></a></div>
</div>
</body>
</html>
