<?php
/**
 * Created by PhpStorm.
 * User: khoga
 * Date: 25/03/17
 * Time: 07:16 م
 */

class Application_Controller_Helper_Login extends Zend_Controller_Action_Helper_Abstract
{
    public function preDispatch()
    {
        require_once APPLICATION_PATH."/controllers/UserController.php";
        $view = $this->getActionController()->view;
        $form = new Application_Form_Login();

        $request = $this->getActionController()->getRequest();
        $response = $this->getActionController()->getResponse();
        if($request->isPost()) {
            if($form->isValid($request->getPost())) {
                //$data = $form->getValues();

                // process data
                $email = $request->getParam('email');
                $password = $request->getParam('password');
                //$model = new Application_Model_AuthorizationModel();
                //$model->authoriseUser($email, $password, 2);
                //$user = new UserController($request,$response);
                $this->authoriseuserAction($email,$password,2);
                $form->processed = true;
            }
        }

        $view->loginForm = $form;
    }

    public function authoriseuserAction($email, $password, $type = 1)
    {
        // action body
        //we get object of ZendDbAdapter to know which database we connect on
        $db = zend_Db_Table::getDefaultAdapter();
        $identity = "email";

        if ($type != 1) {
            $dbm = new Application_Model_User();
            $user = $dbm->fetchRow($dbm->select()->where('username like ?', $email));

            if ($user['username']) {
                $identity = "username";
            }
        }
        $adapter = new Zend_Auth_Adapter_DbTable($db, 'user', $identity, 'password');
        $adapter->setIdentity($email);

        $adapter->setCredential($password);

        //execute qyery
        $result = $adapter->authenticate();
        if ($result->isValid()) {
            //print_r('authentiacte');
            //session steps
            $sessionDataObj = $adapter->getResultRowObject(['id', 'email', 'name', 'name_ar', 'username', 'isBlocked', 'type']);

            if ($sessionDataObj->isBlocked == 0 && $sessionDataObj->type == 1) {
                $auth = Zend_Auth::getInstance();
                $storage = $auth->getStorage();
                $storage->write($sessionDataObj);
                header('Location: /dashboard');
            }

            if ($sessionDataObj->isBlocked == 0 && $sessionDataObj->type == 2) {
                $auth = Zend_Auth::getInstance();
                $storage = $auth->getStorage();
                $storage->write($sessionDataObj);
                header('Location: /dashboard');
            }

            if ($sessionDataObj->isBlocked == 0 && $sessionDataObj->type == 3) {
                $auth = Zend_Auth::getInstance();
                $storage = $auth->getStorage();
                $storage->write($sessionDataObj);
                header('Location: /');
            }
            if($sessionDataObj->isBlocked == 1){
                header('/user/add/email/' . $email . '/msg/You are blocked, contact Admin');
            }
            else{
                header('/user/add/email/' . $email . '/msg/Problem in login, contact Admin');
            }
        } else {
            header('/user/add/email/' . $email . '/msg/User Not Found, Create New Account');
        }
    }
}