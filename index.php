<?php

include_once("includes/config.php"); //config file stores all configuration

if ( ! defined('BASE_PATH')) exit('No direct script access allowed');

if(($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_POST['content']) && !empty($_POST['content']))){
    include_once PAGES_PATH.'emailRequests.php';
}

if(!isset($_SESSION['uid']) && empty($_SESSION['uid'])) exit(header ('Location: '.LOGIN_URL));

$no_visible_elements = true;
//header("location:" . $cfg['admin_url'] . 'module');
$pagename = 'home.php';
if (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) {
    $pagename = $_REQUEST['page'] . '.php';
}
if (!isset($_REQUEST['ajx']) && file_exists(PAGES_PATH . $pagename)) {
    include_once(BASE_PATH . "includes/header.php");
    include_once PAGES_PATH . $pagename;
    include_once(BASE_PATH . "includes/footer.php");
} 
elseif (isset($_REQUEST['ajx']) && file_exists(FUNCTIONS_PATH.$pagename)) {
    include_once FUNCTIONS_PATH.$pagename;
}
else {
    include_once(BASE_PATH . "includes/error.php");
}
?>

