<?php

class Application_Model_Product extends Zend_Db_Table_Abstract
{
    protected $_name = 'product';

    function listAll()
    {
        return $this->fetchAll()->toArray();
    }

    function createData($data)
    {
        $row = $this->createRow();
        $row->name = $data['name'];
        $row->name_ar = $data['name_ar'];
        $row->price = $data['price'];
        $row->rate = $data['rate'];
        $row->image = $data['image'];
        $row->pdesc = $data['pdesc'];
        $row->pdesc_ar = $data['pdesc_ar'];
        $row->cat_id = $data['cat_id'];
        $row->shop_user_id = $data['shop_user_id'];
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
        $new_data['name_ar'] = $data['name_ar'];
        $new_data['price'] = $data['price'];
        $new_data['rate'] = $data['rate'];
        $new_data['image'] = $data['image'];
        $new_data['pdesc'] = $data['pdesc'];
        $new_data['pdesc_ar'] = $data['pdesc_ar'];
        $new_data['shop_user_id'] = $data['shop_user_id'];

        $this->update($new_data, "id = $id");
    }

}

