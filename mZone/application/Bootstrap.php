<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    function _initViewHelpers()
    {
        $view = new Zend_View();
        ZendX_JQuery::enableView($view);

        $viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
	       $view->addHelperPath('ZendX/JQuery/View/Helper/', 'ZendX_JQuery_View_Helper');
        $view->addHelperPath('ZendX/JQuery/View/Helper/JQuery', 'ZendX_JQuery_View_Helper_JQuery');
        $view->addHelperPath('Core/View/Helper/', 'Core_View_Helper');
	       $viewRenderer->setView($view);
        Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);
        ZendX_JQuery_View_Helper_JQuery::enableNoConflictMode();


        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();

        $view->doctype('HTML5');
        $view->headMeta()->appendHttpEquiv('Content-Type', 'text/html;charset=utf-8');
        $view->headTitle()->setSeparator(' - ');
        $view->headTitle('mZone');
    }

    protected function _initConstants()
    {
        $registry = Zend_Registry::getInstance();
        $registry->myresources = new Zend_Config( $this->getApplication()->getOption('myresources') );
    }

    protected function _initMyActionHelpers()
    {
        $this->bootstrap('frontController');

        $signup = Zend_Controller_Action_HelperBroker::getStaticHelper('Signup');
        Zend_Controller_Action_HelperBroker::addHelper($signup);

        $login = Zend_Controller_Action_HelperBroker::getStaticHelper('Login');
        Zend_Controller_Action_HelperBroker::addHelper($login);

        $search = Zend_Controller_Action_HelperBroker::getStaticHelper('Search');
        Zend_Controller_Action_HelperBroker::addHelper($search);
    }
}
