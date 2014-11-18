<?php
class Www_Bootstrap extends Zend_Application_Module_Bootstrap
{

    protected function _initLogger()
    {
        $log = new Zend_Log();
        Zend_Registry::set('Log', $log);
        App_Util_LogHelper::setStreamWritter();

    }

     protected function _initViewHelpers()
     {
			$view = new Zend_View();
			$viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
			$view->addHelperPath('ZendX/JQuery/View/Helper/', 'ZendX_JQuery_View_Helper');
      		$view->addHelperPath('views/helpers', "Www_View_Helper");
      		$view->jQuery()->enable();
      		$viewRenderer->setView($view);
			Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);
		}

    protected function _initAutoload()
    {
        $autoloader = new Zend_Application_Module_Autoloader(array('namespace' => 'Www_','basePath' => dirname(__FILE__)));
        $autoloader->addResourceType("Action_Helper", "Action/Helpers", "Action_Helper");
        return $autoloader;
    }
}
