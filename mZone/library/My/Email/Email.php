<?php

namespace My\Email;

class Email
{
    //use My\Email\Email;
    //$Email = new Email();
    /*use Zend\Mail\Transport\Smtp;*/
    public function sendEmail(){
    /*
        $config = array('auth' => 'login',
            'username' => 'myusername',
            'password' => 'password');

        $transport = new Zend_Mail_Transport_Smtp('mail.server.com', $config);

        $mail = new Zend_Mail();
        $mail->setBodyText('This is the text of the mail.');
        $mail->setFrom('sender@test.com', 'Some Sender');
        $mail->addTo('recipient@test.com', 'Some Recipient');
        $mail->setSubject('TestSubject');
        $mail->send($transport);
*/
        /*
         * $smtpHost = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $config);
                $mail = new Zend_Mail();
                $mail->setBodyText($form->getValue('body'));
                $mail->setBodyHtml('<a href = "http://localhost:8080/certificate/certificate-image/id/' . $id . '">my link</a>');
                $mail->setFrom($certtime['email'], $certtime['first_name'] . $certtime['last_name']);
                $mail->addTo($form->getValue('reciever'));
                $mail->setSubject('My Certificate');
                $mail->send($smtpHost);
         * */

        /*
         * In Bootstrap.php, I configure a default mail transport:
         * protected function _initMail()
{
    try {
        $config = array(
            'auth' => 'login',
            'username' => 'username@gmail.com',
            'password' => 'password',
            'ssl' => 'tls',
            'port' => 587
        );

        $mailTransport = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $config);
        Zend_Mail::setDefaultTransport($mailTransport);
    } catch (Zend_Exception $e){
        //Do something with exception
    }
}


        **********************
         *
         *Prepare email
$mail = new Zend_Mail();
$mail->addTo($email);
$mail->setSubject($subject);
$mail->setBody($message);
$mail->setFrom('username@gmail.com', 'User Name');

//Send it!
$sent = true;
try {
    $mail->send();
} catch (Exception $e){
    $sent = false;
}

//Do stuff (display error message, log it, redirect user, etc)
if($sent){
    //Mail was sent successfully.
} else {
    //Mail failed to send.
}
         * */

        /*
         * //Prepare email
$mail = new Zend_Mail();
$mail->addTo($email);
$mail->setSubject($subject);
$mail->setBody($message);
$mail->setFrom('username@gmail.com', 'User Name');

//Send it!
$sent = true;
try {
    $mail->send();
} catch (Exception $e){
    $sent = false;
}

//Do stuff (display error message, log it, redirect user, etc)
if($sent){
    //Mail was sent successfully.
} else {
    //Mail failed to send.
}
         * */
    }

}

