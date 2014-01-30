<?php

class Application_Model_UsersMapper
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
            $this->setDbTable('Application_Model_DbTable_Users');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Users $users)
    {
        $data = array(
            'Name'   => $users->getName(),
            'Username' => $users->getUsername(),
            'Password' => $users->getPassword(),
			'UserType' => $users->getUserType(),
			'UserTypeTT' => $users->getUserTypeTT(),
			'ReportTo' => $users->getReportTo(),
			'Center' => $users->getCenter(),
			'IsActive' => $users->getIsActive()
        );

        if (null === ($id = $users->getId())) {
            unset($data['Id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('Id = ?' => $id));
        }
    }




	
    public function find($id, Application_Model_Users $users)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $users->setId($row->Id)
                  ->setName($row->Name)
                  ->setUsername($row->Username)
                  ->setPassword($row->Password)
				  ->setUserType($row->UserType)
				  ->setUserTypeTT($row->UserTypeTT)
				  ->setReportTo($row->ReportTo)
				  ->setCenter($row->Center)
				  ->setIsActive($row->IsActive);
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Users();
            $entry->setId($row->Id)
                  ->setName($row->Name)
                  ->setUsername($row->Username)
                  ->setPassword($row->Password)
				  ->setUserType($row->UserType)
				  ->setUserTypeTT($row->UserTypeTT)
				  ->setReportTo($row->ReportTo)
				  ->setCenter($row->Center)
				  ->setIsActive($row->IsActive);
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
/*	$result = new Application_Model_Users();*/
		//$result = $this->getDbTable()->delete('Id = ?',$idd);
/*		$bugs = new Application_Model_Users();
		$result = $this->getDbTable()->fetchAll(
		$this->getDbTable()->select()
		->where('Id = \'' . $idd . '\'')
		);
		$result->delete();*/
		
		$where = $this->getDbTable()->delete('users', 'Id = ?',$idd);
        //$this->delete($where);

	}

}

