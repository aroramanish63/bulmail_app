<?php
if (strlen(session_id()) < 1) {
    session_start();
}

$cfg['base_path'] = '/var/www/html/bulkmail/';
$cfg['site_url'] = 'http://121.242.207.115/bulkmail/';

$cfg['image_url'] = $cfg['site_url'] . 'images/';

$cfg['script_url'] = $cfg['site_url'] . 'js/';
$cfg['style_url'] = $cfg['site_url'] . 'css/';

$cfg['upload_url'] = $cfg['site_url'] . 'uploads/';

$cfg['website_name'] = 'Bulkmail';
$cfg['admin_email'] = 'manish.arora@cyfuture.com';
$cfg['db_host'] = 'localhost';
$cfg['db_port'] = '';
$cfg['db_name'] = 'bulkmail';
$cfg['db_user'] = 'root';
$cfg['db_pass'] = 'pass@123';
$cfg['db_prefix'] = 'tbl_';

$cfg['ftp_server'] = '';
$cfg['ftp_user'] = '';
$cfg['ftp_pass'] = '';
$cfg['ftp_port'] = '';

$cfg['random_key'] = 'qSRcVS6DrTzrPvr';

// Define Constants

define('SITE_URL', $cfg['site_url']);
define('BASE_PATH', $cfg['base_path']);
define('IMAGEPATH', $cfg['image_url']);
define('SCRIPTPATH', $cfg['script_url']);
define('STYLEPATH', $cfg['style_url']);
define('DB_PREFIX', $cfg['db_prefix']);
define('PAGES_PATH', BASE_PATH.'pages/');

define('LOGOUT_URL', SITE_URL.'logout.php');
define('LOGIN_URL', SITE_URL.'login.php');

define('FUNCTIONS_PATH', BASE_PATH.'functions/');
define('MENUCLASS', FUNCTIONS_PATH.'menuFunction.php');



require_once(FUNCTIONS_PATH . "commanFxn.php");

$siteConfig = new AllFunctions();

//Provide your site name here
$siteConfig->SetWebsiteName($cfg['website_name']);

//Provide the email address where you want to get notifications
$siteConfig->SetAdminEmail($cfg['admin_email']);

$siteConfig->SetRandomKey($cfg['random_key']);
?>