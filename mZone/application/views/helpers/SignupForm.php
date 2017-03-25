<?php
/**
 * Created by PhpStorm.
 * User: khoga
 * Date: 25/03/17
 * Time: 07:18 م
 */

class Zend_View_Helper_SignupForm extends Zend_View_Helper_Abstract
{
    public function signupForm(Application_Form_SignUp $form)
    {
        $authorization = Zend_Auth::getInstance();
        $html = '';
        if ($authorization->hasIdentity())
        {
            $html .= '<p>You Are Already signedIn</p>';
        }
        else {
            $html .= $form->render();
        }
        return $html;
    }
}