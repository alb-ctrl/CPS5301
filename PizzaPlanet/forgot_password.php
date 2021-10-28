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
    sendEmail("", $email, "password");
?>
