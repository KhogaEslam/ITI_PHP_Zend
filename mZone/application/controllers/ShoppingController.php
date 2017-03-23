<?php

class ShoppingController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function addAction()
    {
        // action body
        $user_id=$this->_request->getParam("uid");
        $product_id=$this->_request->getParam('pid');
        $shopping_model = new Application_Model_Shopping();
        $shopcart=$shopping_model->addToCart($user_id,$product_id);
    }

    public function removeAction()
    {
        // action body
        $user_id=$this->_request->getParam("uid");
        $product_id=$this->_request->getParam('pid');
        $shopping_model = new Application_Model_Shopping();
        $shopping_model-> removeCart($user_id,$product_id);
    }


}
