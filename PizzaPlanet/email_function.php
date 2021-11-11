<?php

    function sendEmail($value, $email, $reason)
    {
        if($reason == 'username')//$value = username
        {
            $emailBody = "Your PizzaPlanet username is ".$value."<br>";
        }
        else if($reason == 'forgot_reset_password')//$value = message body
        {
            $emailBody = $value;
        }
        require '/home/bitnami/PHPmailerconfig.php';
        $mail->IsHTML(true);
        $mail->AddAddress($email, $value);
        $mail->SetFrom("bitnamiaws@gmail.com", "Pizza Planet");
        $mail->Subject = "Account Recovery";
        $content = $emailBody;
        $mail->MsgHTML($content);
        if(!$mail->Send()) {
            echo "Error while sending Email.";
            var_dump($mail);
        }
        else {
            echo "Email sent successfully";
        }
    }
?>
