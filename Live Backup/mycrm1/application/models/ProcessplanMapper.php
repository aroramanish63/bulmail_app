<?php

class Application_Model_ProcessplanMapper
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
            $this->setDbTable('Application_Model_DbTable_Processplan');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Processplan $processplan)
    {
        $data = array(
            'Title'   => $processplan->getTitle(),
            'ProcessId' => $processplan->getProcessId(),
            'Description' => $processplan->getDescription(),
			'Price' => $processplan->getPrice(),
			'Currency' => $processplan->getCurrency(),
			'IsActive' => $processplan->getIsActive()
        );

        if (null === ($id = $processplan->getId())) {
            unset($data['Id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('Id = ?' => $id));
        }
    }




	
    public function find($id, Application_Model_Processplan $processplan)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $processplan->setId($row->Id)
                  ->setTitle($row->Title)
                  ->setProcessId($row->ProcessId)
                  ->setDescription($row->Description)
				  ->setPrice($row->Price)
				  ->setCurrency($row->Currency)
				  ->setIsActive($row->IsActive);
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Processplan();
            $entry->setId($row->Id)
                  ->setTitle($row->Title)
                  ->setProcessId($row->ProcessId)
                  ->setDescription($row->Description)
				  ->setPrice($row->Price)
				  ->setCurrency($row->Currency)
				  ->setIsActive($row->IsActive);
            $entries[] = $entry;
        }
        return $entries;
    }


	public function findrowById($idd)
	{
		$result = $this->getDbTable()->fetchAll(
		$this->getDbTable()->select()
		->where('Id = \'' . $idd . '\'')
		);

	   return $result;
	}
		
	public function findrow($idd)
	{
		$result = $this->getDbTable()->fetchAll(
		$this->getDbTable()->select()
		->where('ProcessId = \'' . $idd . '\'')
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
		
		$where = $this->getDbTable()->delete('processplan', 'Id = ?',$idd);
        //$this->delete($where);

	}

}

