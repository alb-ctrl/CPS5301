<!DOCTYPE html>
<html lang="en">
<?php
require("/home/bitnami/dbconfig.php");
$db = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
    die('Coul not connect MySQL: ' . mysqli_connect_error());
// Set the encoding...
mysqli_set_charset($db, 'utf8');
include 'navbar.php';
error_reporting(0);
session_start();

if(empty($_SESSION["adm_id"])){
    header('location:index.php');
} else{
?>
    <head>
    </head>
    <body class="fix-header">
<div class="page-wrapper" style="min-height:700px;">
<!-- Tittle-->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary1"><b>Dashboard</b></h3>
    </div>
</div>

<!-- End Tittle-->
<!-- Container fluid  -->
<div class="container-fluid" >
    <!-- Start Page Content -->
    <div class="row" style="min-height:380px;">
        <div class="col-md-3">
            <div class="card p-30">
                <div class="media">
                    <div class="media-left meida media-middle">
                        <span><i class="fas fa-pizza-slice f-s-70"  style="color:#886839;" aria-hidden="true"></i></span>

                    </div>
                    <div class="media-body media-text-right">
                        <h2><?php $sql = "select * from menu";
                        $result = mysqli_query($db, $sql);
                        $rws = mysqli_num_rows($result);
                        echo $rws;?></h2>
                        <p class="m-b-0"><b>Pizzas</b></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-30">
                <div class="media">
                    <div class="media-left meida media-middle">
                        <span><i class="fas fa-users f-s-70 color-danger"></i></span>
                    </div>
                    <div class="media-body media-text-right">
                        <h2><?php $sql = "select * from users";
                        $result= mysqli_query($db, $sql);
                        $rws= mysqli_num_rows($result);
                        echo $rws;?></h2>
                        <p class="m-b-0"><b>Customer</b></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-30">
                <div class="media">
                    <div class="media-left meida media-middle">
                        <span><i class="fa fa-shopping-cart f-s-70 "  style="color:#B8483A;" aria-hidden="true"></i></span>
                    </div>
                    <div class="media-body media-text-right">
                        <h2><?php $sql = "select * from user_orders";
                        $result = mysqli_query($db, $sql);
                        $rws = mysqli_num_rows($result);
                        echo $rws;?></h2>
                        <p class="m-b-0"><b>Orders</b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End PAge Content -->
    <!-- footer -->
    <?php include 'footer.php'; ?>
    <!-- End footer -->

</div>
<!-- End Container fluid  -->
</div>
</body>
</html>
<?php
}
?>