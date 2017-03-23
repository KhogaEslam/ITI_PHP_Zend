<?php

class Application_Model_CurrentUser
{
    public static function getCurrentUserID(){
        $auth=Zend_Auth::getInstance();
        $storage=$auth->getStorage();
        $userdata=$storage->read();
        return $userdata->id;
    }
}

