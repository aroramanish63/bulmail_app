<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');




require('smtp-validate-email.php');

$from = 'check@verify-email.org'; // for SMTP FROM:<> command
//$email = 'manishsharma1978@rediffmail.com';
$email=$_GET['email'];
$validator = new SMTP_Validate_Email($email, $from);
$smtp_results = $validator->validate();

//var_dump($smtp_results);
//echo"<br/>";
//echo"<br/>";
//echo"<br/>";
//echo"<br/>";
//echo"<br/>";
//echo"<br/>";
//echo"<pre>";
//print_r($smtp_results);
if($email!="")
{
if($smtp_results[$email]=="1")
{
?>
<div style="width:16px; float:left; padding-top:2px;"><img src="http://www.databagg.com/refral/emailvalidate/valid.png" /></div>
<div style="color:#00CC00; text-align:left;">
<?php
echo "Valid Email";
?>
</div>
<?php
}
else
{
?>
<div style="width:20px; float:left; padding-top:2px;"><img src="http://www.databagg.com/refral/emailvalidate/invalid.png" /></div>
<div style="color:#FF0000; text-align:left;">
<?php

echo "Invalid Email";
?>
</div>
<?php
}

}

?>