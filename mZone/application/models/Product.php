<?php

class Application_Model_Product extends Zend_Db_Table_Abstract
{
  protected $_name = 'product';
    public function displayproduct()
  	{
  		return $this->fetchAll()-> toArray();

	  }

    public function productdetails($id)
  	{
  		return $this->find($id)->toArray()[0];
  	}

   function addNewproduct($productData)
   	{
   		$row = $this->createRow();
   		$row->image = $productData['image'];
   		$row->name= $productData['name'];
   		$row->name_ar= $productData['name_ar'];
       $row->pdesc = $productData['pdesc'];
       $row->pdesc_ar = $productData['pdesc_ar'];
       $row->price = $productData['price'];
   		$row->save();
   	}

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

  public function TopProducts(){
    $query = "SELECT pcat.id,
                ( 
                  Select  product.id from product
                  left join category on category.id = product.cat_id
                  where product.id = 
                  (
                    select pro_id from history 
                    left join product as p on p.id = pro_id 
                    left join category as c on c.id = p.cat_id 
                    where c.id = pcat.Id 
                    GROUP by pro_id ,c.id 
                    order by SUM(quantity) 
                    DESC LIMIT 1 
                  ) 
                )
                as productID
            FROM category as pcat";

    $db = Zend_Db_Table::getDefaultAdapter();
    $stmt = $db->query($query);
    $data = $stmt->fetchAll();
    // echo "<pre>";
    // var_dump($data);
    // echo "</pre>";
    // exit;
    
    return $data;
  }
}
