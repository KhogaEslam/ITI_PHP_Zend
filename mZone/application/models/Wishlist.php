<?php

class Application_Model_Wishlist extends Zend_Db_Table_Abstract
{
    protected $_name = 'wishlist';

    public function wishlist($user)
    {
        $sql = $this->select()
            ->from(['p' => 'product'], ['id', 'name', 'image'])
            ->joinInner(['w' => 'wishlist'], 'p.id=w.productid', [])
            ->where('w.userid = ?', $user)
            ->setIntegrityCheck(false);
        $result = $sql->query()->fetchAll();
        return $result;
    }

    public function add($user_id, $product_id)
    {
        $row = $this->createRow();
        $row->userid = $user_id;
        $row->productid = $product_id;
        $row->save();
    }

    public function deleteData($pid,$uid){
        $this->delete("userid=".$uid." and productid=".$pid);
    }
}