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
}