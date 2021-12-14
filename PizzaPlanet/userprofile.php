<?php header('Access-Control-Allow-Origin: *'); session_start();

require ("/home/bitnami/dbconfig.php");
$db = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR
        die('Coul not connect MySQL: ' . mysqli_connect_error () );
    // Set the encoding...
    mysqli_set_charset($db, 'utf8');
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


$cookieid = 'email';
setcookie($cookieid, $user_email, time() + (86400 * 30), "/");

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
    <link rel="stylesheet" type="text/css" href="../rsc/styles/user_profile.css">
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
        <p>My Profile&emsp;Please enter current password to make any changes</p>
        <div id = "userform">
            <form action="update_user.php" method="POST">
                <ul>
                    <li>Username <input type="text" name="user" value="<?php echo $user_name; ?>"></li>
                    <li>New Password <input type="password" name="new" value="<?php echo $user_password; ?>"></li>
                    <li>Confirm Password <input type="password" name="con" value="<?php echo $user_password; ?>"></li>
                    <li>Current Password <input type="password" name="old" value="<?php echo $user_password; ?>"></li>
                    <li>First Name <input type="text" name="fname" value="<?php echo $first_name; ?>"></li>
                    <li>Last Name <input type="text" name="lname" value="<?php echo $last_name; ?>"></li>
                    <li>Phone number <input type="text" name="num" value="<?php echo $phone_num; ?>"></li>
                    <li>Address <input type="text" name="add" value="<?php echo $addy; ?>"></li>
                    <li>Email <input type="text" name="email" value="<?php echo $user_email; ?>"></li>
                    <button type="submit" name="submit">Update</button>
                    <p><?php 
                            if (isset($_COOKIE['wrongpass'])){echo $_COOKIE['wrongpass']; unset($_COOKIE['wrongpass']); setcookie('wrongpass', '', time() - 3600, "/");}
                            if (isset($_COOKIE['nomatch'])){echo $_COOKIE['nomatch']; unset($_COOKIE['nomatch']); setcookie('nomatch', '', time() - 3600, "/");} 
                            if (isset($_COOKIE['up'])){echo $_COOKIE['up']; unset($_COOKIE['up']); setcookie('up', '', time() - 3600, "/");} 
                        ?>
                    </p>
                </ul>
            </form>
        </div >
        <div id = "userinfo">
            <ul>
                <li>Username&emsp;&emsp;&emsp;First Name&emsp;&emsp;&emsp;Last name</li>
                <li><?php echo $user_name; ?>&emsp;&emsp;&emsp;<?php echo $first_name; ?>&emsp;&emsp;&emsp;<?php echo $last_name; ?></li>    
                <li>Phone Number&emsp;&emsp;&emsp;Email</li>
                <li><?php echo $phone_num; ?>&emsp;&emsp;&emsp;<?php echo $user_email; ?></li>
                <li>Address</li>
                <li><?php echo $addy?></li>
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