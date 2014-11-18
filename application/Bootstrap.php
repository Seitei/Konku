<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initRoutes()
    {
        $frontController = Zend_Controller_Front::getInstance();
        $router = $frontController->getRouter();
        $router->removeDefaultRoutes();

        $wwwRouteHostename = new Zend_Controller_Router_Route_Hostname("www." . ROUTEHOSTNAMEMAP,array('module' => 'www'));
        $wwwRoute = new Zend_Controller_Router_Route(':controller/:action/*',array('module' => 'www','controller' => 'index','action' => 'index'));
        $wwwChainedRoot = new Zend_Controller_Router_Route_Chain();
        $wwwChainedRoot->chain($wwwRouteHostename)->chain($wwwRoute);

        $router->addRoute('www',$wwwChainedRoot);

        $defaultRouteHostename = new Zend_Controller_Router_Route_Hostname(ROUTEHOSTNAMEMAP,array('module' => 'www'));
        $defaultRoute = new Zend_Controller_Router_Route(':controller/:action/*',array('module' => 'www','controller' => 'index','action' => 'index'));
        $defaultChainedRoot = new Zend_Controller_Router_Route_Chain();
        $defaultChainedRoot->chain($defaultRouteHostename)->chain($defaultRoute);

        $router->addRoute('default',$defaultChainedRoot);
    }

    protected function setConstants($constants)
    {
        foreach ($constants as $key=>$value){
            if(!defined($key)){
                define($key, $value);
            }
        }
    }

 	protected function _initFrontControllerOutput()
    {
        $frontController = Zend_Controller_Front::getInstance();
        $frontController->setParam('useDefaultControllerAlways', false);
        return $frontController;
    }


}

