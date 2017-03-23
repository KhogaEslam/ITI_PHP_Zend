<?php

class DashboardController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        /* Initialize action controller here */
        $authorization = Zend_Auth::getInstance();
        $storage=$authorization->getStorage();
        $userdata=$storage->read();

        if (!$authorization->hasIdentity())
        {
            $this->redirect('/');
        }
        if ($userdata->type == 3)
        {
            $this->redirect('/dashboard/');
        }
    }

    public function indexAction()
    {
        // action body
    }


}

