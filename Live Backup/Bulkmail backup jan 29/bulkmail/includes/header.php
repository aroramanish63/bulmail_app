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
        <link rel="stylesheet" type="text/css" href="<?php echo STYLEPATH; ?>jquery.wysiwyg.css" tppabs="http://www.xooom.pl/work/magicadmin/css/jquery.wysiwyg.css" media="screen" />
        
        <!-- Table sorter stylesheet -->
        <link rel="stylesheet" type="text/css" href="<?php echo STYLEPATH; ?>tablesorter.css" tppabs="http://www.xooom.pl/work/magicadmin/css/tablesorter.css" media="screen" />
        
        <!-- Thickbox stylesheet -->
        <link rel="stylesheet" type="text/css" href="<?php echo STYLEPATH; ?>thickbox.css" tppabs="http://www.xooom.pl/work/magicadmin/css/thickbox.css" media="screen" />
        
        <!-- Themes. Below are several color themes. Uncomment the line of your choice to switch to different color. All styles commented out means blue theme. -->
        <link rel="stylesheet" type="text/css" href="<?php echo STYLEPATH; ?>theme-blue.css" tppabs="http://www.xooom.pl/work/magicadmin/css/theme-blue.css" media="screen" />       
        
		<!-- JQuery engine script-->
		<script type="text/javascript" src="<?php echo SCRIPTPATH; ?>jquery-1.3.2.min.js" tppabs="http://www.xooom.pl/work/magicadmin/js/jquery-1.3.2.min.js"></script>
        
		<!-- JQuery WYSIWYG plugin script -->
		<script type="text/javascript" src="<?php echo SCRIPTPATH; ?>jquery.wysiwyg.js" tppabs="http://www.xooom.pl/work/magicadmin/js/jquery.wysiwyg.js"></script>
        
        <!-- JQuery tablesorter plugin script-->
		<script type="text/javascript" src="<?php echo SCRIPTPATH; ?>jquery.tablesorter.min.js" tppabs="http://www.xooom.pl/work/magicadmin/js/jquery.tablesorter.min.js"></script>
        
		<!-- JQuery pager plugin script for tablesorter tables -->
		<script type="text/javascript" src="<?php echo SCRIPTPATH; ?>jquery.tablesorter.pager.js" tppabs="http://www.xooom.pl/work/magicadmin/js/jquery.tablesorter.pager.js"></script>
        
		<!-- JQuery password strength plugin script -->
		<script type="text/javascript" src="<?php echo SCRIPTPATH; ?>jquery.pstrength-min.1.2.js" tppabs="http://www.xooom.pl/work/magicadmin/js/jquery.pstrength-min.1.2.js"></script>
        
		<!-- JQuery thickbox plugin script -->
		<script type="text/javascript" src="<?php echo SCRIPTPATH; ?>thickbox.js" tppabs="http://www.xooom.pl/work/magicadmin/js/thickbox.js"></script>
        
                <script type="text/javascript" src="<?php echo SCRIPTPATH; ?>commonjs.js"></script>
	</head>
	<body>
    	<!-- Header -->
        <div id="header">
            <!-- Header. Status part -->
            <div id="header-status">
                <div class="container_12">
                    <div class="grid_8">
					&nbsp;
                    </div>
                    <div class="grid_4">
                    <?php
						if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
					?>
                        <span class="welcome-text"><font color="#999999">Logged In as </font><?php echo ucwords($_SESSION['username']); ?></span>
                         <a href="<?php echo LOGOUT_URL; ?>" id="logout">
                        Logout
                        </a>
                    <?php
					}
					?>
                    </div>
                </div>
                <div style="clear:both;"></div>
            </div> <!-- End #header-status -->
            
            <?php
			if(isset($_REQUEST['page']) && $_REQUEST['page']=='home'){
				unset($_SESSION['sites_menu']);
				unset($_SESSION['emails_menu']);
				unset($_SESSION['client_menu']);
//				unset($_SESSION['settings_menu']);
				$_SESSION['home_menu'] = 'current';
			}
			else if(isset($_REQUEST['page']) && ($_REQUEST['page']=='sites')){
				unset($_SESSION['home_menu']);
				unset($_SESSION['emails_menu']);
				unset($_SESSION['client_menu']);
//				unset($_SESSION['settings_menu']);
				$_SESSION['sites_menu'] = 'current';
			}
			else if(isset($_REQUEST['page']) && ($_REQUEST['page']=='emails' || $_REQUEST['page'] == 'exportemail' || $_REQUEST['page'] == 'sendmail')){
				unset($_SESSION['sites_menu']);
				unset($_SESSION['home_menu']);
                                unset($_SESSION['client_menu']);
//				unset($_SESSION['settings_menu']);
				$_SESSION['emails_menu'] = 'current';
			}
                        else if(isset($_REQUEST['page']) && ($_REQUEST['page']=='client')){
				unset($_SESSION['sites_menu']);
				unset($_SESSION['home_menu']);
                                unset($_SESSION['emails_menu']);
//				unset($_SESSION['settings_menu']);
				$_SESSION['client_menu'] = 'current';
			}
