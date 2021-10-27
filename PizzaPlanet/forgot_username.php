<?php
    $email = "";
    if(isset($_POST['email']))
    {
        $email = $_POST['email'];
    }
    else
    {
        echo("Please check email again");
    }
    sendEmail(getUsername($email), $email);

    function getUsername($email)
    {
        $username = "";

        require ("/home/bitnami/dbconfig.php");
        $con = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR
            die("Could not connect to MySQL DB: ".mysqli_connect_error());

        $query = "SELECT username FROM users WHERE email = '$email'";
        $result = mysqli_query($con, $query);

        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $username = $row['username'];
            }
        }
        mysqli_close($con);

        return $username;
    }

    function sendEmail($username, $email)
    {
        $emailBody = "Your PizzaPlanet username is ".$username."<br>";

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