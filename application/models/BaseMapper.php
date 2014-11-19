<?php

abstract class Application_Model_BaseMapper {
    protected $_dbTable='';

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
        if (is_string($this->_dbTable)) {
            $this->setDbTable($this->_dbTable);
        }
        return $this->_dbTable;
    }

    public function getAdapter()
    {
        return $this->getDbTable()->getAdapter();
    }
    
    public function beginTransaction()
    {
    	$this->getAdapter()->beginTransaction();
    }
    
	public function commitTransaction()
    {
    	$this->getAdapter()->commit();
    }

	public function rollbackTransaction()
    {
    	$this->getAdapter()->rollBack();
    }

    public function quoteInto($text, $value, $type = null, $count = null)
    {
        return $this->getAdapter()->quoteInto($text, $value, $type,$count);
    }
    
    private function processQuery($query = null, $params = null)
    {
    	if(is_null($query) || is_null($params))
    		return $query;
    		
    	if(!is_array($params))
    		$params = array($params);
    		
    	$queries = array();
    	while(strlen($query) > 0){
    		$paramIndex = strpos($query, '?');
    		if($paramIndex === false){
    			$queries[count($queries) -1] .= substr($query, 0);
    			$query = '';
    		}
    		else{
    			$queries[] = substr($query, 0, $paramIndex+1);
    			$query = substr($query, $paramIndex+1);
    		}
    	}
    	
    	if(!is_null($params) && is_array($params)){
	    	foreach ($params as $key => $param) {
	    		$query .= $this->getDbTable()->getAdapter()->quoteInto($queries[$key], $param);
	    	}
    	}
    	
    	return $query;
    }



    protected function saveOrUpdate(Application_Model_BaseModel $model, $data)
    { 
        if (null === ($id = $model->getId())) {
            unset($data['id']);
            //$model->setId( $this->getDbTable()->insert($data));
            $model->setId( $this->getDbTable()->insert($data));
        
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
        return $model->getId();
    }
    
    public function find($id)
    {
    	return $this->findByFilter( "id = ?", $id );
    }
 
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
              $entry = $this->createModel($row);
            
            $entries[] = $entry;
        }
        return $entries;
    }
    
    protected function fetchAllByFilter($query = null, $params = null, $orderby = null, $limit = null)
    {	
    	if (!is_null($limit)){
    		$resultSet = $this->getDbTable()->fetchAll($this->processQuery($query, $params),$orderby,$limit,0);
    	} else {
    		$resultSet = $this->getDbTable()->fetchAll($this->processQuery($query, $params),$orderby);	
    	}
        $entries   = array();
        foreach ($resultSet as $row) {
              $entry = $this->createModel($row);
            
            $entries[] = $entry;
        }
        return $entries;
    }
    
    protected function findByFilter($query = null, $params = null, $orderby = null)
    {
    	$row = $this->getDbTable()->fetchRow($this->processQuery($query, $params), $orderby);
        if(!is_null($row)){
    		return $this->createModel($row);
        }
        else{
        	return null;
        }
    }
    
    public function delete($model)
    {
    	$this->getDbTable()->delete($this->quoteInto('id = ?', $model->getId()));
    }
    
    abstract protected function createModel($row);

    
}

?>
