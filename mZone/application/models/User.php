<?php

class Application_Model_User extends Zend_Db_Table_Abstract
{
    protected $_name = 'user';



  function Register($formData)
	{

	$row=$this->createRow();
	$row->name=$formData['name'];
	$row->name_ar=$formData['name_ar'];
	$row->username=$formData['username'];
	$row->email=$formData['email'];
	$row->password=$formData['password'];
	$row->save();

	}




	 function InsertFB($fbData)
	 {

// email and pass not correct just for test insert operation for facebook data
     

    // no rows found
	$row=$this->createRow();
	
    
	$row->name=$fbData['first_name'];
	$row->name_ar=$fbData['last_name'];
	$row->username=$fbData['first_name'];
	$row->email=$fbData['gender'];
	$row->password=$fbData['gender'];


	$row->save();


	 }
}