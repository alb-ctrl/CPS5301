<?php
require ("/home/bitnami/dbconfig.php");
// page will set the session variables after the user has clicked the link in the email
// sent to them and redirect them to the index page with their session variables set
session_start();

if(isset($_SESSION["code"])){
    $scode = $_POST["scode"];
    $c = $_SESSION["code"];
    if($c == $scode){
        $_SESSION["verify"] = "verify";
        header('location: index.php');
    }
    else{
        echo "Incorrect entry click <a href='index.php'>here</a> to return to login";
        session_destroy();
}
}
?>