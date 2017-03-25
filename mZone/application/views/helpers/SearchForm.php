<?php
/**
 * Created by PhpStorm.
 * User: khoga
 * Date: 25/03/17
 * Time: 07:18 م
 */

class Zend_View_Helper_SearchForm extends Zend_View_Helper_Abstract
{
    public function searchForm(Application_Form_search $form)
    {
        $html = '';
        if($form->processed) {
            $html .= '';
        } else {
            $html .= $form->render();
        }
        return $html;
    }
}