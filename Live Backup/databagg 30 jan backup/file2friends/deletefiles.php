<?php
error_reporting(0);
session_start();
include("include/config.php");
if(isset($_POST['delfileid']) && !empty($_POST['delfileid']) && isset($_POST['filecode']))
{
	$file_data_row = mysql_fetch_array(mysql_query("select id from filedata where filecode=".$_POST['filecode']));
	$userid = $file_data_row['id'];
	if($userid == $_SESSION['user_id'])
	{
		if(mysql_query("DELETE from tbl_files where id= ".$_POST['delfileid']))
		{
			 echo 'Deleted'; 
		}
	}
}
?>