<?php

class Www_GameController extends Zend_Controller_Action
{
    public function init() {
    }
    
    public function indexAction() {
        $this->_helper->layout->setLayout('game-layout');

    	$request = $this->getRequest();
    	$gameForm = new Www_Form_Game();
		if ($request->getParam("test")) $gameForm->setAction(
				$this->view->url(array ('controller'=>'source','action'=>'index')) );
    	$options = array();
    	
    	
    	if ($request->isPost() && $gameForm->isValid($request->getPost())) {
    		
    		$gameId = $request->getParam("gameId");
    		
    		$codename = $request->getParam("codename");
   			$version = explode(".", $request->getParam("version"));
    		$major = $version[0];
    		$minor = $version[1];
    		$patch = $version[2];
    		
    		$upload = new Zend_File_Transfer_Adapter_Http();
    		$upload->addFilter('Rename', array('target' => APPLICATION_PATH."/../public/assets/{$codename}_{$major}_{$minor}_{$patch}.swf", 'overwrite' => true));
    		try {
    			$upload->receive();

    			if($gameId > 0){
    				$game = Application_Model_Game::find($gameId); 
    			} else {
    				$game = new Application_Model_Game();
    			}
    			$game->setName($request->getParam("title"));
    			$game->setCodeName($codename);
    			$game->setDescription($request->getParam("description"));
    			$game->setVersionMajor($major);
    			$game->setVersionMinor($minor);
    			$game->setVersionPatch($patch);

                $category = Application_Model_Category::findByName();
                $game->setCategoryId($category->getId());
    			
    			Application_Model_Game::getMapper()->save($game);
    			
    		} catch (Zend_File_Transfer_Exception $e) {
    			echo $e->message();
    			die;
    		}	
        }
        
		$this->view->games = Application_Model_Game::fetchAll();
		$this->view->error = ( isset($error) ) ? $error : false; 
        $this->view->gameForm = $gameForm;
    	
    }
}

