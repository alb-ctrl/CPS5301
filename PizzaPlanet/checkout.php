<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Checkout example for Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/checkout/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <style>
        .container {
            max-width: 960px;
        }

        .border-top {
            border-top: 1px solid #e5e5e5;
        }

        .border-bottom {
            border-bottom: 1px solid #e5e5e5;
        }

        .border-top-gray {
            border-top-color: #adb5bd;
        }

        .box-shadow {
            box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05);
        }

        .lh-condensed {
            line-height: 1.25;
        }
    </style>
</head>

<body class="bg-light">
    <!-- https://getbootstrap.com/docs/4.0/examples/checkout/? -->
    <?php
    session_start();
    if (!isset($_SESSION['cart'])) {
        // print empty basket 
    }
    require("functions.php");

    if (isset($_SESSION['username'])) {
        require("/home/bitnami/dbconfig.php");
        $db = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
            die('Coul not connect MySQL: ' . mysqli_connect_error());
        // Set the encoding...
        mysqli_set_charset($db, 'utf8');

        //$query = "SELECT fname, lname, phone, address, email FROM pizzaplace.users where username = '".$_SESSION['username']."' ";
        $query = "select u.fname, u.lname, u.phone, u.address, u.email, u.zipcode from users u  where u.username='" . $_SESSION['username'] . "' ";

        $results = mysqli_query($db, $query);
        $rows = mysqli_fetch_array($results);
        /* Close the connection as soon as it's no longer needed */
        mysqli_close($db);
    }

    ?>

    <div class="container">
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
            <h2>Checkout form</h2>
            <p class="lead">Below is an example form built entirely with Bootstrap's form controls. Each required form
                group has a validation state that can be triggered by attempting to submit the form without completing
                it.</p>
        </div>

        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                    <span id="number_items_cart" class="badge badge-secondary badge-pill">3</span>
                </h4>
                <ul class="list-group mb-3">
                    <?php
                    foreach ($_SESSION['cart'] as $value) {
                        get_checkout_cart($value['menu_item_id'], $value['quantity']);
                    }
                    ?>
                    
                    <li class="list-group-item d-flex justify-content-between" id="total_amount_cart_li">
                        <span>Total (USD)</span>
                        <strong id="total_amount_cart">$20</strong>
                    </li>
                </ul>
                <?php
                if(!empty($_SESSION['username'])){
                echo '<div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="save-order">
                        <label class="custom-control-label" for="save-order">Save this order for next time</label>
                </div>';
                }
                ?>
                <form class="card p-2" id = "redeem-form">
                    <div class="input-group">
                        <input type="text" class="form-control" name="promo_code" placeholder="Promo code">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-secondary">Redeem</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Delivery Address</h4>
                <form id="checkout" class="needs-validation" novalidate action="checkout_handler.php" method="POST">
                    <input type = "hidden" value="" id="hidden_cost" name = "hidden_cost">
                    <div class="row">
                        <input type="hidden" name="username" value="<?php if (isset($_SESSION['username'])) echo $_SESSION['username']; ?>">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" class="form-control" id="firstName" placeholder="" value="<?php if (isset($_SESSION['username'])) echo $rows['fname']; ?>" required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="<?php if (isset($_SESSION['username'])) echo $rows['lname']; ?>" required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email <span class="text-muted">(Optional)</span></label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com" value="<?php if (isset($_SESSION['username'])) echo $rows['email']; ?>">
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" placeholder="1234 Main St" value="<?php if (isset($_SESSION['username'])) echo $rows['address']; ?>" required>
                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                    </div>

                    <div class="row">


                        <div class="col-md-3 mb-3">
                            <label for="zip">Zip</label>
                            <input type="text" name="zip" class="form-control" id="zip" placeholder="" value="<?php if (isset($_SESSION['username'])) echo $rows['zipcode']; ?>" required>
                            <div class="invalid-feedback">
                                Zip code required.
                            </div>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="same-address">
                        <label class="custom-control-label" for="same-address">Shipping address is the same as my
                            billing address</label>
                    </div>
                    <!-- <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="save-info">
                        <label class="custom-control-label" for="save-info">Save this information for next time</label>
                    </div> -->
                    <?php
                    if(!empty($_SESSION['username'])){
                        echo '<div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="save-info">
                                <label class="custom-control-label" for="save-info">Save this information for next time</label>
                        </div>';
                        }
                    ?>
                    <hr class="mb-4">

                    <h4 class="mb-3">Payment</h4>

                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                            <label class="custom-control-label" for="credit">Credit card</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                            <label class="custom-control-label" for="debit">Debit card</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                            <label class="custom-control-label" for="paypal">Paypal</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="cash" name="paymentMethod" type="radio" class="custom-control-input" required>
                            <label class="custom-control-label" for="cash">Cash</label>
                        </div>
                    </div>
                    <g id = "card_info">
                    <?php
                        $goElse = 0;
                        if (isset($_SESSION['username'])){
                            $user = $_SESSION['username'];
                            $query = "select card_name, card_number from payment_info where username = '$user'";
                            $results = mysqli_query($db, $query);
                            $rowNum = mysqli_num_rows($results);
                            if ($rowNum > 0){
                                while ( $row = mysqli_fetch_array($results) ){
                                    echo '<div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                    '.$row['card_name'].'<b> '.substr($row['card_number'], -4).'</b>
                                    </label>
                                    </div>';
                                }

                            }
                            else {
                                $goElse = 1;
                            }

                    ?>
                    
                    <?php
                        }
                        if ($goElse == 1) {
                            ?>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cc-name">Name on card</label>
                            <input type="text" class="form-control" id="cc-name" required>
                            <small class="text-muted">Full name as displayed on card</small>
                            <div class="invalid-feedback">
                                Name on card is required
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cc-number">Credit card number</label>
                            <input type="text" class="form-control" id="cc-number"  required>
                            <div class="invalid-feedback">
                                Credit card number is required
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="cc-expiration">Expiration</label>
                            <input type="text" class="form-control" id="cc-expiration" required>
                            <div class="invalid-feedback">
                                Expiration date required
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="cc-cvv">CVV</label>
                            <input type="text" class="form-control" id="cc-cvv" placeholder=""  required>
                            <div class="invalid-feedback">
                                Security code required
                            </div>
                        </div>
                    </div>

                    <?php
                        }

                    ?>
                    </g>
                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
                </form>
            </div>
        </div>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">&copy; 2017-2018 Company Name</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Support</a></li>
            </ul>
        </footer>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.8/holder.min.js" integrity="sha512-O6R6IBONpEcZVYJAmSC+20vdsM07uFuGjFf0n/Zthm8sOFW+lAq/OK1WOL8vk93GBDxtMIy6ocbj6lduyeLuqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Optional JavaScript -->
    <script type="text/javascript" src="../rsrc/js/main.js"></script>
    <script>
        $(document).ready(function() {
            console.log("ready!");
            studentCode();
            checkout_total();
            if ($("#cash").is(":checked"))
                    $("#card_info").hide();
            $("#checkout").submit(function(event) {
            //    event.preventDefault();
                if ($("#save-order").is(":checked"))
                    saveOrder();
                if ($("#save-info").is(":checked"))
                    saveInfo($("#cc-name").val(),$("#cc-number").val(),$("#cc-expiration").val(),$("#cc-cc-cvv").val());
            });
            $("#redeem-form").submit(function(event) {
                event.preventDefault();
                redeemCode();
                checkout_total();
                
                
            });

        });
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';

            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');

                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>

</html>