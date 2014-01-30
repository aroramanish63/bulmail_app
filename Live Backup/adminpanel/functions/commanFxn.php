<?php

if (function_exists("date_default_timezone_set"))
    date_default_timezone_set("Asia/Calcutta");
error_reporting(E_ALL);
ini_set("display_errors", 1);
include_once($cfg['admin_path'] . 'classes/mysqlClass.php');

//require_once("class.phpmailer.php");
//require_once("validatorform.php");

class AllFunctions extends Db {

    var $admin_email;
    var $rand_key;
    var $error_message;
    var $alert_message = array();

    public function __construct() {
        parent::__construct();
    }

    //-----Initialization -------
    function SetAdminEmail($email) {
        $this->admin_email = $email;
    }

    function SetWebsiteName($sitename) {
        $this->sitename = $sitename;
    }

    function SetRandomKey($key) {
        $this->rand_key = $key;
    }

    //-------Main Operations ----------------------
    function HandleError($err) {
        $this->error_message .= $err . "\r\n";
    }

    function HandleDBError($err) {
        $this->HandleError($err . "\r\n mysqlerror:" . mysql_error());
    }

    //-------Public Helper functions -------------
    function GetSelfScript() {
        return htmlentities($_SERVER['PHP_SELF']);
    }

    function SafeDisplay($value_name) {
        if (empty($_POST[$value_name])) {
            return'';
        }
        return htmlentities($_POST[$value_name]);
    }

    function RedirectToURL($url) {
        if (!@header("location: $url")) {
            echo '<script type="text/javascript">window.location="' . $url . '"</script>';
        }
        exit;
    }

    function GetErrorMessage() {
        if (empty($this->error_message)) {
            return '';
        }
        $errormsg = nl2br(htmlentities($this->error_message));
        return $errormsg;
    }

    function get_connection() {
        return $this->connection;
    }

    function StripSlashes($str) {
        if (get_magic_quotes_gpc()) {
            $str = stripslashes($str);
        }
        return $str;
    }

    /*
      Sanitize() function removes any potential threat from the
      data submitted. Prevents email injections or any other hacker attempts.
      if $remove_nl is true, newline chracters are removed from the input.
     */

    function Sanitize($str, $remove_nl = true) {
        $str = $this->StripSlashes($str);

        if ($remove_nl) {
            $injections = array('/(\n+)/i',
                '/(\r+)/i',
                '/(\t+)/i',
                '/(%0A+)/i',
                '/(%0D+)/i',
                '/(%08+)/i',
                '/(%09+)/i'
            );
            $str = preg_replace($injections, '', $str);
        }

        return $str;
    }

    /*
      function for set error message

      err_type=>[can be error/success/info/block]]
      msg=>any text


     */

    function setAlertMessage($message = array()) {
        if (is_array($message) && count($message) > 0)
            $this->alert_message = $message;
    }

    function getAlertMessage() {
        $returnThis = '';
        if (isset($this->alert_message['err_type']) && $this->alert_message['err_type'] != '') {
            $returnThis = '
			<div class="alert alert-' . $this->alert_message['err_type'] . '">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<i class="icon-ok-sign"></i>  <strong> ' . ucfirst($this->alert_message['err_type']) . ' : </strong> ' . $this->alert_message['msg'] . '
			</div>
			';
        }
        return $returnThis;
    }

    /*
      function for set language keywords

      input lang_id
      outpur lang_key=>lang_val as array


     */

    function langValue($lang_id, $region = '') {
        if ($lang_id == '') {
            return false;
        }
        $where = array('lang_id' => $lang_id);
        if ($region !== '') {
            $where = array('lang_id' => $lang_id, 'key_region' => $region);
        }
        $language_values = $this->select($this->cfg['db_prefix'].'lang_keywords', '*', $where);
        $return_this = array();
        foreach ($language_values as $lang_val) {
            $return_this[$lang_val['key_region'] . '_' . $lang_val['lang_key']] = trim(addslashes($lang_val['lang_value']));
        }
        return $return_this;
    }

    /* function for getting language value for publishing
     *
     *
     */

