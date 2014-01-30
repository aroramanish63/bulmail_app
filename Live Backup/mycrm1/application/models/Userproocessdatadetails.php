<?php

class Application_Model_Userproocessdatadetails
{

	protected $_Id;
	protected $_Customerid;
	protected $_Processid;
	protected $_Calltype;
	protected $_Disposition;
	protected $_Planid;
	protected $_Salesamount;
	protected $_Issues;
	protected $_Solutions;
	protected $_Orderid;
	protected $_Casenumber;
	protected $_Teamviewerid;
	protected $_Userid;
	protected $_Calldate;
	protected $_Starttime;
	protected $_Endtime;  
	protected $_Salesagent;
	protected $_PaymentGateway;
	protected $_GatewayRefernceNumber;
	protected $_Bound;


   

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
            throw new Exception('Invalid Userproocessdatadetails property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid Userproocessdatadetails property');
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
	
	

	public function setCustomerid($Customerid)
	{
		$this->_Customerid = $Customerid;
		return $this;
	}
	
	public function getCustomerid()
	{
		return $this->_Customerid;
	}
	  
	
	   public function setProcessid($Processid)
    {
        $this->_Processid = $Processid;
        return $this;
    }

    public function getProcessid()
    {
        return $this->_Processid;
    }
	
	public function setCalltype($Calltype)
    {
        $this->_Calltype = $Calltype;
        return $this;
    }

    public function getCalltype()
    {
        return $this->_Calltype;
    }
	
	public function setDisposition($Disposition)
    {
        $this->_Disposition = $Disposition;
        return $this;
    }

    public function getDisposition()
    {
        return $this->_Disposition;
    }
	
	public function setPlanid($Planid)
	{
	$this->_Planid = $Planid;
	return $this;
	}
	
	public function getPlanid()
	{
	return $this->_Planid;
	}
	
	
	public function setSalesamount($Salesamount)
    {
        $this->_Salesamount = $Salesamount;
        return $this;
    }

    public function getSalesamount()
    {
        return $this->_Salesamount;
    }
	
	
	public function setIssues($Issues)
    {
        $this->_Issues = $Issues;
        return $this;
    }

    public function getIssues()
    {
        return $this->_Issues;
    }
	
   public function setSolutions($Solutions)
    {
        $this->_Solutions = $Solutions;
        return $this;
    }

    public function getSolutions()
    {
        return $this->_Solutions;
    }
	
	   public function setOrderid($Orderid)
    {
        $this->_Orderid = $Orderid;
        return $this;
    }

    public function getOrderid()
    {
        return $this->_Orderid;
    }
	
   public function setCasenumber($Casenumber)
    {
        $this->_Casenumber = $Casenumber;
        return $this;
    }

    public function getCasenumber()
    {
        return $this->_Casenumber;
    }
	
	public function setTeamviewerid($Teamviewerid)
    {
        $this->_Teamviewerid = $Teamviewerid;
        return $this;
    }

    public function getTeamviewerid()
    {
        return $this->_Teamviewerid;
    }
	
	public function setUserid($Userid)
    {
        $this->_Userid = $Userid;
        return $this;
    }

    public function getUserid()
    {
        return $this->_Userid;
    }
	
		public function setCalldate($Calldate)
    {
        $this->_Calldate = $Calldate;
        return $this;
    }

    public function getCalldate()
    {
        return $this->_Calldate;
    }
	
	public function setStarttime($Starttime)
    {
        $this->_Starttime = $Starttime;
        return $this;
    }

    public function getStarttime()
    {
        return $this->_Starttime;
    }
	
		public function setEndtime($Endtime)
    {
        $this->_Endtime = $Endtime;
        return $this;
    }

    public function getEndtime()
    {
        return $this->_Endtime;
    }
	
	
  public function setSalesagent($Salesagent)
    {
        $this->_Salesagent = $Salesagent;
        return $this;
    }

  public function getSalesagent()
    {
        return $this->_Salesagent;
    }
	
	  public function setPaymentGateway($PaymentGateway)
    {
        $this->_PaymentGateway = $PaymentGateway;
        return $this;
    }

  public function getPaymentGateway()
    {
        return $this->_PaymentGateway;
    }
	
		  public function setGatewayRefernceNumber($GatewayRefernceNumber)
    {
        $this->_GatewayRefernceNumber = $GatewayRefernceNumber;
        return $this;
    }

  public function getGatewayRefernceNumber()
    {
        return $this->_GatewayRefernceNumber;
    }
	
	
			  public function setBound($Bound)
    {
        $this->_Bound = $Bound;
        return $this;
    }

  public function getBound()
    {
        return $this->_Bound;
    }
	
 }   

