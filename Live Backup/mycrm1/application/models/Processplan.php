<?php

class Application_Model_Processplan
{
	protected $_Id;
	protected $_Title;
	protected $_ProcessId;
	protected $_Description;
	protected $_Price;
	protected $_Currency;
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
            throw new Exception('Invalid users property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid users property');
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
	
	
    public function setTitle($Title)
    {
        $this->_Title = $Title;
        return $this;
    }

    public function getTitle()
    {
        return $this->_Title;
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
	
	
	    public function setDescription($Description)
    {
        $this->_Description = $Description;
        return $this;
    }

    public function getDescription()
    {
        return $this->_Description;
    }
	
	
	    public function setPrice($Price)
    {
        $this->_Price = $Price;
        return $this;
    }

    public function getPrice()
    {
        return $this->_Price;
    }
	
	
	public function setCurrency($Currency)
    {
        $this->_Currency = $Currency;
        return $this;
    }

    public function getCurrency()
    {
        return $this->_Currency;
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

