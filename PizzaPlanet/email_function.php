<?php

    function sendEmail($value, $email, $reason)
    {
        if($reason == 'username')//$value = username
        {
            $emailBody = "Your PizzaPlanet username is ".$value."<br>";
        }
        else if($reason == 'forgot_reset_password')//$value = message body
        //figure out how pass email/some value to reset_password.html so that we can verify the user for whom we change the password
        {
            $emailBody = $value;
        }
        /*else if($reason == 'confirm registration')//need to work on this
        {
            $emailBody = "<a href='verify_registration.php'>Click this link to verify your registration with Pizza Planet</a><br>"
        }*/
        require '/home/bitnami/PHPmailerconfig.php';
        $mail->IsHTML(true);
        $mail->AddAddress($email, $value);
        $mail->SetFrom("bitnamiaws@gmail.com", "Pizza Planet");
        $mail->Subject = "2FA";
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
