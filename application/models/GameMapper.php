<?php

class Application_Model_GameMapper extends Application_Model_BaseMapper
{

    protected $_dbTable = 'Application_Model_DbTable_Game';
    
    public function save(Application_Model_BaseModel &$model)
    {
        parent::save($model);
        $data = array(
        	'name'   => $model->getName(),
        	'codeName'   => $model->getCodeName(),
            'categoryId' => $model->getCategoryId(),
        	'description'   => $model->getDescription(),
        	'versionMajor'   => $model->getVersionMajor(),
        	'versionMinor'   => $model->getVersionMinor(),
        	'versionPatch'   => $model->getVersionPatch(),
        );
        
        return $this->saveOrUpdate($model, $data);
    }

    public function fetchAllByCategoryId($categoryId) {
        return $this->fetchAllByFilter("categoryId = ?", $categoryId);
    }

    public function createModel($row)
    {
        $obj = new Application_Model_Game();
        
        $obj ->setId($row->id)
        		  ->setName($row->name)
        		  ->setCodeName($row->codeName)
                  ->setCategoryId($row->categoryId)
        		  ->setDescription($row->description)
        		  ->setVersionMajor($row->versionMajor)
        		  ->setVersionMinor($row->versionMinor)
        		  ->setVersionPatch($row->versionPatch);
                  
                  
        return $obj;
    }
}


