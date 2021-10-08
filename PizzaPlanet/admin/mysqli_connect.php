<?php
require ("/home/bitnami/dbconfig.php");
$db = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR
  die('Coul not connect MySQL: ' . mysqli_connect_error () );
// Set the encoding...
mysqli_set_charset($db, 'utf8');

session_start();

if(isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if(!empty($_POST["login"])) {
		$sql ="SELECT * FROM admin WHERE username='$username' && password='".md5($password)."'";
		$result=mysqli_query($db, $sql);
		$row=mysqli_fetch_array($result);
	  if(is_array($row)) {
      $_SESSION["adm_id"] = $row['adm_id'];
			header("location: dashboard.php");
    } else {
      $message = "Invalid Username or Password!";
      }
	}	
}

if(isset($_POST['register'] )) {
  if(empty($_POST['user']) ||
   	empty($_POST['email'])|| 
		empty($_POST['pass']) ||  
		empty($_POST['cpass']) ||
		empty($_POST['code'])){
		$message = "ALL fields must be fill";
	}
  else {
		
  	$check_username= mysqli_query($db, "SELECT username FROM admin where username = '".$_POST['user']."' ");
  	$check_email = mysqli_query($db, "SELECT email FROM admin where email = '".$_POST['email']."' ");
  	
  	if($_POST['pass'] != $_POST['cpass']){
      $message = "Password not match";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $message = "Invalid email address please type a valid email!";
    } elseif(mysqli_num_rows($check_username) > 0) {
      $message = 'username Already exists!';
    } elseif(mysqli_num_rows($check_email) > 0) {
      $message = 'Email Already exists!';
    } else {
      $result = mysqli_query($db,"SELECT id FROM admin_code WHERE code =  '".$_POST['code']."'");  
  		if(mysqli_num_rows($result) == 0){
  			$message = "invalid code!";
      } 
      else {
        $mql = "INSERT INTO admin (username,password,email,code) VALUES ('".$_POST['user']."','".md5($_POST['pass'])."','".$_POST['email']."','".$_POST['code']."')";
  			mysqli_query($db, $mql);
  			$success = "Admin Added successfully!";
  		}
    }
 }

}
?>

