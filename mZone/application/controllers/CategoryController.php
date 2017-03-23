<?php

class CategoryController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function listAction()
    {
        $category_model = new Application_Model_Category();
        $this->view->category = $category_model->listCategory();
    }


    public function detailsAction()
    {
        $category_model = new Application_Model_Category();
        $id = $this->_request->getParam("id");
        $category = $category_model->categoryDetails($id);
        $this->view->category = $category;
    }

    public function deleteAction()
    {
        // action body
        $category_model = new Application_Model_Category();
        $cat_id= $this->_request->getParam('id');
        $category_model->deleteCategory($cat_id);
        $this->redirect("/category/list");
    }

    public function addAction()
    {
        // action body
        $form = new Application_Form_Categoryform();
        $request = $this->getRequest();
        if($request->isPost()){
            if($form->isValid($request->getPost())){
                $category_model = new Application_Model_Category();
                $category_model-> addNewcategory($request->getParams());
                $this->redirect('/category/list');
            }
        }
        $this->view->category_form = $form;
    }


    public function updateAction()
    {
        // action body
        $form = new Application_Form_Categoryform();
        $cat_id = $this->_request->getParam('id');
        $category_model = new Application_Model_Category();
        $data = $category_model->categoryDetails($cat_id);
        $form->populate($data);
        $request = $this->getRequest();
        if($request->isPost()){
            if($form->isValid($request->getPost())){
                $category_model = new Application_Model_Category();
                $category_model->updateCategory($cat_id,$request->getParams());
                $this->redirect("/category/list");

            }
        }
        $this->view->category_form = $form;
    }
}
