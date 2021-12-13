<?php
require("/home/bitnami/dbconfig.php");
$db = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
    die('Coul not connect MySQL: ' . mysqli_connect_error());
// Set the encoding...
mysqli_set_charset($db, 'utf8');
error_reporting(0);
session_start();


$user_order_id = $_POST['user_order_id'];
$menu_item_id = $_POST['menu_item_id'];



//echo "$user_order_id";

//echo "$menu_item_id";
// sending query
mysqli_query($db,"DELETE FROM user_orders WHERE user_order_id = $user_order_id and menu_item_id = $menu_item_id");
header("location:all_orders.php");  

?>


