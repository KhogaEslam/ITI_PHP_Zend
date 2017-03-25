<?php

class Application_Model_History extends Zend_Db_Table_Abstract
{
    protected $_name = 'history';
  

    public function product_statistics()
    {
      $sql=$this->select()
            ->from(['h'=>'history'],['sum(quantity) as quantity',"sum(h.price) as price"])
            ->joinInner(array('p'=>'product'),'p.id=h.pro_id',array('id','name','image','pdesc'))
            ->group('pro_id')
            ->setIntegrityCheck(false);
          //  echo $sql;
            //exit();
      $result=$sql->query()->fetchAll();
      return $result;
    }


}
