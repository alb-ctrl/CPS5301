<?php
require ("/home/bitnami/dbconfig.php");
function secureCode() 
    {
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    
        $pass = array();
        //put the length -1 in cache
        $alphaLength = strlen($alphabet) - 1;

        for ($i = 0; $i < 4; $i++) 
        {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        
        //turn the array into a string
        return implode($pass);
    }


function sendAEmail($v_email,$username,$code)
    {
        require '/home/bitnami/PHPmailerconfig.php';
        $mail->IsHTML(true);
        $mail->AddAddress($v_email, $username);
        $mail->SetFrom("bitnamiaws@gmail.com", "Pizza Planet");
        $mail->Subject = "2FA";
        $content = "Hello user ".$username." here is your secure code: ".$code."";
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
<form action="2FA.php" method="POST">
    Please check your email for your secure code

    Enter Secure Code
    <input type="text" name = "scode">
    <button type="submit">Submit</button>
</form>