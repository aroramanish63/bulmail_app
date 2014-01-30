<?php
session_start();
if(!isset($_SESSION["user_id"]))
header("Location:../login.php");

include("../connect.php");
include("../function.php");
error_reporting(0);

if(isset($_REQUEST['mail']))
{
    mail_verify($_REQUEST['mail'],$_REQUEST['nm']);
    ?>
    <script>
    alert("Verification mail send on, <?php echo $_REQUEST['mail']; ?> Please verify it.");
    </script>
    <?php
}

$pagename="home.php";
if(isset($_REQUEST["name_page"]))
	$pagename=$_REQUEST["name_page"].".php";
$select_user_data="select * from tab_members where int_id='".$_SESSION['user_id']."'";
$result_user_data=mysql_query($select_user_data) or die(mysql_error());
$fetch_user_data=mysql_fetch_array($result_user_data);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <title>Data Bagg</title>
<script></script>
<link href="css/style.css" type="text/css" rel="stylesheet" />
<link href="css/design_dash.css" type="text/css" rel="stylesheet" />

<script src="js/jquery-1.2.2.pack.js" type="text/javascript"></script>




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
<a href="mailto:help@databagg.com">help@databagg.com </a> <br /> <br />

<?php
if($fetch_user_data['int_verified']==0)
{
$em_enc=$fetch_user_data['txt_email'];
$nm=$fetch_user_data['txt_first_name'];
    //$dest="http://www.databagg.com/verify.php?code=".$em_enc;
echo "<font color='red'>Unverified Account !  Please Verify it or <a href='index.php?nm=$nm&mail=$em_enc' > Resend Email </a> </font>";
}

?>
</span>
</h5>

</div>





</div>


                
                  </span>

</div>
</div>

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <script src="js/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/jquery-1.7.2.min.js"><\/script>')</script>

<!--[if (gte IE 6)&(lte IE 8)]>
<script src="js/selectivizr.js"></script>
<![endif]-->

<script src="js/scripts.js"></script>

<!-- Asynchronous Google Analytics snippet. Change UA-XXXXX-X to be your site's ID. -->
<script>
 var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
 (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
 g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
 s.parentNode.insertBefore(g,s)}(document,'script'));
</script>
 
 

    
    <?php include"header.php"; ?>
    
  <div class="ind_pattern">
<div class="index_mid">
<div class="ind_data_mid">

