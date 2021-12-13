<?php header('Access-Control-Allow-Origin: *'); session_start();

require ("/home/bitnami/dbconfig.php");

if(!isset($_SESSION["verify"])){
    session_destroy();
    
}
$username = $_SESSION['username'];

$result = mysqli_query($db, "select * from users where username = '$username' limit 1");

$getrows = mysqli_fetch_array($result, MYSQLI_ASSOC);
$user_name = $getrows['username'];
$first_name = $getrows['fname'];
$last_name = $getrows['lname'];
$phone_num = $getrows['phone'];
$addy = $getrows['address'];
$user_email = $getrows['email'];
$user_password = $getrows['password'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"  crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../rsrc/styles/index_styles.css">
</head>
<body>
    <body>
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
                    <li><a href="userprofile.php">My profile</a></li>
                </ul>
        </li>
<?php            
}
?>
            <li>
            <a href="view_cart.php">Cart <i class="fas fa-shopping-cart" style="font-size: 18px" ></i></a>

            </li>
        </ul>
    </nav>
    <div>
        <p>My Profile</p>
        <div id = "userform">
            <form action="update_user.php" method="POST">
                <ul>
                    <li>Username <input type="text" name="user"></li>
                    <li>New Password <input type="text" name="new"></li>
                    <li>Confirm Password <input type="text" name="con"></li>
                    <li>Old Password <input type="text" name="old"></li>
                    <li>First Name <input type="text" name="fname"></li>
                    <li>Last Name <input type="text" name="lname"></li>
                    <li>Phone number <input type="text" name="num"></li>
                    <li>Address <input type="text" name="add"></li>
                    <li>Email <input type="text" name="email"></li>
                    
                </ul>
            </form>
        </div id = "userinfo">
        <div>
            <ul>
                <li>Username&emsp;&emsp;&emsp;First Name&emsp;&emsp;&emsp;Last name</li>
                <li><?php echo "$user_name d"; ?>&emsp;&emsp;&emsp;<?php echo $first_name; ?>&emsp;&emsp;&emsp;<?php echo $last_name; ?></li>    
                <li>Phone Number&emsp;&emsp;&emsp;Email</li>
                <li><?php echo $phone_num; ?>&emsp;&emsp;&emsp;<?php echo $user_email; ?></li>
                <li>Address</li>
                <li><?php echo $addy; ?></li>
            </ul>
        </div>
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
</body>
</html>