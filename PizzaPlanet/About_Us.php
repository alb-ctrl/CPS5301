<?php

session_start();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>About Us</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"  crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../rsrc/styles/index_styles.css">
    <link rel="stylesheet" type="text/css" href="../rsrc/styles/mis.css">
</head>

<body>
    <!--Navigation Menu-->

    <body>
        <nav>
            <input id="check" type="checkbox">
            <label for="check" class="checkbtn">
                <i class="fas fa-bars" color="red"></i>
            </label>
            <label href="#">
                <a href="index.php"><img src="../rsrc/imgs/pizza.png" alt="logo" class="logo"></a>
            </label>
            <ul class="links">
                <li><a href="index.php">Home</a></li>
                <li><a href="About_Us.php">About</a></li>
                <li><a href="get_menu.php">Menu</a></li>
                <li><a href="Contact_Us.php">Contact</a></li>
                <li>
<?php
if(empty($_SESSION['username'])){
?>

                <a href="login.php">Sign in <i class="fas fa-user-astronaut fa-5x" 
            style="margin-left:2px;font-size:18px;"></i></a>
            </li>

<?php
}

else{
?>
                
                <a href="#?you are logged in">
                    <?php
                    echo$_SESSION['username'];
                    ?>
                    <i class="fas fa-user-astronaut fa-5x" 
            style="margin-left:2px;font-size:18px;"></i></a>
            <ul class="drop">
                    <li><a href="logout.php">Sign out</a></li>
                    <li><a href="#">My profile</a></li>
                </ul>
        </li>
<?php            
}
?>
                <li>
                    <a href="view_cart.php">Cart <i class="fas fa-shopping-cart" style="font-size: 18px"></i></a>

                </li>
            </ul>
        </nav>

        <br />

        <!--Header-->
        <header>
            <div class="p-5 text-center bg-light">
                <h1 class="mb-3">About Us</h1>
                <h4 class="mb-3">We have some of the best Pizzas fit to your liking! Order Now To Get Your Pizza</h4>
                <a class="butt" href="" role="button">Order Now</a>
                <!--This button is supposed to anchor to form-->
            </div>
        </header>
        <br /> <br />


        <div class="container">
            <p class="lh-base" class="fw-light">Pizza Planet was founded in 2021 by a group of students who wanted to
                reinvent the way pizza is provided to students and other guests.
                Our gal is to provide the best quality pizza to our customers in anytime of need, whether for a study
                session, party, netflix and chill, or more.
                Order your first pie today!</p>
        </div>

        <br /> <br />

        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <img src="https://static.toiimg.com/photo/53110049.cms" class="rounded float-left" alt="Piza">
                    <img src="https://static.toiimg.com/photo/53110049.cms" class="rounded float-right" alt="pizza2">
                </div>
            </div>
        </div>
    </body>

    <br /><br />

    <!--Reviews for the pizza-->
    <div class="container">
        <h1 align="center" class="display-3">---Reviews---</h1> <br />
        <div class="row">
            <div class="col-sm">
                <blockquote class="blockquote text-center">
                    <p class="mb-0">This pizza place is the best place ever, During a night of studying, or whether it
                        is a pizza part,
                        it fits so well and so delicious.</p>
                    <footer class="blockquote-footer">Kean Student <cite title="Source Title">Miya</cite>
                    </footer>
                </blockquote>
            </div>
            <div class="col-sm">
                <blockquote class="blockquote text-center">
                    <p class="mb-0">I am so happy since I used Pizaa Planet, It's been really hard finding a Pizza place
                        since i moved here
                        I really love this pizza.</p>
                    <footer class="blockquote-footer">Kean Student <cite title="Source Title">Katie Graham</cite>
                    </footer>
                </blockquote>
            </div>
            <div class="col-sm">
                <blockquote class="blockquote text-center">
                    <p class="mb-0">Some of the best pizza ever. It is a really good late night snack while you are
                        studying/watching tv.</p>
                    <footer class="blockquote-footer">Guest <cite title="Source Title">Lorry V</cite>
                    </footer>
                </blockquote>
            </div>
        </div>
    </div>

    <br /> <br />
<hr>
    <!--Footer-->

    <div class="footer">
        <ul id="left">
            <span>
                <li>Hours of Operation</li>
            </span>
            <li>Monday - Sunday 10:00am - 10:00pm</li>
        </ul>
        <ul id="right">
            <span>
                <li>For Reservation</li>
            </span>
            <li>Our Location</li>
            <li><a href="#">Front St, Elizabeth, NJ 07206</a></li>
            <li>Tel: (908)555-3474</li>
        </ul>
    </div>


</html>
