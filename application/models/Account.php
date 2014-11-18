<?php

class Application_Model_Account extends Application_Model_BaseModel
{
    
	protected $_modelName='account';
    protected $_username;
    protected $_email;
    protected $_password;
    
    protected $_measures = array();

    public function save(){
    	$mapper = new Application_Model_AccountMapper();
    	$mapper->save($this);
    }
 
    public function getUsername()
    {
        return $this->_username;
    }
 
    public function setUsername($val)
    {
        $this->_username = $val;
        return $this;
    }
 
    public function getEmail()
    {
        return $this->_email;
    }
 
    public function setEmail($val)
    {
        $this->_email = $val;
        return $this;
    }
 
    public function getPassword()
    {
        return $this->_password;
    }
 
    public function setPassword($val)
    {
        $this->_password = $val;
        return $this;
    }
}

