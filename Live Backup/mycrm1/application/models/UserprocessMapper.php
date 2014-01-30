<?php


class Application_Model_UserprocessMapper
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
            $this->setDbTable('Application_Model_DbTable_Userprocess');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Userprocess $Userprocess)
    {
        $data = array(
            'UserId'   => $Userprocess->getUserId(),
            'ProcessId' => $Userprocess->getProcessId(),
			'IsActive' => $Userprocess->getIsActive()
        );

        if (null === ($id = $Userprocess->getId())) {
            unset($data['Id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('Id = ?' => $id));
        }
    }




	
    public function find($id, Application_Model_Userprocess $Userprocess)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $Userprocess->setId($row->Id)
                  ->setUserId($row->UserId)
                  ->setProcessId($row->ProcessId)
				  ->setIsActive($row->IsActive);
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Userprocess();
            $entry->setId($row->Id)
                  ->setUserId($row->UserId)
                  ->setProcessId($row->ProcessId)
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
/*	$result = new Application_Model_Userprocess();*/
		//$result = $this->getDbTable()->delete('Id = ?',$idd);
/*		$bugs = new Application_Model_Userprocess();
		$result = $this->getDbTable()->fetchAll(
		$this->getDbTable()->select()
		->where('Id = \'' . $idd . '\'')
		);
		$result->delete();*/
		
		$where = $this->getDbTable()->delete('Userprocess', 'Id = ?',$idd);
        //$this->delete($where);

	}

}

