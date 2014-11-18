<?php

class Application_Model_Game extends Application_Model_BaseModel
{
	protected $_name;
    protected $_categoryId;
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

    public function getCategoryId(){
        return $this->_categoryId;
    }

    public function setCategoryId($categoryId){
        $this->_categoryId = $categoryId;
        return $this;
    }
	
	public function setCodeName($codeName){
		$this->_codeName = $codeName;
		return $this;
	}
	
	public function getCodeName()	{
		return $this->_codeName;
	}
	
	public function setDescription($description){
		$this->_description = $description;
		return $this;
	}
	
	public function getDescription()	{
		return $this->_description;
	}
	
	public function setVersionMajor($versionMajor){
		$this->_versionMajor = $versionMajor;
		return $this;
	}
	
	public function getVersionMajor()	{
		return $this->_versionMajor;
	}
	
	public function setVersionMinor($versionMinor){
		$this->_versionMinor = $versionMinor;
		return $this;
	}
	
	public function getVersionMinor()	{
		return $this->_versionMinor;
	}
	
	public function setVersionPatch($versionPatch){
		$this->_versionPatch = $versionPatch;
		return $this;
	}
	
	public function getVersionPatch()	{
		return $this->_versionPatch;
	}

}

