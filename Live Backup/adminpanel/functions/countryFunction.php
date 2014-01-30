<?php

class siteLangFunctions extends AllFunctions {

    //-----Initialization -------
    function addSiteLanguage() {
        if (!isset($_POST['saveButton'])) {
            return false;
        }
        if ($_POST['language_name'] != '' && $_POST['language_code'] != '' && $_POST['countryName'] != '' && $_POST['countryCode'] != '') {
            $fields = array("language_name" => $_POST['language_name'], "language_code" => $_POST['language_code'], "country_name" => urldecode($_POST['countryName']), "country_code" => $_POST['countryCode'], "currency_code" => $_POST['currencyCode'], "active" => $_POST['active'], "custom_field" => base64_encode(serialize(array('tollfree' => $_POST['tollfree']))));

            $result = $this->insert($this->cfg['db_prefix'].'country', $fields);
        } else {
            return 'Please Fill Required Fields!';
        }
        return isset($result['error']) ? $result['error'] : 'success';
    }

    function editSiteLanguage() {
        if (!isset($_POST['saveButton'])) {
            return false;
        }
        if ($_POST['language_name'] != '' && $_POST['language_code'] != '' && $_POST['countryName'] != '' && $_POST['countryCode'] != '' && $_POST['currencyCode'] != '') {
            $fields = array("language_name" => $_POST['language_name'], "language_code" => $_POST['language_code'], "country_name" => urldecode($_POST['countryName']), "country_code" => $_POST['countryCode'], "currency_code" => $_POST['currencyCode'], "active" => $_POST['active'], "custom_field" => base64_encode(serialize(array('tollfree' => $_POST['tollfree']))));

            $where = array("id" => $_REQUEST['edit_id']);
            $result = $this->update($this->cfg['db_prefix'].'country', $fields, $where);
        } else {
            return 'Please Fill Required Fields!';
        }
        return isset($result['error']) ? $result['error'] : 'success';
    }

    function getCountryList() {

        return $this->select('country');
    }

    function getCurrencyList() {

        return $this->select($this->cfg['db_prefix'].'currency');
    }

    function getSelectedCurrencyList() {
        return $this->select($this->cfg['db_prefix'].'base_currency');
    }

    function getAllSiteLanguages() {

        return $this->select($this->cfg['db_prefix'].'country');
    }

    function getSiteEditInfo($id) {
        return $this->select($this->cfg['db_prefix'].'country', "*", array("id" => $id));
    }

    function deleteSiteLanguage($id) {
        if (isset($id)) {
            $result = $this->update($this->cfg['db_prefix'].'country', array('active' => 0), array("id" => $id));
        } else {
            return 'Unable to delete!';
        }
        return isset($result['error']) ? $result['error'] : 'success';
    }

}

?>