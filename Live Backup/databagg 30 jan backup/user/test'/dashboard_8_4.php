<?php
session_start();
if(!$_SESSION['user_id'])
header("Location:../login.php");
include("../connect.php");
include("../function.php");
$select_user_data="select * from tab_members where int_id='".$_SESSION['user_id']."'";
$result_user_data=mysql_query($select_user_data) or die(mysql_error());
$fetch_user_data=mysql_fetch_array($result_user_data);

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>//Data Bagg//</title>
<link href="css/style_dash.css" type="text/css" rel="stylesheet" />
<script src="js/dw_lib.js" type="text/javascript"></script>
<script src="js/dw_glide.js" type="text/javascript"></script>
<script src="js/layermenu.js" type="text/javascript"></script>

<!-- ukey="24717B8D" --> 

<link rel="stylesheet" href="css/design_dash.css" type="text/css" media="all">
<script language="JavaScript" type="text/JavaScript">
<!--
MM_reloadPage(true);
//-->
</script>
<script type="text/javascript">
//ContentSlider("slider1", 3000)
</script>

</head>



<body style="overflow-x:hidden;">

<script>
var mydiv_rightpos=-220; var mydiv_fluc=20; var mydiv_timer;
function moveMyDiv()
                {
                if(mydiv_rightpos<0)
                                {
                                mydiv_rightpos+=mydiv_fluc;
                                document.getElementById("mydiv").style.right=mydiv_rightpos + "px"
                                mydiv_timer=setTimeout("moveMyDiv()",100)
                                }
                else
                                clearTimeout(mydiv_timer);
                }

function closeMyDiv()
                {
                //document.title=e.target
                if(mydiv_rightpos>-220)
                                {
                                mydiv_rightpos-=mydiv_fluc;
                                document.getElementById("mydiv").style.right=mydiv_rightpos + "px"
                                mydiv_timer=setTimeout("closeMyDiv()",100)
                                }
                else
                                clearTimeout(mydiv_timer);
                }

document.onclick=closeMyDiv;
                
</script>

<div id="mydiv" >

<div id="mydiv1">
  <div style="float: left;margin-top: 50px;"><img src="image/open.png" width="33"  height="44" onmouseover="moveMyDiv()"></div>
                  <span class="rightbox">
<div class="bg_slider">
  <div class="right_menu">
                 <a href="index.php?name_page=my_settings" class="my_profile active">My Profile</a>
  	             <a href="logout.php" class="logout">logout</a>	
  </div>
<div class="width fleft" >
                <div class="profile_box fleft">
                                <img src="<?php if($fetch_user_data['txt_image']){ echo "profile_pic/".$_SESSION['user_id']."/".$fetch_user_data['txt_image']; } else echo "images/avtar.jpg"; ?>" alt="">
                </div>
                <div class="fleft" style="width:120px;">
                                <h4 class="name"><?php echo $fetch_user_data['txt_first_name']." ".$fetch_user_data['txt_last_name']; ?></h4>
                                <h6><?php echo $fetch_user_data['txt_designation']; ?></h6>
                </div>
</div>
<div class="fleft yello_rang">
<p class="fleft">Space</p>
<p class="fright"><?php echo total_space_used(); ?> MB / 5,120 MB</p>
<div class="fleft rang">
<div class="yello" style="width: <?php echo number_format(round((total_space_used()*100)/5120))."%"; ?>;"></div>
</div>
</div>
<div class="pattern_right_slider fleft">
<div class="cmpy_img fleft"></div>
<h3 class="italic fleft">Company</h3>
</div>
<div class="box_color">
<h4><?php echo $fetch_user_data['txt_company']; ?></h4>

</div>
<div class="pattern_right_slider fleft">
<div class="cmpy_resources fleft"></div>
<h3 class="italic fleft">Resources</h3>
</div>
<div class="box_color1">
<ul class="right_link">
<li><a href="#">Service Information</a></li>
<li><a href="#">Product Brochures</a></li>
</ul>
</div>
<div class="pattern_right_slider fleft">
<div class="cmpy_carehelp fleft"></div>
<h3 class="italic fleft">Care Help</h3>
</div>
<div class="box_color1">
<ul class="right_link">
<li><a href="#">User Guide</a></li>
<li><a href="#">Jump to Specific Tutorials</a></li>
</ul>
</div>
<div class="pattern_right_slider fleft">
<div class="cmpy_contact fleft"></div>
<h3 class="italic fleft">Contacts</h3>
</div>
<div class="box_color">
<h4>Cyber Futuristics India Pvt. 
Ltd.</h4>
<h5>#1000000239<br>
<span class="blue">@ - 
<a href="mailto:help@databagg.com">help@databagg.com </a>
</span>
</h5>

