<?php

class DiscountController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function newDiscountAction()
    {
        // action body
        $form = new Application_Form_Discount();
        $uid = $this->_request->getParam('uid');
        $userObj = new Application_Model_User();
        $user = $userObj->retrieveData($uid)[0];
        $codeObj = new Application_Model_CodeGenerator();
        $code = $codeObj->generate();
        $form_data['code'] = $code;
        $form_data['user_id'] = $uid;
        //get User Data...
        $form->populate($form_data);
        $this->view->discount_form = $form;
        $request = $this->getRequest();
        if($request->isPost()){
            if($form->isValid($request->getPost())){
                $data['user_id'] = $form->getValue('user_id');
                $data['start_date'] = $form->getValue('startDate');
                $data['end_date'] = $form->getValue('endDate');
                $data['code'] = $form->getValue('code');
                $data['percentage'] = $form->getValue('percentage');
                $emailObj = new Application_Model_Email();
                $emailObj->sendEmail($user['email'],$user['name'],$data['percentage'],$data['code']);
                $offer_model = new Application_Model_Discount();
                $offer_model-> createData($data);
                $this->redirect('/User/list-All');
            }
        }
    }


}



