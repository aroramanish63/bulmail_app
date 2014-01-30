<?php

if (strlen(session_id()) < 1) {
    session_start();
}
$cfg['base_path'] = '/home/cloudoye/public_html/';
$cfg['site_url'] = 'http://www.cloudoye.com/';

$cfg['admin_path'] = $cfg['base_path'] . 'adminpanel/';
$cfg['admin_url'] = $cfg['site_url'] . 'adminpanel/';

$cfg['image_url'] = $cfg['site_url'] . 'images/';
$cfg['landing_image_url'] = $cfg['site_url'] . 'images/landingimg/';
$cfg['script_url'] = $cfg['site_url'] . 'js/';
$cfg['style_url'] = $cfg['site_url'] . 'css/';
$cfg['doc_url'] = $cfg['site_url'] . 'document/';


$cfg['admin_image_url'] = $cfg['admin_url'] . 'img/';
$cfg['admin_script_url'] = $cfg['admin_url'] . 'js/';
$cfg['admin_style_url'] = $cfg['admin_url'] . 'css/';
$cfg['upload_url'] = $cfg['site_url'] . 'uploads/';

$cfg['website_name'] = 'Cloudoye.com';
$cfg['admin_email'] = 'admin@cloudoye.com';
$cfg['db_host'] = 'localhost';
$cfg['db_port'] = '';
$cfg['db_name'] = 'cloudoye_cloudoye';
$cfg['db_user'] = 'cloudoye_db';
$cfg['db_pass'] = 'H}.z2@Tnt@*5';
$cfg['db_prefix'] = 'tbl_';

$cfg['ftp_server'] = '';
$cfg['ftp_user'] = '';
$cfg['ftp_pass'] = '';
$cfg['ftp_port'] = '';

$cfg['random_key'] = 'qSRcVS6DrTzrPvr';

require_once($cfg['admin_path'] . "functions/commanFxn.php");

$siteConfig = new AllFunctions();

//Provide your site name here
$siteConfig->SetWebsiteName($cfg['website_name']);

//Provide the email address where you want to get notifications
$siteConfig->SetAdminEmail($cfg['admin_email']);

$siteConfig->SetRandomKey($cfg['random_key']);
?>