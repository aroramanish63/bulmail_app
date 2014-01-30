<?php

include_once("../includes/config.php");
include_once($cfg['admin_path'] . "functions/adminFunction.php");
$pagename = 'module.php';
$dir = 'module/';
if (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) {
    $pagename = $_REQUEST['page'] . '.php';
}
if (!isset($_REQUEST['ajx']) && file_exists($cfg['admin_path'] . $dir . $pagename)) {
    include_once($cfg['admin_path'] . "includes/header.php");
    include_once $cfg['admin_path'] . $dir . $pagename;
    include_once($cfg['admin_path'] . "includes/footer.php");
} elseif (isset($_REQUEST['ajx']) && file_exists($cfg['admin_path'] . $dir . $pagename)) {
    include_once $cfg['admin_path'] . $dir . $pagename;
} else {
    include_once($cfg['admin_path'] . "includes/error.php");
}
?>

