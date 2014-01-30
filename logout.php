<?php

/* Created By : MANISH ARORA
 */
?>
<?php

include_once("includes/config.php"); //config file stores all configuration

if(!isset($_SERVER['HTTP_REFERER'])){
    echo die('Access Denied...!!');
}

$cloudfun = new AllFunctions();
$cloudfun->logout();
header("location:" . LOGIN_URL);
?>
