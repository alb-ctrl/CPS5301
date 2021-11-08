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
            //update password
            updatePassword($email, $pw1);
            //change temp password
            resetTempPwd($email);
            
            //send email
            $message = "Password change successful!";
            include "email_function.php";
            sendEmail($message, $email, "forgot_reset_password");
            
            //redirect user to login
            header( "refresh:5; url= index.php");
            echo("You successfully changed password<br>You will be redirected to the pizza planet home page in 5 seconds...");
        }
        else if(!$match and $email_in_db)
        {
            header( "refresh:5; url= ../reset_password.html");
            echo("You will be redirected to the reset password page in 5 seconds...<br><br>");
            echo("Email found in DB!<br>Passwords do not match. Please retype the same password.");
        }
        else if($match and !$email_in_db)
        {
            header( "refresh:5; url= ../reset_password.html");
            echo("You will be redirected to the reset password page in 5 seconds...<br><br>");
            echo("Email not found in DB! Please ensure you're using the correct email."
                    ."<br>Passwords match!");
        }
        else
        {
            header( "refresh:5; url= ../reset_password.html");
            echo("You will be redirected to the reset password page in 5 seconds...<br><br>");
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

    //reset temp pw in db
    function resetTempPwd($email)
    {
        $new_temp_pwd = md5(randomPassword());

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
