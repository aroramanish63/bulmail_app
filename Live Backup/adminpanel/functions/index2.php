<?php

if (strlen(session_id()) < 1) {
    session_start();
}
include_once('adminpanel/includes/config.php');
include_once($cfg['admin_path'] . 'functions/adminFunction.php');
include_once($cfg['admin_path'] . 'classes/geo/redirection.php');
$adminFunc = new AdminFunctions();
/* @var $languages type */
$languages = $adminFunc->select($this->cfg['db_prefix'].'language', '*', array('active' => 1));
$currencies = $adminFunc->select($this->cfg['db_prefix'].'base_currency', "*", array('active' => 1));
$page = isset($_REQUEST['page']) && $_REQUEST['page'] != '' ? $_REQUEST['page'] : 'home';

//$url = 'http://ws.go4hosting.com/setusersession.php?sessaction=set';
//
//$ch = curl_init($url);
//$data = curl_exec($ch);
//curl_close($ch);

$pageId = $adminFunc->select($this->cfg['db_prefix'].'site_region', 'id', array('region_name' => $page));
if (!isset($_SESSION['lang'])) {
    /* @var $country_code type */
    //$country_code = @file_get_contents('http://api.hostip.info/country.php');
    $country_code = getCountryCodeByIP();
    $country_code = (isset($country_code) && $country_code != '' ) ? $country_code : 'IN';
    $_SESSION['country_code'] = $country_code;
    $_SESSION['lang'] = $adminFunc->siteLanguage($country_code);
    $_SESSION['curr'] = $adminFunc->getCurrency($country_code);
}

$_SESSION['config'] = $adminFunc->getSiteConfig();
if (isset($_POST['language'])) {
    if (!$adminFunc->isUnique($this->cfg['db_prefix'].'language', 'abrv', $_POST['language'])) {
        $_SESSION['lang'] = $_POST['language'];
    }
    //$currency = $adminFunc->select($this->cfg['db_prefix'].'language', '*', array('abrv' => $_POST['language']));
    // $_SESSION['curr'] = $currency[0]['default_currency'];
}
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'en';
    $_SESSION['curr'] = 'USD';
}

if (isset($_POST['currency'])) {
    $_SESSION['curr'] = $_POST['currency'];
}
$lang = strtolower($_SESSION['lang']);
if (file_exists($cfg['base_path'] . 'header/header_' . $lang . '.php')) {
    include($cfg['base_path'] . 'header/header_' . $lang . '.php');
}


$arr = array();
$sqlRegion = $adminFunc->select($this->cfg['db_prefix']."site_region", array("id", "region_name", "breadcrumb_parent_id"));
$page_id = isset($pageData['id']) ? $pageData['id'] : '';
$breadCrumb = $adminFunc->getBreadCrumb($page_id, $sqlRegion, $arr);

$breadcrumbarray = array_reverse($arr);
$breadcrumbStruct = '';
foreach ($breadcrumbarray as $key => $val) {
    foreach ($val as $keyId => $valId) {
        $getLangId = $adminFunc->select($this->cfg['db_prefix']."language", "*", array("abrv" => $_SESSION["lang"]));
        $getBreadLinks = $adminFunc->select($this->cfg['db_prefix']."page_data", "*", array("page_id" => $keyId, "lang_id" => $getLangId[0]["id"]));
        if ($pageData['id'] == $keyId && isset($getBreadLinks[0]['breadcrumb'])) {
            $breadcrumbStruct.="<a class='active'>" . $getBreadLinks[0]['breadcrumb'] . "   </a>";
        } elseif (isset($getBreadLinks[0]['breadcrumb'])) {
            $breadcrumbStruct.="<a  href='" . $cfg['site_url'] . $valId . "' >" . $getBreadLinks[0]['breadcrumb'] . " / </a>";
        }
    }
}


if (file_exists($cfg['base_path'] . 'contents/' . $page . '_' . $lang . '.php')) {
    include_once($cfg['base_path'] . 'contents/' . $page . '_' . $lang . '.php');
} else {
    if (file_exists($cfg['base_path'] . 'contents/pagenotfound_' . $lang . '.php')) {
        include_once($cfg['base_path'] . 'contents/pagenotfound_' . $lang . '.php');
    }
}
if (file_exists($cfg['base_path'] . 'footer/footertop_' . $lang . '.php')) {
    include_once($cfg['base_path'] . 'footer/footertop_' . $lang . '.php');
}
if (file_exists($cfg['base_path'] . 'footer/footer_' . $lang . '.php')) {
    include_once($cfg['base_path'] . 'footer/footer_' . $lang . '.php');
}
?>
