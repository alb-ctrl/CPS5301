<?php
session_start();

//if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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
    $description= "$crust,$size,$sauce";




    // get indormation/price from each menu id 
    $query = "Select price from menu where menu_item_id = $crust and menu_item_id = $size and menu_item_id = $sauce ";
    $results = mysqli_query($db, $query);
    while($row = mysqli_fetch_array($results)){
        $cost += $row['price'];
    }

    for ($i=0; $i<count($meat); $i++){
        $description .=",$meat[$i]";
        $query = "Select price from menu where menu_item_id = $meat[$i]";
        $results = mysqli_query($db, $query);
        while($row = mysqli_fetch_array($results)){
            $cost += $row['price'];
        }
    }
    

    // insert new menu item and make it hidden as Hiden Order
    $query = "insert into menu (description, menu_item_name, price, picture_path, hiden) values ('$description', 'Custome Pizza' , $cost, 'custom-made-pizza.jpg', 'HO');";
    $results = mysqli_query($db, $query);
    $last_id = mysqli_insert_id($db);

    $quantity = 1;
    $index = count($_SESSION['cart']);
    $_SESSION['cart'][$index+1] = array('cart_index' => $index+1, 'menu_item_id' => $last_id, 'quantity' => $quantity);
    $_SESSION['special_item'] =  $last_id;


    header('location: get_menu.php');


    /* Close the connection as soon as it's no longer needed */
    mysqli_close($db);

//}else{header('location: index.php');die();}
    


?>
