<?php

class Application_Model_Wishlist extends Zend_Db_Table_Abstract
{
    protected $_name = 'wishlist';
    public function wishlist($id)
    {
      return $this->fetchAll('userid="1"')->toArray();
    }

}
