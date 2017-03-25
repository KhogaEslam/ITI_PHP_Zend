<?php

class WishlistController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->_helper->_layout->setLayout('home');
    }

    public function indexAction()
    {
        // action body
        $wishlist_model = new Application_Model_Wishlist();
        $user_model = new Application_Model_User();
        $userid = $user_model->getCurrentLoggedInUserID();
        $wishlist = $wishlist_model->wishlist($userid);
        $product_model = new Application_Model_Product();
        $array = array();
        foreach ($wishlist as $key => $value) {
            //if($key == "productid"){
            if ($key == "pid") {
                $array[] = $product_model->productdetails($value);
            }
            $defaultNamespace = new Zend_Session_Namespace('Default');
            $defaultNamespace->session_array = $array;
        }

        $this->view->wishlist_user = $wishlist;
        $this->view->prd_array = $array;

    }

    public function addAction()
    {
        $product_id = $this->_request->getParam("pid");
        //$product_id=3;
        $user_id = 3;
        $wishlist_model = new Application_Model_Wishlist();
        $check = $wishlist_model->find($product_id, $user_id)->toArray();
        if (!empty($check)) {
            echo "already added before";
        } else {
            //addNewproduct
            $row = $wishlist_model->createRow();
            $row->userid = $user_id;
            $row->productid = $product_id;
            $row->save();
        }


    }

    public function removeAction()
    {
        // action body
        $product_id = $this->_request->getParam("pid");
        $user_id = 3;
        $wishlist_model = new Application_Model_Wishlist();
        $wishlist_model->delete("productid=$product_id");
        $this->redirect('/product/displayforcustomer');
    }

    public function checkuniqueAction($prd_id, $u_id)
    {
        // action body

        $check = $this->find($prd_id, $u_id)->toArray();
        if (!empty($check)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function listAction()
    {
        $wishlist_model = new Application_Model_Wishlist();
        $this->view->allwishproduct = $wishlist_model->wishlist();
    }
}
