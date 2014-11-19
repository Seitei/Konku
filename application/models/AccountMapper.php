<?php

class Application_Model_AccountMapper extends Application_Model_BaseMapper
{
    protected $_dbTable = 'Application_Model_DbTable_Account';
    
    public function save(Application_Model_BaseModel &$model)
    {

        $data = array(
            'username'   => $model->getUsername(),
            'email'   => $model->getEmail(),
            'password'   => $model->getPassword(),
        );
        
        return $this->saveOrUpdate($model, $data);
    }
    
    public function findByIp($ip){
    	return $this->findByFilter( "email = ?", $ip );
    }
    
    public function createModel($row)
    {
        $obj = new Application_Model_Account();
        
        $obj ->setId($row->id)
                  ->setUsername($row->username)
                  ->setEmail($row->email)
                  ->setPassword($row->password);
        return $obj;
    }
}
