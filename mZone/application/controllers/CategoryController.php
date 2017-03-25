<?php

class CategoryController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

//    public function indexAction()
//    {
//        // action body
//    }

    /*
     *
     * used in Admin Dashboard
     *
    */
    public function listAllAction()
    {
        $category_model = new Application_Model_Category();
        $this->view->category = $category_model->listCategory();
    }

    /*
     *
     * used in Admin Dashboard
     *
    */
    public function detailsAction()
    {
        $category_model = new Application_Model_Category();
        $id = $this->_request->getParam("cat_id");
        $category = $category_model->categoryDetails($id)[0];
        $this->view->category = $category;
    }
    /*
     *
     * used in Admin Dashboard
     *
    */
    public function deleteAction()
    {
        // action body
        $category_model = new Application_Model_Category();
        $cat_id= $this->_request->getParam('cat_id');
        $category_model->deleteCategory($cat_id);
        $this->redirect("/category/list-all");
    }

    /*
     *
     * used in Admin Dashboard
     *
    */
    public function addAction()
    {
        // action body
        $form = new Application_Form_Categoryform();
        $request = $this->getRequest();
        if($request->isPost()){
            if($form->isValid($request->getPost())){
                $category_model = new Application_Model_Category();
                if ($form->image->receive()) {
                    $image = $form->image->getFileName(null, false);
                    $category_model-> addNewcategory($request->getParams(),$image);
                }

                $this->redirect('/category/list-all');
            }
        }
        $this->view->category_form = $form;
    }

    /*
     *
     * used in Admin Dashboard
     *
    */
    public function updateAction()
    {
        // action body
        $form = new Application_Form_Categoryform();
        $cat_id = $this->_request->getParam('cat_id');
        $category_model = new Application_Model_Category();
        $data = $category_model->categoryDetails($cat_id)[0];
        $form->populate($data);
        $request = $this->getRequest();
        if($request->isPost()){
            if($form->isValid($request->getPost())){
                if ($form->image->receive()) {
                    $image = $form->image->getFileName(null, false);
                    $category_model->updateCategory($cat_id,$request->getParams(), $image);
                }
                $this->redirect("/category/list-all");
            }
        }
        $this->view->category_form = $form;
    }
}
