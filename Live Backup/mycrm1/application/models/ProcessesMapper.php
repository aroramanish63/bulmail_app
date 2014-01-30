<?php


class Application_Model_ProcessesMapper
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
            $this->setDbTable('Application_Model_DbTable_Processes');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Processes $Processes)
    {
        $data = array(
            'Name'   => $Processes->getName(),
            'Description' => $Processes->getDescription(),
            'ProcessDate' => $Processes->getProcessDate(),
			'IsActive' => $Processes->getIsActive()
        );

        if (null === ($id = $Processes->getId())) {
            unset($data['Id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('Id = ?' => $id));
        }
    }




	
    public function find($id, Application_Model_Processes $Processes)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $Processes->setId($row->Id)
                  ->setName($row->Name)
                  ->setDescription($row->Description)
                  ->setProcessDate($row->ProcessDate)
				  ->setIsActive($row->IsActive);
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Processes();
            $entry->setId($row->Id)
                  ->setName($row->Name)
                  ->setDescription($row->Description)
                  ->setProcessDate($row->ProcessDate)
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
/*	$result = new Application_Model_Processes();*/
		//$result = $this->getDbTable()->delete('Id = ?',$idd);
/*		$bugs = new Application_Model_Processes();
		$result = $this->getDbTable()->fetchAll(
		$this->getDbTable()->select()
		->where('Id = \'' . $idd . '\'')
		);
		$result->delete();*/
		
		$where = $this->getDbTable()->delete('Processes', 'Id = ?',$idd);
        //$this->delete($where);

	}

}

