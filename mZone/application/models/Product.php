<?php

class Application_Model_Product extends Zend_Db_Table_Abstract
{
  protected $_name = 'product';

  protected $shop_user_id;

    public function displayproduct()
  	{
  		return $this->fetchAll()-> toArray();

	  }

    public function productdetails($id)
  	{
  		return $this->find($id)->toArray()[0];
  	}

   function addNewproduct($productData,$image)
   	{
        $this->shop_user_id = Application_Model_CurrentUser::getCurrentUserID();
   		$row = $this->createRow();
   		$row->image = $image;
   		$row->name= $productData['name'];
   		$row->name_ar= $productData['name_ar'];
       $row->pdesc = $productData['pdesc'];
       $row->pdesc_ar = $productData['pdesc_ar'];
       $row->price = $productData['price'];
       $row->cat_id = $productData['cat_id'];
       $row->shop_user_id = $this->shop_user_id;
   		$row->save();
   	}

    public function deleteproduct($id)
    	{
    		$this->delete("id=$id");
    	}

      function updateproduct($id,$formData,$image){
          $this->shop_user_id = Application_Model_CurrentUser::getCurrentUserID();
		  $productData['image']=$image;
		  $productData['name']=$formData['name'];
		  $productData['name_ar']=$formData['name_ar'];
		  $productData['pdesc']=$formData['pdesc'];
          $productData['pdesc_ar']=$formData['pdesc_ar'];
          $productData['price']=$formData['price'];
          $productData['cat_id']=$formData['cat_id'];
          $productData['shop_user_id'] = $this->shop_user_id;
		  $this->update($productData,"id=".$id);
}

  public function createproduct($formData,$image){
      $this->shop_user_id = Application_Model_CurrentUser::getCurrentUserID();
    $row=$this->createRow();
    $row->image=$image;
    $row->name=$formData['name'];
    $row->name_ar=$formData['name_ar'];
    $row->pdesc=$formData['pdesc'];
    $row->pdesc_ar=$formData['pdesc_ar'];
    $row->price=$formData['price'];
    $row->cat_id=$formData['cat_id'];
      $row->shop_user_id = $this->shop_user_id;
  $row ->save();
  }


  public function shopProducts(){
      $this->shop_user_id = Application_Model_CurrentUser::getCurrentUserID();
      return $this->fetchAll('shop_user_id = '.$this->shop_user_id);
  }
}
