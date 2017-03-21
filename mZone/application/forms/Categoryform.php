<?php

class Application_Form_Categoryform extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('POST');
        $cname = new Zend_Form_Element_Text('name');
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



         $uploadDir = APPLICATION_PATH.'/../public/images';
                $image = new Zend_Form_Element_File('image');
                $image
                ->setRequired(true)
                ->setLabel('Select the file to upload:')
                ->setDestination($uploadDir)
                ->addValidator('Count', false, 1) // ensure only 1 file
                ->addValidator('Size', false, 2097152) // limit to 2MB
                ->addValidator('Extension', false, 'jpeg,png,jpg')
               
                ->addValidator('NotExists', false, $uploadDir);


        $submit= new Zend_Form_Element_Submit('save');
        $submit->setAttribs(Array('class'=>'btn btn-success'));

        $reset= new Zend_Form_Element_Reset('reset');
        $reset->setAttribs(Array('class'=>'btn btn-danger'));

        $this->addElements(Array(
            $cname,
            $parent,
            $cdesc,
            $image,
            $submit,
            $reset,
        ));
    }


}