<?php

class Application_Form_Productform extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('POST');
        $name = new Zend_Form_Element_Text('name');
    		$name->setLabel('EN Name: ');
    		$name->setAttribs(Array(

    					'class'=>'form-control'

    		));
    			$name->setRequired();
    			$name->addFilter('StringTrim');


          $name_ar = new Zend_Form_Element_Text('name_ar');
          $name_ar->setLabel('Ar.Name: ');
          $name_ar->setAttribs(Array(

                'class'=>'form-control'
          ));
            $name_ar->setRequired();
            $name_ar->addFilter('StringTrim');


            $pdesc = new Zend_Form_Element_Text('pdesc');
            $pdesc->setLabel('EN.Description: ');
            $pdesc->setAttribs(Array(

                  'class'=>'form-control'

            ));
              $pdesc->setRequired();
              $pdesc->addFilter('StringTrim');


              $pdesc_ar= new Zend_Form_Element_Text('pdesc_ar');
              $pdesc_ar->setLabel('Ar.Description: ');
              $pdesc_ar->setAttribs(Array(

                    'class'=>'form-control'

              ));
                $pdesc_ar->setRequired();
                $pdesc_ar->addFilter('StringTrim');

                $price= new Zend_Form_Element_Text('price');
                $price->setLabel('Price:');
                $price->setRequired();
                $price->addFilter('StringTrim');

                $uploadDir = APPLICATION_PATH.'/../public/images';
                $image = new Zend_Form_Element_File('image');
                $image
                ->setRequired(true)
                ->setLabel('Select the file to upload:')
                ->setDestination($uploadDir)
                ->addValidator('Count', false, 1) // ensure only 1 file
                ->addValidator('Size', false, 2097152) // limit to 2MB
                ->addValidator('Extension', false, 'jpeg,png,jpg')
                ->addFilter('Rename', implode('_',
                                  array($this->_user_id,
                                    $this->_upload_category,
                                    date('YmdHis'))))
                ->addValidator('NotExists', false, $uploadDir);

                $cat_id = new Zend_Form_Element_Select('cat_id');
                $cat_id->setLabel('Category: ');
                $modelObj = new Application_Model_Category();
                $categories = $modelObj->getParentCategories();
                $cat_id->addMultiOption(1,"mZone");
                foreach ($categories as $key => $value) {
                  $cat_id->addMultiOption($value['id'],"- ".$value['name']);
                  $child_cats = $modelObj->getChildCategories($value['id']);
                  foreach ($child_cats as $keyc => $valuec) {
                    $cat_id->addMultiOption($valuec['id'],"-- ".$valuec['name']);
                  }
                }
                $cat_id->setAttribs(Array(
                    'placeholder'=>'Example:this category includes phones and labtops',
                    'class'=>'form-control'

                ));
                $cat_id->setRequired();
                $cat_id->addFilter('StringTrim');

                $submit= new Zend_Form_Element_Submit('save');
			          $submit->setAttribs(Array('class'=>'btn btn-success'));

          			$reset= new Zend_Form_Element_Reset('reset');
          			$reset->setAttribs(Array('class'=>'btn btn-danger'));


               $this->addElements(Array(
                 $image,
                 $name,
                 $name_ar,
                 $pdesc,
                 $pdesc_ar,
                 $price,
                 $cat_id,
                 $submit,
                 $reset,
   ));
    }


}
