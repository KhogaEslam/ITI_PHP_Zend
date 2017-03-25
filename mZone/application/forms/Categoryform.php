<?php

class Application_Form_Categoryform extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('POST');
        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Category Name: ');
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

        $uploadDir = APPLICATION_PATH.'/../public/images';
        $image = new Zend_Form_Element_File('image');
        $image
            ->setRequired(true)
            ->setLabel('Select the file to upload:')
            ->setDestination($uploadDir)
            ->addValidator('Count', false, 1) // ensure only 1 file
            ->addValidator('Size', false, 2097152) // limit to 2MB
            ->addValidator('Extension', false, array('jpg', 'png', 'gif', 'jpeg',''))
            ->addFilter('Rename', implode('category_',
                array($this->_user_id,
                    $this->_upload_category,
                    date('YmdHis'))))
            ->addValidator('NotExists', false, $uploadDir);

        $parent = new Zend_Form_Element_Text('parent');
        $parent->setLabel('Parent: ');
        $parent->setAttribs(Array(
            'placeholder'=>'Example: choose parent category Mobiles -> Electronics',
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
                ->addFilter('Rename', implode('product_',
                    array($this->_user_id,
                        $this->_upload_category,
                        date('YmdHis'))));
                //->addValidator('NotExists', false, $uploadDir);


        $submit= new Zend_Form_Element_Submit('save');
        $submit->setAttribs(Array('class'=>'btn btn-success'));

        $reset= new Zend_Form_Element_Reset('reset');
        $reset->setAttribs(Array('class'=>'btn btn-danger'));

        $this->addElements(Array(
            $name,
            $cdesc,
            $image,
            $parent,
            $submit,
            $reset,
        ));
    }


}