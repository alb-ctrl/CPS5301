<?php
session_start();

//if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require("functions.php");
    require ("/home/bitnami/dbconfig.php");
    $db = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR
        die('Coul not connect MySQL: ' . mysqli_connect_error () );
    // Set the encoding...
    mysqli_set_charset($db, 'utf8');
    $crust = $_POST['crust'];
    $size = $_POST['size'];
    $sauce = $_POST['sauce'];
    $meat = $_POST['meat'];
    $cost = 12;

    echo "$crust - $size - $sauce - $meat";



    $query = "Select price from menu where menu_item_id = $crust ";
    $results = mysqli_query($db, $query);
    $row = mysqli_fetch_array($results);
    $cost += $row['price'];

    echo "<br>$cost";


    /* Close the connection as soon as it's no longer needed */
    mysqli_close($db);

//}else{header('location: index.php');die();}
    


?>
