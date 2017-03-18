<?php

class ProductController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
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
        $product_model = new Application_Model_Product();
        $p_id = $this->_request->getParam("pid");
        $product = $product_model->retrieveData($p_id);
        $this->view->product = $product[0];
        //var_dump($product[0]);
        //die;
        $reviewModel = new Application_Model_Review();
        $allReviews = $reviewModel->getProductReviews($p_id );
        $this->view->reviews = $allReviews;

        $form = new Application_Form_Comment();
        $request = $this->getRequest();
        if($request->isPost()){
            if($form->isValid($request->getPost())){
                /*echo "<pre>";
                print_r($form);
                echo "</pre>";
                exit;*/
                $data['user_id'] = $this->_request->getParam('user_id'); //$form->getValue('user_id'); //current logged in user from session
                $data['product_id'] = $this->_request->getParam('product_id'); //$form->getValue('product_id'); //current product id
                $data['comment'] = $form->getValue('comment');
                $data['date'] = $form->getValue('date'); //current date-time
                var_dump($data);
                //die;
                $comment_model = new Application_Model_Review();
                $comment_model-> createData($data);
                $this->redirect('/Product/retrieve/'.$data['product_id']);
            }
        }
        $this->view->comment_form = $form;
    }

    public function updateAction()
    {
        // action body
    }

    public function deleteAction()
    {
        // action body
    }

    public function listAllAction()
    {
        // action body
        $product_model = new Application_Model_Product();
        $this->view->products = $product_model->listAll();

        $product_form = new Application_Form_Product();
        $this->view->product_form = $product_form;
    }

    public function addOfferAction()
    {
        // action body
    }


}