    function langValuePublish($lang_id, $region = '') {
        if ($lang_id == '') {
            return false;
        }
        $where = array('lang_id' => $lang_id);
        if ($region !== '') {
            $where = array('lang_id' => $lang_id, 'key_region' => $region);
        }
        $language_values = $this->select($this->cfg['db_prefix'].'lang_keywords', '*', $where);
        $return_this = array();
        foreach ($language_values as $lang_val) {
            $return_this[$lang_val['key_region'] . '_' . $lang_val['lang_key']] = trim(htmlspecialchars_decode($lang_val['lang_value']));
        }
        return $return_this;
    }

    /* Languages in countries
     *
     *
     *
     */

    function languagesInCountry($countryCode) {
        $lang = array();
        $languages = $this->select($this->cfg['db_prefix'].'country', 'language_code', array('country_code' => $countryCode));
        if (count($languages) > 0) {
            foreach ($languages as $language) {
                $lang[] = $language['language_code'];
            }
        }
        return $lang;
    }

    function returnMD5($str) {
        if (!is_null($str)) {
            return md5($str);
        }
    }

    function handle_upload(&$file, $overrides = false, $time = null) {
        global $cfg;
        $upload_error_handler = 'handle_upload_error';

        if (isset($file['error']) && !is_numeric($file['error']) && $file['error'])
            return $upload_error_handler($file, $file['error']);

        // You may define your own function and pass the name in $overrides['unique_filename_callback']
        $unique_filename_callback = null;

        // $_POST['action'] must be set and its value must equal $overrides['action'] or this:
        $action = 'handle_upload';
        if (is_array($overrides))
            extract($overrides, EXTR_OVERWRITE);

        // A successful upload will pass this test. It makes no sense to override this one.
        if ($file['error'] > 0)
            return call_user_func($upload_error_handler, $file, $upload_error_strings[$file['error']]);
        $uploads = array(
            'path' => $cfg['base_path'] . 'uploads',
            'url' => $cfg['site_url'] . 'uploads'
        );

        $filename = $this->unique_filename($uploads['path'], $file['name'], $unique_filename_callback);
        // Move the file to the uploads dir
        $new_file = $uploads['path'] . "/$filename";
        if (false === @ move_uploaded_file($file['tmp_name'], $new_file)) {
            if (0 === strpos($uploads['basedir'], ABSPATH))
                $error_path = str_replace(ABSPATH, '', $uploads['basedir']) . $uploads['subdir'];
            else
                $error_path = basename($uploads['basedir']) . $uploads['subdir'];

            return $upload_error_handler($file, sprintf(__('The uploaded file could not be moved to %s.'), $error_path));
        }

        // Set correct file permissions
        $stat = stat(dirname($new_file));
        $perms = $stat['mode'] & 0000666;
        @ chmod($new_file, $perms);
        // Compute the URL
        $url = $filename;

        return $url;
    }

    function handle_upload_error(&$file, $message) {
        return array('error' => $message);
    }

    function unique_filename($dir, $filename, $unique_filename_callback = null) {
        global $cfg;
        // separate the filename into a name and extension
        $info = pathinfo($filename);
        $ext = !empty($info['extension']) ? '.' . $info['extension'] : '';
        $name = basename($filename, $ext);
        // edge case: if file is named '.ext', treat as an empty name
        if ($name === $ext)
            $name = '';

        // Increment the file number until we have a unique file to save in $dir. Use callback if supplied.
        if ($unique_filename_callback && is_callable($unique_filename_callback)) {
            $filename = call_user_func($unique_filename_callback, $dir, $name, $ext);
        } else {
            $number = '';

            // change '.ext' to lower case
            if ($ext && strtolower($ext) != $ext) {
                $ext2 = strtolower($ext);
                $filename2 = preg_replace('|' . preg_quote($ext) . '$|', $ext2, $filename);

                // check for both lower and upper case extension or image sub-sizes may be overwritten
                while (file_exists($dir . "/$filename") || file_exists($dir . "/$filename2")) {
                    $new_number = $number + 1;
                    $filename = str_replace("$number$ext", "$new_number$ext", $filename);
                    $filename2 = str_replace("$number$ext2", "$new_number$ext2", $filename2);
                    $number = $new_number;
                }
                return $filename2;
            }

            while (file_exists($dir . "/$filename")) {
                if ('' == "$number$ext")
                    $filename = $filename . ++$number . $ext;
                else
                    $filename = str_replace("$number$ext", ++$number . $ext, $filename);
            }
        }

        return $filename;
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
        unset($_SESSION['firstname']); 
        unset($_SESSION['role']);
        return TRUE;
    }

}

?>