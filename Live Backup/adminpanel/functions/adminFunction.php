<?php

class AdminFunctions extends AllFunctions {

    //-----Initialization -------

    function __construct() {
        parent::__construct();
        // var_dump($this->cfg['db_prefix']);
    }

    public function convertCurrency($value, $curr = '') {
        $curr_code = $curr;
        $returnThis = $value;
        if ($curr == '' && isset($_SESSION['curr'])) {
            $curr_code = $_SESSION['curr'];
        }
        $curr_val = $this->select($this->cfg['db_prefix'] . 'base_currency', '*', array('currency_code' => $curr_code, 'active' => 1));
        if (isset($curr_val[0]['currency_weight'])) {
            //  if ($value != 0 && $curr_val[0]['currency_weight'] != 0)
            //  return $curr_val[0]['currency_code'] . ' ' . round($value * $curr_val[0]['currency_weight'], 3);
            //   return '<img src="images/ruppesgrey-img.jpg" alt=""/>' . ' ' . round($value * $curr_val[0]['currency_weight'], 2);
            $returnThis = $curr_val[0]['currency_code'] . ' ' . $value;
        }

        return $returnThis;
        //return '<img src="images/ruppesgrey-img.jpg" alt=""/>' . ' ' . $value;
    }

    public function pagaData($pagename) {
        if ($pagename == '') {
            return FALSE;
        }
        $returnThis = array();
        $page_id = $this->select($this->cfg['db_prefix'] . 'site_region', array('id'), array('region_name' => $pagename));
        if (isset($_SESSION['lang']) && count($page_id) > 0) {
            $lag_id = $this->select($this->cfg['db_prefix'] . 'language', '*', array('abrv' => $_SESSION['lang']));
            $pagedata = $this->select($this->cfg['db_prefix'] . 'page_data', '*', array('page_id' => $page_id[0]['id'], 'lang_id' => $lag_id[0]['id']));

            $returnThis['id'] = $page_id[0]['id'];
            if (count($pagedata) > 0) {
                foreach ($pagedata as $data) {
                    $returnThis['title'] = $data['page_title'];
                    $returnThis['meta_key'] = $data['meta_key'];
                    $returnThis['meta_desc'] = $data['meta_desc'];
                }
            }
        }
        return $returnThis;
    }

    function getBreadCrumb($page_id, $sqlRegion, &$arrres = array()) {

        foreach ($sqlRegion as $parent) {
            if ($parent['id'] == $page_id) {
                $arrres[] = array($parent['id'] => $parent['region_name']);
                $this->getBreadCrumb($parent['breadcrumb_parent_id'], $sqlRegion, $arrres);
            }
        }
    }

    /* function for getting language value
     *
     *
     */

    public function getLangVal($key, $region = '', $langId = '') {
        if ($langId == '' && isset($_SESSION['lang'])) {
            $lang = $this->select($this->cfg['db_prefix'] . 'language', '*', array('abrv' => $_SESSION['lang']));
            $langId = $lang[0]['id'];
        }
        if ($region == '') {
            $region_arr = $this->select($this->cfg['db_prefix'] . 'site_region', array('id'), array('region_name' => 'common'));
            $region = $region_arr[0]['id'];
        }
        $where = array('lang_id' => $langId, 'lang_key' => $key, 'key_region' => $region);
        $value = $this->select($this->cfg['db_prefix'] . 'lang_keywords', '*', $where);
        return isset($value[0]['lang_value']) ? $value[0]['lang_value'] : '';
    }

    /* function for getting pricing order by server type
     *
     *
     */

    public function pricing() {
        $returnThis = array();
        $where = array('currency_code' => isset($_SESSION['curr']) ? strtolower($_SESSION['curr']) : 'INR');
        $field = array();
        $pricing = $this->select($this->cfg['db_prefix'] . 'pricing', '*', $where);
        $i = 0;
        foreach ($pricing as $price) {
            foreach ($price as $key => $val) {
                if ($key == 'hrly' || $key == 'mnthly') {
                    $returnThis[$price['server_type']][$i][$key] = $price['currency_code'] . ' ' . $val;
                } else {
                    $returnThis[$price['server_type']][$i][$key] = $val;
                }
            }
            $i++;
        }

        return $returnThis;
    }

    /* function for getting pricing elastic cloud plans server type
     *
     *
     */

