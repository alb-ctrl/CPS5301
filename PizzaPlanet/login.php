
<?php include('mysqli_connect_Register.php');header('Access-Control-Allow-Origin: *'); header('Access-Control-Allow-Methods: *');  ?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" type="text/css" href="../rsrc/styles/login_style.css">
<link rel="stylesheet" href="../rsrc/styles/index_styles.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>

<!-- Bootstrap Scripts -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</head>
<meta name="viewport" content="width=device-width, initial-scale=1">
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
        <ul class = "links">
            <li><a href="index.php">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="get_menu.php">Menu</a></li>
            <li>


            <a href="login.php">Sign in  <span class="diff"><i class="fas fa-user-astronaut fa-5x"style="margin-left:2px;font-size:18px;"></i></span></a>
            </li>
            <li>
            <a href="view_cart.php">Cart <i class="fas fa-shopping-cart" style="font-size: 18px" ></i></a>

            </li>
        </ul>
    </nav>
<form action="login.php" method="post" id="hide">
<?php include('errors.php'); ?>
<div class="imgcontainer">
<i class="fas fa-user-astronaut fa-5x" style="color: red;"></i>
</div>

<div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
        
    <button type="submit" name="login_user">Login</button>
    <label>
    <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
</div>

<div class="container">
    <button type="reset">Clear</button>
    <span class="Signup">Forgot your username? <a href="../forgot_username.html">Forgot Username</a></span>
    <span class="Signup">Forgot your password? <a href="../forgot_password.html">Forgot Password</a></span>
    <span class="Signup">Not yet a member? <a href="register.php">Signup</a></span>
</div>
</form>

</body>
</html>
