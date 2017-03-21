<?php

class Application_Model_Product extends Zend_Db_Table_Abstract
{
  protected $_name = 'product';
    public function displayproduct()
  	{
  		return $this->fetchAll()-> toArray();

	  }


//-----------------------------------------------------
    public function displayallproduct($catId)
    {

    
        // return $this->find($catId)->toArray()[0];
      // return $this->fetchAll("cat_id=".$catId.");


         $select = $this->select();
    $select->where('cat_id = ?', $catId);
    return $this->fetchAll($select)-> toArray();

    // $resultSet = $this->getDbTable()->fetchAll($select);





    }

    //------------------------------------

    public function productdetails($id)
  	{
  		return $this->find($id)->toArray();
  	}

   // function addNewproduct($productData)
   // 	{
   // 		$row = $this->createRow();
   // 		$row->image = $productData['image'];
   // 		$row->name= $productData['name'];
   // 		$row->name_ar= $productData['name_ar'];
   //     $row->pdesc = $productData['pdesc'];
   //     $row->pdesc_ar = $productData['pdesc_ar'];
   //     $row->price = $productData['price'];
   // 		$row->save();
   // 	}

    public function deleteproduct($id)
    	{
    		$this->delete("id=$id");
    	}

      function updateproduct($id,$formData,$image){

		  $productData['image']=$image;
		  $productData['name']=$formData['name'];
		  $productData['name_ar']=$formData['name_ar'];
		  $productData['pdesc']=$formData['pdesc'];
      $productData['pdesc_ar']=$formData['pdesc_ar'];
      $productData['price']=$formData['price'];
		  $this->update($productData,"id=".$id);
}

  public function createproduct($formData,$image){
    $row=$this->createRow();
    $row->image=$image;
    $row->name=$formData['name'];
    $row->name_ar=$formData['name_ar'];
    $row->pdesc=$formData['pdesc'];
    $row->pdesc_ar=$formData['pdesc_ar'];
    $row->price=$formData['price'];
  $row ->save();
  }

   public function updateRate($avgRate,$proId)
   {
      $productRate['rate']=$avgRate;

      $this->update($productRate,"id=".$proId);
   }


//----------------------


   public function searchByPname($name)
    {
      $select = $this->select();
    $select->where('name like ?', "%".$name."%");
    //$select->order('votes DESC');

    //$resultSet = $this->getDbTable()->fetchAll($select);
        return $this->fetchAll($select)-> toArray();
    }


}
