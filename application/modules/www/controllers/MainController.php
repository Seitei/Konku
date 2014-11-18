<?php

class Www_MainController extends Zend_Controller_Action
{
	
	public function init()
	{
        App_Util_LogHelper::LogMessage("HELLO3");
		
	}

	private function getClientIp() {
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP']) && $_SERVER['HTTP_CLIENT_IP'])
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'])
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_X_FORWARDED']) && $_SERVER['HTTP_X_FORWARDED'])
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if(isset($_SERVER['HTTP_FORWARDED_FOR']) && $_SERVER['HTTP_FORWARDED_FOR'])
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_FORWARDED']) && $_SERVER['HTTP_FORWARDED'])
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'])
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
	
	public function indexAction()
	{
		$account = null;
		if(!$account){
			$ip = $this->getClientIp();
			$account = Application_Model_Account::findByIp($ip);
			if(!$account){
				$account = new Application_Model_Account();
				$account->setActivated(0);
				$account->setBio($ip);
				$account->setUsername(" ");
				$account->setEmail(" ");
				$account->setPassword(" ");
				$account->setState("INITIAL");
				Application_Model_Account::getMapper()->save($account);
				$account->setUsername("guest{$account->getId()}");
				$account->setEmail("guest{$account->getId()}@email.com");
				Application_Model_Account::getMapper()->save($account);
			}
			$this->view->isGuestUser = true;
		} else {
			$this->view->isGuestUser = false;
		}
		$_SESSION['accountId'] = $account->getId();
		$this->view->accountName = $account->getUsername();
		
	}
	
	public function logoutAction()
	{
		$this->_helper->viewRenderer->setNoRender();
		$this->_helper->getHelper('layout')->disableLayout();

		unset($_SESSION['accountId']);
	}
	
	public function loginAction()
	{
		try{
			$this->_helper->viewRenderer->setNoRender();
			$this->_helper->getHelper('layout')->disableLayout();
			
			$username = $this->getRequest()->getParam("username");
			$password = $this->getRequest()->getParam("password");
			
			$dbAdapter = Zend_Db_Table::getDefaultAdapter();
			$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
			 
			$status = null;
			if ($status->getCode() == Zend_Auth_Result::SUCCESS ) {
				$users = new Application_Model_AccountMapper();
				$currentUser = $users->find( 1 );
				$currentUser->setLastLogin(date("Y-m-d H:i:s"));
				$currentUser->save();

				$_SESSION['accountId'] = $currentUser->getId();
			} else {
				echo json_encode($status->getMessages());
			}
		} catch(Exception $e) {
			echo $e->getMessage();
		}
	}
	
	public function registerAction()
	{
		try{
			$this->_helper->viewRenderer->setNoRender();
			$this->_helper->getHelper('layout')->disableLayout();
			
			$username = $this->getRequest()->getParam("username");
			$email = $this->getRequest()->getParam("email");
			$password = md5($this->getRequest()->getParam("password"));
			$password2 = md5($this->getRequest()->getParam("password2"));
			$acceptTerms = $this->getRequest()->getParam("acceptTerms");
			
			$account = new Application_Model_Account();
			$account->setUsername($username);
			$account->setEmail($email);
			$account->setPassword($password);
			$account->setActivated(true);
			$account->setState(Application_Model_Account::STATE_INITIAL);
			Application_Model_Account::getMapper()->save($account);
		} catch(Exception $e) {
			echo $e->getMessage();
		}
	}
}