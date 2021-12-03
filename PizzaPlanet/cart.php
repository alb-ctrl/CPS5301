<?php
session_start();

// https://stackoverflow.com/questions/21652702/multidimensional-array-in-php-session
if (!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}

if (isset($_POST['menu_item_id'])) {
    $item_id = $_POST['menu_item_id'];
    echo "Menu id: $item_id";
    $quantity = 1;
    $index = count($_SESSION['cart']);
    $_SESSION['cart'][$index+1] = array('cart_index' => $index+1, 'menu_item_id' => $item_id, 'quantity' => $quantity);
    foreach($_SESSION['cart'] as $value){
        echo "<br>it should work<br>".$value['menu_item_id'];
    }
    print_r($_SESSION['cart']);
    // this is how you report an error to ajax
    //header("HTTP/1.0 500 You're not logged in. Try loggin in first");

}
if (isset($_POST['remove_item'])) {
    unset($_SESSION['cart'][$_POST['cart_index']]);
    echo "success";
    if (isset($_SESSION['special_item']) && $_SESSION['special_item'] == $_POST['remove_item']){
        require ("/home/bitnami/dbconfig.php");
        $db = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR
            die('Coul not connect MySQL: ' . mysqli_connect_error () );
        // Set the encoding...
        mysqli_set_charset($db, 'utf8');
        $query = "delete from menu where menu_item_id = " . $_POST['remove_item'];
        $results = mysqli_query($db, $query);
        mysqli_close($db);
    }
    /*
    foreach($_SESSION['cart'] as $value){
        if ($value['menu_item_id'] == $_POST['remove_item'] && $value['cart_index'] == $_POST['cart_index']){
            echo "$value was unset";
            unset($_SESSION['cart'][$_POST['cart_index']]);
        }
    }
    */
}

if (isset($_POST['increase_quantity'])) {
    foreach($_SESSION['cart'] as &$value){
        if ($value['cart_index'] == $_POST['cart_index']){
            echo "old quantity ". $value['quantity'];
            $value['quantity']+=1;
            print_r($value);
        }
        
    }
}

if (isset($_POST['decrease_quantity'])) {
    foreach($_SESSION['cart'] as &$value){
        if ($value['cart_index'] == $_POST['cart_index']){
            echo "old quantity ". $value['quantity'];
            if ($value['quantity'] == 1)
                unset($_SESSION['cart'][$_POST['cart_index']]);
            else
                $value['quantity']-=1;
            print_r($value);
        }
        
    }
}

if (isset($_POST['pre_checkout'])){
    if (isset($_SESSION['username'])){
        header("HTTP/1.1 222 is Logged in");
        die();
    }
    echo "show d-block";

}

if (isset($_POST['saveOrder'])){
    require ("/home/bitnami/dbconfig.php");
    $db = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR
        die('Coul not connect MySQL: ' . mysqli_connect_error () );
    // Set the encoding...
    mysqli_set_charset($db, 'utf8');

    foreach($_SESSION['cart'] as $value){
        $menu_id = $value['menu_item_id'];
        $user = $_SESSION['username'];

        $query = "insert into favorites_orders values ($menu_id, $user)";
        $results = mysqli_query($db, $query);
    }
    mysqli_close($db);

}

if (isset($_POST['promo_code'])){
    require ("/home/bitnami/dbconfig.php");
    $db = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR
        die('Coul not connect MySQL: ' . mysqli_connect_error () );
    // Set the encoding...
    mysqli_set_charset($db, 'utf8');

    $code_id = $_POST['promo_code'];
    $query = "select code_id, price from promo_code where code_id= '$code_id' ";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) > 0){
        $row = mysqli_fetch_array($results);
        $index = count($_SESSION['cart']['promo']);
        $_SESSION['cart']['promo'][$index+1] = array('code_id' => $row['code_id'], 'price' => $row['price']);
        echo '
        <div class="text-success">
          <h6 class="my-0">Promo code</h6>
          <small>'.$code_id.'</small>
        </div>
        <span class="text-success">$'.$row['price'].'</span>';
    }
    
    mysqli_close($db);

}

?>