<?php
/**
 * Created by PhpStorm.
 * User: khoga
 * Date: 25/03/17
 * Time: 07:16 م
 */

class Application_Controller_Helper_Signup extends Zend_Controller_Action_Helper_Abstract
{
    public function preDispatch()
    {
        $request = $this->getActionController()->getRequest();
        $view = $this->getActionController()->view;
        $form = new Application_Form_SignUp();
        $email = $request->getParam('email');
        $msg = $request->getParam('msg');
        $msg = "<strong>" . $msg . "</strong><hr>";
        $data['email'] = $email;
        $data['msg'] = $msg;
        $form->populate($data);

        if ($request->ispost()) {
            if ($form->isValid($request->getParams())) {
                $user_model = new Application_Model_User();
                $user_model->Register($request->getParams());
                $form->processed = true;
                header('Location: /');
            }
        }

        $view->signupForm = $form;



    }
}