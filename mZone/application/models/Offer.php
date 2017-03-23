<?php

class Application_Model_Offer extends Zend_Db_Table_Abstract
{
    protected $_name = 'offer';

    function listAll()
    {
        return $this->fetchAll()->toArray();
    }

    function createData($data)
    {
        $row = $this->createRow();
        $row->pro_id = $data['pro_id'];
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

