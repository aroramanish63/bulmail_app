<?php

class elasticPlans extends AllFunctions {

    //function for get Language
    public function getPricing($id = '') {
        $condition = '';
        if ($id != '') {
            $condition = array('id' => $id);
        }
        return $this->select($this->cfg['db_prefix'].'elastic_plans', '*', $condition, NULL, array('id'));
    }

    function savePlans() {
        if (!isset($_POST['saveButton'])) {
            return false;
        }
        $setarr = array();
        $i = 0;
        foreach ($_POST['plan_link'] as $key => $val) {
            $setarr[$i]['set'] = array($_POST['plan_name'] => htmlentities($val));
            $setarr[$i]['where'] = array('plan_property' => 'plan_link', 'currency_code' => strtoupper($key));
            $i++;
        }
        $res = $this->updateMultiple($this->cfg['db_prefix'].'elastic_plans', $setarr);
        return $res;
        /*
          if ($_POST['id'] == '' && $_POST['planProperty'] != '') {
          if ($this->isUnique($this->cfg['db_prefix'].'elastic_plans', 'plan_property', $_POST['planPrice'])) {
          $fields = array('plan_server_type' => $_POST['serverName'], 'plan_property' => $_POST['planProperty'], 'plan_2000' => $_POST['plan2000'], 'plan_5000' => $_POST['plan5000'], 'plan_10000' => $_POST['plan10000'], 'plan_25000' => $_POST['plan25000'], 'plan_50000' => $_POST['plan50000'], 'active' => $_POST['planStatus']);
          $result = $this->insert($this->cfg['db_prefix'].'elastic_plans', $fields);
          } else {
          return 'Plan already exists';
          }
          } elseif ($_POST['id'] != '' && $_POST['planProperty'] != '') {
          //	echo "update<pre>";print_r($_POST);echo "</pre>";die;

          $set_fields = array('plan_server_type' => $_POST['serverName'], 'plan_property' => $_POST['planProperty'], 'plan_2000' => $_POST['plan2000'], 'plan_5000' => $_POST['plan5000'], 'plan_10000' => $_POST['plan10000'], 'plan_25000' => $_POST['plan25000'], 'plan_50000' => $_POST['plan50000'], 'active' => $_POST['planStatus']);
          $where = array('id' => $_POST['id']);
          $result = $this->update($this->cfg['db_prefix'].'elastic_plans', $set_fields, $where);
          } else {
          return 'Fill Required Fields';
          }
         *
          return isset($result['error']) ? $result['error'] : 'success';
         *
         *
         *
         * */
    }

}

?>