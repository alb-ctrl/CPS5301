<?php
session_start();

// initializing variables
$username = "";
$fname = "";
$lname = "";
$email    = "";
$plan     = "";
$phone = "";
$address = "";
$errors = array(); 


// REGISTER USER
if (isset($_POST['reg_user'])) {

  require ("/home/bitnami/dbconfig.php");
  $db = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR
	  die('Coul not connect MySQL: ' . mysqli_connect_error () );
  // Set the encoding...
  mysqli_set_charset($db, 'utf8');

  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $fname = mysqli_real_escape_string($db, $_POST['fname']);
  $lname = mysqli_real_escape_string($db, $_POST['lname']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $address = mysqli_real_escape_string($db, $_POST['address']);

  

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error onto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($fname)) { array_push($errors, "First name is required"); }
  if (empty($lname)) { array_push($errors, "Last name is required"); }

  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }
  if (empty($phone)) { array_push($errors, "Phone number is required"); }
  if (empty($address)) { array_push($errors, "address is required"); }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $row = mysqli_fetch_array($result);
  
  if ($result) { // if user exists
    if (strcmp($row['username'],$username) == 0) {
      array_push($errors, "Username already exists");
    }

    if (strcmp($row['email'],$email) == 0) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

    // ?? Guys I need to know how we gonna have the database 

  	$query = "INSERT INTO users (username, fname, lname, phone, address, email, password) 
  			  VALUES('$username', '$fname', '$lname', '$phone', '$address', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['password'] = $password;
  	//header('location: index.php');
  }

  /* Close the connection as soon as it's no longer needed */
  mysqli_close($db);

}

// ... 

// LOGIN USER
if (isset($_POST['login_user'])) {

  require ("/home/bitnami/dbconfig.php");
  $db = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR
	  die('Coul not connect MySQL: ' . mysqli_connect_error () );
  // Set the encoding...
  mysqli_set_charset($db, 'utf8');


  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
      if(strcmp($username,"admin") == 0 && strcmp($password,md5("admin")) == 0){
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        header('location: admin_dashboard.php');
      }
      else{
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        header('location: index.php');

      }
  	}
    else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }

  /* Close the connection as soon as it's no longer needed */
  mysqli_close($db);
  
}

?>