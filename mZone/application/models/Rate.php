<?php

class Application_Model_Rate extends Zend_Db_Table_Abstract
{
    protected $_name = 'rate';


    public function getAllrates()
    {
        return $this->fetchAll()->toArray();
    }


    public function addRate($rate, $uid, $pid)
    {
        if(!$this->fetchRow("pro_id = $pid and user_id = $uid")) {
            $row = $this->createRow();
            $row->pro_id = $pid;
            $row->user_id = $uid;
            $row->rate = $rate;
            $row->save();
        }
        else{
            $new = array();
            $new['rate'] = $rate;
            $old = array();
            $old['pro_id'] = (int)$pid;
            $old['user_id'] = (int)$uid;
            $this->update($new,"pro_id = $pid and user_id = $uid");
        }
    }


//---------------------------
    public function searchByPname($name)
    {
        return $this->fetchAll("name = '$name'")->toArray();
    }

    public function totalProductRate($pid){

    }
}
