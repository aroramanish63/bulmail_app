<?php

class Application_Model_Userprocess
{
	protected $_Id;
	protected $_UserId;
	protected $_ProcessId;
	protected $_IsActive;

   
    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

   public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid Processes property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid Processes property');
        }
        return $this->$method();
    }
	
	    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }
	
    public function setId($Id)
    {
        $this->_Id = $Id;
        return $this;
    }

    public function getId()
    {
        return $this->_Id;
    }
	
	
        public function setUserId($UserId)
    {
        $this->_UserId = $UserId;
        return $this;
    }

    public function getUserId()
    {
        return $this->_UserId;
    }
	
	    public function setProcessId($ProcessId)
    {
        $this->_ProcessId = $ProcessId;
        return $this;
    }

    public function getProcessId()
    {
        return $this->_ProcessId;
    }
	
	
	    public function setIsActive($IsActive)
    {
        $this->_IsActive = $IsActive;
        return $this;
    }

    public function getIsActive()
    {
        return $this->_IsActive;
    }
 }   

