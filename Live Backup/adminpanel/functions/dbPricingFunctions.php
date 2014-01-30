<?php

class dbPlans extends AllFunctions {

     
    //function for get Language
    public function getPricing($id = '') {
        $condition = '';
        if ($id != '') {
            $condition = array('id' => $id);
        }
        return $this->select($this->cfg['db_prefix'].'db_plans', '*', $condition);
    }

    function savePlans() {
		//echo "insert<pre>";print_r($_POST);echo "</pre>";die;
        if (!isset($_POST['saveButton'])) {
            return false;
        }
        if ($_POST['id'] == '' && $_POST['db_name'] != '') {
				//	echo "insert<pre>";print_r($_POST);echo "</pre>";die;

            if ($this->isUnique($this->cfg['db_prefix'].'db_plans', 'db_type', $_POST['db_name'])) {
                $fields =  array('db_type' => $_POST['db_name'], 'no_of_cores' => $_POST['noCores'], 'hourly_price' => $_POST['hourlyPrice'], 'monthly_price' => $_POST['monthlyPrice'],'active' => $_POST['planStatus']);
                $result = $this->insert($this->cfg['db_prefix'].'db_plans', $fields);
            }
            else
			{
                return 'Plan already exists';
			}
        }
        elseif ($_POST['id']!= '' && $_POST['db_name'] != '') {
				//	echo "update<pre>";print_r($_POST);echo "</pre>";die;

            $set_fields = array('db_type' => $_POST['db_name'], 'no_of_cores' => $_POST['noCores'], 'hourly_price' => $_POST['hourlyPrice'], 'monthly_price' => $_POST['monthlyPrice'],'active' => $_POST['planStatus']);
            $where = array('id' => $_POST['id']);
            $result = $this->update($this->cfg['db_prefix'].'db_plans', $set_fields, $where);
        } else {
            return 'Fill Required Fields';
        }
        return isset($result['error']) ? $result['error'] : 'success';
    }
    

}

?>