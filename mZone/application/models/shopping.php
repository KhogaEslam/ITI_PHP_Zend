<?php

class Application_Model_Shopping extends Zend_Db_Table_Abstract
{
    protected $_name = 'shoppingcart';


public function addToCart($uid,$pid)
{
 $check=$this->find($uid,$pid)->toArray();

  if(!empty($check))
	        {
	          echo "already added before";
	          // $row->quentity=
	        }
	        else{
	          //addNewproduct
	          $row->createRow();
	          $row->userid=$uid;
	          $row->productid=$pid;
	          $row->save();
	          echo"sucessfully added";
	          }
}


	public function removeCart($uid,$pid)
	{

		$row->delete("productid=$product_id");
	}




}