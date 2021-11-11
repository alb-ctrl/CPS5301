<?php
    include "email_function.php";

    $email = "";
    if(isset($_POST['email']))
    {
        $email = $_POST['email'];
    }
    else
    {
        echo("Please check email again");
    }
    sendEmail(getUsername($email), $email, "username");
    header( "refresh:3; url= login.php");
    echo "\nYou will be redirected to login in a few seconds";
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

?>
