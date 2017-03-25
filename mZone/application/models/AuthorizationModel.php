<?php

class Application_Model_AuthorizationModel extends Zend_Db_Table_Abstract
{

    function authoriseUser($email, $password, $type = 1){

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
                header('Location:/dashboard');
            }

            if ($sessionDataObj->isBlocked == 0 && $sessionDataObj->type == 2) {
                $auth = Zend_Auth::getInstance();
                $storage = $auth->getStorage();
                $storage->write($sessionDataObj);
                header('Location:/dashboard');
            }

            if ($sessionDataObj->isBlocked == 0 && $sessionDataObj->type == 3) {
                $auth = Zend_Auth::getInstance();
                $storage = $auth->getStorage();
                $storage->write($sessionDataObj);
                header('Location:/');
            } else {
                header('Location:/user/add/email/' . $email . '/msg/You are blocked, contact Admin');
            }
        } else {
            header('Location:/user/add/email/' . $email . '/msg/User Not Found, Create New Account');
        }
    }

}

