<?php

/* Created By:- Manish Arora
   Purpose:- Ajax Function
   Date:-   Sept-18,2013  
 */

if(isset($_REQUEST['request']) && !empty($_REQUEST['request'])){
    $val = $_REQUEST['request'];
    switch ($val){
        case 'removeImage':
            removeImage();
            break;
    }
    
}

function includeConfig(){
    
    $cfg['base_path']		='C:/xampp/htdocs/cloudoye/adminpanel/';
    $cfg['site_url']		='http://localhost/cloudoye/adminpanel/';
    $cfg['image_url']		=$cfg['site_url'].'img/';
    $cfg['script_url']		=$cfg['site_url'].'js/';
    $cfg['style_url']		=$cfg['site_url'].'css/';
    $cfg['upload_url']		='http://localhost/cloudoye/uploads';
    $cfg['website_name']            ='Cloudoye';
    $cfg['admin_email']		='admin@test.com';
    $cfg['db_host']			='localhost';
    $cfg['db_port']			='';
    $cfg['db_name']			='cloudoye';
    $cfg['db_user']			='root';
    $cfg['db_pass']			='';
    $cfg['random_key']		='qSRcVS6DrTzrPvr';

    require_once($cfg['base_path']."classes/ajaxMysqlClass.php");
    $siteConfig = new Db($cfg['db_host'],$cfg['db_user'],$cfg['db_pass'],$cfg['db_name']);    
    return $siteConfig;
}

function removeImage(){
    if(isset($_REQUEST['imid']) && !empty($_REQUEST['imid'])){
        $config = includeConfig();
        
        $where = array(
            'id'=>$_REQUEST['imid']
        );
        if($config->delete($this->cfg['db_prefix'].'slider', $where))
               echo 'true';
        else
            echo 'false';
    }
    else
        echo 'false';
}

?>
