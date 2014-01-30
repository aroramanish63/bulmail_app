<?php

class basecurrency extends AllFunctions {

    //function for get Language
    public function getCurrency($id = '') {
        $condition = '';
        if ($id != '') {
            $condition = array('id' => $id);
        }
        return $this->select($this->cfg['db_prefix'].'base_currency', '*', $condition);
    }

    function saveCurrency() {
        //echo "insert<pre>";print_r($_POST);echo "</pre>";die;
        if (!isset($_POST['saveButton'])) {
            return false;
        }
        if ($_POST['id'] == '' && $_POST['currencyCode'] != '') {
            //	echo "insert<pre>";print_r($_POST);echo "</pre>";die;

            if ($this->isUnique($this->cfg['db_prefix'].'base_currency', 'currency_code', $_POST['currencyCode'])) {
                $fields = array('currency_code' => $_POST['currencyCode'], 'currency_weight' => $_POST['currencyWeight'], 'active' => $_POST['base_active']);
                $result = $this->insert($this->cfg['db_prefix'].'base_currency', $fields);
            } else {
                return 'Currency already exists';
            }
        } elseif ($_POST['id'] != '' && $_POST['currencyWeight'] != '') {
            //	echo "update<pre>";print_r($_POST);echo "</pre>";die;

            $set_fields = array('currency_weight' => $_POST['currencyWeight'], 'active' => $_POST['base_active']);
            $where = array('id' => $_POST['id']);
            $result = $this->update($this->cfg['db_prefix'].'base_currency', $set_fields, $where);
        } else {
            return 'Fill Required Fields';
        }
        return isset($result['error']) ? $result['error'] : 'success';
    }

    function getCurrencyList() {

        return $this->select($this->cfg['db_prefix'].'currency');
    }

}

?>