<?php

class app{
    private $siteid;
    private $secretkey;
    private $postdata = array(
        'email'=>'',
        'name'=>'',
        'ip_addr'=>'',
        'phone'=>''
    );
    

    private $errors = array(
        'siteId' => 'SiteId Invalid.',
        'secretKey' => 'Secret Key Invalid',
        'curl' =>'Curl not working.',
        'postdata'=>'Post Data array is empty.',        
    );


    public function __construct($config) {
         $this->setAppId($config['site_id']);
         $this->setAppSecret($config['secret_key']);
    }
    
    public function setAppId($siteId){
        if($siteId != ''){
            $this->siteid = $siteId;
            return $this;
        }
    }
    
    public function setAppSecret($secretkey){
        if($secretkey != ''){
            $this->secretkey = $secretkey;
            return $this;
        }
    }
    
    public function curlRequest($data){
        $this->setFields($data);
        $this->postdata['site_id'] = $this->siteid;
        $this->postdata['secret_key'] = $this->secretkey;
        $this->curlSend();
    }
    
    protected function curlSend(){
        if(is_array($this->postdata) && ($this->postdata['site_id'] == $this->siteid) && ($this->postdata['secret_key'] == $this->secretkey)){                                                
            $data = $this->encode($this->postdata); 
            $ch = curl_init('http://121.242.207.115/bulkmail/index.php');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, array('content'=>$data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
        }
        else{
            echo $this->setError();
        }
    }
    
    protected function setError(){
        if($this->siteid == ''){
            return $this->errors['siteId'];
        }
       
        if($this->secretkey == ''){
            return $this->errors['secretKey'];
        }
        
        if($this->postdata['site_id'] == ''){
            return $this->errors['siteId'];
        }
        
        if($this->postdata['secret_key'] == ''){
            return $this->errors['secretKey'];
        }
        
        if($this->postdata == ''){
            return $this->errors['postdata'];
        }
    }
    
    private function encode(){
        return base64_encode(json_encode($this->postdata));
    }
    
    private function setFields($data){
        $result = false;
       if(is_array($data) && ($data != '')){           
           foreach($data as $fieldval){
               if($this->postdata['email'] == ''){
                   $this->setEmail($fieldval);
                   $result = true;
                }
                if($this->postdata['name'] == ''){
                    $this->setName($fieldval);
                    $result = true;
                }
                if($this->postdata['ip_addr'] == ''){
                    $this->get_client_ip();
                    $result = true;
                }
                if($this->postdata['phone'] == ''){
                    $this->setPhone($fieldval);
                    $result = true;
                }
            }            
            return $result;
        }
    }
    
    private function setPhone($str){
        if(is_numeric($str)){
            $this->postdata['phone'] = $str;
        }
    }
    
    private function setEmail($str=''){
        if($str != '' && filter_var($str, FILTER_VALIDATE_EMAIL)){            
               $this->postdata['email'] = filter_var($str, FILTER_VALIDATE_EMAIL);
        }
    }
    
    private function setName($str=''){
        if($str != '' && filter_var($str, FILTER_SANITIZE_STRING)){            
               $this->postdata['name'] = filter_var($str, FILTER_SANITIZE_STRING);
        }
    }
           
    private function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
			
        $this->postdata['ip_addr'] = $ipaddress; 
	}

}

/*
 * Put this below code in any registartion or any contact us form file.
 */
/*
 * 
 * include 'Path to App File';                 
 *          $siteConnect = new app(
 *                      array(
 *                          'site_id'=>'SITE ID PUT HERE',
 *                          'secret_key'=>'SECRET KEY PUT HERE'
 *                          )
 *          );
 *      $siteConnect->curlRequest($_POST);
 */
/*
 * Code End Here........!!!!
 */