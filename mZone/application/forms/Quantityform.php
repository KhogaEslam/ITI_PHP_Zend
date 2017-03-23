<?php

class Application_Form_Quantityform extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('POST');
		$quantity = new Zend_Form_Element_Select('quantity');
		$quantity->setLabel('Quantity: ');
		foreach($quantities as $key=>$value)
		{
			$quantity->addMultiOption('1','1');
			$quantity->addMultiOption('2','2');
			$quantity->addMultiOption('3','3');

		}
	}
}