    public function elasticpricing() {
        $returnThis = array();
        $pricing = $this->select($this->cfg['db_prefix'] . 'elastic_plans', '*', array('currency_code' => $_SESSION['curr']));
        $i = 0;
        foreach ($pricing as $price) {
            foreach ($price as $key => $val) {
                if ($i == 0) {
                    $returnThis[$i][$key] = ($val != '') ? $_SESSION['curr'] . ' ' . $val : '';
                }
                else
                    $returnThis[$i][$key] = $val;
            }
            $i++;
        }
        return $returnThis;
    }

    /* function for dedicated server plan
     *
     *
     */

    public function dedicatedPlan() {
        $returnThis = array();
        $where = array('currency_code' => isset($_SESSION['curr']) ? strtolower($_SESSION['curr']) : 'INR');
        $field = array();
        $pricing = $this->select($this->cfg['db_prefix'] . 'dedicated_plan', '*', $where);
        foreach ($pricing as $price) {
            $returnThis[$price['server']]['price'] = $price['currency_code'] . ' ' . $price['price'];
            $returnThis[$price['server']]['link'] = $price['link'];
        }
        return $returnThis;
    }

    /* function for getting currency code by country
     *
     *
     */

    public function getCurrency($countryCode) {
        $currency = $this->select($this->cfg['db_prefix'] . 'country', '*', array('country_code' => $countryCode));
        if (isset($currency[0]['currency_code'])) {
            return $currency[0]['currency_code'];
        } else {
            $config = $this->getSiteConfig();
            if (isset($config['default_currency'])) {
                return $config['default_currency'];
            }
        }
        return 'USD';
    }

    /* function for getting exchange server shared server on emailapps tab
     *
     *
     */

    public function exchangedServer() {
        $returnThis = array();
        $pricing = $this->select($this->cfg['db_prefix'] . 'exc_shrdsvr', '*', array('currency_code' => $_SESSION['curr']));
        $i = 0;
        foreach ($pricing as $price) {
            foreach ($price as $key => $val) {
                if ($key == 'plan_name') {
                    $returnThis[$i][$key] = $this->getLangVal($val);
                } elseif ($val == 'callfordetails') {
                    $returnThis[$i][$key] = $this->getLangVal($val);
                } elseif ($price['plan_name'] == '' && is_numeric($val)) {
                    $returnThis[$i][$key] = $price['currency_code'] . ' ' . $val;
                } else {
                    $returnThis[$i][$key] = $val;
                }
            }
            $i++;
        }
        return $returnThis;
    }

    /*
     * function for zimbra exchanged server
     */

    public function zimbraExchangedServer() {
        $returnThis = array();
        $pricing = $this->select($this->cfg['db_prefix'] . 'zimbra_shrdsvr', '*', array('currency_code' => $_SESSION['curr']));
        $i = 0;
        foreach ($pricing as $price) {
            foreach ($price as $key => $val) {
                if ($price['plan_name'] == 'price' && is_numeric($val)) {
                    $returnThis[$i][$key] = $price['currency_code'] . ' ' . $val;
                } else {
                    $returnThis[$i][$key] = $val;
                }
            }
            $i++;
        }
        return $returnThis;
    }

    /*
     * function for cloud cdn server
     *
     */

    public function CdnServer() {
        $returnThis = array();
        $pricing = $this->select($this->cfg['db_prefix'] . 'cdn_pricing', '*', array('currency_code' => $_SESSION['curr']));
        foreach ($pricing as $price) {
            $returnThis[$price['type_name']] = $price['type_value'];
        }
        return $returnThis;
    }

    /* function for getting cloud databases plans
     *
     *
     */

    public function clouddatabaseplans() {
        $returnThis = array();
        $c_code = isset($_SESSION['curr']) ? $_SESSION['curr'] : 'INR';
        $pricing = $this->select($this->cfg['db_prefix'] . 'db_plans', '*', array('currency_code' => $c_code));
        $i = 0;
        foreach ($pricing as $price) {
            foreach ($price as $key => $val) {
                if (strtoupper($val) == 'FREE') {
                    $returnThis[$i][$key] = $this->getLangVal($val);
                } elseif ($key == 'hourly_price' || $key == 'monthly_price') {
                    $returnThis[$i][$key] = $price['currency_code'] . ' ' . $val;
                } else {
                    $returnThis[$i][$key] = $val;
                }
            }
            $i++;
        }
        return $returnThis;
    }

