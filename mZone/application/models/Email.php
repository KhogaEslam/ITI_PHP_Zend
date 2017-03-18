<?php

class Application_Model_Email
{
    public function sendEmail($emailTo,$emailToName,$percentage, $code, $startDate="", $endDate=""){
        /** Must fill Following detail * */
        $yourGmailAccountUsername = 'mzonenotamazon@gmail.com';
        $yourGmailAccountPassword = 'OurGreateApp';
        /** Must fill Following detail * */

        /** Optional Detail * */
        $emailBody = "Hello Mr ".$emailToName."
        <br>We have made a discount for you with amount of ".$percentage." % for the upcoming purchase
        Order.<br>
        write this in discount field when purchasing next time :-<br>
        <center><strong>".$code."</strong></center>";
        $emailSubject = '[mZone] We have new discount for you';
        /** Optional Detail * */

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

