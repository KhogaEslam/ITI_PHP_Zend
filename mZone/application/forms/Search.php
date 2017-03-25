<?php

class Application_Form_Search extends ZendX_JQuery_Form
{

    public $processed = false;
    public function init()
    {
        /* Form Elements & Other Definitions Here ... */

        $this->setAttribs(array('class'=>''));
        $this->setMethod('POST');
        $search = new ZendX_JQuery_Form_Element_AutoComplete('search');
        $search->setAttribs(array('class'=>'search'));


        $table = new Application_Model_Product();
        $select = $table->select();
        $select->from($table, array('name'));
        $searchp = array();
        $cats = $table->fetchAll($select)->toArray();
        foreach ($cats as $value){
            array_push($searchp,$value['name']);
        }
        $search->setJQueryParams(array('source' => $searchp));

        $cat_id = new Zend_Form_Element_Select('cat_id');
        $cat_id->setAttribs(array('class'=>'section_room frm-field'));
        $modelObj = new Application_Model_Category();
        $categories = $modelObj->getParentCategories();
        $cat_id->addMultiOption(1,"mZone");
        foreach ($categories as $key => $value) {
            $cat_id->addMultiOption($value['id'],"- ".$value['name']);
            $child_cats = $modelObj->getChildCategories($value['id']);
            foreach ($child_cats as $keyc => $valuec) {
                $cat_id->addMultiOption($valuec['id'],"-- ".$valuec['name']);
            }
        }

        $submit=new Zend_Form_Element_Submit('submit');
        $submit->setAttribs(array('class'=>'sear-sub'));

        $this->addElements(array($search,$cat_id,$submit));
        echo "<div class=\"clearfix\"></div>";


    }


}