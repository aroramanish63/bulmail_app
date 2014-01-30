<?php

class managedServicesPlans extends AllFunctions {

    //function for get Language
    public function getPricing($id = '') {
        $condition = '';
        if ($id != '') {
            $condition = array('id' => $id);
        }
        return $this->select($this->cfg['db_prefix'].'managed_services_plans', '*', $condition);
    }

    function savePlans() {
        //echo "insert<pre>";print_r($_POST);echo "</pre>";die;
        if (!isset($_POST['saveButton'])) {
            return false;
        }
        if ($_POST['id'] == '' && $_POST['planType'] != '') {
            //	echo "insert<pre>";print_r($_POST);echo "</pre>";die;

            if ($this->isUnique($this->cfg['db_prefix'].'managed_services_plans', 'plan_type', $_POST['planType'])) {
                $fields = array('plan_type' => $_POST['planType'], 'plan_name' => $_POST['planName'], 'silver_price' => $_POST['silverPrice'], 'gold_price' => $_POST['goldPrice'], 'platinum_price' => $_POST['platinumPrice'], 'titanium_price' => $_POST['titaniumPrice'], 'currency_code' => $_POST['currency_code'], 'active' => $_POST['planStatus']);
                $result = $this->insert($this->cfg['db_prefix'].'managed_services_plans', $fields);
            } else {
                return 'Plan already exists';
            }
        } elseif ($_POST['id'] != '' && $_POST['planType'] != '') {
            //	echo "update<pre>";print_r($_POST);echo "</pre>";die;

            $set_fields = array('plan_type' => $_POST['planType'], 'plan_name' => $_POST['planName'], 'silver_price' => $_POST['silverPrice'], 'gold_price' => $_POST['goldPrice'], 'platinum_price' => $_POST['platinumPrice'], 'titanium_price' => $_POST['titaniumPrice'], 'currency_code' => $_POST['currency_code'], 'active' => $_POST['planStatus']);
            $where = array('id' => $_POST['id']);
            $result = $this->update($this->cfg['db_prefix'].'managed_services_plans', $set_fields, $where);
        } else {
            return 'Fill Required Fields';
        }
        return isset($result['error']) ? $result['error'] : 'success';
    }

}

?>