    function adminlogin($uname, $pass) {
        if (!$this->getConnectionId()) {
            echo "Database login failed!";
            $this->HandleError("Database login failed!");
            return false;
        }
        $tablename = $this->cfg['db_prefix'] . 'admin_master';
        if (!is_null($uname) && !is_null($pass)) {
            $cpass = $this->returnMD5($pass);
            $where = array(
                'username' => $uname,
                'password' => $cpass,
                'active' => 1
            );
            $result = $this->select($tablename, '*', $where);
            if (is_array($result) && count($result) > 0) {
                foreach ($result as $res) {
                    $_SESSION['uid'] = $res['id'];
                    $_SESSION['username'] = $res['username'];
                    $_SESSION['role'] = array();
                    $userGroup = $res['user_group'];
                    $roleValue = $this->select($this->cfg['db_prefix'] . 'user_group', '*', array('id' => $userGroup));
                    if (is_array($roleValue) && count($roleValue) > 0) {
                        $rolesIds = isset($roleValue[0]['role_value']) ? $roleValue[0]['role_value'] : '';
                        $roles = $this->selectWhereIn($this->cfg['db_prefix'] . "user_role", "*", array('id' => $rolesIds));
                        if (is_array($roles) && count($roles) > 0) {
                            foreach ($roles as $role) {
                                $_SESSION['role'][$role['role_name']] = TRUE;
                            }
                        }
                    }
                }
                return true;
            } else {
                return false;
            }
        }
    }

