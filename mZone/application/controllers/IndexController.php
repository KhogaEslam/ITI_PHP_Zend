<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }


     public function searchAction()
    {
        // action body

         $this->_helper->layout('layout')->disableLayout();

    if ($this->getRequest()->isXmlHttpRequest())
     {
        if ($this->getRequest()->isPost())
         {
            $q=$_POST['searchword'];
            $indexSearch = new Model_Index();
            $result = $indexSearch ->indexSearch ($q);
            $this->view->indexSearch = $result;

        }
    } 
    else 
	    {
	        //regular controller logic goes here
	    }
    }






}

