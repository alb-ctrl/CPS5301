<?php
session_start();


if (isset($_POST['cancelOrder'])){
    require ("/home/bitnami/dbconfig.php");
    $db = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR
        die('Coul not connect MySQL: ' . mysqli_connect_error () );
    // Set the encoding...
    mysqli_set_charset($db, 'utf8');
    $orderId = (int)$_POST['orderId'];
    
    $timeB = time();
    //five minutes in seconds
$fiveMinutes = 60 * 5;
//check if current time is after 5 minutes the initial time
if ( ($orderId+$fiveMinutes) >= $timeB) {
    $query = "update  user_orders set status = 'X' where user_order_id = $orderId  ";
    echo $orderId+$fiveMinutes . " => $timeB";
        $results = mysqli_query($db, $query);
        if ($results){
            echo "Order Succesfully canceled";
        }
  }
  else {
    echo "Too late, Cant Cacel order. Please contact us for further assistance";
  }

    mysqli_close($db);

}

?>