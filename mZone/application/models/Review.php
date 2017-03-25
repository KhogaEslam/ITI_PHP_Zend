<?php

class Application_Model_Review extends Zend_Db_Table_Abstract
{
    protected $_name = 'review';

    function listAll()
    {
        return $this->fetchAll()->toArray();
    }

    function createData($data)
    {
        $row = $this->createRow();
        $row->user_id = (int)$data['user_id'];
        $row->product_id = (int)$data['product_id'];
        $row->comment = $data['comment'];
        $row->date = new Zend_Db_Expr('NOW()');
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
        $new_data['comment'] = $data['comment'];

        $this->update($new_data, "id = $id");
    }

    function getProductReviews($pid){
        return $this->fetchAll($this->select()->where('product_id = ?', $pid))->toArray();
    }
}

