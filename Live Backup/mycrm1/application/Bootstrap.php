<?php

/**
 * Application Bootstrap
 *
 * @author          Eddie Jaoude
 * @package       Default Module
 *
 */

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    /**
     * Doctype
     *
     * @param           void
     * @return          void
     *
     */
	 
    protected function _initDoctype() {
        $doctypeHelper = new Zend_View_Helper_Doctype();
        $doctypeHelper->doctype('XHTML1_STRICT');
		
		
		/*New Addition*/
		 $this->bootstrap('view');
		 $view = $this->getResource('view');
          $view->doctype('XHTML1_STRICT');
		       $view->setEncoding('UTF-8');
$view->headMeta()->appendHttpEquiv('Content-Type', 'text/html;charset=utf-8');
		/*For Multiple Layouts Start*/
		$layout = new Zend_Layout(APPLICATION_PATH . '/layouts/scripts');
		   
    }

 

   
    protected function _initConfig() {
        # get config
        $config = new Zend_Config_Ini(APPLICATION_PATH . 
                DIRECTORY_SEPARATOR . 'configs' .
                DIRECTORY_SEPARATOR . 'application.ini', APPLICATION_ENV);

        # get registery
        $this->_registry = Zend_Registry::getInstance();

        # save new database adapter to registry
        $this->_registry->config = new stdClass();
        $this->_registry->config->application = $config;
    }



   
 
	}