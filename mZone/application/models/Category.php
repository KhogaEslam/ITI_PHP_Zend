<?php

class Application_Model_Category extends Zend_Db_Table_Abstract
{
    protected $_name = 'category';
    function listAll()
    {
        return $this->fetchAll()->toArray();
    }

    function createData($data)
    {
        $row = $this->createRow();
        $row->name = $data['name'];
        $row->cdesc = $data['cdesc'];
        $row->parent = $data['parent'];

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
        $new_data['cdesc'] = $data['cdesc'];
        $new_data['parent'] = $data['parent'];

        $this->update($new_data, "id = $id");
    }
}

