<?php
// require ("/home/bitnami/dbconfig.php");
// $db = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR
//   die('Coul not connect MySQL: ' . mysqli_connect_error () );
// // Set the encoding...
// mysqli_set_charset($db, 'utf8');

include("../connection/connect.php");

session_start();
$errors = array(); 

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
      array_push($errors, "Invalid Username or Password!");
      }
	}	
}

if(isset($_POST['register'] )) {
  if(empty($_POST['user']) ||
   	empty($_POST['email'])|| 
		empty($_POST['pass']) ||  
		empty($_POST['cpass']) ||
		empty($_POST['code'])){
		array_push($errors, "ALL fields must be fill");
	}
  else {
		
  	$check_username= mysqli_query($db, "SELECT username FROM admin where username = '".$_POST['user']."' ");
  	$check_email = mysqli_query($db, "SELECT email FROM admin where email = '".$_POST['email']."' ");
  	
  	if($_POST['pass'] != $_POST['cpass']){
      array_push($errors, "Password not match");
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      array_push($errors, "Invalid email address please type a valid email!");
    } elseif(mysqli_num_rows($check_username) > 0) {
      array_push($errors, 'username Already exists!');
    } elseif(mysqli_num_rows($check_email) > 0) {
      array_push($errors, 'Email Already exists!');
    } else {
      $result = mysqli_query($db,"SELECT id FROM admin_code WHERE code =  '".$_POST['code']."'");  
  		if(mysqli_num_rows($result) == 0){
  			array_push($errors, "invalid code!");
      } 
      else {
        $mql = "INSERT INTO admin (username,password,email,code) VALUES ('".$_POST['user']."','".md5($_POST['pass'])."','".$_POST['email']."','".$_POST['code']."')";
  			mysqli_query($db, $mql);
  			echo "Admin Added successfully!";
        header("location: dashboard.php");
  		}
    }
 }

}
?>

