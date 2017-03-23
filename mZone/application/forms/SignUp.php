<?php

class Application_Form_SignUp extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */


    	 $this->setMethod('post');
        $msg = new Zend_Form_Element_Note('msg');
//  set name 
    	 $name=new Zend_Form_Element_Text('name');
        $name->setLabel('Name in English: ')
        ->setRequired(true)
        ->addFilter('StringTrim')
        ->addValidator('StringLength',false, Array(3,20));
        $name->setAttribs(array('class'=>'form-control','placeholder'=>'your Name in Engish'));


// set name_ar

        $name_ar=new Zend_Form_Element_Text('name_ar');
        $name_ar->setLabel('Name in Arabic: ');
        $name_ar->setAttribs(array('class'=>'form-control','placeholder'=>'your Name in Arabic'));
        $name_ar->setRequired();
        $name_ar->addValidator('StringLength', false, Array(3,10));
        $name_ar->addFilter('StringTrim');


// username
        $username=new Zend_Form_Element_Text('username');
        $username->setLabel('userName: ');
        $username->setAttribs(array('class'=>'form-control','placeholder'=>'username'));
        $username->setRequired();
        $username->addValidator('StringLength', false, Array(3,10));
        $username->addFilter('StringTrim');



        $email=new Zend_Form_Element_Text('email');
        $email->setLabel('Email: ');
        $email->setAttribs(array('class'=>'form-control','placeholder'=>'example@mZone.com'));
        $email->setRequired();
        $email->addValidator('StringLength', false, Array(10,50));
        $email->addValidator('EmailAddress',  TRUE  );
        $email->addFilter('StringTrim');

        $password=new Zend_Form_Element_Password('password');
        $password->setLabel('password: ');
        $password->setAttribs(array('class'=>'form-control','requireAlpha' => 'true','requireNumeric' => 'true','minPasswordLength' => 8));
        $password->addValidator('StringLength', false, Array(8,50));
        $v=new Zend_Validate_Alnum();
        $password->addValidator($v);
        // $password->addValidator('Alnum');
        // $password->addValidator('Regex', false, 
        //              array('/^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$/'));

        // $v = new Zend_Validate_Alnum();
        // $password->addValidator($v);


        $re_password=new Zend_Form_Element_Password('re_password');
        $re_password->setLabel('re_password: ');
        $re_password->setAttribs(array('class'=>'form-control'));



        $check_equal=new Zend_Validate_Identical("password");
        $re_password->addValidator($check_equal);



        $submit=new Zend_Form_Element_Submit('submit');
        $submit->setAttribs(array('class'=>'btn btn-success'));





        $reset=new Zend_Form_Element_Reset('reset');
        $reset->setAttribs(array('class'=>'btn btn-danger'));



      $this->addElements(array($msg, $name,$name_ar,$username,$email,$password,$re_password,$submit,$reset));


    }


}

