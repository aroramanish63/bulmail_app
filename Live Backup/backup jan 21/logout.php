<?php

/* Created By : MANISH ARORA
 *
 *
 */
?>
<?php

include_once("includes/config.php"); //config file stores all configuration

$cloudfun = new AllFunctions();
$cloudfun->logout();
header("location:" . LOGIN_URL);
?>
