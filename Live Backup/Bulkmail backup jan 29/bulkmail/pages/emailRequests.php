<?php
/* 
 * Created By: Manish Arora
 * Purpose: Email Requests.
 */
if ( ! defined('BASE_PATH')) exit('No direct script access allowed');

if(($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_POST['content']) && !empty($_POST['content']))){
    
    global $siteConfig;
    
    $siteConfig->load_class('requestFunctions'); 
    $requestFun = new requestFunctions();

    $content = $requestFun->base64decode($_POST['content']);
    $decodedContent = $requestFun->jsonDecode($content);
    
    $result = array();
    
    if(is_object($decodedContent) && ($decodedContent != '') && ($decodedContent->site_id != '') && ($decodedContent->secret_key != '')){
        if($requestFun->chekAccess($decodedContent->site_id, $decodedContent->secret_key)){
            $added = $requestFun->addRequests($decodedContent); 
            if($added != 'success'){
               $result['error'] = 'Details not added.'; 
            }
            else
                $result['success'] = 'Successfully added';
        }
        else
            $result['error'] = 'App id or secret key not valid.';
    }
    else
        $result['error'] = 'App id or secret key not valid.';
    
    echo $requestFun->jsonEncode($result);
}