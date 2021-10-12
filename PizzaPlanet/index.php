<?php header('Access-Control-Allow-Origin: *'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"  crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../rsrc/styles/index_styles.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
<nav>
        <input id="check" type="checkbox">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
            <label href="#">
                <a href="#"><img src="../rsrc/imgs/pizza.png" alt="logo" class="logo"></a>
            </label>
        <ul class = "links">
            <li><a href="index.php">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Menu</a></li>
            <li>
            <a href="login.php">Sign in  <span class="diff"><i class="fas fa-user-astronaut fa-5x" color="red" style="margin-left:2px;font-size:18px;"></i></span></a>
            </li>
            <li>
            <a href="#">Cart <i class="fas fa-shopping-cart" style="font-size: 18px" color="red"></i></a>
            </li>
        </ul>
    </nav>
    <div>
        <img id = "ftr" src="../rsrc/imgs/top2.jpg" alt="featured-pizza">
        <div id = "ftrbl">
            <p>
                Stuffed Crust Deep Dish <a href="#">Order now !</a>
            </p> 
        </div>
    </div>
    <div><div id="l"><hr></div></div>
    <div class="footer">
        <ul id = "left">
            <span><li>Hours of Operation</li></span>
            <li>Monday - Sunday 10:00am - 10:00pm</li>
        </ul>
        <ul id = "right">
            <span><li>For Reservation</li></span>
            <li>Our Location</li>
            <li><a href="#">Front St, Elizabeth, NJ 07206</a></li>
            <li>Tel: (908)555-3474</li>
        </ul>
    </div>
</body>
</html>
