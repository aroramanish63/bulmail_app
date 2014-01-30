<?php
include_once("includes/config.php"); //config file stores all configuration
    if ( ! defined('BASE_PATH')) exit('No direct script access allowed');    
        $siteConfig->check_login();
        $siteConfig->load_class('emailFunctions');  
    $emailFun = new emailFunctions();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['saveButton']) && !empty($_POST['saveButton'])){  
        $result = $emailFun->exportToExcel();
        if ($result == 'success') {
            $siteConfig->setAlertMessage(array('err_type' => 'success', 'msg' => 'successfully saved'));
        }
        else{
            $siteConfig->setAlertMessage(array('err_type' => 'error', 'msg' => $result));
        }    
     }
}