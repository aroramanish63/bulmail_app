<?php

require_once 'geoip.inc';

function getCountryCodeByIP() {
    global $cfg;
    //$gi = geoip_open($_SERVER["DOCUMENT_ROOT"] . '/adminpanel/classes/geo/GeoIP.dat', GEOIP_STANDARD);
    $gi = geoip_open($cfg['admin_path'] . 'classes/geo/GeoIP.dat', GEOIP_STANDARD);
    $temp = geoip_country_code_by_addr($gi, $_SERVER['REMOTE_ADDR']);
    return $temp;
}

?>