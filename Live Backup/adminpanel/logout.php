<?php

/* Created By : Shambhulal Verma
 *
 *
 */
?>
<?php

include_once("includes/config.php"); //config file stores all configuration
include_once($cfg['admin_path'] . 'functions/adminFunction.php');
$cloudfun = new AdminFunctions();
$cloudfun->logout();
header("location:" . $cfg['admin_url']);
?>
