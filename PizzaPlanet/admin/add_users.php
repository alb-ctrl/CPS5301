<!DOCTYPE html>
<html lang="en">
<?php

require("/home/bitnami/dbconfig.php");
$db = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
    die('Coul not connect MySQL: ' . mysqli_connect_error());
// Set the encoding...
mysqli_set_charset($db, 'utf8');


include 'navbar.php';
$errors = array(); 
session_start();

if (empty($_SESSION["adm_id"])) {
    header('location:index.php');
} else {


    if (isset($_POST['email'])) { 
    $check_username = mysqli_query($db, "SELECT username FROM users where username = '" . $_POST['uname'] . "' ");
    $check_email    = mysqli_query($db, "SELECT email FROM users where email = '" . $_POST['email'] . "' ");

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) // Validate email address
    {
        $error = '<div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>invalid email!</strong>
            </div>';
    } elseif (strlen($_POST['password']) < 8) {
        $error = '<div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <strong>Password must be at least eight characters</strong>
                </div>';
    } elseif (strlen($_POST['phone']) < 10) {
        $error = '<div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>invalid phone!</strong>
                </div>';
    } elseif (mysqli_num_rows($check_username) > 0) {
        $error = '<div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Username already exist!</strong>
                </div>';
    } elseif (mysqli_num_rows($check_email) > 0) {
        $error = '<div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>email already exist!</strong>
                </div>';
    } else {

        $mql = "INSERT INTO users(username,fname,lname,email,phone,password,address) VALUES('" . $_POST['uname'] . "','" . $_POST['fname'] . "','" . $_POST['lname'] . "','" . $_POST['email'] . "','" . $_POST['phone'] . "','" . md5($_POST['password']) . "','" . $_POST['address'] . "')";
        mysqli_query($db, $mql);
        $success = '<div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Congrats!</strong> New User Added Successfully.</br></div>';

    }
}
?>
<head>
</head>

<body class="fix-header fix-sidebar">
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>


        <!-- Page wrapper  -->
        <div class="page-wrapper" style="min-height:700px;">
            <!-- Bread crumb -->
            <div class="row page-titles" >
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary1"><b>Add Users</b></h3> </div>

            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->


    <?php 

    if (count($error) == 0) {
  echo $success; 
    } else {
    echo $error;
    }

   ?>
        <div class="row" style="min-height:380px;">

                        <div class="col-lg-12" >
                        <div class="card card-outline-primary">

                            <div class="card-body">
                                <form action='' method='post'  enctype="multipart/form-data">
                                    <div class="form-body">



                                        <div class="row p-t-20">

                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Username</label>
                                                    <input type="text" name="uname" class="form-control" required="required" placeholder="">
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">First Name</label>
                                                    <input type="text" name="fname" class="form-control form-control-danger" required="required" placeholder="">
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Last Name </label>
                                                    <input type="text" name="lname" class="form-control" placeholder="" required="required">
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Email</label>
                                                    <input type="text" name="email" class="form-control form-control-danger" required="required" placeholder="">
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                         <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Password</label>
                                                    <input type="text" name="password" class="form-control form-control-danger" required="required" placeholder="">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Phone</label>
                                                    <input type="text" name="phone" class="form-control form-control-danger" required="required" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <!--/row-->
                                         <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Address</label>
                                                    <input type="text" name="address" class="form-control" required="required" placeholder="">
                                                </div>
                                            </div>

                                        </div>
                                            <!--/span-->
                                        
                                    </div>
                                    <div class="form-actions">
                                        <input type="submit" name="submit" class="btn btn-success" value="save">
                                        <a href="dashboard.php" class="btn btn-inverse">Cancel</a>
                                    </div>
                                </form>
                            </div><!-- <div class="card-body"> -->
                        </div><!-- <div class="card card-outline-primary"> -->

                    </div> <!--  <div class="col-lg-12">-->


                </div>


                </div><!--  <div class="container-fluid"> -->

<!-- footer -->
            <?php
include 'footer.php';
    ?>

<!-- End footer -->

         
        </div>
        <!-- End Page wrapper  -->


</body>
</html>
<?php
}
?>