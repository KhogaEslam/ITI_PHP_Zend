<?php

class Application_Form_Comment extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('POST');

        $comment = new Zend_Form_Element_Textarea('comment');
        $comment->setLabel('Your Comment: ');
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

        $user_id = new Zend_Form_Element_Hidden('user_id');
        $user_id->setValue("1");
        $product_id = new Zend_Form_Element_Hidden('product_id');
        $product_id-> setValue("1");
        $date = new Zend_Form_Element_Hidden('date');

        $submit= new Zend_Form_Element_Submit('Comment');
        $submit->setAttribs(array('class'=>'btn btn-success'));

        $this->addElements(array(
            $comment,
            $user_id,
            $product_id,
            $date,
            $submit,
        ));

    }


}