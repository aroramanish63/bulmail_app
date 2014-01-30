<?php
if(isset($_REQUEST['log']) && $_REQUEST['log']=='out')
{
	unset($_SESSION['user_id']);
	unset($_SESSION['user_email']);
	unset($_SESSION["plan_id"]);
	session_destroy();
	header("location: index.php");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Send Files to Your Friends</title>
<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="css/formcss.css" type="text/css" media="screen"/>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js"></script>

<!--============ Tag-It =========-->
<link rel="stylesheet" type="text/css" href="css/jquery.tagsinput.css" />
<script type="text/javascript" src="js/jquery.tagsinput.js"></script>
<script type="text/javascript">
    $(function() {
        $('#tags_1').tagsInput({width:'340px'});
    });
</script>
<!--========= End Tag-It =====-->

<!--===== Upload Multiple Files =====-->
<script src='js/jquery.MultiFile.js' type="text/javascript" language="javascript"></script>
<!--======== End Multi Files ========-->

<!--============ Validation ========-->
<script type="text/javascript" src="js/validation.js"></script>
<!--========== End validation =======-->

<!--============= Fancy Box ============-->
<link rel="stylesheet" href="css/colorbox.css" />
<script src="js/jquery.colorbox.js"></script>
<script>
    $(document).ready(function(){
        $(".ajax").colorbox();
    });
</script>
<!--========================================-->



</head>

<body>
<div class="fileform_container">
<div class="topheader">
<div class="topheaderright">

<?php
if(isset($_SESSION['user_id']) && $_SESSION['user_id']!='')
{
	$session_user_id = $_SESSION['user_id'];
	$query_find_plan = mysql_fetch_array(mysql_query("select plan_id,plan_expiry from users_register where id=".$session_user_id));
	//print_r($query_find_plan);
	$stringtimeexpire = strtotime($query_find_plan['plan_expiry']);
	
	if($query_find_plan['plan_id'] != 0)
	{
		if($stringtimeexpire > $now_string)
		{
			$_SESSION["plan_id"] = $query_find_plan['plan_id'];	
		}
		else
		{
			unset($_SESSION["plan_id"]);
		}
	}
	
	?>
    <div class="userlogin">Welcome <span><?php echo $_SESSION['user_email']; ?></span></div>
    <div class="sign_button"><a href="index.php">Send Files</a>&nbsp;&nbsp;&nbsp;<a href="myfiles.php">My Files</a>&nbsp;&nbsp;&nbsp;<a href="?log=out">LogOut</a></div>
	<?php
}else{
?>
	<div class="sign_button"><a class="signin" href="login.php"></a><a class="signup" href="registration.php"></a></div>
<?php
}
?>

</div>
</div>

  <div class="midfile_wrap">
    <div class="logo"><a href="index.php"><img src="images/logo.png"  alt="#" /></a></div>
    <h1>Send Files to Your Friends <br />
      <span>Send Upto 1 GB Free</span></h1>
    <div class="fileform_section">
      <div class="blue_contianer">
        <div class="border_light">
          <h2>Send Files to
            Your Friends </h2>
          <ul class="databgg_services">
            <li><img src="images/icon-customization.png" width="20" height="16" alt="#" />Customization</li>
            <li><img src="images/icon-transfers.png" width="25" height="20" alt="#" />5 GB Transfers</li>
            <li><img src="images/icon-expiration.png" width="25" height="22" alt="#" />No File Expiration</li>
            <li><img src="images/icon-history.png" width="25" height="20" alt="#" />File History</li>
            <li><img src="images/icon-domain.png" width="25" height="22" alt="#" />Your Own Domain</li>
          </ul>
        </div>
      </div>
      
      
      