<div class="width">
<div class="fleft">
    
    <ul class="index_tab clearfix">
                          <li class="<?php if($_REQUEST['name_page']=='my_sync') echo "active_leftmenu"; else echo "index_tab1"; ?>"><a href="index.php?name_page=my_sync">          
                            <div class="fleft" style="margin:10px 5px 0 0;"><img src="image/sync_icon.png"  alt="" /></div>
                            Sync Folders<br />
                     	    <span class="text">Sync the whole</span>                          </a></li>
                            <li class="<?php if($_REQUEST['name_page']=='home') echo "active_leftmenu"; else echo "index_tab1"; ?>"><a href="index.php?name_page=home">          
                            <div class="fleft" style="margin:10px 5px 0 0;"><img src="image/my_databagg_icon.png"  alt="" /></div>
                            My Data Bagg<br />
                     	    <span class="text">Store everything</span>                          </a></li>
                           <!-- <li class="<?php if($_REQUEST['name_page']=='home') echo "active_leftmenu"; else echo "index_tab1"; ?>"><a href="index.php?name_page=home">          
                            <div class="fleft" style="margin:10px 5px 0 0;"><img src="image/my_databagg_icon.png"  alt="" /></div>
                            My Data Bagg
                            <br />
                     	    <span class="text">Store everyth</span></a></li>  -->
                              <li class="<?php if($_REQUEST['name_page']=='shared_data') echo "active_leftmenu"; else echo "index_tab1"; ?>"><a href="index.php?name_page=shared_data">         
                            <div class="fleft" style="margin:10px 5px 0 0;">					  							<img src="image/shared_icon.png"  alt="" /></div>
                            Shared<br />
                     	    <span class="text">Categorization</span>                          </a></li>
                               <li class="<?php if($_REQUEST['name_page']=='my_data' && $_REQUEST['page_type']=='music') echo "active_leftmenu"; else echo "index_tab1"; ?>">
                               <a href="index.php?name_page=my_data&page_type=music">          
                            <div class="fleft" style="margin:10px 5px 0 0;">					  							<img src="image/my_music_icon.png"  alt="" /></div>
                            My Music<br />
                     	   <span class="text">Enjoy music</span>                          </a></li>
                               <li class="<?php if($_REQUEST['name_page']=='my_data' && $_REQUEST['page_type']=='video') echo "active_leftmenu"; else echo "index_tab1"; ?>"><a href="index.php?name_page=my_data&page_type=video">          
                            <div class="fleft" style="margin:10px 5px 0 0;">					  							<img src="image/my_video_icon.png"  alt="" /></div>
                            My Videos<br />
                     	    <span class="text">Videos upload</span>                          </a></li>
                               <li class="<?php if($_REQUEST['name_page']=='my_data' && $_REQUEST['page_type']=='gallary') echo "active_leftmenu"; else echo "index_tab1"; ?>"><a href="index.php?name_page=my_data&page_type=gallary">          
                            <div class="fleft" style="margin:10px 5px 0 0;">					  							<img src="image/my_album_icon.png"  alt="" /></div>
                            My Albums<br />
                     	    <span class="text">Collaborate Pics</span>                          </a></li>
                               <li class="<?php if($_REQUEST['name_page']=='contacts') echo "active_leftmenu"; else echo "index_tab1"; ?>"><a href="index.php?name_page=contacts">          
                            <div class="fleft" style="margin:10px 5px 0 0;">					  							<img src="image/contact_icon.png"  alt="" /></div>
                           Contacts<br />
                     	    <span class="text">Find your friend</span>                          </a></li>
                             <li class="<?php if($_REQUEST['name_page']=='my_settings') echo "active_leftmenu"; else echo "index_tab1"; ?>"><a href="index.php?name_page=my_settings">          
                            <div class="fleft" style="margin:5px 0 0 0;">					  							<img src="image/Settings.png"  alt="" /></div>
                           My Settings<br />
                     	   <span class="text"> Change settings</span>                          </a></li>
                               <li class="<?php if($_REQUEST['name_page']=='trash_data') echo "active_leftmenu"; else echo "index_tab1"; ?>"><a href="index.php?name_page=trash_data">          
                            <div class="fleft" style="margin:10px 5px 0 0;">					  							<img src="image/trash_icon.png"  alt="" /></div>
                            Trash Bagg<br />
                     	   <span class="text">Deleted items</span>                          </a></li>
                           
                            <li class="index_tab1"><a href="#tab9">          
                            <div class="fleft" style="margin:10px 5px 0 0;">					  							<img src="image/help_icon.png"  alt="" /></div>
                            Help?<br />
                     	   <span class="text">Need help</span>                          </a></li>
                                    			</ul>


</div>
<div class="fleft" style="background: #fff; width: 852px; margin: 0 0 50px -3px; overflow: hidden;">
     
  <?php include"$pagename"; ?>
  
</div>

</div>



<!--</div>-->
</div>
</div>
</div>
</div>  
   
    <?php include"footer.php"; ?>

</body>
	<a href="#" title="Scroll to top" class="scrollup">Scroll</a>

</html>
	<style type="text/css">

		
		.scrollup{
			width:40px;
			height:40px;			
			text-indent:-9999px;
			opacity:0.3;
			position:fixed;
			bottom:70px;
			right:100px;
			display:none;			
			background: url('icon_top.png') no-repeat;
		}
	
		

		</style>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript">
			$(document).ready(function(){ 
			
			$(window).scroll(function(){
				if ($(this).scrollTop() > 100) {
					$('.scrollup').fadeIn();
				} else {
					$('.scrollup').fadeOut();
				}
			}); 
			
			$('.scrollup').click(function(){
				$("html, body").animate({ scrollTop: 0 }, 600);
				return false;
			});
 
		});
		</script>

<script>
	var xmlhttp;
function testXML(){

	if(window.XMLHttpRequest)
  {
	//code for IE7 and hiegher version
	xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=ActiveXObject("Microsoft.XMLHTTP");
	}
return xmlhttp;	
}

function big(val)
{
		var strURL="ajax_crt_plst.php?pid="+val;

		var req = testXML();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					
					// only if "OK"
					if (req.status == 200) {
					
						
                        if(req.responseText)
                        {
                             frameset=parent.document.getElementById("main");
                             frameset.setAttribute("rows","10%,*");
                             parent.document.getElementById("menu").src="ply.php";
                             document.getElementById('img1').style.display='block';
                        
                        }
                        else
                        {
                           
                        }
                       				
						
					} else {
					//	alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	
}


</script>
