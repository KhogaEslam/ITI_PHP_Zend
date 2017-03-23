<?php

class Application_Form_Search extends ZendX_JQuery_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */


        $this->setMethod('POST');
        $search = new ZendX_JQuery_Form_Element_AutoComplete(
                "search", array('label' => 'serarch:')
            );




        $search->setJQueryParams(array('source' => array('New York',
                                             'Berlin',
                                             'Bern',
                                             'Boston')));




        // $Psearch = new Application_Model_Product();
        // $getproduct=$Psearch->displayproduct();
        


        $submit=new Zend_Form_Element_Submit('submit');
        $submit->setAttribs(array('class'=>'btn btn-success'));

        $this->addElements(array($search,$submit));


    }


}