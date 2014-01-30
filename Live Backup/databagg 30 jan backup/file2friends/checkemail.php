<?php
error_reporting(0);
include("include/config.php");
if(isset($_POST['email']) && !empty($_POST['email']))
{
	if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $_POST['email']))
	{
      $email=strtolower(mysql_real_escape_string($_POST['email']));
      $query="select * from users_register where LOWER(email)='$email'";
      $res=mysql_query($query);
      $count=mysql_num_rows($res);
      $HTML='';
      if($count > 0){
        $HTML='Email exists';
      }else{
        $HTML='';
      }
      echo $HTML;
	}
	else
	{
		echo "Invalid";	
	}
}
?>