<?php include('mysqli_connect_Register.php') ?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" type="text/css" href="../rsrc/styles/login_style.css">

<!-- Bootstrap Scripts -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
		body {font-family: Arial, Helvetica, sans-serif;}
		form {border: 3px solid #f1f1f1; transform: translate(0%,10%); border-radius: 15px 15px 15px 15px;}

		input[type=text], input[type=password] {
		width: 100%;
		padding: 12px 20px;
		margin: 8px 0;
		display: inline-block;
		border: 1px solid #ccc;
		box-sizing: border-box;
		}

		button {
		background-color: #4CAF50;
		color: white;
		padding: 14px 20px;
		margin: 8px 0;
		border: none;
		cursor: pointer;
		width: 100%;
		}

		button:hover {
		opacity: 0.8;
		}


		.imgcontainer {
		text-align: center;
		margin: 24px 0 12px 0;
		}

		img.avatar {
		width: 40%;
		border-radius: 50%;
		}

		.container {
		padding: 16px;
		}

		span.Signup {
		float: right;
		padding-top: 16px;
		}

		/* Change styles for span and cancel button on extra small screens */
		@media screen and (max-width: 300px) {
		span.psw {
			display: block;
			float: none;
		}		
		}
		</style>
</head>
<body>

<form action="login.php" method="post">
<?php include('errors.php'); ?>
<div class="imgcontainer">
    <img src="../rsrc/imgs/avatar.png" alt="Avatar" class="avatar">
</div>

<div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
        
    <button type="submit" class="btn" name="login_user">Login</button>
    <label>
    <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
</div>

<div class="container" style="background-color:#f1f1f1">
    <button type="reset" class="clear">Clear</button>
    <span class="Signup">Not yet a member? &nbsp <a href="register.php"> Signup</a></span>
</div>
</form>

</body>
</html>