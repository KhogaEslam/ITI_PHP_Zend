<?php

class Application_Model_Rate extends Zend_Db_Table_Abstract
{
    protected $_name = 'rate';


	 public function getAllrates(){
 	 return $this->fetchAll()->toArray();
}
}
