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
            <div id="header-status" class="<?php echo SITE_URL; ?>">
                <div class="container_12">
                    <div class="grid_8">
					&nbsp;
                    </div>
                    <div class="grid_4">
                        <a href="<?php echo LOGOUT_URL; ?>" id="logout">
                        Logout
                        </a>
                    </div>
                </div>
                <div style="clear:both;"></div>
            </div> <!-- End #header-status -->
            
            <!-- Header. Main part -->
            <div id="header-main">
                <div class="container_12">
                    <div class="grid_12">
                        <div id="logo">
                         <?php 
                           
//                             $items = array(
//                                    'dashboard' => array('text'=>'Dashboard',  'url'=>'?page=home'),
//                                    'categories'  => array('text'=>'Categories',  'url'=>'?page=category'),
//                                    'files'     => array('text'=>'Files', 'url'=>'?page=about'),
//                                    'profile'   => array('text'=>'Profile', 'url'=>'?page=about'),
//                                    'settings'  => array('text'=>'Settings', 'url'=>'?page=about'),
//                                  );                             
                             $menuclass = new menuFunction($_REQUEST['page']);    
                             ?>
                            
<!--                            <ul id="nav">
                                <li <?php echo (!isset($_REQUEST['page']) && empty($_REQUEST['page'])) ? 'id="current"' : '';  ?>><a href="<?php echo SITE_URL; ?>">Dashboard</a></li>
                                <li <?php echo (isset($_REQUEST['page']) && ($_REQUEST['page'] == 'categories')) ? 'id="current"' : '';  ?>><a href="?page=categories">Categories</a></li>
                                <li <?php echo (isset($_REQUEST['page']) && ($_REQUEST['page'] == 'emails')) ? 'id="current"' : '';  ?>><a href="?page=emails">Email</a></li>
                                <li <?php echo (isset($_REQUEST['page']) && ($_REQUEST['page'] == 'profile')) ? 'id="current"' : '';  ?>><a href="?page=profile">Profile</a></li>
                                <li <?php echo (isset($_REQUEST['page']) && ($_REQUEST['page'] == 'settings')) ? 'id="current"' : '';  ?>><a href="?page=settings">Settings</a></li>
                            </ul>-->
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
<!--                        <ul>
                            <li><a href="<?php echo SITE_URL.'?page=categories'; ?>">Categories</a></li>
                            <li><a href="<?php echo SITE_URL.'?page=subcategory'; ?>">Sub Categories</a></li>
                            <li><a href="<?php echo SITE_URL.'?page=sites'; ?>">Sites</a></li>
                        </ul>-->
                            <?php $menuclass->generateSubmenu(); ?>
                        
                    </div><!-- End. .grid_12-->
                </div><!-- End. .container_12 -->
                <div style="clear: both;"></div>
            </div> <!-- End #subnav -->
      <?php // } ?>
        </div> <!-- End #header -->
        