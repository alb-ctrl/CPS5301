<?php include('mysqli_connect.php') ?>
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

<div class="container">  
  <form action="register.php" method="post">
  <?php include('../errors.php'); ?>
  <h1><center>Admin</center></h1>
  
    <input type="text" placeholder="username" name="user"/>
    <input type="text" placeholder="email address"  name="email"/>
   <input type="password" placeholder="password"  name="pass"/>
    <input type="password" placeholder="Confirm password"  name="cpass"/>
    <input type="password" placeholder="Code"  name="code"/>
   <input type="submit"  name="register" value="Create" />
    <p class="message">Already registered? <a href="index.php">Sign In</a></p>
  </form>
  
</div>
</body>

</html>
