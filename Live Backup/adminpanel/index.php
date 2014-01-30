<?php

include_once("includes/config.php"); //config file stores all configuration

$no_visible_elements = true;
//header("location:" . $cfg['admin_url'] . 'module');
$pagename = 'home.php';
if (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) {
    $pagename = $_REQUEST['page'] . '.php';
}
if (file_exists($cfg['admin_path'] . $pagename)) {
    include_once($cfg['admin_path'] . "includes/header.php");
    include_once $cfg['admin_path'] . $pagename;
    include_once($cfg['admin_path'] . "includes/footer.php");
} else {
    include_once($cfg['admin_path'] . "includes/error.php");
}
?>

