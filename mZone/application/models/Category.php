<?php

class Application_Model_Category extends Zend_Db_Table_Abstract
{
    protected $_name = 'category';


    function listCategory()
    {
        return $this->fetchAll()->toArray();
    }
    function deleteCategory($id)
    {
        $this->delete("id=$id");
    }
    function categoryDetails($id)
    {
        return $this->find($id)->toArray()[0];
    }
    function updateCategory($id,$formData){
        $categoryData['parent']=$formData['parent'];
        $categoryData['name']=$formData['name'];
        $categoryData['cdesc']=$formData['cdesc'];

        $this->update($categoryData,"id=".$id);
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

    function getParentCategories(){
      return $this->fetchAll('parent = 1')->toArray();
    }

    function getChildCategories($id){
      return $this->fetchAll($this->select()->where('parent = ?',$id))->toArray();
    }

}
