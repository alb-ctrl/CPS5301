<?php
    $pw1 = "";
    $pw2 = "";
    $email = "";

    #passwords are from reset_password.html
    #email is from the form (post in email_function.php) and can be posted again from reset_password to change_password.php
    if(isset($_POST['password']) and isset($_POST['password_2']) and isset($_POST['email']))
    {
        $pw1 = $_POST['password'];
        $pw2 = $_POST['password_2'];
        $email = $_POST['email'];
        $match = checkPasswordMatch($pw1, $pw2);

        if($match)
        {
            require ("/home/bitnami/dbconfig.php");
            $con = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR
                die("Could not connect to MySQL DB: ".mysqli_connect_error());

            $password = md5($pw1);

            $query = "UPDATE users SET password = '$password' WHERE email = '$email'";
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
        else
        {
            echo("Passwords do not match. Please retype the same password.");
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
?>
