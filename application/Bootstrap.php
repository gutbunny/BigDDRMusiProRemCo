<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initUser() {

	$this->bootstrap('view');
	$view = $this->getResource('view');
        if (Zend_Loader::isReadable('../application/controllers/UserController.php')) {
            require '../application/controllers/UserController.php';
            session_start();
            //if($_SESSION['email'] && $_SESSION['email'] != 'logout') {
                UserController::loadSession();
            //}
            
        }        
    }

    protected function _initAdmin() {
        $tmp = $this->getOptions();
        $this->view->smtpsettings = $tmp['mysmtp'];
        //$this->view->debug = $this->smtpsettings;
    }

    protected function _initErrors() {
        
        if (Zend_Loader::isReadable('../errors.php')) {
            require '../errors.php';
        }

    }

    protected function _initView()
    {
        // Initialize view
        $view = new Zend_View();
        $view->doctype('XHTML1_STRICT');
        $view->headTitle("Big Daddy Death Ray's Project Manager");
 
        // Add it to the ViewRenderer
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper(
            'ViewRenderer'
        );
        $viewRenderer->setView($view);

        // Return it, so that it can be stored by the bootstrap
        return $view;
    }

    protected function _initDoctype()
    {
	$this->bootstrap('view');
	$view = $this->getResource('view');
	$view->doctype('XHTML1_STRICT');
    }

    protected function _initProjects() {


    }

}

