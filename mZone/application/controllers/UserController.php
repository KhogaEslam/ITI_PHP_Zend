<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function listAllAction()
    {
        // action body
    }

    public function createAction()
    {
        // action body
    }

    public function retrieveAction()
    {
        // action body
    }

    public function deleteAction()
    {
        // action body
    }

    public function updateAction()
    {
        // action body
    }

    public function blockAction()
    {
        // action body
        $user_model = new Application_Model_User();
        $u_id = $this->_request->getParam("uid");
        $user_model->block($u_id);
    }

    public function unblockAction()
    {
        // action body
        $user_model = new Application_Model_User();
        $u_id = $this->_request->getParam("uid");
        $user_model->unblock($u_id);
    }

    public function makeShopUserAction()
    {
        // action body
        $user_model = new Application_Model_User();
        $u_id = $this->_request->getParam("uid");
        $user_model->makeShopUser($u_id);
    }

    public function deleteShopUserAction()
    {
        // action body
        $user_model = new Application_Model_User();
        $u_id = $this->_request->getParam("uid");
        $user_model->deleteShopUser($u_id);
    }

    public function makeAdminUserAction()
    {
        // action body
        $user_model = new Application_Model_User();
        $u_id = $this->_request->getParam("uid");
        $user_model->makeAdminUser($u_id);
    }

    public function deleteAdminUserAction()
    {
        // action body
        $user_model = new Application_Model_User();
        $u_id = $this->_request->getParam("uid");
        $user_model->deleteAdminUser($u_id);
    }


}

























