<?php

class Application_Form_AddOffer extends ZendX_JQuery_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('POST');

        $user_id = new Zend_Form_Element_Hidden('user_id');
        $user_id->setValue("1");
        $product_id = new Zend_Form_Element_Hidden('product_id');
        $product_id-> setValue("1");

        $startDate = new ZendX_JQuery_Form_Element_DatePicker('startDate');
        $startDate->setJQueryParams(array(
            'dateFormat'=>'yy-mm-dd',
            'changeMonth'=> true,
            'changeYear'=> true
        ))
            ->setDecorators(array(
                array('UiWidgetElement', array('tag' => '')),
                array('Errors'),
                array('HtmlTag', array('tag' => 'div', 'class'=>'span-11 last')),
                array('Label', array('tag' => 'div', 'class'=>'span-5 clear'))
            ));
        $startDate->setLabel('Start date: ');
        $endDate = new ZendX_JQuery_Form_Element_DatePicker('endDate');
        $endDate->setJQueryParams(array(
            'dateFormat'=>'yy-mm-dd',
            'changeMonth'=> true,
            'changeYear'=> true
        ))
            ->setDecorators(array(
                array('UiWidgetElement', array('tag' => '')),
                array('Errors'),
                array('HtmlTag', array('tag' => 'div', 'class'=>'span-11 last')),
                array('Label', array('tag' => 'div', 'class'=>'span-5 clear'))
            ));
        $endDate->setLabel('End date: ');

        $percentage = new Zend_Form_Element_Text('percentage');
        $validator1=new Zend_Validate_GreaterThan(0);
        $validator2=new Zend_Validate_LessThan(100);
        $percentage
            ->addValidator($validator1,true)
            ->addValidator($validator2,true)
            ->setRequired(true)
            ->addFilter('StringTrim')
            ->addFilter('StripTags')
            ->addValidator('Digits')
            ->setAttrib('class', 'small')
            ->addValidator('StringLength', false, array(1, 3))
            ->setDecorators(array('ViewHelper', 'errors'));

        $submit= new Zend_Form_Element_Submit('Add Offer');
        $submit->setAttribs(array('class'=>'btn btn-success'));

        $this->addElements(array(
            $user_id,
            $product_id,
            $startDate,
            $endDate,
            $percentage,
            $submit,
        ));


    }


}

/*
 * $comment->setLabel('Your Comment: ');
        $comment->setAttribs(Array(
            'placeholder'=>'Share Your Experience...',
            'class'=>'form-control'
        ));
        $comment->addValidator('StringLength', false, Array(3,500));
        $comment->addFilter('StringTrim');
        $comment->addFilter('StripTags');
        $comment->removeDecorator('DtDdWrapper');
        $comment->removeDecorator('label');
        $comment->removeDecorator('HtmlTag');
 * */