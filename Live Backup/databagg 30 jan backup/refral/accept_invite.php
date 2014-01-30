<?php
session_start();
$_SESSION['invitedby']=$_REQUEST['invitedby'];
$_SESSION['uid']=$_REQUEST['uid'];
$_SESSION['useremail']=$_REQUEST['useremail'];
header("Location:https://www.databagg.com/refral/registration.php");
 ?>