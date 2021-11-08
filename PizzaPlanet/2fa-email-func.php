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


function sendAEmail($v_email, $code)
    {
        $v_emailBody = 'Hello user: '.$v_email.' code: '.$code.'';

        $v_body = '{
            "subject": "From Pizza Planet",
            "to": [
            {
                "email": "'.$v_email.'",
                "name": "test"
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
        curl_close($ch);
        echo("Check your email to complete the verification process");
    }
?>