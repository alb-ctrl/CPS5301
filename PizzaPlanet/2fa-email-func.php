<?php
require ("/home/bitnami/dbconfig.php");
$db = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR
	die('Coul not connect MySQL: ' . mysqli_connect_error () );
// $v_email = $_POST['v_email'];

// $v_sql = "SELECT * FROM users WHERE email='$v_email' LIMIT 1";
// $v_result = mysqli_query($db, $v_sql);

// if (mysqli_num_rows($v_result) == 0) {
//     echo "email is not associated with any registered account";
//     }

// else if (mysqli_num_rows($v_result) > 0) {
// sendEmail($v_email);

// }

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