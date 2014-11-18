<?php

class Application_Model_Category extends Application_Model_BaseModel
{
	protected $_name;
	protected $_codeName;
	protected $_description;
	protected $_versionMajor;
	protected $_versionMinor;
	protected $_versionPatch;
	
	public function setName($name){
		$this->_name = $name;
		return $this;
	}
	
	public function getName()	{
		return $this->_name;
	}

	public function setDescription($description){
		$this->_description = $description;
		return $this;
	}
	
	public function getDescription()	{
		return $this->_description;
	}

}

