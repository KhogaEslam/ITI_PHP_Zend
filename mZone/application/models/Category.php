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

    function addNewcategory($categoryData,$image)
    {
        $row = $this->createRow();
        $row->image=$image;
        $row->parent = $categoryData['parent'];
        $row->name= $categoryData['name'];
        $row->cdesc = $categoryData['cdesc'];
        $row->save();
    }

      function getParentCategories(){
      return $this->fetchAll('parent = 1')->toArray();
    }

    function getChildCategories($id){
      return $this->fetchAll($this->select()->where('parent = ?',$id))->toArray();
    }


}

