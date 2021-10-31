<?php include('mysqli_connect.php');header('Access-Control-Allow-Origin: *'); header('Access-Control-Allow-Methods: *');  ?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" type="text/css" href="../../rsrc/styles/login_style.css">
<link rel="stylesheet" href="../../rsrc/styles/index_styles.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>

<!-- Bootstrap Scripts -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>


  <form action="index.php" method="post" id="hide">
  	<?php include('../errors.php'); ?>
    <h1><center>Admin</center></h1>
    <div class="imgcontainer"><i class="fas fa-user-astronaut fa-5x" style="color: red;"></i></div>
    <div class="container">  
    <input type="text" placeholder="username" name="username"/>
    <input type="password" placeholder="password" name="password"/>
    <input type="submit"  name="login" value="login" />
    </div>  

	<div class="container">
    <spam class="Signup">Not registered? <a href="register.php">Create an account</a></spam>
	</div>  
  </form>
  

</body>

</html>
