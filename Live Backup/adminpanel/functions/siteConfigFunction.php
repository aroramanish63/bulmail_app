<?php

class siteConfigFunctions extends AllFunctions {

    function getConfig() {
        return $this->select($this->cfg['db_prefix'].'config');
    }

    function saveConfig() {
        $result = FALSE;
        if (count($_POST['config']) > 0) {
            $set = array();
            $insert = array();
            $i = 0;
            foreach ($_POST['config'] as $key => $val) {
                $set[$i]['set'] = $val;
                $set[$i]['where'] = array('id' => $key);
                $insert[key($val)] = $val[key($val)];
                $i++;
            }
            if (isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
                $result = $this->updateMultiple($this->cfg['db_prefix'].'config', $set);
            } else {
                $result = $this->insert($this->cfg['db_prefix'].'config', $insert);
                if (!isset($result['error'])) {
                    $result = 'success';
                }
            }
        }
        return $result;
    }

    function getAllSiteLanguages() {

        return $this->select($this->cfg['db_prefix'].'country');
    }

}

?>