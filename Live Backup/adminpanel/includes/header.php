<?php
if (!isset($_SESSION['uid']) || empty($_SESSION['uid'])) {
    header("location:" . $cfg['admin_url'] . 'login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?= $cfg['website_name']; ?> :: Adminpanel</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?= $cfg['website_name']; ?> Adminpanel">
        <base href="<?php echo $cfg['admin_url']; ?>" />

        <!-- The styles -->
        <link id="bs-css" href="<?php echo $cfg['admin_style_url']; ?>bootstrap-cerulean.css" rel="stylesheet">
        <style type="text/css">
            body {
                padding-bottom: 40px;
            }
            .sidebar-nav {
                padding: 9px 0;
            }
        </style>
        <link href="<?php echo $cfg['admin_style_url']; ?>bootstrap-responsive.css" rel="stylesheet">
        <link href="<?php echo $cfg['admin_style_url']; ?>charisma-app.css" rel="stylesheet">
        <link href="<?php echo $cfg['admin_style_url']; ?>jquery-ui-1.8.21.custom.css" rel="stylesheet">
        <link href="<?php echo $cfg['admin_style_url']; ?>fullcalendar.css" rel='stylesheet'>
        <link href="<?php echo $cfg['admin_style_url']; ?>fullcalendar.print.css" rel='stylesheet'  media='print'>
        <link href="<?php echo $cfg['admin_style_url']; ?>chosen.css" rel='stylesheet'>
        <link href="<?php echo $cfg['admin_style_url']; ?>uniform.default.css" rel='stylesheet'>
        <link href="<?php echo $cfg['admin_style_url']; ?>colorbox.css" rel='stylesheet'>
        <link href="<?php echo $cfg['admin_style_url']; ?>jquery.cleditor.css" rel='stylesheet'>
        <link href="<?php echo $cfg['admin_style_url']; ?>jquery.noty.css" rel='stylesheet'>
        <link href="<?php echo $cfg['admin_style_url']; ?>noty_theme_default.css" rel='stylesheet'>
        <link href="<?php echo $cfg['admin_style_url']; ?>elfinder.min.css" rel='stylesheet'>
        <link href="<?php echo $cfg['admin_style_url']; ?>elfinder.theme.css" rel='stylesheet'>
        <link href="<?php echo $cfg['admin_style_url']; ?>jquery.iphone.toggle.css" rel='stylesheet'>
        <link href="<?php echo $cfg['admin_style_url']; ?>opa-icons.css" rel='stylesheet'>
        <link href="<?php echo $cfg['admin_style_url']; ?>uploadify.css" rel='stylesheet'>

        <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <!-- jQuery -->
        <script src="<?php echo $cfg['admin_script_url']; ?>jquery-1.7.2.min.js"></script>
        <!-- The fav icon -->
        <link rel="shortcut icon" href="<?php echo $cfg['admin_image_url']; ?>favicon.ico">

    </head>

    <body>
        <!-- topbar starts -->
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="<?php echo $cfg['admin_url']; ?>"><span>Adminpnael</span></a>

                    <!-- theme selector starts -->
                    <div class="btn-group pull-right theme-container" >
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="icon-tint"></i><span class="hidden-phone"> Change Theme / Skin</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" id="themes">
                            <li><a data-value="classic" href="#"><i class="icon-blank"></i> Classic</a></li>
                            <li><a data-value="cerulean" href="#"><i class="icon-blank"></i> Cerulean</a></li>
                            <li><a data-value="cyborg" href="#"><i class="icon-blank"></i> Cyborg</a></li>
                            <li><a data-value="redy" href="#"><i class="icon-blank"></i> Redy</a></li>
                            <li><a data-value="journal" href="#"><i class="icon-blank"></i> Journal</a></li>
                            <li><a data-value="simplex" href="#"><i class="icon-blank"></i> Simplex</a></li>
                            <li><a data-value="slate" href="#"><i class="icon-blank"></i> Slate</a></li>
                            <li><a data-value="spacelab" href="#"><i class="icon-blank"></i> Spacelab</a></li>
                            <li><a data-value="united" href="#"><i class="icon-blank"></i> United</a></li>
                        </ul>
                    </div>
                    <!-- theme selector ends -->

                    <!-- user dropdown starts -->
                    <div class="btn-group pull-right" >
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="<?php echo $cfg['admin_url']; ?>">
                            <i class="icon-user"></i><span class="hidden-phone"><?= (isset($_SESSION['username'])) ? $_SESSION['username'] : 'Admin'; ?> </span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $cfg['admin_url']; ?>module/?page=userDetail&id=1">Profile</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo $cfg['admin_url']; ?>logout.php">Logout</a></li>
                        </ul>
                    </div>
                    <!-- user dropdown ends -->

                    <div class="top-nav nav-collapse">
                        <ul class="nav">
                            <li><a href="<?= $cfg['site_url']; ?>" target="_blank">Visit Site</a></li>
                            <li>
                                <form class="navbar-search pull-left">
                                    <input placeholder="Search" class="search-query span2" name="query" type="text">
                                </form>
                            </li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <!-- topbar ends -->
        <div class="container-fluid">
            <div class="row-fluid">

                <!-- left menu starts -->
                <div class="span2 main-menu-span">
                    <div class="well nav-collapse sidebar-nav">
                        <ul class="nav nav-tabs nav-stacked main-menu">
                            <li class="nav-header hidden-tablet">Main</li>
                            <?php
                            echo isset($_SESSION['role']['site_config']) ? '<li><a class="ajax-link" href="' . $cfg["admin_url"] . 'module/?page=siteconfig"><i class="icon-wrench"></i><span class="hidden-tablet"> Site Configuration</span></a></li>' : '';
                            echo isset($_SESSION['role']['user_role']) ? '<li><a class="ajax-link" href="' . $cfg["admin_url"] . 'module/?page=userrole"><i class="icon-wrench"></i><span class="hidden-tablet"> User Role</span></a></li>' : '';
                            echo isset($_SESSION['role']['user_group']) ? ' <li><a class="ajax-link" href="' . $cfg["admin_url"] . 'module/?page=usergroup"><i class="icon-wrench"></i><span class="hidden-tablet"> User Group</span></a></li>' : '';
                            echo isset($_SESSION['role']['user']) ? '<li><a class="ajax-link" href="' . $cfg["admin_url"] . 'module/?page=userDetail"><i class="icon-wrench"></i><span class="hidden-tablet"> Users</span></a></li>' : '';
                            echo isset($_SESSION['role']['publish']) ? ' <li><a class="ajax-link" href="' . $cfg["admin_url"] . 'module/"><i class="icon-home"></i><span class="hidden-tablet"> Publish</span></a></li>' : '';
                            echo isset($_SESSION['role']['publish']) ? '<li><a class="ajax-link" href="' . $cfg["admin_url"] . 'module/?page=multiplepublish"><i class="icon-picture"></i><span class="hidden-tablet"> Multiple Publish</span></a></li>' : '';
                            echo (isset($_SESSION['role']['site_region']) || isset($_SESSION['role']['seo'])) ? ' <li><a class="ajax-link" href="' . $cfg["admin_url"] . 'module/?page=addSiteRegion"><i class="icon-list-alt"></i><span class="hidden-tablet"> Site Region</span></a></li>' : '';
                            echo isset($_SESSION['role']['edit_key']) ? ' <li><a class="ajax-link" href="' . $cfg["admin_url"] . 'module/?page=editkeyword"><i class="icon-font"></i><span class="hidden-tablet"> Edit Keyword</span></a></li>' : '';
                            echo isset($_SESSION['role']['imp_key']) ? ' <li><a class="ajax-link" href="' . $cfg["admin_url"] . 'module/?page=import"><i class="icon-th"></i><span class="hidden-tablet"> Import Keywords</span></a></li>' : '';
                            echo isset($_SESSION['role']['manage_language']) ? '   <li><a class="ajax-link" href="' . $cfg["admin_url"] . 'module/?page=language"><i class="icon-folder-open"></i><span class="hidden-tablet"> Language</span></a></li>' : '';
                            echo isset($_SESSION['role']['manage_currency']) ? '     <li><a class="ajax-link" href="' . $cfg["admin_url"] . 'module/?page=currency"><i class="icon-picture"></i><span class="hidden-tablet"> Currency Weight</span></a></li>' : '';
                            echo isset($_SESSION['role']['manage_country']) ? '<li><a class="ajax-link" href="' . $cfg["admin_url"] . 'module/?page=country"><i class="icon-align-justify"></i><span class="hidden-tablet"> Countries</span></a></li>' : '';
                            echo isset($_SESSION['role']['exp_kay']) ? '<li><a class="ajax-link" href="' . $cfg["admin_url"] . 'module/?page=export"><i class="icon-picture"></i><span class="hidden-tablet"> Export Keywords</span></a></li>' : '';
                            echo isset($_SESSION['role']['add_key']) ? '<li><a class="ajax-link" href="' . $cfg["admin_url"] . 'module/?page=addKeyWords"><i class="icon-eye-open"></i><span class="hidden-tablet"> Add Keywords</span></a></li>' : '';
                            ?>
                            <li class="nav-header hidden-tablet">Other Section</li>


                            <?php
                            echo isset($_SESSION['role']['edit_page']) ? '<li><a class="ajax-link" target="_blank" href="' . $cfg["site_url"] . '"><i class="icon-calendar"></i><span class="hidden-tablet"> Edit Whole Page</span></a></li>' : '';
                            echo isset($_SESSION['role']['plans']) ? '<li><a class="ajax-link" href="' . $cfg["admin_url"] . 'module/?page=elasticpricing"><i class="icon-picture"></i><span class="hidden-tablet">Elastic Plan</span></a></li>' : '';
                            echo isset($_SESSION['role']['plans']) ? '<li><a class="ajax-link" href="' . $cfg["admin_url"] . 'module/?page=fixedpricing"><i class="icon-picture"></i><span class="hidden-tablet"> Add Fixed Plan</span></a></li>' : '';
                            echo isset($_SESSION['role']['plans']) ? '<li><a class="ajax-link" href="' . $cfg["admin_url"] . 'module/?page=pricing"><i class="icon-picture"></i><span class="hidden-tablet"> Edit Fixed Plan</span></a></li>' : '';
                            echo isset($_SESSION['role']['plans']) ? ' <li><a class="ajax-link" href="' . $cfg["admin_url"] . 'module/?page=dbpricing"><i class="icon-picture"></i><span class="hidden-tablet">Cloud Databases</span></a></li>' : '';
                            echo isset($_SESSION['role']['blog']) ? '
                            <li><a class="ajax-link" href="' . $cfg["admin_url"] . 'module/?page=blog"><i class="icon-picture"></i><span class="hidden-tablet"> Blogs</span></a></li>' : '';
                            echo isset($_SESSION['role']['slider']) ? '<li><a href="' . $cfg["admin_url"] . 'module/?page=slider"><i class="icon-globe"></i><span class="hidden-tablet"> Slider</span></a></li>
' : '';
                            ?>
                        </ul>
                    </div><!--/.well -->
                </div><!--/span-->
                <!-- left menu ends -->

                <noscript>
                <div class="alert alert-block span10">
                    <h4 class="alert-heading">Warning!</h4>
                    <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
                </div>
                </noscript>

                <div id="content" class="span10">
                    <!-- content starts -->
