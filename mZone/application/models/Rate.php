<?php

class Application_Model_Rate extends Zend_Db_Table_Abstract
{
    protected $_name = 'rate';


	 public function getAllrates(){
 	 return $this->fetchAll()->toArray();
}


	public function addRate($rate,$uid,$pid)
	{
 $row=$this->createRow();
    $row->pro_id=$pid;
    $row->user_id=$uid;
    $row->rate=$rate;
    
  $row ->save();
  }



//---------------------------
   public function searchByPname($name)
   {

     return $this->fetchAll("name = '$name'")->toArray();

   }
	


}
