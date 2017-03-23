<?php

class Application_Model_Shopping extends Zend_Db_Table_Abstract
{
    protected $_name = 'shoppingcart';


public function addToCart($uid,$pid)
{
 	$check=$this->find($uid)->toArray();

 		 if(!empty($check))
	        {
	        	$product_model = new Application_Model_Product();
	          	$data = $product_model->find($pid)->toArray();
	        }
	        else{
	          	$row = $this->createRow();
		          $row->createRow();
		          $row->userid=$uid;
		          $row->productid=$pid;
		          $row->save();
	          }
}


	public function removeFromCart($uid,$pid)
	{
    
		$this->delete('product_id = '.$pid.' and user_id = '.$uid);
	}

   


}
