<?php

if (strlen(session_id()) < 1) {
    session_start();
}
include_once('../adminpanel/includes/config.php');
include_once($cfg['admin_path'] . 'functions/adminFunction.php');
include_once($cfg['admin_path'] . 'classes/geo/redirection.php');
$adminFunc = new AdminFunctions();
/* @var $languages type */
$languages = $adminFunc->select('cms_tbl_language', '*', array('active' => 1));
$currencies = $adminFunc->select('cms_tbl_base_currency', "*", array('active' => 1));
$page = isset($_REQUEST['page']) && $_REQUEST['page'] != '' ? $_REQUEST['page'] : 'index';


$pageId = $adminFunc->select('cms_tbl_site_region', 'id', array('region_name' => $page));
if (!isset($_SESSION['lang'])) {
    /* @var $country_code type */
    //$country_code = @file_get_contents('http://api.hostip.info/country.php');
    $country_code = getCountryCodeByIP();
    $country_code = isset($country_code) ? $country_code : 'IN';
    $_SESSION['lang'] = $adminFunc->siteLanguage($country_code);
    $_SESSION['curr'] = $adminFunc->getCurrency($country_code);
}

if (isset($_POST['language'])) {
    $_SESSION['lang'] = $_POST['language'];
    $currency = $adminFunc->select('cms_tbl_language', '*', array('abrv' => $_POST['language']));
    $_SESSION['curr'] = $currency[0]['default_currency'];
}
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'en';
    $_SESSION['curr'] = 'USD';
}

if (isset($_POST['currency'])) {
    $_SESSION['curr'] = $_POST['currency'];
}
$lang = strtolower($_SESSION['lang']);


$arr = array();
$pageData = $adminFunc->pagaData($page);
$sqlRegion = $adminFunc->select("cms_tbl_site_region", array("id", "region_name", "breadcrumb_parent_id"));
$page_id = isset($pageData['id']) ? $pageData['id'] : '';
$breadCrumb = $adminFunc->getBreadCrumb($page_id, $sqlRegion, $arr);

$breadcrumbarray = array_reverse($arr);
$breadcrumbStruct = '';
foreach ($breadcrumbarray as $key => $val) {
    foreach ($val as $keyId => $valId) {
        $getLangId = $adminFunc->select("cms_tbl_language", "*", array("abrv" => $_SESSION["lang"]));
        $getBreadLinks = $adminFunc->select("cms_tbl_page_data", "*", array("page_id" => $keyId, "lang_id" => $getLangId[0]["id"]));
        if ($pageData['id'] == $keyId) {
            $breadcrumbStruct.="<a class='active'>" . $getBreadLinks[0]['breadcrumb'] . "   </a>";
        } else {
            $breadcrumbStruct.="<a  href='" . $cfg['site_url'] . "?page=" . $valId . "' >" . $getBreadLinks[0]['breadcrumb'] . " / </a>";
        }
    }
}




$req_prm = $_SERVER['REQUEST_URI'];
$index_found = strstr($req_prm, "/index.php/");
if ($req_prm == '/help/index.php' || $index_found != FALSE) {
    header('HTTP/1.1 301 Moved Permanently');
    header('Location:https://www.databagg.com/help/');
    exit();
}
$found = strstr($req_prm, "?");
if ($found != FALSE) {
    header('HTTP/1.0 404 Not Found');
    include_once($cfg['base_path'] . 'header/header_' . $lang . '.php');
    include_once($cfg['base_path'] . 'header/inner_header_' . $lang . '.php');
    include_once($cfg['base_path'] . 'contents/page_not_found_' . $lang . '.php');
    //include_once($cfg['base_path'] . 'footer/footertop_' . $lang . '.php');
    include_once($cfg['base_path'] . 'footer/footer_' . $lang . '.php');
    exit();
}


if (file_exists($cfg['base_path'] . 'header/header_' . $lang . '.php')) {
    include($cfg['base_path'] . 'header/header_' . $lang . '.php');
}

if (file_exists($cfg['base_path'] . 'header/inner_header_' . $lang . '.php')) {
    include($cfg['base_path'] . 'header/inner_header_' . $lang . '.php');
}

if (file_exists($cfg['base_path'] . 'help/' . $page . '_' . $lang . '.php')) {
    include_once($cfg['base_path'] . 'help/' . $page . '_' . $lang . '.php');
} else {
    if (file_exists($cfg['base_path'] . 'contents/page_not_found_' . $lang . '.php')) {
        include_once($cfg['base_path'] . 'contents/page_not_found_' . $lang . '.php');
    }
}
if (file_exists($cfg['base_path'] . 'footer/footertop_' . $lang . '.php')) {
    include_once($cfg['base_path'] . 'footer/footertop_' . $lang . '.php');
}
if (file_exists($cfg['base_path'] . 'footer/footer_' . $lang . '.php')) {
    include_once($cfg['base_path'] . 'footer/footer_' . $lang . '.php');
}
echo "<!-- $req_prm -->";
?>
