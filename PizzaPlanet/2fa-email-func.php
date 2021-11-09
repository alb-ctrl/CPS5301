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


function sendAEmail($v_email,$username)
    {
        require '/home/bitnami/PHPmailerconfig.php';
        $mail->IsHTML(true);
        $mail->AddAddress($v_email, $username);
        $mail->SetFrom("bitnamiaws@gmail.com", "Pizza Planet");
        $mail->Subject = "Test is Test Email sent via Gmail SMTP Server using PHP Mailer";
        $content = "<b>This is a Test Email sent via Gmail SMTP Server using PHP mailer class.</b>";
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