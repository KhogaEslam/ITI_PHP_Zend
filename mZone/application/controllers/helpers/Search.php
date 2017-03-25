<?php
/**
 * Created by PhpStorm.
 * User: khoga
 * Date: 25/03/17
 * Time: 07:16 م
 */

class Application_Controller_Helper_Search extends Zend_Controller_Action_Helper_Abstract
{
    public function preDispatch()
    {
        $view = $this->getActionController()->view;
        $form = new Application_Form_Search();

        $request = $this->getActionController()->getRequest();
        if($request->isPost()) {
            if($form->isValid($request->getPost())) {
                $product_model = new Application_Model_Product();
                $search = $product_model->searchByPname($request->getParam('search'));
                $view->searchproduct = $search;
                $form->processed = true;
            }
        }

        $view->searchForm = $form;

        $category_model = new Application_Model_Category();
        $all = $category_model->listCategory();
        $view->category = $all;
    }
}