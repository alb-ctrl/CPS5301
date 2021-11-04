<?php
    $pw1 = "";
    $pw2 = "";
    $email = "";

    if(isset($_POST['password1']) and isset($_POST['password2']) and isset($_POST['email']))
    {
        $pw1 = $_POST['password1'];
        $pw2 = $_POST['password2'];
        $email = $_POST['email'];

        $match = checkPasswordMatch($pw1, $pw2);
        $email_in_db = emailInDB($email);

        if($match and $email_in_db)
        {
            $message = "Password change successful!";
            
            updatePassword($email, $pw1);
            include "email_function.php";
            sendEmail($message, $email, "forgot_reset_password");
        }
        else if(!$match and $email_in_db)
        {
            echo("Email found in DB!<br>Passwords do not match. Please retype the same password.");
        }
        else if($match and !$email_in_db)
        {
            echo("Email not found in DB! Please ensure you're using the correct email."
                    ."<br>Passwords match!");
        }
        else
        {
            echo("Email not found in DB! Please ensure you're using the correct email."
                    ."<br>Passwords do not match. Please retype the same password.");
        }
    }
    else
    {
        echo("Please go back and ensure form has been completed properly");
    }
    
    function checkPasswordMatch($pw1, $pw2)
    {
        if(strcmp($pw1, $pw2) !== 0)#dont match
        {
            return false;
        }
        return true;
    }

    function emailInDB($email)
    {
        require ("/home/bitnami/dbconfig.php");
        $con = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR
            die("Could not connect to MySQL DB: ".mysqli_connect_error());
        
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($con, $query);

        if(mysqli_num_rows($result) > 0)
        {
            mysqli_close($con);
            return true;
        }
        mysqli_close($con);
        return false;
    }

    function updatePassword($email, $password)
    {
        require ("/home/bitnami/dbconfig.php");
        $con = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR
            die("Could not connect to MySQL DB: ".mysqli_connect_error());

        $pw = md5($password);

        $query = "UPDATE users SET password = '$pw' WHERE email = '$email'";
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
?>
