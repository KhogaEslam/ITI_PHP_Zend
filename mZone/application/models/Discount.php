<?php

class Application_Model_Discount extends Zend_Db_Table_Abstract
{
    protected $_name = 'discount';
    function listAll()
    {
        return $this->fetchAll()->toArray();
    }

    function createData($data)
    {
        $row = $this->createRow();
        $row->user_id = $data['user_id'];
        $row->code = $data['code'];
        $row->start_date = $data['start_date'];
        $row->end_date = $data['end_date'];
        $row->percentage = $data['percentage'];
        $row->save();
    }

    function retrieveData($id)
    {
        return $this->find($id)->toArray();
    }

    function delete($id)
    {
        $this->delete("id=$id");
    }

    function updateData($id, $data)
    {
        $new_data['name'] = $data['name'];

        $this->update($new_data, "id = $id");
    }
}

