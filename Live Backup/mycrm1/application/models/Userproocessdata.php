<?php

class Application_Model_Userproocessdata
{

	protected $_Id;
	protected $_Title;
	protected $_Firstname;
	protected $_Middlename;
	protected $_Lastname;
	protected $_Phonenumber;
	protected $_Email;
	protected $_Othersdetails;


   

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
            throw new Exception('Invalid Userproocessdata property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid Userproocessdata property');
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
	
	    public function setFirstname($Firstname)
    {
        $this->_Firstname = $Firstname;
        return $this;
    }

    public function getFirstname()
    {
        return $this->_Firstname;
    }
	
	
	    public function setMiddlename($Middlename)
    {
        $this->_Middlename = $Middlename;
        return $this;
    }

    public function getMiddlename()
    {
        return $this->_Middlename;
    }
	
	
	    public function setLastname($Lastname)
    {
        $this->_Lastname = $Lastname;
        return $this;
    }

    public function getLastname()
    {
        return $this->_Lastname;
    }
	
	
	    public function setPhonenumber($Phonenumber)
    {
        $this->_Phonenumber = $Phonenumber;
        return $this;
    }

    public function getPhonenumber()
    {
        return $this->_Phonenumber;
    }
	
   public function setEmail($Email)
    {
        $this->_Email = $Email;
        return $this;
    }

    public function getEmail()
    {
        return $this->_Email;
    }
	
	   public function setOthersdetails($Othersdetails)
    {
        $this->_Othersdetails = $Othersdetails;
        return $this;
    }

    public function getOthersdetails()
    {
        return $this->_Othersdetails;
    }
	
 }   

