<?php
require("/home/bitnami/dbconfig.php");
$db = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
    die('Coul not connect MySQL: ' . mysqli_connect_error());
// Set the encoding...
mysqli_set_charset($db, 'utf8');
error_reporting(0);
session_start();


// sending query
mysqli_query($db,"DELETE FROM menu WHERE menu_item_id = '".$_GET['menu_del']."'");
header("location:all_menu.php");  

?>