    public function logout() {
        unset($_SESSION['uid']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        unset($_SESSION['firstname']);
        unset($_SESSION['visible_elements']);
        unset($_SESSION['publish']);
        return TRUE;
    }

    public function siteLanguage($countryCode) {
        if ($countryCode == '') {
            return NULL;
        }
        $languages = $this->languagesInCountry($countryCode);
        $site_language = $this->selectWhereIn($this->cfg['db_prefix'] . 'language', '*', array('abrv' => implode(",", $languages), 'active' => 1));
        if (count($site_language) > 0) {
            return $site_language[0]['abrv'];
        } else {
            $config = $this->getSiteConfig();
            if (isset($config['default_language'])) {
                return $config['default_language'];
            }
        }
        return 'EN';
    }

    /*
     * function to get confinguration of site
     */

    public function getSiteConfig() {
        $config = $this->select($this->cfg['db_prefix'] . 'config');
        $returnthis = array();
        if (is_array($config) && count($config) > 0) {
            foreach ($config as $cc) {
                $returnthis[$cc['config_name']] = $cc['config_value'];
            }
        }

        $tollfree = $this->select($this->cfg['db_prefix'] . 'country', array('custom_field'), array('country_code' => isset($_SESSION['country_code']) ? $_SESSION['country_code'] : ''));
        if (isset($tollfree[0]['custom_field'])) {
            $tf = unserialize(base64_decode($tollfree[0]['custom_field']));
            $returnthis['tollfree'] = isset($tf['tollfree']) ? $tf['tollfree'] : '';
        }
        return $returnthis;
    }

    //function for saving kaywords in database
    public function saveLangText() {
        if (isset($_POST['btn_save_text'])) {
            global $cfg;
            $res = array();
            $error = '';
            for ($i = 0; $i < count($_POST['val']); $i++) {
                $key = key($_POST['val'][$i]);
                $where = array('id' => $key);
                if ($_POST['val'][$i][$key] != '') {
                    $set = array('lang_value' => $_POST['val'][$i][$key]);
                    $res[] = $this->update($this->cfg['db_prefix'] . 'lang_keywords', $set, $where);
                } else {
                    $error = 'Null value can not updated';
                }
            }
            if ($error != '') {
                $message = array('err_type' => 'error', 'msg' => $error);
                $this->setAlertMessage($message);
            } else {
                $message = array('err_type' => 'success', 'msg' => 'Saved successfully. You need to publish the page to make changes.<a href="' . $cfg['admin_url'] . 'module">Publish</a>');
                $this->setAlertMessage($message);
            }
        }
    }

    /* function to save all page content on database
     * make sure page is posted
     *
     *
     *
     */

    public function savePageText() {
        $lang_id = $this->select($this->cfg['db_prefix'] . 'language', 'id', array('abrv' => $_SESSION['lang']));
        $setArr = array();
        $error = '';
        if (isset($_POST['langval']) && count($_POST['langval']) > 0) {
            foreach ($_POST['langval'] as $key => $val) {
                if ($val != '') {
                    $arrtxt = explode("_", $key);
                    $key_region = trim($arrtxt[0]);
                    $lang_key = $arrtxt[1];
                    $setArr[] = array(
                        'set' => array('lang_value' => $val),
                        'where' => array('lang_key' => $lang_key,
                            'key_region' => $key_region,
                            'lang_id' => $lang_id[0]['id']));
                } else {
                    $error = 'Some null value skipped';
                }
            }
            $res = $this->updateMultiple($this->cfg['db_prefix'] . 'lang_keywords', $setArr);
            if ($res == 'success') {
                $this->setAlertMessage(array('err_type' => 'success', 'msg' => 'Page updated.' . $error));
            } else {
                $this->setAlertMessage(array('err_type' => 'error', 'msg' => 'Error... Please try Again'));
            }
        } else {
            $this->setAlertMessage(array('err_type' => 'error', 'msg' => 'Error... Please try Again'));
            return;
        }
    }

    //function for get Language
    public function getLanguages($id = '') {
        $condition = '';
        if ($id != '') {
            $condition = array('id' => $id);
        }
        return $this->select($this->cfg['db_prefix'] . 'language', '*', $condition);
    }

    //function for get Language
    public function getImages($id = '') {
        $condition = '';
        if ($id != '') {
            $condition = array('id' => $id);
        }
        return $this->select($this->cfg['db_prefix'] . 'slider', '*', $condition);
    }

    function saveJobTitle() {
        if (!isset($_POST['saveButton'])) {
            return false;
        }
        if ($_POST['id'] == '' && $_POST['job_title'] != '') {
            if ($this->isUnique('job_title', 'job_title', $_POST['job_title'])) {
                $fields = array('job_title' => $_POST['job_title'], 'job_description' => $_POST['job_description']);
                $result = $this->insert('job_title', $fields);
            }
            else
                return 'Job title already exists';
        }
        elseif ($_POST['id'] != '' && $_POST['job_title'] != '') {
            $set_fields = array('job_title' => $_POST['job_title'], 'job_description' => $_POST['job_description']);
            $where = array('id' => $_POST['id']);
            $result = $this->update('job_title', $set_fields, $where);
        } else {
            return 'Job title is empty';
        }
        return isset($result['error']) ? $result['error'] : 'success';
    }

    function saveLanguange() {
        global $cfg;
        if (!isset($_POST['saveButton'])) {
            return false;
        }
        if ($_POST['id'] == '' && $_POST['languageTitle'] != '') {
            if ($this->isUnique($this->cfg['db_prefix'] . 'language', 'language', $_POST['languageTitle'])) {
                $fields = array('language' => $_POST['languageTitle'], 'abrv' => $_POST['lang_abrv'], 'charset' => $_POST['lang_charset'], 'default_currency' => $_POST['default_currency'], 'active' => $_POST['active']);
                $result = $this->insert($this->cfg['db_prefix'] . 'language', $fields);
            }
            else
                return 'Language already exists';
        }
        elseif ($_POST['id'] != '' && $_POST['languageTitle'] != '') {
            $set_fields = array('language' => $_POST['languageTitle'], 'abrv' => $_POST['lang_abrv'], 'charset' => $_POST['lang_charset'], 'default_currency' => $_POST['default_currency'], 'active' => $_POST['active']);
            $where = array('id' => $_POST['id']);
            $result = $this->update($this->cfg['db_prefix'] . 'language', $set_fields, $where);
        } else {
            return 'Language is empty.';
        }
        if (isset($_FILES['icon_name']['name'])) {
            $imagePath = $cfg['base_path'] . 'images/countryicon/' . strtolower($_POST['lang_abrv']) . '.png';
            $this->saveImage($_FILES['icon_name']['tmp_name'], $imagePath);
        }
        return isset($result['error']) ? $result['error'] : 'success';
    }

    public function managedservicesplans() {
        $c_code = isset($_SESSION['curr']) ? $_SESSION['curr'] : 'INR';
        $returnThis = array();
        $managedplans = $this->select($this->cfg['db_prefix'] . 'managed_services_plans', '*', array('active' => 1, 'currency_code' => $c_code));
        $i = 0;
        foreach ($managedplans as $price) {
            foreach ($price as $key => $val) {
                if ($key == 'silver_price' || $key == 'gold_price' || $key == 'platinum_price' || $key == 'titanium_price') {
                    $returnThis[$i][$key] = $price['currency_code'] . ' ' . $val;
                } else {
                    $returnThis[$i][$key] = $val;
                }
            }
            $i++;
        }
        return $returnThis;
    }

    public function outgoingpricing($page) {
        $c_code = isset($_SESSION['curr']) ? $_SESSION['curr'] : 'INR';
        $returnThis = array();
        $ogprice = $this->select($this->cfg['db_prefix'] . 'outgoing_price', '*', array('active' => 1, 'currency_code' => $c_code, 'page' => $page));
        $i = 0;
        if (count($ogprice) > 0) {
            foreach ($ogprice as $price) {
                foreach ($price as $key => $val) {
                    if ($key == 'plan_value') {
                        $returnThis[$i][$key] = $price['currency_code'] . ' ' . $val;
                    } else {
                        $returnThis[$i][$key] = $val;
                    }
                }
                $i++;
            }
        }
        return $returnThis;
    }

    function load_tbl_bckp() {
        $c_code = isset($_SESSION['curr']) ? $_SESSION['curr'] : 'INR';
        $returnThis = array();
        $lgprice = $this->select($this->cfg['db_prefix'] . 'load_bal_bckp', '*', array('active' => 1, 'currency_code' => $c_code));
        $i = 0;
        foreach ($lgprice as $price) {
            foreach ($price as $key => $val) {
                if ($key == 'ins_pr_hr' || $key == 'ins_pr_mo' || $key == 'pri_pr_gb') {
                    $returnThis[$i][$key] = $price['currency_code'] . ' ' . $val;
                } else {
                    $returnThis[$i][$key] = $val;
                }
            }
            $i++;
        }
        return $returnThis;
    }

    /*
     * function for ssl pricing on ssl certificate page
     */

    function sslPricing() {
        $c_code = isset($_SESSION['curr']) ? $_SESSION['curr'] : 'INR';
        $returnThis = array();
        $lgprice = $this->select($this->cfg['db_prefix'] . 'ssl_pricing', '*', array('currency_code' => $c_code));
        $i = 0;
        foreach ($lgprice as $price) {
            foreach ($price as $key => $val) {
                if (($price['plan_name'] == 'price' || $price['plan_name'] == 'hover') && $val != '') {
                    $returnThis[$i][$key] = $price['currency_code'] . ' ' . $val;
                } else {
                    $returnThis[$i][$key] = $val;
                }
            }
            $i++;
        }
        return $returnThis;
    }

    /* function for saving image to file
     *
     *
     */

    function saveImage($image, $path) {
        move_uploaded_file($image, $path);
    }

    function saveSliderImages() {
        if (!isset($_POST['saveButton'])) {
            return false;
        }

        if ($_POST['lang'] != '') {

            $upload = $_FILES['sliderimage'];
            $imagename = $this->handle_upload($upload);
            $fields = array('lang_id' => $_POST['lang'], 'image' => $imagename, 'add_date' => date('y-m-d'));
            $result = $this->insert($this->cfg['db_prefix'] . 'slider', $fields);
        } elseif ($_POST['lang'] != '') {
            $set_fields = array('lang_id' => $_POST['lang'], 'image' => $imagename, 'add_date' => date('y-m-d'));
            $where = array('id' => $_POST['id']);
            $result = $this->update($this->cfg['db_prefix'] . 'slider', $set_fields, $where);
        } else {
            return 'Language is empty.';
        }
        return isset($result['error']) ? $result['error'] : 'success';
    }

    // Function for get language name

    public function getLanguageName($id) {
        if (isset($id) && !is_null($id)) {
            $langname = $this->getLanguages($id);
            if (is_array($langname)) {
                foreach ($langname as $lang)
                    return $lang['language'];
            }
        }
    }

    /*     * ***
     * *** Function for get Blogs details
     * ** */

    //-----Initialization for image upload -------
    var $imageExts = array(".png", ".gif", ".jpg", ".jpeg", ".bmp");
    var $uploadImageTarget = "../../articleimages/";
    var $uploadThumbImageTarget = "../../articleimages/thumbs/";
    var $fileName = "";
    var $tmpName = "";
    var $fileNametoUpload;
    var $imageUploadPath;

    public function getBlogs($id = '') {
        $condition = '';
        if ($id != '') {
            $condition = array('id' => $id);
        }
        return $this->select($this->cfg['db_prefix'] . 'blog', '*', $condition);
    }

    /*
     * Function for insert blog details
     */

    public function saveBlog() {
        if (!isset($_POST['saveButton'])) {
            return false;
        }

        if (trim($_POST['language']) == '' || trim($_POST['blogTitle']) == '' || trim($_POST['blogcontent']) == '' || $_POST['blogCategory'] == '') {
            return 'All fields are required.';
        }

        /* $this->fileName = $_FILES['uploadedFile']['name'];
          if(!empty($this->fileName)){
          $this->fileNametoUpload = time().$this->fileName;
          } */

        $blogTitle = str_replace(".", "", str_replace("/", "", $_POST['blogTitle']));

        if (($_POST['id'] == '')) {
            $uniqcondition = array('title' => trim($blogTitle), 'categoryId' => trim($_POST['blogCategory']));
            if (!$this->isUniqueMultiple($this->cfg['db_prefix'] . 'blog', 'title', $uniqcondition)) {
                return 'Blog Title is already exists in same category.';
            }
        }

        if (($_POST['id'] == '') && ($_POST['language'] != '') && ($_POST['blogTitle'] != '')) {
            $this->startUpload(); // For Blog Image Upload
            $fields = array('title' => $_POST['blogTitle'], 'content' => mysqli_real_escape_string($this->getConnectionId(), $_POST['blogcontent']), 'blog_name' => strtolower(str_replace(" ", "-", $blogTitle)), 'categoryId' => $_POST['blogCategory'], 'blogImage' => $this->fileNametoUpload, 'langid' => $_POST['language'], 'userid' => $_SESSION['uid'], 'status' => $_POST['publish'], 'add_date' => date('Y-m-d H:i:s'));
            $result = $this->insert($this->cfg['db_prefix'] . 'blog', $fields);
        } elseif (($_POST['id'] != '') && ($_POST['language'] != '')) {
            $this->startUpload(); // For Blog Image Upload
            if (!empty($this->fileName)) {
                $set_fields = array('title' => $_POST['blogTitle'], 'content' => $_POST['blogcontent'], 'blog_name' => strtolower(str_replace(" ", "-", $blogTitle)), 'categoryId' => $_POST['blogCategory'], 'blogImage' => $this->fileNametoUpload, 'langid' => $_POST['language'], 'userid' => $_SESSION['uid'], 'status' => $_POST['publish'], 'update_date' => date('Y-m-d H:i:s'));
            } else {
                $set_fields = array('title' => $_POST['blogTitle'], 'content' => $_POST['blogcontent'], 'blog_name' => strtolower(str_replace(" ", "-", $blogTitle)), 'categoryId' => $_POST['blogCategory'], 'langid' => $_POST['language'], 'userid' => $_SESSION['uid'], 'status' => $_POST['publish'], 'update_date' => date('Y-m-d H:i:s'));
            }
            //print_r($set_fields);die;
            $where = array('id' => $_POST['id']);
            $result = $this->update($this->cfg['db_prefix'] . 'blog', $set_fields, $where);
        } else {
            return 'Language is not selected.';
        }
        return isset($result['error']) ? $result['error'] : 'success';
    }

    public function deleteBlog() {
        if (!isset($_POST['deleteBlog']) && count($_POST['blogIds']) == 0) {
            return 'Select blog(s) to delete.';
        }

        $blogIdsArray = $_POST['blogIds'];
        $blogIdsCount = count($_POST['blogIds']);

        for ($i = 0; $i < $blogIdsCount; $i++) {
            $blogId = $blogIdsArray[$i];
            $where = array('id' => $blogId);
            $blogImage = $this->select($this->cfg['db_prefix'] . 'blog', 'blogImage', $where);
            $blogImageToDelete = $blogImage[0]['blogImage'];
            $this->delete($this->cfg['db_prefix'] . 'blog', $where);
            if (!empty($blogImageToDelete)) {
                unlink($this->uploadImageTarget . $blogImageToDelete);
                //unlink($this->uploadThumbImageTarget.$blogImageToDelete);
            }
        }
        return true;
    }

    /*
      startUpload() function uploads image file into
      database with checking the file type. Here $this->imageExts
      has the image extensions defined on the top of this file and
      $this->uploadImageTarget is the target path where you want to save images.
     */

    public function startUpload() {
        $this->fileName = $_FILES['uploadedFile']['name'];
        $this->tmpName = $_FILES['uploadedFile']['tmp_name'];

        //$imagevars = array();

        if (!empty($this->fileName)) {
            if (!$this->checkExt($this->imageExts)) {
                //return "Sorry, you can not upload this filetype!";
                return false;
            }
            if ($this->uploadIt($this->uploadImageTarget)) {
                //$this->createThumbnailForImage(); //creating thumbnail image
                return true;
            } else {
                //return "Sorry, your file could not be uploaded for some unknown reason!";
                return false;
            }
        }
    }

    public function uploadIt($uploadFileTarget) {
        $this->fileNametoUpload = time() . $this->fileName;
        $this->imageUploadPath = $uploadFileTarget . $this->fileNametoUpload;
        return (move_uploaded_file($this->tmpName, $this->imageUploadPath) ? true : false);
    }

    function createThumbnailForImage() {
        $img_thumb = $this->uploadThumbImageTarget . $this->fileNametoUpload;
        list($gotwidth, $gotheight, $gottype, $gotattr) = getimagesize($this->imageUploadPath);

        if ($this->getExt() == ".jpg" || $this->getExt() == ".jpeg") {
            $src = imagecreatefromjpeg($this->imageUploadPath);
        } else if ($this->getExt() == ".png") {
            $src = imagecreatefrompng($this->imageUploadPath);
        } else if ($this->getExt() == ".bmp") {
            $src = $this->ImageCreateFromBMP($this->imageUploadPath);
        } else {
            $src = imagecreatefromgif($this->imageUploadPath);
        }

        if ($gotwidth >= 253) {
            $newwidth = 253;
        } else {
            $newwidth = $gotwidth;
        }

        //Find the new height
        $newheight = round(($gotheight * $newwidth) / $gotwidth);

        //Creating thumbnail
        $tmp = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $gotwidth, $gotheight);

        //Create thumbnail image
        imagejpeg($tmp, $img_thumb, 100);
    }

