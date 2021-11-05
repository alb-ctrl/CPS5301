<?php
require ("/home/bitnami/dbconfig.php");
include('mysqli_connect_Register.php');

// page will set the session variables after the user has clicked the link in the email
// sent to them and redirect them to the index page with their session variables set

$_SESSION['username'] = $username;
$_SESSION['password'] = $password;
header('location: index.php');

?>