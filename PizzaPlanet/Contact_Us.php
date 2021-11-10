<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Contact Us</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"  crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../rsrc/styles/index_styles.css">
</head>

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
    <header>

        <div class="p-5 text-center bg-light">
            <h1 class="mb-3">Contact Us</h1>
            <h4 class="mb-3">Message us using the form below for any inqueries or comments</h4>
            <a class="btn btn-primary" href="" role="button">Message Us</a>
            <!--This button could be used to anchor to form-->
        </div>
    </header>

    <br /> <br />

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <h1>Message Us:</h1> <br />
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Phone Number</label>
                        <input type="tel" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group ">
                        <label for="exampleFormControlTextarea1">Type Message Here</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Us A Message</button>
                </form>
            </div>
            <div class="col-sm">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3025.7187336701086!2d-74.23529868496692!3d40.68016587933531!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c3ad5b6a0b3391%3A0x76c486324be28e94!2sKean%20University!5e0!3m2!1sen!2sus!4v1635214846718!5m2!1sen!2sus"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>

    <br />
    <!--Footer-->
    <hr>

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
