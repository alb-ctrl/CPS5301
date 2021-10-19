<?php include('mysqli_connect_Register.php') ?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" type="text/css" href="../rsrc/styles/login_style.css">
</head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
	body {font-family: Arial, Helvetica, sans-serif;}
	form {border: 3px solid #f1f1f1; transform: translate(0%,5%); border-radius: 15px 15px 15px 15px;}

	input[type=text], input[type=password], input[type=email] {
		width: 100%;
		padding: 12px 20px;
		margin: 8px 0;
		display: inline-block;
		border: 1px solid #ccc;
		box-sizing: border-box;
	}

	button {
		color: white;
		padding: 14px 20px;
		margin: 8px 0;
		cursor: pointer;
		width: 100%;
	}

	button:hover {
		background: #da0000;
	}

	.imgcontainer {
		text-align: center;
		margin: 24px 0 12px 0;
	}

	img.avatar {
		width: 100%;
		border-radius: 50%;
	}

	.container {
		padding: 5px;
	}

	span.Signin {
		float: right;
		padding-top: 7px;
		padding-bottom: 100px;
	}

	/* Change styles for span and cancel button on extra small screens */
	@media screen and (max-width: 300px) {
		span.psw {
			display: block;
			float: none;
		}
		
		span.email {
			display: block;
			float: none;
		}
	}
	</style>
</head>
<body>


<form action="register.php" method="post">
<?php include('errors.php'); ?>
<div class="register">
<img src="../rsrc/imgs/avatar1.jpg" alt="Avatar" class="avatar">
</div>

<div class="container">
<label for="uname"><b>Username:</b></label>
<input type="text" placeholder="Enter Username" pattern="^[a-z0-9_-]{3,15}$" title="Three to fifteen lowercase letters, numbers, underscores or hyphens" name="username" value="<?php echo $username; ?>" required>



	<label for="fname"><b>First Name:</b></label>
<input type="text" placeholder="Enter First Name" name="fname" value="<?php echo $fname; ?>" required>

	<label for="lname"><b>Last Name:</b></label>
<input type="text" placeholder="Enter Last Name" name="lname"  value="<?php echo $lname; ?>" required>


<label for="email"><b>Email:</b></label>

<input type="email"  name="email" placeholder="Enter Email" value="<?php echo $email; ?>" required>

<label for="psw"><b>Password:</b></label>
<input type="password"  title="Minimum eight characters, at least one uppercase letter, one lowercase letter and one number"  placeholder="Enter Password" name="password_1" required>


<label for="psw"><b>Confirm Password:</b></label>
<input type="password" placeholder="Enter Password Again" name="password_2" required>

	<label for="phone"><b>Primary Phone Number:</b></label>

<input type="text" placeholder="Phone"  name="phone" value="<?php echo $phone; ?>" required>

	<label for="address"><b>Address:</label>
<input type="text" placeholder="Enter an address" title="Three to fifteen lowercase letters, numbers, underscores or hyphens" name="address" value="<?php echo $address; ?>" required>


	
<button type="submit" class="btn" name="reg_user">Register</button>
<label>
	<input type="checkbox" checked="checked" name="remember"> Remember me
</label>
</div>

<div class="container" style="background-color:#f1f1f1">
<button type="reset" class="clear">Clear</button>
<span class="Signin">Already a member? &nbsp <a href="login.php"> Sign in</a></span>
</div>
</form>

</body>
</html>