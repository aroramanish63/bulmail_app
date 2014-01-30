<?php

class siteRegionFunction extends AllFunctions {

    //-----Initialization -------
    function addSiteRegion() {
        if (!isset($_POST['saveButton'])) {
            return false;
        }
        if (!$this->isUnique($this->cfg['db_prefix'] . 'site_region', 'region_name', $_POST['siteRegion_name'])) {
            return 'Region name alerady Exists';
        }
        if ($_POST['siteRegion_directory'] != '' && $_POST['siteRegion_name'] != '') {
            $page_code = $_POST['pageCode'];
            $page_code = str_replace(array('<textarea', '</textarea>'), array('&lt;textarea', '&lt;/textarea&gt;'), $page_code);
            $fields = array("region_name" => $_POST['siteRegion_name'],
                "directory" => $_POST['siteRegion_directory'],
                'page' => $_POST['siteRegion_page'],
                'active' => isset($_POST['siteRegion_active']) ? $_POST['siteRegion_active'] : 0,
                'page_code' => ($page_code),
                'breadcrumb_parent_id' => isset($_POST['siteRegion_parent']) ? $_POST['siteRegion_parent'] : 0,
                'breadcrumb_link' => $_POST['breadcrumb_link']);
            $result = $this->insert($this->cfg['db_prefix'] . 'site_region', $fields);
            if (isset($result['error'])) {
                return $result['error'];
            }
            $id = $this->getInsertId();
            $fieldsPage = array();
            $i = 0;
            if (isset($_POST['siteRegion'])) {
                foreach ($_POST['siteRegion'] as $key => $value) {
                    $fieldsPage[$i]['page_id'] = $id;
                    if (isset($value['title'])) {
                        $fieldsPage[$i]['page_title'] = htmlspecialchars($value['title']);
                    }
                    if (isset($value['meta_key'])) {
                        $fieldsPage[$i]['meta_key'] = htmlspecialchars($value['meta_key']);
                    }
                    if (isset($value['meta_desc'])) {
                        $fieldsPage[$i]['meta_desc'] = htmlspecialchars($value['meta_desc']);
                    }
                    if (isset($value['breadcrumb'])) {
                        $fieldsPage[$i]['breadcrumb'] = htmlspecialchars($value['breadcrumb']);
                    }
                    $i++;
                }
            }
            $res = $this->insertMultiple($this->cfg['db_prefix'] . 'page_data', $fieldsPage);
        } else {
            return 'Please Fill the required Fields';
        }
        return isset($res['error']) ? $res['error'] : 'success';
    }

    /* function for updating site region and page data
     *
     *
     */

    function updateSiteRegion() {
        if (!isset($_POST['saveButton']) && !isset($_REQUEST['id'])) {
            return false;
        }
        $resPage = 'success';
        global $cfg;
        if (isset($_POST['siteRegion_name'])) {
            $previous_code = $this->select($this->cfg['db_prefix'] . 'site_region', '*', array('id' => $_REQUEST['id']));
            if (is_writable($cfg['admin_path'] . 'code_backup/')) {
                $filename = $cfg['admin_path'] . 'code_backup/' . $previous_code[0]['directory'] . '_' . $previous_code[0]['region_name'] . '_' . time() . '.tmp';
                $wrt = fopen($filename, 'w');
                fwrite($wrt, $previous_code[0]['page_code']);
                fclose($wrt);
            }
            $page_code = $_POST['pageCode'];
            $page_code = str_replace(array('<textarea', '</textarea>'), array('&lt;textarea', '&lt;/textarea&gt;'), $page_code);
            $setArr = array();
            $setArr[] = array(
                'set' => array("region_name" => $_POST['siteRegion_name'],
                    "directory" => $_POST['siteRegion_directory'],
                    'page' => $_POST['siteRegion_page'],
                    'active' => $_POST['siteRegion_active'],
                    'page_code' => ($page_code),
                    'breadcrumb_parent_id' => isset($_POST['siteRegion_parent']) ? $_POST['siteRegion_parent'] : 0,
                    'breadcrumb_link' => ($_POST['breadcrumb_link'])),
                'where' => array('id' => $_REQUEST['id']));
            $res = $this->updateMultiple($this->cfg['db_prefix'] . 'site_region', $setArr);
        }



        $fieldsPage = array();
        $i = 0;
        if (isset($_POST['siteRegion'])) {
            foreach ($_POST['siteRegion'] as $key => $value) {
                if (isset($value['title'])) {
                    $fieldsPage[$i]['set']['page_title'] = htmlspecialchars($value['title']);
                }
                if (isset($value['meta_key'])) {
                    $fieldsPage[$i]['set']['meta_key'] = htmlspecialchars($value['meta_key']);
                }
                if (isset($value['meta_desc'])) {
                    $fieldsPage[$i]['set']['meta_desc'] = htmlspecialchars($value['meta_desc']);
                }
                if (isset($value['breadcrumb'])) {
                    $fieldsPage[$i]['set']['breadcrumb'] = htmlspecialchars($value['breadcrumb']);
                }

                $fieldsPage[$i]['where'] = array('page_id' => $_REQUEST['id'],
                    'lang_id' => $key);
//
//                $fieldsPage[] = array(
//                    'set' => array('page_title' => htmlspecialchars($value['title']),
//                        'meta_key' => htmlspecialchars($value['meta_key']),
//                        'meta_desc' => htmlspecialchars($value['meta_desc']),
//                        'breadcrumb' => htmlspecialchars($value['breadcrumb'])),
//                    'where' => array('page_id' => $_REQUEST['id'],
//                        'lang_id' => $key)
//                );
                $i++;
            }

            $resPage = $this->updateMultiple($this->cfg['db_prefix'] . 'page_data', $fieldsPage);
        }
        return $resPage;
    }

    /* function for getting site region
     *
     *
     *
     */

    function getAllRegion($id = '') {
        if ($id != '') {
            $where = array('id' => $id);
            return $this->select($this->cfg['db_prefix'] . "site_region", '*', $where);
        } else {
            return $this->select($this->cfg['db_prefix'] . "site_region");
        }
    }

    /* function for getting site data
     *
     */

    function siteData($region) {
        $where = array('page_id' => $region);
        $pageData = $this->select($this->cfg['db_prefix'] . "page_data", '*', $where);
        $returnThis = array();
        if (is_array($pageData) && count($pageData) > 0) {
            foreach ($pageData as $data) {
                $returnThis[$data['lang_id']]['title'] = $data['page_title'];
                $returnThis[$data['lang_id']]['meta_key'] = $data['meta_key'];
                $returnThis[$data['lang_id']]['meta_desc'] = $data['meta_desc'];
                $returnThis[$data['lang_id']]['breadcrumb'] = $data['breadcrumb'];
            }
        }
        return $returnThis;
    }

}

?>