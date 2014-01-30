<?php
session_start();



echo "Computer name: ".gethostname()."<br>";
echo "Operating System: ".php_uname()."<br>";
//echo PHP_OS;
$ip= $_SERVER['REMOTE_ADDR'];
$str="http://api.hostip.info/get_html.php?ip=$ip";
echo file_get_contents($str)."<br>";

echo "Browser Name: ".$_SERVER['HTTP_USER_AGENT']."<br>";
?>