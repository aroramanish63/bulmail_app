<?php
include("../include/config.php");
/*$message = $_REQUEST["payment_status"];
$f = fopen("textfile.txt", "w");
// Write text line
fwrite($f, "Hi"); 
// Close the text file
fclose($f);
die;*/
//echo "insert into test values('test1','test2')";
/*if(mysql_query("insert into test values('test2','test3')")){
	echo "Done";	
}*/

if(isset($_REQUEST["payment_status"])  &&  isset($_REQUEST["custom"])  &&  isset($_REQUEST["item_number"]) &&  isset($_REQUEST["mc_gross"]) && isset($_REQUEST["receiver_email"]))
{
	if(($_REQUEST["payment_status"]=="Completed"))
	{
		$amount=str_replace("'","''",$_REQUEST["mc_gross"]);
	
		$user_id=$_REQUEST["custom"];
		$plan_id = $_REQUEST['item_number'];
		$sb_date=date("YmdHis",time());
		$sb_duration='30';
		$insert_query="update users_register set plan_id=$plan_id, plan_registered_on= '$sb_date', plan_expiry=DATE_ADD($sb_date,INTERVAL $sb_duration DAY),total_sent='0' where id=$user_id";
		mysql_query($insert_query);
	}
}
?>