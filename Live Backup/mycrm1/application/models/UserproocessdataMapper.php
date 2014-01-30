<?php

class Application_Model_UserproocessdataMapper
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
            $this->setDbTable('Application_Model_DbTable_Userproocessdata');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Userproocessdata $Userproocessdata)
    {
        $data = array(
			'Title' => $Userproocessdata->getTitle(),
			'Firstname' => $Userproocessdata->getFirstname(),
			'Middlename' => $Userproocessdata->getMiddlename(),
			'Lastname' => $Userproocessdata->getLastname(),
			'Phonenumber' => $Userproocessdata->getPhonenumber(),
			'Email' => $Userproocessdata->getEmail(),
			'Othersdetails' => $Userproocessdata->getOthersdetails()
        );

        if (null === ($id = $Userproocessdata->getId())) {
            unset($data['Id']);
         $lastinsertedid = $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('Id = ?' => $id));
        }
		
		if($Userproocessdata->getId()!="") { return $Userproocessdata->getId(); } else { return $lastinsertedid; }
    }




	
    public function find($id, Application_Model_Userproocessdata $Userproocessdata)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
       $Userproocessdata->setId($row->Id)
						->setTitle($row->Title)
						->setFirstname($row->Firstname)
						->setMiddlename($row->Middlename)
						->setLastname($row->Lastname)
						->setPhonenumber($row->Phonenumber)
						->setEmail($row->Email)
						->setOthersdetails($row->Othersdetails);
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Userproocessdata();
              $entry->setId($row->Id)
					->setTitle($row->Title)
					->setFirstname($row->Firstname)
					->setMiddlename($row->Middlename)
					->setLastname($row->Lastname)
					->setPhonenumber($row->Phonenumber)
					->setEmail($row->Email)
					->setOthersdetails($row->Othersdetails);
					
            $entries[] = $entry;
        }
        return $entries;
    }


	public function searchrow($idd,$type)
	{
	 if($type==1)
	  {
		$result = $this->getDbTable()->fetchAll(
		$this->getDbTable()->select()
		->where('Email = ?',$idd)
		);
       }
	   elseif($type==2)
	    {
		  		$result = $this->getDbTable()->fetchAll(
		$this->getDbTable()->select()
		->where('Phonenumber = ?',$idd)
		);
		}
	   return $result[0];
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
/*	$result = new Application_Model_Userproocessdata();*/
		//$result = $this->getDbTable()->delete('Id = ?',$idd);
/*		$bugs = new Application_Model_Userproocessdata();
		$result = $this->getDbTable()->fetchAll(
		$this->getDbTable()->select()
		->where('Id = \'' . $idd . '\'')
		);
		$result->delete();*/
		
		$where = $this->getDbTable()->delete('Userproocessdata', 'Id = ?',$idd);
        //$this->delete($where);

	}

}

