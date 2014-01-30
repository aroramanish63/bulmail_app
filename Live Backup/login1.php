<?php
include_once("includes/config.php"); //config file stores all configuration
include_once($cfg['admin_path'] . 'functions/adminFunction.php');
if (isset($_SESSION['uid']) && !empty($_SESSION['uid'])) {
    header('location:' . $cfg['admin_url']);
    exit();
}
$cloudfun = new AdminFunctions();
if (isset($_POST['login'])) {
    if (!empty($_POST['user_name']) && !empty($_POST['pass_word'])) {
        $username = $_POST['user_name'];
        $password = $_POST['pass_word'];
        if ($cloudfun->adminlogin($username, $password)) {
            if (isset($_SESSION['uid']) && !empty($_SESSION['uid'])) {
                header('location:' . $cfg['admin_url'] . 'index.php');
                exit();
            }
        } else {
            $cloudfun->setAlertMessage(array('err_type' => 'error', 'msg' => 'Incorrect username or password.'));
        }
    } else {
        $cloudfun->setAlertMessage(array('err_type' => 'error', 'msg' => 'Username and password required.'));
    }
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Welcome to Adminpanel of <?= $cfg['website_name']; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
        <meta name="author" content="Muhammad Usman">
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
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="row-fluid">
                    <div class="span12 center login-header">
                        <h2>Welcome to Adminpanel of <?= $cfg['website_name']; ?></h2>
                    </div><!--/span-->
                </div><!--/row-->

                <div class="row-fluid">
                    <div class="well span5 center login-box">
                        <div class="alert alert-info">
                            Please login with your Username and Password.
                        </div>
                        <form class="form-horizontal" name="login_form" id="login_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <fieldset>
                                <div class="input-prepend" title="Username" data-rel="tooltip">
                                    <span class="add-on"><i class="icon-user"></i></span><input autofocus class="input-large span10" name="user_name" id="user_name" type="text" />
                                </div>
                                <div class="clearfix"></div>

                                <div class="input-prepend" title="Password" data-rel="tooltip">
                                    <span class="add-on"><i class="icon-lock"></i></span><input class="input-large span10" name="pass_word" id="pass_word" type="password" />
                                </div>
                                <div class="clearfix"></div>

                                <div class="input-prepend">
                                    <label class="remember" for="remember"><input type="checkbox" id="remember" />Remember me</label>
                                </div>
                                <div class="clearfix"></div>

                                <p class="center span5">
                                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                                </p>
                                <?php echo $cloudfun->getAlertMessage(); ?>
                            </fieldset>
                        </form>
                    </div><!--/span-->
                </div><!--/row-->
