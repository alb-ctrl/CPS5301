<?php
session_start();
// https://stackoverflow.com/questions/21652702/multidimensional-array-in-php-session
if (!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}

if (isset($_POST['menu_id'])) {
    $item_id = $_POST['menu_id'];
    echo "Menu id: $item_id";
    $quantity = 1;
    $index = count($_SESSION['cart']);
    $_SESSION['cart'][$index+1] = array('cart_index' => $index+1, 'menu_id' => $item_id, 'quantity' => $quantity);
    foreach($_SESSION['cart'] as $value){
        echo "<br>it should work<br>".$value['menu_id'];
    }
    print_r($_SESSION['cart']);
    // this is how you report an error to ajax
    //header("HTTP/1.0 500 You're not logged in. Try loggin in first");

}
if (isset($_POST['remove_item'])) {
    unset($_SESSION['cart'][$_POST['cart_index']]);
    echo "success";
    /*
    foreach($_SESSION['cart'] as $value){
        if ($value['menu_id'] == $_POST['remove_item'] && $value['cart_index'] == $_POST['cart_index']){
            echo "$value was unset";
            unset($_SESSION['cart'][$_POST['cart_index']]);
        }
    }
    */
}

if (isset($_POST['increase_quantity'])) {
    foreach($_SESSION['cart'] as $value){
        if ($value['cart_index'] == $_POST['cart_index']){
            echo "old quantity ". $value['quantity'];
            $value['quantity']+=1;
            print_r($value);
        }
        
    }
}

?>