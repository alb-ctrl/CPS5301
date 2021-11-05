<?php
require ("/home/bitnami/dbconfig.php");

$v_email = $_POST['v_email'];

$v_sql = "SELECT * FROM users WHERE email='$v_email' LIMIT 1";
$v_result = mysqli_query($db, $user_check_query);
$v_row = mysqli_fetch_array($result);

if ($v_result) {
    if (strcmp($row['email'],$v_email) == 0) {
        echo "email is not associated with any registered account";
    }

    else if (strcmp($row['email'],$v_email) == 1) {
    sendEmail($v_email);
    }
}

function sendEmail($v_email)
    {
        $v_emailBody = 'Hello user: '.$v_email.' Please click link to enter your account
        "<a href="http://3.82.35.248/CPS5301/PizzaPlanet/2FA.php"> click here </a> "';

        $v_body = '{
            "subject": "From Pizza Planet",
            "to": [
            {
                "email": "'.$v_email.'"
            }
            ],
            "from": [
            {
                "email": "developing5301@gmail.com",
                "name": "Pizza Planet"
            }
            ],
            "body": "'.$v_emailBody.'"
        }';
        
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, 'https://api.nylas.com/send');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $v_body);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization: Bearer n9W8GxAT6wkdF2CAYu5ZFOnM9QUXkM','cache-control: no-cache' ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $v_result = curl_exec($ch);
        
        echo("Check your email to complete the verification process");
    }
?>
    <!--form that will ask the user to enter their email account -->
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>2FA</title>
    </head>
    <body>
        <form action="2fa-email.php" method="POST">
            Enter Email associated with account
            <input type="text" name = "v_email">
            <button type="submit">Submit</button>
        </form>
    </body>
    </html>




