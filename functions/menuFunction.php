<?php
if ( ! defined('BASE_PATH')) exit('No direct script access allowed');
class menuFunction{
    
    public $_menuarray = array(         
                    'dashboard' => array(
                    'text'=>'Dashboard',  
                    'url'=>'?page=home'
                    ),
                'sites'=>array(
                        'text'=>'Sites',  
                        'url'=>'?page=sites',
                    ),  
                'emails'=> array('text'=>'Emails', 'url'=>'?page=emails','sub'=>array(
                                        'importemail'=>array('text'=>'Import Email', 'url'=>'?page=importemail'),
                                        'exportemail'=>array('text'=>'Export Email', 'url'=>'?page=exportemail'),
                                        'sendmail'=>array('text'=>'Send Email', 'url'=>'?page=sendmail'),
                                    )),
                'client'   => array('text'=>'Client', 'url'=>'?page=client'),       
            );
    public $_parent;
    public $_submenuarray = array();
    public $page;    
    public $current = '';
    
    public $sub;
    public $parent = '';
            
    function __construct($current = '') {
        if($current != ''){
            $this->page = $current;
        }
        $this->generateMainmenu();
    }
    
    function generateMainmenu(){
        $items = $this->_menuarray;
        $menu = '<ul id="example" class="sf-menu">';
        foreach ($items as $item){           
           $menu .= '<li><a href="'.$item['url'].'">'.$item['text'].'</a>';
             if(isset($item['sub']) && is_array($item['sub'])){
                 $this->_submenuarray = $item['sub'];
                 $menu .= $this->generateSubmenu();
              }
              $menu .= '</li>';
        }
        $menu .= '</ul>';
        
        echo $menu;
    }
    
    function generateSubmenu(){
        if($this->_submenuarray != ''){  
             $sitems = $this->_submenuarray; 
             $smenu = '';
            $smenu = '<ul>';
            foreach ($sitems as $sitem){
                $smenu .= '<li><a href="'.$sitem['url'].'">'.$sitem['text'].'</a></li>';
            }
            $smenu .= '</ul>';
            return $smenu;
        }
    }
}
