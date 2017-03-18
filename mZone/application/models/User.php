<?php

class Application_Model_User extends Zend_Db_Table_Abstract
{
    protected $_name = 'user';
    function listAll()
    {
        return $this->fetchAll()->toArray();
    }


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
    function createData($data)
    {
        $row = $this->createRow();
        $row->name = $data['name'];
        $row->name_ar = $data['name_ar'];
        $row->username = $data['username'];
        $row->email = $data['email'];
        $row->password = $data['password'];
        $row->type = $data['type'];
        $row->isBlocked = $data['isBlocked'];
        $row->save();
    }

    function retrieveData($id)
    {
        return $this->find($id)->toArray();
    }

    function deleteData($id)
    {
        $this->delete("id=$id");
    }

    function updateData($id, $data)
    {
        $new_data['name'] = $data['name'];
        $new_data['name_ar'] = $data['name_ar'];
        $new_data['username'] = $data['username'];
        $new_data['email'] = $data['email'];
        $new_data['password'] = $data['password'];
        $new_data['type'] = $data['type'];
        $new_data['isBlocked'] = $data['isBlocked'];

        $this->update($new_data, "id = $id");
    }

    function block($id)
    {
        $new_data['isBlocked'] = 1;
        $this->update($new_data, "id = $id");
    }

    function unblock($id)
    {
        $new_data['isBlocked'] = 0;
        $this->update($new_data, "id = $id");
    }

    function makeShopUser($id)
    {
        $new_data['type'] = 2;
        $this->update($new_data, "id = $id");
    }

    function deleteShopUser($id)
    {
        $new_data['type'] = 3;
        $this->update($new_data, "id = $id");
    }

    function makeAdminUser($id)
    {
        $new_data['type'] = 1;
        $this->update($new_data, "id = $id");
    }

    function deleteAdminUser($id)
    {
        $new_data['type'] = 3;
        $this->update($new_data, "id = $id");
    }
}


