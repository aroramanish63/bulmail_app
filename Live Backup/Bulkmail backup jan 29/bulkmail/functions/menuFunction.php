<?php
if ( ! defined('BASE_PATH')) exit('No direct script access allowed');
class menuFunction{
    
    public $_menuarray = array(         
                'dashboard' => array(
                    'text'=>'Dashboard',  
                    'url'=>'?page=home',
                    'sub'=>''
                    ),
                'categories'  => array(
                    'text'=>'Categories',  
                    'url'=>'?page=categories',
//                    'sub'=>array(
//                           'categories'=>array('text'=>'Categories',  'url'=>'?page=categories','parent'=>'categories'),
//                           'subcategory'=>array('text'=>'Sub Categories',  'url'=>'?page=subcategory','parent'=>'categories'),
//                           'sites'=>array('text'=>'Sites',  'url'=>'?page=sites','parent'=>'categories'), 
//                        )
                    ),
                'files'     => array('text'=>'Emails', 'url'=>'?page=emails','sub'=>'','parent'=>'files'),
                'profile'   => array('text'=>'Profile', 'url'=>'?page=profile','sub'=>'','parent'=>'profile'),
                'settings'  => array('text'=>'Settings', 'url'=>'?page=settings','sub'=>'','parent'=>'settings'),         
            );
    public $_parent;
    public $_submenuarray = array(               
                    'maincategory'=>array('text'=>'Categories',  'url'=>'?page=categories', 'parent'=>'categories'),
                    'subcategory'=>array('text'=>'Sub Categories',  'url'=>'?page=subcategory', 'parent'=>'categories'),
                    'sites'=>array('text'=>'Sites',  'url'=>'?page=sites', 'parent'=>'categories'),
            );
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
        $menu = '<ul id="nav">';
        foreach ($items as $item){
            if($this->page != ''){
                 if((substr(strstr($item['url'], '='),1) == $this->page)){
                     $this->current = 'id="current"';
//                     if($item['sub'] != '' && is_array($item['sub'])){
//                            $this->_submenuarray = $item['sub'];
//                            $this->parent = $this->page;
//                      }
//                 }
//                 else if($item['sub'] != '' && is_array($item['sub'])){
//                     $this->_submenuarray = $item['sub'];
//                 }
                 }
                 else
                     $this->current = '';                                  
            }
           $menu .= '<li '.$this->current.'><a href="'.$item['url'].'">'.$item['text'].'</a></li>';
        }
        $menu .= '</ul>';
        
        echo $menu;
    }
    
    function generateSubmenu(){
        if($this->_submenuarray != ''){  
             $sitems = $this->_submenuarray;             
            $smenu = '<ul>';
            
        $mainmenu = array_keys($this->_menuarray);
        
            foreach ($sitems as $sitem){
                if(in_array($sitem['parent'], $mainmenu,true)){
                    $this->current = 'id="current"';
                }
                $smenu .= '<li><a href="'.$sitem['url'].'">'.$sitem['text'].'</a></li>';
            }
            $smenu .= '</ul>';
//            unset($this->_submenuarray);
            echo $smenu;
        }
    }
}
