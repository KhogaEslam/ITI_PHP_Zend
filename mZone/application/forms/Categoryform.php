<?php

class Application_Form_Categoryform extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('POST');
        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Cat Name: ');
        $name->setAttribs(Array(
            'placeholder'=>'Example: Tech',
            'class'=>'form-control'

        ));
        $name->setRequired();
        $name->addFilter('StringTrim');


        $cdesc = new Zend_Form_Element_Text('cdesc');
        $cdesc->setLabel('Description: ');
        $cdesc->setAttribs(Array(
            'placeholder'=>'Example:this category includes phones and labtops',
            'class'=>'form-control'

        ));

        $cdesc->setRequired();
        $cdesc->addFilter('StringTrim');

        $parent = new Zend_Form_Element_Select('parent');
        $parent->setLabel('Parent Category: ');
        $modelObj = new Application_Model_Category();
        $categories = $modelObj->getParentCategories();
        foreach ($categories as $key => $value) {
          $parent->addMultiOption($value['id'],$value['name']);
        }
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
            $name,
            $parent,
            $cdesc,
            $submit,
            $reset,
        ));
    }


}
