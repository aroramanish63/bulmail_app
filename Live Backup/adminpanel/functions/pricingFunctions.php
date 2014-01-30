<?php

class PricingFunctions extends AllFunctions {

    //function for get Language
    public function getPricing($id = '') {
        $condition = '';
        if ($id != '') {
            $condition = array('id' => $id);
        }
        return $this->select($this->cfg['db_prefix'].'pricing', '*', $condition);
    }

    function savePlans() {
        if (!isset($_POST['saveButton'])) {
            return false;
        }
        if ($_POST['id'] == '' && $_POST['planName'] != '') {
            if ($this->isUnique($this->cfg['db_prefix'].'language', 'type_name', $_POST['planName'])) {
                $fields = array('server_type' => $_POST['serverName'], 'type_name' => $_POST['planName'], 'vcpu' => $_POST['vcpu'], 'ram' => $_POST['ram'], 'storage' => $_POST['storage'], 'ips' => $_POST['ip'], 'data_transfer' => $_POST['dataTransfer'], 'hrly' => $_POST['hourlyRate'], 'mnthly' => $_POST['monthlyRate'], 'currency_code' => $_POST['currency'], 'plan_link' => $_POST['plan_link'], 'active' => $_POST['planStatus']);
                $result = $this->insert($this->cfg['db_prefix'].'pricing', $fields);
            }
            else
                return 'Plan already exists';
        }
        if ($_POST['id'] != '' && $_POST['planName'] != '') {
            $set_fields = array('server_type' => $_POST['serverName'], 'type_name' => $_POST['planName'], 'vcpu' => $_POST['vcpu'], 'ram' => $_POST['ram'], 'storage' => $_POST['storage'], 'ips' => $_POST['ip'], 'data_transfer' => $_POST['dataTransfer'], 'hrly' => $_POST['hourlyRate'], 'mnthly' => $_POST['monthlyRate'], 'currency_code' => $_POST['currency'], 'plan_link' => $_POST['plan_link'], 'active' => $_POST['planStatus']);
            $where = array('id' => $_POST['id']);
            $result = $this->update($this->cfg['db_prefix'].'pricing', $set_fields, $where);
        } else {
            return 'Fill Required Fields';
        }
        return isset($result['error']) ? $result['error'] : 'success';
    }

}

?>