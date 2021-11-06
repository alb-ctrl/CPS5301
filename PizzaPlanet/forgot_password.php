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

    //get temporary password, store in db, send in email
    $temp_pwd = randomPassword();//getTempPwd($email);
    resetTempPwd($email, $temp_pwd);

    //message for email body
    $message = "Your temporary password for the account under ".$email." is now active.<br>".
                "Use <b>".$temp_pwd."</b> to access your account and choose to reset your password in the menu.<br>";
    //call send email method
    sendEmail($message, $email, "forgot_reset_password");

    /*
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
    */

    //reset temp pw in db
    function resetTempPwd($email, $new_temp_pwd)
    {
        require ("/home/bitnami/dbconfig.php");
        $con = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR
            die("Could not connect to MySQL DB: ".mysqli_connect_error());

        $query = "UPDATE users SET temp_password = '$new_temp_pwd' WHERE email = '$email'";
        $result = mysqli_query($con, $query);
    
        if($result)
        {
            if(mysqli_affected_rows($con) > 0)
            {
                echo("Successfully updated password!<br>");
            }
            else
            {
                echo("ERROR:<br><br>".mysqli_error($con));
            }
        }
        else
        {
            echo("ERROR:<br><br>".mysqli_error($con));
        }
        mysqli_close($con);
    }

    //generate a random password
    function randomPassword() 
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    
        //remember to declare $pass as an array
        $pass = array();
        //put the length -1 in cache
        $alphaLength = strlen($alphabet) - 1;

        for ($i = 0; $i < 8; $i++) 
        {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        
        //turn the array into a string
        return implode($pass);
    }
?>
