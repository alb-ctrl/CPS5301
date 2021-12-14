<!DOCTYPE html>
<html>

<head>
    <title>Cart</title>
    <link rel="stylesheet" type="text/css" href="../rsrc/styles/cart_style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="../rsrc/styles/index_styles.css">
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
    <nav>
        <input id="check" type="checkbox">
        <label for="check" class="checkbtn">

            <i class="fas fa-bars" color="red"></i>

        </label>
            <label href="#">
                <a href="index.php"><img src="../rsrc/imgs/pizza.png" alt="logo" class="logo"></a>
            </label>
        <ul class = "links">
            <li><a href="index.php">Home</a></li>
            <li><a href="About_Us.php">About</a></li>
            <li><a href="get_menu.php">Menu</a></li>
            <li><a href="Contact_Us.php">Contact</a></li>
            <li>


            <a href="login.php">Sign in  <span class="diff"><i class="fas fa-user-astronaut fa-5x"style="margin-left:2px;font-size:18px;"></i></span></a>
            </li>
            <li>
            <a href="view_cart.php">Cart <i class="fas fa-shopping-cart" style="font-size: 18px" ></i></a>

            </li>
        </ul>
    </nav>
        <div class="Header">
            <h3 class="Heading">Shopping Cart</h3>
            <form action="getdiscount.php">
                Redeem Code: <input type="text" name="disc">
            </form>
            <h5 class="Action" onclick="return removeAll();">Remove all</h5>
        </div>

        <?php
        foreach($_SESSION['cart'] as $value){
            get_cart($value['menu_item_id'], $value['quantity'], $value['cart_index']);
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
            <button  onclick="return cart_checkout();" id="cart_checkout" class="button">Checkout</button>
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
    $(document).ready(function() {
        console.log("ready!");
        sub_total();

    });
    </script>
</body>

</html>

<div id="guest_checkout" class="modal fade " tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <button type="button" class="btn btn-primary btn-outline-dark btn-lg btn-block" onclick="window.location.href='login.php'">Login</button>
            <br>
            <button type="button" class="btn btn-secondary btn-outline-dark btn-lg btn-block" onclick="window.location.href='checkout.php'">Checkout as a Guest</button>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>