<?php

class DashboardController extends Zend_Controller_Action
{
    /*
     *
     * used in Admin Dashboard
     *
    */
    public function init()
    {
        /* Initialize action controller here */
        /* Initialize action controller here */
        $authorization = Zend_Auth::getInstance();
        $storage=$authorization->getStorage();
        $userdata=$storage->read();

        if (!$authorization->hasIdentity() || $userdata->type == 3)
        {
            $this->redirect('/');
        }
    }

    /*
     *
     * used in Admin Dashboard
     *
    */
    public function indexAction()
    {
        // action body
        $product_model = new Application_Model_Product();
        $cat_model = new Application_Model_Category();
        $tops = $product_model->TopProducts();
        $asize = sizeof($tops);
        $fullDetails = "";
        for ($i=0; $i<$asize; $i++){
            $cat_id = $tops[$i]['id'];
            $cate = $cat_model->categoryDetails($cat_id);
            $p_id = $tops[$i]['productID'];
            $pro = $product_model->productdetails($p_id);
            $fullDetails[$i]['cate'] = $cate;
            $fullDetails[$i]['pro'] = $pro;
        }
        $this->view->topproduct = $fullDetails;
        $history_model = new Application_Model_History();
        $stat = $history_model->product_statistics();
        $this->view->statisticproduct = $stat;
    }


}

