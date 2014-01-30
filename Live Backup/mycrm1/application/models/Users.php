<?php

class Application_Model_Users
{
	protected $_Id;
	protected $_Name;
	protected $_Username;
	protected $_Password;
	protected $_UserType;
	protected $_UserTypeTT;
	protected $_ReportTo;
	protected $_Center;
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
	
	
        public function setName($Name)
    {
        $this->_Name = $Name;
        return $this;
    }

    public function getName()
    {
        return $this->_Name;
    }
	
	    public function setUsername($Username)
    {
        $this->_Username = $Username;
        return $this;
    }

    public function getUsername()
    {
        return $this->_Username;
    }
	
	
	    public function setPassword($Password)
    {
        $this->_Password = $Password;
        return $this;
    }

    public function getPassword()
    {
        return $this->_Password;
    }
	
	
	    public function setUserType($UserType)
    {
        $this->_UserType = $UserType;
        return $this;
    }

    public function getUserType()
    {
        return $this->_UserType;
    }
	
	public function setUserTypeTT($UserTypeTT)
    {
        $this->_UserTypeTT = $UserTypeTT;
        return $this;
    }

    public function getUserTypeTT()
    {
        return $this->_UserTypeTT;
    }
	
	public function setReportTo($ReportTo)
    {
        $this->_ReportTo = $ReportTo;
        return $this;
    }

    public function getReportTo()
    {
        return $this->_ReportTo;
    }
	
		public function setCenter($Center)
    {
        $this->_Center = $Center;
        return $this;
    }

    public function getCenter()
    {
        return $this->_Center;
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

