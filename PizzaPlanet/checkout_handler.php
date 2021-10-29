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
    


    if (!isset($_SESSION['username'])){
        $query = "insert into order_history values (null, null,'guest', O)";
        echo "user is not logged in";
    }
    else{
        $query = "insert into order_history values (null, null,".$_SESSION['username'].", 'O')";
        echo "user is logged in";
    }
    $results = mysqli_query($db, $query);
    $last_id = mysqli_insert_id($db);
    echo "last id : $last_id";
    $_SESSION['order_id']=$last_id;

    foreach($_SESSION['cart'] as $value){
        $query = "insert into order_items values ($last_id,".$value['menu_id'].", ".$value['quantity'].") ";
        $results = mysqli_query($db, $query);
    }
    echo "hello";

    
    
    /* Close the connection as soon as it's no longer needed */
    mysqli_close($db);

}
?>