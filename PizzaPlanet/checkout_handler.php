<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    require ("/home/bitnami/dbconfig.php");
    $db = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR
        die('Coul not connect MySQL: ' . mysqli_connect_error () );
    // Set the encoding...
    mysqli_set_charset($db, 'utf8');
    $username = $_POST['username'];
    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $zipcode = $_POST['zip'];
    

    $checkoutUsername="";
    if (!isset($_SESSION['username'])){
        $checkoutUsername="guest";
        echo "user is not logged in";
    }
    else{
        $checkoutUsername=$_SESSION['username'];
        echo "user is logged in";
    }

    $_SESSION['order_id']= time(); 

    foreach($_SESSION['cart'] as $value){
        $query = "insert into user_orders values (".$_SESSION['order_id'].", '$checkoutUsername', ".$value['menu_item_id'].", ".$value['quantity'].", 'O', now()) ";
        $results = mysqli_query($db, $query);
    }
    echo "hello";

    
    
    /* Close the connection as soon as it's no longer needed */
    mysqli_close($db);

}
?>