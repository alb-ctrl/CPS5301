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
    



    //$query = "SELECT fname, lname, phone, address, email FROM pizzaplace.users where username = '".$_SESSION['username']."' ";
    $query = "select u.fname, u.lname, u.phone, u.address, u.email, u.zipcode, p.card_name, p.expiration_date, p.card_number, p.cvv from users u left join payment_info p on u.username=p.username where u.username='".$_SESSION['username']."' ";

    $results = mysqli_query($db, $query);
    $rows = mysqli_fetch_array($results);
    /* Close the connection as soon as it's no longer needed */
    mysqli_close($db);

}
?>