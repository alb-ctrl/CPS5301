<!DOCTYPE html>
<html>

<head>
    <title>Cart</title>
    <link rel="stylesheet" type="text/css" href="../rsrc/styles/cart_style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,900" rel="stylesheet">
</head>

<body>
    <?php 
session_start(); 
if (!isset($_SESSION['cart'])){
// print empty basket 
}
require("functions.php");

?>
    <div class="CartContainer">
        <div class="Header">
            <h3 class="Heading">Shopping Cart</h3>
            <h5 class="Action">Remove all</h5>
        </div>

        <?php
        foreach($_SESSION['cart'] as $value){
            get_cart($value['menu_id'], $value['quantity'], $value['cart_index']);
        }
        ?>
        <hr>
        <div class="checkout">
            <div class="total">
                <div>
                    <div class="Subtotal">Sub-Total</div>
                    <div id="number_items_cart" class="items">2 items</div>
                </div>
                <div id="total_amount_cart" class="total-amount">$6.18</div>
            </div>
            <button class="button">Checkout</button>
        </div>
    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/0.71/jquery.csv-0.71.min.js"></script>

    <!-- Optional JavaScript -->
    <script type="text/javascript" src="../rsrc/js/main.js"></script>
    <script>
        $( document ).ready(function() {
    console.log( "ready!" );
    sub_total();

});
    
    </script>
</body>

</html>