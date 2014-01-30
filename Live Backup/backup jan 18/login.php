<?php
include_once("includes/config.php"); //config file stores all configuration

if ( ! defined('BASE_PATH')) exit('No direct script access allowed');

if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])) exit(header ('Location: '.SITE_URL));

$allfun = new AllFunctions();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if((isset($_POST['txtusername']) && !empty($_POST['txtusername'])) && (isset($_POST['txtpassword']) && !empty($_POST['txtpassword'])))
    {
                $username = $_POST['txtusername'];
              $password = $_POST['txtpassword'];             
              if ($allfun->adminlogin($username, $password)) {
                  if (isset($_SESSION['uid']) && !empty($_SESSION['uid'])) {
                      header('location:' . SITE_URL);
                      exit();
                  }
              } else {
                  $allfun->setAlertMessage(array('err_type' => 'error', 'msg' => 'Incorrect username or password.'));
              }
     } else 
              $allfun->setAlertMessage(array('err_type' => 'error', 'msg' => 'Username and password required.'));     
}
?>
<!doctype html>
<head>
	<!-- General Metas -->
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><!-- Force Latest IE rendering engine -->
	<title>Login</title>
    
	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/login.css">
	
</head>
<body>
 
	  <?php if (isset($allfun->alert_message['err_type']) && $allfun->alert_message['err_type'] != '') { ?>
	<div class="notice">
		<p class="warn"><?php echo $allfun->getAlertMessage(); ?></p>
        </div>
    <?php } ?>

	<!-- Primary Page Layout -->
	<div class="container">
		<div class="form-bg">
			<form name="loginForm" id="loginForm" action="" method="post">
				<h2>Login</h2>
				<p><input type="text" name="txtusername" placeholder="Username"></p>
				<p><input type="password" name="txtpassword" placeholder="Password"></p>
				<!--<label for="remember">
				  <input type="checkbox" id="remember" value="remember" />
				  <span>Remember me on this computer</span>
				</label>-->
				<button type="submit"></button>
			</form>
		</div>
	
		<!--<p class="forgot">Forgot your password? <a href="">Click here to reset it.</a></p>-->

	</div><!-- container -->
	
<!-- End Document -->
</body>
</html>