</div>




</div>


                
                  </span>

</div>
</div>
















<!-- Right  Glider  Start -->
<div class="data_container clearfix">
<div class="logo" style="width:100%;"></div>
</div>
<div class="pattern">
<div class="data_mid">
<a href="index.php?name_page=home">
<div class="data_box1" onmouseover="document.getElementById('p1').style.color='#76cdf1';" onmouseout="document.getElementById('p1').style.color='#999999';">
<div class="fleft"><img src="image/box1.png" alt="" /></div>
<h1>My Data Bagg</h1>
<p id="p1">Store everything under one
platform. Upload, synchronize and share: With just one click...</p>
</div>
</a>
<a href="index.php?name_page=my_sync">
<div class="data_box1" onmouseover="document.getElementById('p2').style.color='#76cdf1';" onmouseout="document.getElementById('p2').style.color='#999999';">
<div class="fleft"><img src="image/sync_box.png" alt="" /></div>
<h1>Sync Folders</h1>
<p id="p2">Databagg brings convenience to 
your fingertip; Sync the whole 
folder in one go...</p>
</div>
</a>
<a href="index.php?name_page=shared_data">
<div class="data_box1" onmouseover="document.getElementById('p3').style.color='#76cdf1';" onmouseout="document.getElementById('p3').style.color='#999999';">
<div class="fleft"><img src="image/shared_box.png" alt="" /></div>
<h1>Shared</h1>
<p id="p3">Hassle free categorization of data, based on your own requirements...</p>
</div>
</a>
<a href="index.php?name_page=my_data&page_type=music">
<div class="data_box1" onmouseover="document.getElementById('p4').style.color='#76cdf1';" onmouseout="document.getElementById('p4').style.color='#999999';">
<div class="fleft"><img src="image/music_box.png" alt="" /></div>
<h1>My Music</h1>
<p id="p4">Enjoy music to the fullest! Store 
your music in our bag, share & 
collaborate right here...</p>
</div>
</a>
<a href="index.php?name_page=my_data&page_type=video">
<div class="data_box1" onmouseover="document.getElementById('p5').style.color='#76cdf1';" onmouseout="document.getElementById('p5').style.color='#999999';">
<div class="fleft"><img src="image/myvideo_box.png" alt="" /></div>
<h1>My Videos</h1>
<p id="p5">Videos are personal; Secure and 
store all your videos in just one 
location...</p>
</div>
</a>
<a href="index.php?name_page=my_data&page_type=gallary">
<div class="data_box1" onmouseover="document.getElementById('p6').style.color='#76cdf1';" onmouseout="document.getElementById('p6').style.color='#999999';">
<div class="fleft"><img src="image/myalbums_box.png" alt="" /></div>
<h1>My Albums</h1>
<p id="p6">Collect and collaborate all your pictures at one single location. 
Databagg makes it super easy...</p>
</div>
</a>
<a href="index.php?name_page=my_settings">
<div class="data_box1" onmouseover="document.getElementById('p7').style.color='#76cdf1';" onmouseout="document.getElementById('p7').style.color='#999999';">
<div class="fleft"><img src="image/mydownload_box.png" alt="" /></div>
<h1>My Settings</h1>
<p id="p7">Collect all your files, spread over everywhere, into one centralized location.</p>
</div>
</a>
<a href="index.php?name_page=contacts">
<div class="data_box1" onmouseover="document.getElementById('p8').style.color='#76cdf1';" onmouseout="document.getElementById('p8').style.color='#999999';">
<div class="fleft"><img src="image/contacts.png" alt="" /></div>
<h1>Contacts</h1>
<p id="p8">Find all your friends and family over here. Simply scroll the list to locate 
the one whom you are searching..</p>
</div>
</a>
<div class="data_box1" onmouseover="document.getElementById('p9').style.color='#76cdf1';" onmouseout="document.getElementById('p9').style.color='#999999';">
<div class="fleft"><img src="image/help_box.png" alt="" /></div>
<h1>help?</h1>
<p id="p9">Need help? Want assistance? Click here!...</p>
</div>




</div>

</div>
<div class="footer">
<p>©2012 <span>Databagg</span></p>
<ul id="footer" class="fleft">
    <li><a href="#" class="active">Terms</a></li>
    <li><a href="#">Privacy Policy</a></li>
    <li><a href="#">Partner with us</a></li>
    <li><a href="#">Contact Fujibox</a></li>
    <li ><a href="#" class="right_b">Help </a></li>
    </ul> </div>
   

</div>

</body>
</html>
