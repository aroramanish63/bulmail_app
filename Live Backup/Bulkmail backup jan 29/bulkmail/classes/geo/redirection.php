<?php

//include '../../includes/config.php';
require_once CLASSES_PATH.'geo/geoip.inc';

class redirection{    
        public function getCountryCodeByIP($ipaddr='') {
//            global $cfg;
            //$gi = geoip_open($_SERVER["DOCUMENT_ROOT"] . '/adminpanel/classes/geo/GeoIP.dat', GEOIP_STANDARD);
            if($ipaddr != ''){
                $gi = geoip_open(CLASSES_PATH.'geo/GeoIP.dat', GEOIP_STANDARD);
                $temp = geoip_country_code_by_addr($gi, $ipaddr);
                return $temp;
            }
        }
        
         public function getCountryNameByIP($ipaddr='') {
            if($ipaddr != ''){
                $gi = geoip_open(CLASSES_PATH.'geo/GeoIP.dat', GEOIP_STANDARD);
                $temp = geoip_country_name_by_addr($gi, $ipaddr);
                return $temp;
            }
        }

}

?>