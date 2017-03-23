<?php

class ShoppingController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function addAction()
    {
        // action body
         //$form = new Application_Form_Quantityform();
        $user_id=$this->_request->getParam("uid");
        $product_id=$this->_request->getParam('pid');
        $shopping_model = new Application_Model_Shopping();

    }

    public function removeAction()
    {
        // action body
        $user_id=$this->_request->getParam("uid");
        $product_id=$this->_request->getParam('pid');
        $shopping_model = new Application_Model_Shopping();
        $shopping_model-> removeFromCart($user_id,$product_id);
    }
	
	public function purchaseBill()
	{
		$total = $total +($values ["quantity"] * $values["price"]);
	}
	
	 public function sendEmail($emailTo,$emailToName,$totalPrice){
    	$emailObj = new Application_Model_Email();
        $emailObj->sendEmail($user['email'],$user['name'],$data['price']);
		
        $yourGmailAccountUsername = 'mzonenotamazon@gmail.com';
        $yourGmailAccountPassword = 'OurGreateApp';

        $emailBody = "Hello Mr ".$emailToName."
        <br>Thanks For Shopping From Our mZone Store, Your Total Bill".$totalPrice."<br>";
         
       	$emailSubject = '[mZone] YOur Bill:';

        try {
            $config = array('ssl' => 'tls',
                'auth' => 'login',
                'username' => $yourGmailAccountUsername,
                'password' => $yourGmailAccountPassword);

            $transport = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $config);


            $mail = new Zend_Mail();

            $mail->setBodyHtml($emailBody);
            $mail->setFrom($yourGmailAccountUsername);
            $mail->addTo($emailTo, $emailToName);
            $mail->setSubject($emailSubject);
            if ($mail->send($transport)) {
                echo 'Sent successfully';
            } else {
                echo 'unable to send email';
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }

}
