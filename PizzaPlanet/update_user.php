<?php

require ("/home/bitnami/dbconfig.php");
$db = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR
        die('Coul not connect MySQL: ' . mysqli_connect_error () );
    // Set the encoding...
    mysqli_set_charset($db, 'utf8');



$user_name = mysqli_real_escape_string($db,$_POST['user']);
$first_name = mysqli_real_escape_string($db,$_POST['fname']);
$last_name = mysqli_real_escape_string($db,$_POST['lname']);
$phone_num = mysqli_real_escape_string($db,$_POST['num']);
$addy = mysqli_real_escape_string($db,$_POST['add']);
$email = mysqli_real_escape_string($db,$_POST['email']);
$newpass = mysqli_real_escape_string($db,$_POST['new']);
$conpass = mysqli_real_escape_string($db,$_POST['con']);
$oldpass_unencrypted = mysqli_real_escape_string($db,$_POST['old']);

$oldpass = md5($oldpass_unencrypted);

if (isset($_POST['submitpass'])){
    $sql = "SELECT password FROM users WHERE email = '$email' LIMIT 1";
    $passcheck = mysqli_query($db, $sql);
    $get_pass_row = mysqli_fetch_array($passcheck);
    $userPass = $get_pass_row['password'];

    if ($oldpass != $userPass){
        $cookieid = 'wrongpass';
        $cookie_val = 'Old password is incorrect';
        setcookie($cookieid, $cookie_val, time() + (86400 * 30), "/");
        header("Location: userprofile.php?=old-password-incorrect");
    }
    elseif ($conpass != $newpass){
        $cookieid = 'nomatch';
        $cookie_val = 'Passwords do not match';
        setcookie($cookieid, $cookie_val, time() + (86400 * 30), "/");
        header("Location: userprofile.php?=passwords-do-not-match");
        }
    else{
        $cookieid = 'up';
        $cookie_val = 'Successful Update';
        setcookie($cookieid, $cookie_val, time() + (86400 * 30), "/");
        
        $old_email = $_COOKIE['email'];

        $new = md5($newpass);

        $sql = "UPDATE users SET password='$new' WHERE email = '$old_email'";

        mysqli_query($db,$sql);

        unset($_COOKIE['email']); 
        setcookie('email', '', time() - 3600, "/");
        header("Location: userprofile.php?=Update-successful");
    }
    
}
elseif(isset($_POST['submitreg'])){
        $old_email = $_COOKIE['email'];
        $sql = "UPDATE users SET username='$user_name', fname='$first_name', 
        lname='$last_name', phone='$phone_num', address='$addy', email='$email'
        WHERE email = '$old_email'";

        $cookieid = 'up';
        $cookie_val = 'Successful Update';
        setcookie($cookieid, $cookie_val, time() + (86400 * 30), "/");

        mysqli_query($db,$sql);
        unset($_COOKIE['email']); 
        setcookie('email', '', time() - 3600, "/");
        header("Location: userprofile.php?=Update-successful");
}