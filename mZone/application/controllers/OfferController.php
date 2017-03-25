<?php

class OfferController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function addOfferAction()
    {
        // action body
        $form = new Application_Form_AddOffer();
        $pid = $this->_request->getParam('pid');
        $form_data['product_id'] = $pid;
        $form->populate($form_data);
        $this->view->offer_form = $form;
        $request = $this->getRequest();
        if($request->isPost()){
            if($form->isValid($request->getPost())){
                $data['pro_id'] = $form->getValue('product_id');
                $data['start_date'] = $form->getValue('startDate');
                $data['end_date'] = $form->getValue('endDate');
                $data['percentage'] = $form->getValue('percentage');
                $offer_model = new Application_Model_Offer();
                $offer_model-> createData($data);
                $this->redirect('/product/shop-products');
            }
        }
    }


}



