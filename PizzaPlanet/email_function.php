<?php

    function sendEmail($value, $email, $reason)
    {
        $emailBody = '';

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

        $body = '{
            "subject": "From Pizza Planet",
            "to": [
            {
                "email": "'.$email.'",
                "name": "padat30258 "
            }
            ],
            "from": [
            {
                "email": "developing5301@gmail.com",
                "name": "Pizza Planet"
            }
            ],
            "body": "'.$emailBody.'"
        }';
        
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, 'https://api.nylas.com/send');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization: Bearer n9W8GxAT6wkdF2CAYu5ZFOnM9QUXkM','cache-control: no-cache' ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Fire!
        //$result = htmlspecialchars_decode(curl_exec($ch));
        $result = curl_exec($ch);
        
        echo("An email has been sent to ".$email."<br>Account recovery should be ready in an hour");
    }
?>