    public function getExt() {
        return strtolower(substr($this->fileName, strpos($this->fileName, "."), strlen($this->fileName) - 1));
    }

    public function checkExt($fileExts) {
        return (in_array($this->getExt(), $fileExts) ? true : false);
    }

    function ImageCreateFromBMP($filename) {
        if (!$f1 = fopen($filename, "rb"))
            return FALSE;

        $FILE = unpack("vfile_type/Vfile_size/Vreserved/Vbitmap_offset", fread($f1, 14));
        if ($FILE['file_type'] != 19778)
            return FALSE;

        $BMP = unpack('Vheader_size/Vwidth/Vheight/vplanes/vbits_per_pixel' .
                '/Vcompression/Vsize_bitmap/Vhoriz_resolution' .
                '/Vvert_resolution/Vcolors_used/Vcolors_important', fread($f1, 40));
        $BMP['colors'] = pow(2, $BMP['bits_per_pixel']);
        if ($BMP['size_bitmap'] == 0)
            $BMP['size_bitmap'] = $FILE['file_size'] - $FILE['bitmap_offset'];
        $BMP['bytes_per_pixel'] = $BMP['bits_per_pixel'] / 8;
        $BMP['bytes_per_pixel2'] = ceil($BMP['bytes_per_pixel']);
        $BMP['decal'] = ($BMP['width'] * $BMP['bytes_per_pixel'] / 4);
        $BMP['decal'] -= floor($BMP['width'] * $BMP['bytes_per_pixel'] / 4);
        $BMP['decal'] = 4 - (4 * $BMP['decal']);
        if ($BMP['decal'] == 4)
            $BMP['decal'] = 0;

        $PALETTE = array();
        if ($BMP['colors'] < 16777216) {
            $PALETTE = unpack('V' . $BMP['colors'], fread($f1, $BMP['colors'] * 4));
        }

        $IMG = fread($f1, $BMP['size_bitmap']);
        $VIDE = chr(0);

        $res = imagecreatetruecolor($BMP['width'], $BMP['height']);
        $P = 0;
        $Y = $BMP['height'] - 1;
        while ($Y >= 0) {
            $X = 0;
            while ($X < $BMP['width']) {
                if ($BMP['bits_per_pixel'] == 24)
                    $COLOR = unpack("V", substr($IMG, $P, 3) . $VIDE);
                elseif ($BMP['bits_per_pixel'] == 16) {
                    $COLOR = unpack("n", substr($IMG, $P, 2));
                    $COLOR[1] = $PALETTE[$COLOR[1] + 1];
                } elseif ($BMP['bits_per_pixel'] == 8) {
                    $COLOR = unpack("n", $VIDE . substr($IMG, $P, 1));
                    $COLOR[1] = $PALETTE[$COLOR[1] + 1];
                } elseif ($BMP['bits_per_pixel'] == 4) {
                    $COLOR = unpack("n", $VIDE . substr($IMG, floor($P), 1));
                    if (($P * 2) % 2 == 0)
                        $COLOR[1] = ($COLOR[1] >> 4);
                    else
                        $COLOR[1] = ($COLOR[1] & 0x0F);
                    $COLOR[1] = $PALETTE[$COLOR[1] + 1];
                }
                elseif ($BMP['bits_per_pixel'] == 1) {
                    $COLOR = unpack("n", $VIDE . substr($IMG, floor($P), 1));
                    if (($P * 8) % 8 == 0)
                        $COLOR[1] = $COLOR[1] >> 7;
                    elseif (($P * 8) % 8 == 1)
                        $COLOR[1] = ($COLOR[1] & 0x40) >> 6;
                    elseif (($P * 8) % 8 == 2)
                        $COLOR[1] = ($COLOR[1] & 0x20) >> 5;
                    elseif (($P * 8) % 8 == 3)
                        $COLOR[1] = ($COLOR[1] & 0x10) >> 4;
                    elseif (($P * 8) % 8 == 4)
                        $COLOR[1] = ($COLOR[1] & 0x8) >> 3;
                    elseif (($P * 8) % 8 == 5)
                        $COLOR[1] = ($COLOR[1] & 0x4) >> 2;
                    elseif (($P * 8) % 8 == 6)
                        $COLOR[1] = ($COLOR[1] & 0x2) >> 1;
                    elseif (($P * 8) % 8 == 7)
                        $COLOR[1] = ($COLOR[1] & 0x1);
                    $COLOR[1] = $PALETTE[$COLOR[1] + 1];
                }
                else
                    return FALSE;
                imagesetpixel($res, $X, $Y, $COLOR[1]);
                $X++;
                $P += $BMP['bytes_per_pixel'];
            }
            $Y--;
            $P+=$BMP['decal'];
        }

        fclose($f1);

        return $res;
    }

