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
        $body = "Your PizzaPlanet username is ".$username."<br>";
        $output = shell_exec('curl -X POST \
        \'https://api.nylas.com/send\' \
        -H \'Authorization: Bearer n9W8GxAT6wkdF2CAYu5ZFOnM9QUXkM\' \
        -H \'Content-Type: application/json\' \
        -H \'cache-control: no-cache\' \
        --data-raw \'{
            "subject": "From Nylas",
            "to": [
                {
                    "email": '$email',
                    "name": "Customer"
                }],
            "from": [
                {
                    "email": "ragothaa@kean.edu",
                    "name": "PizzaPlanet"
                }],
            "body": '$body'
        }\'');
    }
?>