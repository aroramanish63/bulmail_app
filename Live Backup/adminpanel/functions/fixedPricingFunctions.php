<?php

class fixedPricingFunctions extends AllFunctions {

    public function getFixedplanName() {
        return $this->select($this->cfg['db_prefix'].'pricing', '*', NULL, "type_name", 'id');
    }

    public function getallPlansbyCurr($planame) {
        $condition = NUll;
        if ($planame != '') {
            $condition = array('type_name' => $planame);
        }
        return $this->select($this->cfg['db_prefix'].'pricing', '*', $condition);
    }

    function saveFixedPlan() {
        if (!isset($_POST['saveButton'])) {
            return false;
        }
        if (count($_POST['price']) > 0) {
            $save = array();
            $i = 0;
            foreach ($_POST['price'] as $key => $val) {
                $save[$i]['where'] = array('id' => $key);
                $a = array();
                foreach ($val as $k => $v) {
                    $a[$k] = htmlentities($v);
                }
                $save[$i]['set'] = $a;
                $i++;
            }
        }
        $res = $this->updateMultiple($this->cfg['db_prefix'].'pricing', $save);
        return $res;
    }

}

?>