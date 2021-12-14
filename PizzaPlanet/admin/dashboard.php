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
    <div class="row" style="min-height:280px;">
        <div class="col-md-4">
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
        <div class="col-md-4">
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
        <div class="col-md-4">
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
<div class="row" style="min-height:120px;">
    <div class="col-md-4">
    </div>

<div class="col-md-6 col-sm-12">
<?php
 echo "<form name='input' action='salesreport.php' method='post'>";
        echo "<label for='report_period'><H3> Sales Report - Period:</H3> </label>";
        echo "<select  class='form-control-lg' name='report_period' style='
    border-left-width: 14px;
    border-right-width: 10px; 
    border-color: #F9EEC9;'> ";
        echo "<option value='all'>All</option>";
        echo "<option value='past_week'>Past Week</option>";
        echo "<option value='current_month'>Current Month</option>";
        echo "<option value='past_month'>Past Month</option>";
        echo "<option value='this_year'>This year</option>";
        echo "<option value='past_year'>Past Year</option>";
echo "<input type='submit'   class='btn btn-primary' value='Submit' style='height: 52px;' >";

        echo "</form>";





?>




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