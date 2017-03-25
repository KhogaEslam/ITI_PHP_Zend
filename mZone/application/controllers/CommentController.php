<?php

class CommentController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

//    public function indexAction()
//    {
//        // action body
//    }

    public function updateAction()
    {
        // action body
        $form = new Application_Form_Comment();
        $review_model = new Application_Model_Review();
        $id = $this->_request->getParam('cid');
        $review_data = $review_model->retrieveData($id)[0];
        //var_dump($review_data);
        //die;
        $form->populate($review_data);
        $this->view->comment_form = $form;
        $request = $this->getRequest();
        if($request->isPost()){
            if($form->isValid($request->getPost())){
                $data['comment'] = $form->getValue('comment');
                $comment_model = new Application_Model_Review();
                $comment_model-> updateData($id,$data);
                $this->redirect('/Product/retrieve/'.$data['product_id']);
            }
        }
    }

    public function deleteAction()
    {
        // action body
        $review_model = new Application_Model_Review();
        $pid = $this->_request->getParam("pid");
        $id = $this->_request->getParam("cid");
        $review_model->deleteData($id);
        $this->redirect('/Product/retrieve/'.$pid);
    }

    public function createAction()
    {
        // action body
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

    public function listAllAction()
    {
        // action body
        $review_model = new Application_Model_Review();
        $pid = $this->_request->getParam("pid");
        $allReviews = $review_model->getProductReviews($pid);
        $this->view->allReviews = $allReviews;
    }
}













