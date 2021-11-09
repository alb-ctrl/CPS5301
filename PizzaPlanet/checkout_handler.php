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
    

    $checkoutUsername="";
    if (!isset($_SESSION['username'])){
        $checkoutUsername="guest";
        //echo "user is not logged in";
    }
    else{
        $checkoutUsername=$_SESSION['username'];
        //echo "user is logged in";
    }

    $_SESSION['order_id']= time(); 

    foreach($_SESSION['cart'] as $value){
        $query = "insert into user_orders values (".$_SESSION['order_id'].", '$checkoutUsername', ".$value['menu_item_id'].", ".$value['quantity'].", 'O', now()) ";
        $results = mysqli_query($db, $query);
    }
    echo "<br>Your order number is <b>#".$_SESSION['order_id']."</b>";

    
    
    /* Close the connection as soon as it's no longer needed */
    mysqli_close($db);

}
else{
    //header('location: index.php');
    //die();
}
    


?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Reciept</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../rsrc/styles/reciept_style.css">



</head>

<body class="bg-light">
    <!-- https://getbootstrap.com/docs/4.0/examples/checkout/? -->



    <div class="container">


        <div class="card">
            <div class="title">Purchase Reciept</div>
            <div class="info">
                <div class="row">
                    <div class="col-7"> <span id="heading">Date</span><br> <span id="details"><?php echo date('d-M-Y', $_SESSION['order_id']/1000);?></span>
                    </div>
                    <div class="col-5 pull-right"> <span id="heading">Order No.</span><br> <span
                            id="details"><?php echo $_SESSION['order_id'];?></span> </div>
                </div>
            </div>
            <div class="pricing">
                
            <?php require("functions.php"); get_reciept($_SESSION['order_id']);?>

            
            </div>
            <div class="total">
                <div class="row">
                    <div class="col-9"></div>
                    <div class="col-3"><big>£262.99</big></div>
                </div>
            </div>
            <div class="tracking">
                <div class="title">Tracking Order</div>
            </div>
            <div class="progress-track">
                <ul id="progressbar">
                    <li class="step0 active " id="step1">Ordered</li>
                    <li class="step0 active text-center" id="step2">Shipped</li>
                    <li class="step0 active text-right" id="step3">On the way</li>
                    <li class="step0 text-right" id="step4">Delivered</li>
                </ul>
            </div>
            <div class="footer">
                <div class="row">
                    <div class="col-2"><img class="img-fluid" src="https://i.imgur.com/YBWc55P.png"></div>
                    <div class="col-10">Want any help? Please &nbsp;<a> contact us</a></div>
                </div>
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
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.8/holder.min.js"
        integrity="sha512-O6R6IBONpEcZVYJAmSC+20vdsM07uFuGjFf0n/Zthm8sOFW+lAq/OK1WOL8vk93GBDxtMIy6ocbj6lduyeLuqQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Optional JavaScript -->
    <script type="text/javascript" src="../rsrc/js/main.js"></script>
    <script>
    </script>
</body>

</html>