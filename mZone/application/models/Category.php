<?php

class Application_Model_Category extends Zend_Db_Table_Abstract
{
    protected $_name = 'category';


    function listCategory()
    {
        return $this->fetchAll()->toArray();
    }
    function deleteCategory($cat_id)
    {
        $this->delete("cat_id=$cat_id");
    }
    function categoryDetails($cat_id)
    {
        return $this->find($cat_id)->toArray()[0];
    }
    function updateCategory($cat_id,$formData){
        $categoryData['parent']=$formData['parent'];
        $categoryData['cname']=$formData['cname'];
        $categoryData['cdesc']=$formData['cdesc'];

        $this->update($categoryData,"cat_id=".$cat_id);
    }

    function addNewcategory($categoryData)
    {
        $row = $this->createRow();
        $row->parent = $categoryData['parent'];
        $row->cname= $categoryData['cname'];
        $row->cdesc = $categoryData['cdesc'];
        $row->save();
    }


}

