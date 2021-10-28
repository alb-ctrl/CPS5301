<?php

    function sendEmail($un, $email, $reason)
    {
        $emailBody = '';

        if($reason == 'username')
        {
            $emailBody = "Your PizzaPlanet username is ".$un."<br>";
        }
        else if($reason == 'password')
        //figure out how pass email/some value to reset_password.html so that we can verify the user for whom we change the password
        {
            #$emailBody = "<a href='reset_password.html'>Click this link to reset your password</a><br>";
            $emailBody = "Click the submit button to reset your password<br>".
                            "<form action='reset_password.html' method='post'>".
                                "<input type='hidden' name='email' value='".$email."'/>".
                                "<input type='submit' name='submit'>".
                            "</form><br>";
        }
        else if($reason == 'confirm registration')//need to work on this
        {
            $emailBody = "<a href='verify_registration.php'>Click this link to verify your registration with Pizza Planet</a><br>"
        }

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
    }
?>
