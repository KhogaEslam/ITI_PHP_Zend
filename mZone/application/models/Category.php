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
        $this->delete("id=$cat_id");
    }
    function categoryDetails($cat_id)
    {
        return $this->find($cat_id)->toArray()[0];
    }
    function updateCategory($cat_id,$formData, $image){
        $categoryData['parent']=$formData['parent'];
        $categoryData['name']=$formData['name'];
        $categoryData['cdesc']=$formData['cdesc'];
        $categoryData['image']=$image;

        $this->update($categoryData,"id=".$cat_id);
    }

    function addNewcategory($categoryData, $image)
    {
        $row = $this->createRow();
        $row->parent = $categoryData['parent'];
        $row->name= $categoryData['name'];
        $row->cdesc = $categoryData['cdesc'];
        $row->image = $image;
        $row->save();
    }

      function getParentCategories(){
      return $this->fetchAll('parent = 1')->toArray();
    }

    function getChildCategories($id){
      return $this->fetchAll($this->select()->where('parent = ?',$id))->toArray();
    }

    function getParentCategories(){
      return $this->fetchAll('parent = 1')->toArray();
    }

    function getChildCategories($id){
      return $this->fetchAll($this->select()->where('parent = ?',$id))->toArray();
    }

}
