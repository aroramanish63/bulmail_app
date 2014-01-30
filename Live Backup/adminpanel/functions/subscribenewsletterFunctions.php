<?php

class subscribenewsletter extends AllFunctions {

    //function for get Language
    public function getSubscribersNewletters($id = '') {
        $condition = '';
        if ($id != '') {
            $condition = array('id' => $id);
        }
        return $this->select($this->cfg['db_prefix'].'subscribe_newsletter', '*', $condition);
    }

    function saveSubscribers() {
        //echo "insert<pre>";print_r($_POST);echo "</pre>";die;
        if (!isset($_POST['saveButton'])) {
            return false;
        }
      /*  if ($_POST['id'] == '' ) {
            //	echo "insert<pre>";print_r($_POST);echo "</pre>";die;

            if ($this->isUnique($this->cfg['db_prefix'].'base_currency', 'currency_code', $_POST['currencyCode'])) {
                $fields = array('currency_code' => $_POST['currencyCode'], 'currency_weight' => $_POST['currencyWeight'], 'active' => $_POST['base_active']);
                $result = $this->insert($this->cfg['db_prefix'].'base_currency', $fields);
            } else {
                return 'Currency already exists';
            }
        } else*/
			if ($_POST['id'] != '' ) {
            //	echo "update<pre>";print_r($_POST);echo "</pre>";die;

            $set_fields = array('email_id' => $_POST['subscribe_email'], 'active' => $_POST['base_active']);
            $where = array('id' => $_POST['id']);
            $result = $this->update($this->cfg['db_prefix'].'subscribe_newsletter', $set_fields, $where);
        } else {
            return 'Fill Required Fields';
        }
        return isset($result['error']) ? $result['error'] : 'success';
    }

    

}

?>