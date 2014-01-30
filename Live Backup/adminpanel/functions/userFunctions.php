<?php

class userFunction extends AllFunctions {

    function saveUserRole() {
        $result = FALSE;
        if (count($_POST['config']) > 0) {
            $set = array();
            $insert = array();
            $i = 0;
            foreach ($_POST['config'] as $key => $val) {
                $set[$i]['set'] = $val;
                $set[$i]['where'] = array('id' => $key);
                if ($val[key($val)] != '') {
                    $insert[key($val)] = $val[key($val)];
                }
                $i++;
            }
            if (isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
                $result = $this->updateMultiple($this->cfg['db_prefix'].'user_role', $set);
            } elseif (count($insert) > 0) {
                $result = $this->insert($this->cfg['db_prefix'].'user_role', $insert);
                if (!isset($result['error'])) {
                    $result = 'success';
                }
            }
        }
        return $result;
    }

    function saveUserGroup() {
        $result = FALSE;
        if (count($_POST['config']) > 0) {
            $set = array();
            $insert = array();
            $i = 0;
            $role = array();
            if (isset($_REQUEST['id'])) {
                $set[1]['set'] = array('group_name' => $_POST['config']['group_name'],
                    'description' => $_POST['config']['description'],
                    'role_value' => implode(",", array_keys($_POST['config']['role'])));
                $set[1]['where'] = array('id' => $_REQUEST['id']);
            } else {
                foreach ($_POST['config'] as $key => $val) {
                    if ($key != 'role') {
                        $insert[$key] = $val;
                    } elseif ($key == 'role') {
                        if (is_array($val)) {
                            foreach ($val as $k => $v) {
                                $role[] = $k;
                            }
                        }
                    }
                    $i++;
                }
            }
            if (count($role) > 0) {
                $insert['role_value'] = implode(",", $role);
            }
            if (isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
                $result = $this->updateMultiple($this->cfg['db_prefix'].'user_group', $set);
            } elseif (count($insert) > 0) {
                $result = $this->insert($this->cfg['db_prefix'].'user_group', $insert);
                if (!isset($result['error'])) {
                    $result = 'success';
                }
            }
        }
        return $result;
    }

    // function for save user details

    function saveUser() {
        if (!isset($_POST['saveButton'])) {
            return false;
        }
        if ($_POST['username'] != '' && !isset($_REQUEST['id'])) {
            if ($this->isUnique($this->cfg['db_prefix'].'admin_master', 'username', $_POST['username'])) {
                $fields = array('username' => $_POST['username'], 'user_group' => $_POST['user_group'], 'password' => $this->returnMD5($_POST['password']), 'add_date' => date('y-m-d'), 'active' => $_POST['active']);
                $result = $this->insert($this->cfg['db_prefix'].'admin_master', $fields);
            }
            else
                return 'Username or Email already exists';
        }
        elseif ($_POST['username'] != '' && isset($_REQUEST['id'])) {
            $set_fields = array('username' => $_POST['username'], 'user_group' => $_POST['user_group'], 'active' => $_POST['active']);
            if ($_POST['password'] != '') {
                $set_fields['password'] = $this->returnMD5($_POST['password']);
            }
            $where = array('id' => $_REQUEST['id']);
            $result = $this->update($this->cfg['db_prefix'].'admin_master', $set_fields, $where);
        }
        return isset($result['error']) ? $result['error'] : 'success';
    }

    // function for get userdetails
    public function getUsers($id = '') {
        $condition = '';
        if ($id != '') {
            $condition = array('id' => $id);
        }
        return $this->select($this->cfg['db_prefix'].'admin_master', '*', $condition);
    }

    function getUserRole() {
        return $this->select($this->cfg['db_prefix']."user_role");
    }

    function getUserGroup() {
        return $this->select($this->cfg['db_prefix']."user_group");
    }

}

?>