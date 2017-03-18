<?php

class Application_Form_Categoryform extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('POST');
        $cname = new Zend_Form_Element_Text('cname');
        $cname->setLabel('Cat Name: ');
        $cname->setAttribs(Array(
            'placeholder'=>'Example: Tech',
            'class'=>'form-control'

        ));
        $cname->setRequired();
        $cname->addFilter('StringTrim');


        $cdesc = new Zend_Form_Element_Text('cdesc');
        $cdesc->setLabel('Description: ');
        $cdesc->setAttribs(Array(
            'placeholder'=>'Example:this category includes phones and labtops',
            'class'=>'form-control'

        ));

        $cdesc->setRequired();
        $cdesc->addFilter('StringTrim');

        $parent = new Zend_Form_Element_Text('parent');
        $parent->setLabel('Parent: ');
        $parent->setAttribs(Array(
            'placeholder'=>'Example:this category includes phones and labtops',
            'class'=>'form-control'

        ));
        $parent->setRequired();
        $parent->addFilter('StringTrim');


        $submit= new Zend_Form_Element_Submit('save');
        $submit->setAttribs(Array('class'=>'btn btn-success'));

        $reset= new Zend_Form_Element_Reset('reset');
        $reset->setAttribs(Array('class'=>'btn btn-danger'));

        $this->addElements(Array(
            $cname,
            $parent,
            $cdesc,
            $submit,
            $reset,
        ));
    }


}