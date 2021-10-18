<?php
if (!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}
$item_id = $_POST['menu_id'];
$quantity = 1;
echo "size: ". count($_SESSION['cart']);
$_SESSION['cart'][$id] = array('menu_id' => $item_id, 'quantity' => $quantity);
?>