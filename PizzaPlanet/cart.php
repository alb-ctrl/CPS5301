<?php
if (!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}
$item_id = $_POST['menu_id'];
$quantity = 1;
$index = count($_SESSION['cart']);
$_SESSION['cart'][$index+1] = array('menu_id' => $item_id, 'quantity' => $quantity);
foreach($_SESSION['cart'] as $value){
    echo $value['quantity'];
}
//print_r($_SESSION['cart']);
?>