//			else if(isset($_REQUEST['page']) && ($_REQUEST['page']=='profile')){
//				unset($_SESSION['category_menu']);
//				unset($_SESSION['emails_menu']);
//				unset($_SESSION['home_menu']);
//				unset($_SESSION['settings_menu']);
//				$_SESSION['profile_menu'] = 'current';
//			}
//			else if(isset($_REQUEST['page']) && ($_REQUEST['page']=='settings')){
//				unset($_SESSION['category_menu']);
//				unset($_SESSION['emails_menu']);
//				unset($_SESSION['profile_menu']);
//				unset($_SESSION['home_menu']);
//				$_SESSION['settings_menu'] = 'current';
//			}
			else{
                                unset($_SESSION['category_menu']);
				unset($_SESSION['emails_menu']);
				unset($_SESSION['profile_menu']);
				unset($_SESSION['settings_menu']);
				$_SESSION['home_menu'] = 'current';
                        }
                            
			?>
            
            <!-- Header. Main part -->
            <div id="header-main">
                <div class="container_12">
                    <div class="grid_12">
                        <div id="logo">
                       <!--<div class="headerlogo" style="width:auto; float:left; "><img src="images/bsnl_logo.jpg" alt="#" /></div>-->
       					<div style="width:100%; float:left;">                
                            <ul id="nav">                               
                                <li id="<?php echo $_SESSION['home_menu']; ?>"><a href="<?php echo SITE_URL; ?>?page=home">Dashboard</a></li>
                                <li id="<?php echo $_SESSION['sites_menu']; ?>"><a href="?page=sites">Sites</a></li>
                                <li id="<?php echo $_SESSION['emails_menu']; ?>"><a href="?page=emails">Email</a></li>
                                <li id="<?php echo $_SESSION['client_menu']; ?>"><a href="?page=client">Client</a></li>
<!--                                <li id="<?php // echo $_SESSION['profile_menu']; ?>"><a href="?page=profile">Profile</a></li>
                                <li id="<?php // echo $_SESSION['settings_menu']; ?>"><a href="?page=settings">Settings</a></li>                                -->
                            </ul></div>
                        </div><!-- End. #Logo -->
                    </div><!-- End. .grid_12-->
                    <div style="clear: both;"></div>
                </div><!-- End. .container_12 -->
            </div> <!-- End #header-main -->
            <div style="clear: both;"></div>
            <!-- Sub navigation -->
            <div id="subnav">
                <div class="container_12">
                    <div class="grid_12">
<!--                        <ul style=" <?php if(isset($_SESSION['category_menu'])){ echo "display:block"; }else{ echo "display:none"; } ?> ">
                            <li><a href="<?php echo SITE_URL.'?page=categories'; ?>">Categories</a></li>
                            <li><a href="<?php echo SITE_URL.'?page=subcategory'; ?>">Sub Categories</a></li>
                            <li><a href="<?php echo SITE_URL.'?page=sites'; ?>">Sites</a></li>                                                                           
                       </ul>   -->
                         <ul style=" <?php if(isset($_SESSION['emails_menu'])){ echo "display:block"; }else{ echo "display:none"; } ?> ">
                            <li><a href="<?php echo SITE_URL.'?page=emails'; ?>">Emails</a></li>
                            <li><a href="<?php echo SITE_URL.'?page=exportemail'; ?>">Export Email</a></li>
                            <li><a href="<?php echo SITE_URL.'?page=sendmail'; ?>">Send Email</a></li>
                            <!--<li><a href="<?php // echo SITE_URL.'?page=sites'; ?>">Sites</a></li>-->                                                                           
                       </ul>  
                    </div><!-- End. .grid_12-->
                </div><!-- End. .container_12 -->
                <div style="clear: both;"></div>
            </div> <!-- End #subnav -->
        </div> <!-- End #header -->
        