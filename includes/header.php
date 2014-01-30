<?php if ( ! defined('BASE_PATH')) exit('No direct script access allowed'); ?>
   
<?php $siteConfig->load_class('menuFunction'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Bulk Mailing CRM</title>
       
        <!-- CSS Reset -->
		<link rel="stylesheet" type="text/css" href="<?php echo STYLEPATH; ?>reset.css" media="screen" />
       
        <!-- Fluid 960 Grid System - CSS framework -->
		<link rel="stylesheet" type="text/css" href="<?php echo STYLEPATH; ?>grid.css" media="screen" />
		
        <!-- IE Hacks for the Fluid 960 Grid System -->
        <!--[if IE 6]><link rel="stylesheet" type="text/css" href="<?php echo STYLEPATH; ?>ie6.css" tppabs="http://www.xooom.pl/work/magicadmin/css/ie6.css" media="screen" /><![endif]-->
		<!--[if IE 7]><link rel="stylesheet" type="text/css" href="<?php echo STYLEPATH; ?>ie.css" tppabs="http://www.xooom.pl/work/magicadmin/css/ie.css" media="screen" /><![endif]-->
        
        <!-- Main stylesheet -->
        <link rel="stylesheet" type="text/css" href="<?php echo STYLEPATH; ?>styles.css" tppabs="http://www.xooom.pl/work/magicadmin/css/styles.css" media="screen" />
        
        <!-- WYSIWYG editor stylesheet -->
        <!--<link rel="stylesheet" type="text/css" href="<?php echo STYLEPATH; ?>jquery.wysiwyg.css" tppabs="http://www.xooom.pl/work/magicadmin/css/jquery.wysiwyg.css" media="screen" />-->
        
        <!-- Table sorter stylesheet -->
        <link rel="stylesheet" type="text/css" href="<?php echo STYLEPATH; ?>tablesorter.css" tppabs="http://www.xooom.pl/work/magicadmin/css/tablesorter.css" media="screen" />
        
        <!-- Thickbox stylesheet -->
        <link rel="stylesheet" type="text/css" href="<?php echo STYLEPATH; ?>thickbox.css" tppabs="http://www.xooom.pl/work/magicadmin/css/thickbox.css" media="screen" />
        
        <!-- Themes. Below are several color themes. Uncomment the line of your choice to switch to different color. All styles commented out means blue theme. -->
        <link rel="stylesheet" type="text/css" href="<?php echo STYLEPATH; ?>theme-blue.css" tppabs="http://www.xooom.pl/work/magicadmin/css/theme-blue.css" media="screen" />       
        
        <link rel="stylesheet" type="text/css" href="<?php echo STYLEPATH; ?>dropdownmenu.css" />
		<!-- JQuery engine script-->
		<!--<script type="text/javascript" src="<?php echo SCRIPTPATH; ?>jquery-1.3.2.min.js" tppabs="http://www.xooom.pl/work/magicadmin/js/jquery-1.3.2.min.js"></script>-->
        <!--<script type="text/javascript" src="<?php echo SCRIPTPATH; ?>logintab/jquery2.js"></script>-->
                <script src="<?php echo SCRIPTPATH; ?>jquery-1.10.1.min.js" type="text/javascript"></script>
                <script src="<?php echo SCRIPTPATH; ?>jquery-migrate-1.0.0.js" type="text/javascript"></script>
		<!-- JQuery WYSIWYG plugin script -->
		<!--<script type="text/javascript" src="<?php echo SCRIPTPATH; ?>jquery.wysiwyg.js" tppabs="http://www.xooom.pl/work/magicadmin/js/jquery.wysiwyg.js"></script>-->
                
        <!-- JQuery tablesorter plugin script-->
		<script type="text/javascript" src="<?php echo SCRIPTPATH; ?>jquery.tablesorter.min.js" tppabs="http://www.xooom.pl/work/magicadmin/js/jquery.tablesorter.min.js"></script>
        
		<!-- JQuery pager plugin script for tablesorter tables -->
		<script type="text/javascript" src="<?php echo SCRIPTPATH; ?>jquery.tablesorter.pager.js" tppabs="http://www.xooom.pl/work/magicadmin/js/jquery.tablesorter.pager.js"></script>
        
		<!-- JQuery password strength plugin script -->
		<script type="text/javascript" src="<?php echo SCRIPTPATH; ?>jquery.pstrength-min.1.2.js" tppabs="http://www.xooom.pl/work/magicadmin/js/jquery.pstrength-min.1.2.js"></script>
               
		<!-- JQuery thickbox plugin script -->
		<script type="text/javascript" src="<?php echo SCRIPTPATH; ?>thickbox.js" tppabs="http://www.xooom.pl/work/magicadmin/js/thickbox.js"></script>
                
                <script type="text/javascript" src="<?php echo SCRIPTPATH; ?>menu/hoverIntent.js"></script>
                
		<script type="text/javascript" src="<?php echo SCRIPTPATH; ?>menu/superfish.js"></script>
        
                <!--<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>-->
                    
                <!--<link rel="stylesheet" href="<?php echo STYLEPATH; ?>login.css" type="text/css" />-->
  
                <script type="text/javascript" src="<?php echo SCRIPTPATH; ?>logintab/login.js"></script>

                
                
                <script type="text/javascript" src="<?php echo SCRIPTPATH; ?>commonjs.js"></script>
                
                
	</head>
	<body>
    	<!-- Header -->
        <div id="header">                                  
            <!-- Header. Main part -->
            <div id="header-main">
                <div class="container_12">
                    <div class="grid_12">
                    <div class="headerpanel">
                            <div id="logo"><a href="<?php echo SITE_URL; ?>"><img src="<?php echo IMAGEPATH; ?>logo.png"  alt="#" /></a></div>
                            <div class="headerright"> 
                                    <div style="width:auto; float:right; text-align:right; margin:5px 60px 0 0; color:#FFF;" >
                                    <div class="usericon"><?php if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){ ?><img src="<?php echo IMAGEPATH; ?>usericon.png" alt="#" 	  border="0"  /></div><?php echo ucwords($_SESSION['username']); ?><?php } ?></div>
                                    <div style="position:absolute; top:-1px; right:-9px;"><a href="#" style="color:#000; margin-top:-5px; text-decoration:none;" id="loginButton"  ><img src="<?php echo IMAGEPATH; ?>logintab2.png" alt="#"  border="0"  /></a></div>                                                                        
                                    <div  style="display: none; padding:15px; background-color:#FFF; float:right;  margin: 51px 0 0 -13px; position: absolute;" id="loginBox">
                                    <a class="logoutbutton" href="<?php echo LOGOUT_URL; ?>" id="logout">Logout</a><br />
                                     <a class="myprofile" href="#">My Profile</a>
                                             </div>                                                                       
                            </div>
                        </div>
                       
                       <!--Menu section start here-->                       
                            <div class="menu">
                                <?php $menu = new menuFunction(); ?>
                           </div>
                       <!--Menu section end here-->                       
                    </div><!-- End. .grid_12-->
                    <div style="clear: both;"></div>
                </div><!-- End. .container_12 -->
            </div>
            <div style="clear: both;"></div>
            <!-- Sub navigation -->
            <div id="subnav">
                <div class="container_12">
                    <div class="grid_12"> 
                    </div> <!--  End. .grid_12 -->
            </div> <!--  End. .container_12 -->
                <div style="clear: both;"></div>
          </div>  <!--  End #subnav -->
        </div> <!-- End #header -->
        
        