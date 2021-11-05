<?php
    //send user a temporary password to access their account

    include "email_function.php";

    $email = "";
    //check if email is submitted from form
    if(isset($_POST['email']))
    {
        $email = $_POST['email'];
    }
    else
    {
        echo("Please check email address again");
    }

    //get temporary password
    $temp_pwd = getTempPwd($email);

    //message for email body
    $message = "Your temporary password for the account under ".$email." is now active.<br>".
                "Use <b>".$temp_pwd."</b> to access your account and choose to reset your password in the menu.<br>";
    //call send email method
    sendEmail($message, $email, "forgot_reset_password");

    //get temp pw from db
    function getTempPwd($email)
    {
        $temp_pwd = "";

        require ("/home/bitnami/dbconfig.php");
        $con = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR
            die("Could not connect to MySQL DB: ".mysqli_connect_error());

        $query = "SELECT temp_password FROM users WHERE email = '$email'";
        $result = mysqli_query($con, $query);

        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $temp_pwd = $row['temp_password'];
            }
        }
        mysqli_close($con);

        return $temp_pwd;
    }
?>
