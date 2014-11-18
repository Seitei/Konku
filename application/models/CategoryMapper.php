<?php

class Application_Model_CategoryMapper extends Application_Model_BaseMapper
{
    protected $_dbTable = 'Application_Model_DbTable_Category';
    
    public function save(Application_Model_BaseModelWithAudit &$model)
    {
        parent::save($model);
        $data = array(
        	'name'   => $model->getName(),
        	'description'   => $model->getDescription(),
        );
        
        return $this->saveOrUpdate($model, $data);
    }

    public function findByName($name) {
        return $this->findByFilter("name = ?", $name);
    }
    
    public function createModel($row)
    {
        $obj = new Application_Model_Category();
        
        $obj ->setId($row->id)
        		  ->setName($row->name)
        		  ->setDescription($row->description);
        return $obj;
    }
}


