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
$oldpass = mysqli_real_escape_string($db,$_POST['old']);


if (isset($_POST['submit'])){
    $sql = "SELECT password FROM users WHERE email = '$email' LIMIT 1";
    $passcheck = mysqli_query($db, $sql);
    $get_pass_row = mysqli_fetch_array($passcheck);
    $userPass = $get_pass_row['password'];

    if ($oldpass != $userPass){
        $cookieid = 'wrongpass';
        $cookie_val = 'Old password is incorrect';
        setcookie($cookieid, $cookie_val, time() + (86400 * 30), "/");
        header("Location: userProfile.php?=old-password-incorrect");
    }
    elseif ($conpass != $newpass){
        $cookieid = 'nomatch';
        $cookie_val = 'Passwords do not match';
        setcookie($cookieid, $cookie_val, time() + (86400 * 30), "/");
        header("Location: userProfile.php?=passwords-do-not-match");
        }
    else{
        $cookieid = 'up';
        $cookie_val = 'Successful Update';
        setcookie($cookieid, $cookie_val, time() + (86400 * 30), "/");
        
        $old_email = $_COOKIE['email'];

        $sql = "UPDATE users SET username='$user_name', fname='$first_name', lname='$last_name', phone='$phone_num', address='$addy', email='$email', password='$newpass' WHERE email = '$old_email'";
        unset($_COOKIE['email']); 
        setcookie('email', '', time() - 3600, "/");
        header("Location: userprofile.php?=Update-successful");
    }
    
}