    /*     * ******** Start Function for blog Category ******* */

    public function getCategoryList($id = '') {
        $condition = '';
        if ($id != '') {
            $condition = array('id' => $id);
        }
        return $this->select($this->cfg['db_prefix'] . 'blog_category', '*', $condition);
    }

    public function saveCategory() {
        if (!isset($_POST['saveButton'])) {
            return false;
        }
        $catName = str_replace(".", "", str_replace("/", " ", $_POST['catName']));
        if (($_POST['id'] == '') && ($_POST['catName'] != '')) {
            if (!$this->isUnique($this->cfg['db_prefix'] . 'blog_category', 'catName', $catName)) {
                return 'Category Name is already exists.';
            }
            $fields = array('catName' => $catName, 'createdOn' => date('Y-m-d H:i:s'));
            $result = $this->insert($this->cfg['db_prefix'] . 'blog_category', $fields);
        } elseif (($_POST['id'] != '') && ($_POST['catName'] != '')) {
            $fields = array('catName' => $catName, 'createdOn' => date('Y-m-d H:i:s'));
            $where = array('id' => $_POST['id']);
            $result = $this->update($this->cfg['db_prefix'] . 'blog_category', $fields, $where);
        } else {
            return 'Category Name is required.';
        }
        return isset($result['error']) ? $result['error'] : 'success';
    }

    public function deleteCategory() {
        if (!isset($_POST['deleteCategory']) && count($_POST['categoryIds']) == 0) {
            return 'Select category to delete.';
        }

        $categoryIdsArray = $_POST['categoryIds'];
        $categoryIdsCount = count($_POST['categoryIds']);

        for ($i = 0; $i < $categoryIdsCount; $i++) {
            $categoryId = $categoryIdsArray[$i];
            $where = array('id' => $categoryId);
            $this->delete($this->cfg['db_prefix'] . 'blog_category', $where);
        }
        return true;
    }

    public function getBlogCatName($id) {
        if (isset($id) && !is_null($id)) {
            $blogCatName = $this->getCategoryList($id);
            if (is_array($blogCatName)) {
                foreach ($blogCatName as $bCatname)
                    return $bCatname['catName'];
            }
        }
    }

    /*     * ******** End Function for blog Category ******* */
}

?>