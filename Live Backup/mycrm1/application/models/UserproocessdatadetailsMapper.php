<?php

class Application_Model_UserproocessdatadetailsMapper
{
    protected $_dbTable;

    public function setDbTable($dbTable) 
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Userproocessdatadetails');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Userproocessdatadetails $Userproocessdatadetails)
    {
        $data = array(
			'Customerid' => $Userproocessdatadetails->getCustomerid(),
			'Processid' => $Userproocessdatadetails->getProcessid(),
			'Calltype' => $Userproocessdatadetails->getCalltype(),
			'Disposition' => $Userproocessdatadetails->getDisposition(),
			'Planid' => $Userproocessdatadetails->getPlanid(),
			'Salesamount' => $Userproocessdatadetails->getSalesamount(),
			'Issues' => $Userproocessdatadetails->getIssues(),
			'Solutions' => $Userproocessdatadetails->getSolutions(),
			'Orderid' => $Userproocessdatadetails->getOrderid(),
			'Casenumber' => $Userproocessdatadetails->getCasenumber(),
			'Teamviewerid' => $Userproocessdatadetails->getTeamviewerid(),
			'Userid' => $Userproocessdatadetails->getUserid(),
			'Calldate' => $Userproocessdatadetails->getCalldate(),
			'Starttime' => $Userproocessdatadetails->getStarttime(),
			'Endtime' => $Userproocessdatadetails->getEndtime(),
			'Salesagent' => $Userproocessdatadetails->getSalesagent(),
			'PaymentGateway' => $Userproocessdatadetails->getPaymentGateway(),
			'GatewayRefernceNumber' => $Userproocessdatadetails->getGatewayRefernceNumber(),
			'Bound' => $Userproocessdatadetails->getBound()
        );

        if (null === ($id = $Userproocessdatadetails->getId())) {
            unset($data['Id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('Id = ?' => $id));
        }
    }




	
    public function find($id, Application_Model_Userproocessdatadetails $Userproocessdatadetails)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
       $Userproocessdatadetails->setId($row->Id)
						->setCustomerid($row->Customerid)
						->setProcessid($row->Processid)
						->setCalltype($row->Calltype)
						->setDisposition($row->Disposition)
						->setPlanid($row->Planid)
						->setSalesamount($row->Salesamount)
						->setIssues($row->Issues)
						->setSolutions($row->Solutions)
						->setOrderid($row->Orderid)
						->setCasenumber($row->Casenumber)
						->setTeamviewerid($row->Teamviewerid)
						->setUserid($row->Userid)
						->setCalldate($row->Calldate)
						->setStarttime($row->Starttime)
						->setEndtime($row->Endtime)
						->setSalesagent($row->Salesagent)
						->setPaymentGateway($row->PaymentGateway)
						->setGatewayRefernceNumber($row->GatewayRefernceNumber)
						->setBound($row->Bound);
						
						//GatewayRefernceNumber
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Userproocessdatadetails();
              $entry->setId($row->Id)
					->setCustomerid($row->Customerid)
					->setProcessid($row->Processid)
					->setCalltype($row->Calltype)
					->setDisposition($row->Disposition)
					->setPlanid($row->Planid)
					->setSalesamount($row->Salesamount)
					->setIssues($row->Issues)
					->setSolutions($row->Solutions)
					->setOrderid($row->Orderid)
					->setCasenumber($row->Casenumber)
					->setTeamviewerid($row->Teamviewerid)
					->setUserid($row->Userid)
					->setCalldate($row->Calldate)
					->setStarttime($row->Starttime)
					->setEndtime($row->Endtime)
					->setSalesagent($row->Salesagent)
					->setPaymentGateway($row->PaymentGateway)
					->setGatewayRefernceNumber($row->GatewayRefernceNumber)
					->setBound($row->Bound);
            $entries[] = $entry;
        }
        return $entries;
    }


	
	public function findrow($idd)
	{
		$result = $this->getDbTable()->fetchAll(
		$this->getDbTable()->select()
		->where('Id = \'' . $idd . '\'')
		);

	   return $result;
	}
	
		public function delete($idd)
	{
/*	$result = new Application_Model_Userproocessdatadetails();*/
		//$result = $this->getDbTable()->delete('Id = ?',$idd);
/*		$bugs = new Application_Model_Userproocessdatadetails();
		$result = $this->getDbTable()->fetchAll(
		$this->getDbTable()->select()
		->where('Id = \'' . $idd . '\'')
		);
		$result->delete();*/
		
		$where = $this->getDbTable()->delete('Userproocessdata', 'Id = ?',$idd);
        //$this->delete($where);

	}

}

