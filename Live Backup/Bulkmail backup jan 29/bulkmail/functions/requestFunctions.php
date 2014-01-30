<?php

/* 
 * Created By: Manish Arora
 * 
 * Purpose: For Request Functions.
 */
if ( ! defined('BASE_PATH')) exit('No direct script access allowed');

include CLASSES_PATH.'geo/redirection.php';
            
class requestFunctions extends AllFunctions{
        
    private $siteTable = 'tbl_sites';
    private $emailTable = 'tbl_email';
    
    public function jsonDecode($content = ''){
        if(!is_null($content) && ($content != '')){
            return json_decode($content);
        }
    }
    
    public function chekAccess($siteId = '',$secret = ''){
        if(($siteId != '') && ($secret != '')){
            $where = array(
                'site_id'=>$this->base64decode($siteId),
                'secret_key'=>$this->base64decode($secret)
            );
            if($this->get_num_rows($this->siteTable,'*',$where) > 0){
                return true;
            }
            else
                return false;
        }
    }
    
    public function jsonEncode($content = ''){
        if(!is_null($content) && ($content != '')){
            return json_encode($content);
        }
    }
    
    public function addRequests($content = array()){
        if(is_object($content) && !empty($content)){
            $fields = array(
                'email_id'=>$content->email,
                'email_user'=>$content->name,
                'site_id'=>$this->detectSite($content->site_id, $content->secret_key),
                'client_type_id'=> (($this->detectClient($content->ip_addr) != '') && ($this->detectClient($content->ip_addr) == 'IN' ))? 4 : 2,
                'phone'=>$content->phone,
                'add_date'=>date('Ymdhis'),
                'active'=>1
            );
            $this->requestBackup($content);
            $result = $this->insert($this->emailTable, $fields);
        }        
        
        return isset($result['error'])?$result['error']:'success';        
    }
    
    public function detectClient($ipaddr = ''){
        if($ipaddr != ''){
                $ipclass = new redirection();
                $country_code = $ipclass->getCountryCodeByIP($ipaddr);
                return $country_code;               
        }
    } 
    
    
    // function for detect site id for saving details.
    
    public function detectSite($siteId = '',$secret = ''){
        if(($siteId != '') && ($secret != '')){
            $where = array(
                'site_id'=>$this->base64decode($siteId),
                'secret_key'=>$this->base64decode($secret)
            );
            $result = $this->select($this->siteTable,'id',$where);
            if(is_array($result)){
                return $result[0]['id'];
            }
        }
    } 
    
   // function for testing save details for backup
    
    public function requestBackup($request){
        if(is_object($request) && !empty($request)){
            $fields = array(
                'site_id'=>$this->detectSite($request->site_id, $request->secret_key),
                'email_id'=>$request->email,
                'email_user'=>$request->name, 
                'ip_addr'=>$request->ip_addr, 
                'client_type_id'=> (($this->detectClient($request->ip_addr) != '') && ($this->detectClient($request->ip_addr) == 'IN' ))? 4 : 2,
                'country_code'=>$this->detectClient($request->ip_addr), 
                'country_name'=>$this->detectClientCountry($request->ip_addr), 
                'site_secret_id'=>$this->base64decode($request->site_id),
                'site_secret_key'=>$this->base64decode($request->secret_key),
                'add_date'=>date('Ymdhis')
            );
                $result = $this->insert($this->emailTable.'_request', $fields);
        }
    }
    
    public function detectClientCountry($ipaddr = ''){
        if($ipaddr != ''){
                $ipclass = new redirection();
                $country_name = $ipclass->getCountryNameByIP($ipaddr);
                return $country_name;               
        }
    }
}

