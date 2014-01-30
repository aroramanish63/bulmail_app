<?php

/**
 * Index Bootstrap
 *
 * @author        Nishith
 * @package       Index Module
 *
 */
class Index_Bootstrap extends Zend_Application_Module_Bootstrap {

    protected function _initAutoload() {
        $moduleLoader = new Zend_Application_Module_Autoloader(array(
                    'namespace' => 'Index_',
                    'basePath' => APPLICATION_PATH . '/modules/index'));
        
        return $moduleLoader;
    }

    protected function _initConfig() {
        # get config
        $config = new Zend_Config_Ini( dirname(__FILE__) .
                DIRECTORY_SEPARATOR . 'config' .
                DIRECTORY_SEPARATOR . 'application.ini', APPLICATION_ENV);

        # get registery
        $this->_registry = Zend_Registry::getInstance();

        # save config to registry
        $this->_registry->config->home = $config;
    }


}

