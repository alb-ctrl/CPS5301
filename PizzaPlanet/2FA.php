<?php
require ("/home/bitnami/dbconfig.php");
// page will set the session variables after the user has clicked the link in the email
// sent to them and redirect them to the index page with their session variables set
session_start();

if(isset($_SESSION["code"])){
    $scode = $_POST["scode"];
    $c = $_SESSION["code"];
    if($c == $scode){
        header('location: index.php');
    }
    else{
        $count += 1;
        if($count < 4){
            echo "Incorrect Code check email for code click <a href='2fa-email-func.php'>here</a> to try again, Caution: you have 3 attempts";
        }
        else{
            echo "No more attempts click <a href='2fa-email-func.php'>here</a> to return to login";
            session_destroy();
        }
}
}
?>