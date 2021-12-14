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
if (empty($_SESSION["adm_id"])) {
    header('location:index.php');
} else {
    ?>
<head>
</head>

<body class="fix-header ">
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
        <div class="page-wrapper" style="min-height:400px;">

            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary1"><b>User Orders</b></h3>
                </div>

            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row" style="min-height:380px;">
                    <div class="col-12">


                        <div class="card">
                            <div class="card-body">
                                

                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr><th>Order Number</th>
                                                <th>Username</th>
                                                <th>Menu Item</th>
                                                <th>Quantity</th>

                                                <th>Price</th>
                                                <th>Address</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>Delete</th>
                                                <th>Modify Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php
$sql   = "SELECT users.username,  user_orders.menu_item_id, menu.menu_item_name ,users.address, user_orders.quantity, menu.price, user_orders.status, user_orders.order_date, user_orders.user_order_id FROM users, user_orders, menu  where users.username=user_orders.username and menu.menu_item_id = user_orders.menu_item_id;";
$query = mysqli_query($db, $sql);

if (!mysqli_num_rows($query) > 0) {
    echo '<td colspan="8"><center>No Orders</center></td>';
} else {
    while ($rows = mysqli_fetch_array($query)) {

        ?>
<?php
echo '  <tr>
        <td>' . $rows['user_order_id'] . '</td>
        <td>' . $rows['username'] . '</td>
        <td>' . $rows['menu_item_name'] . '</td>
        <td>' . $rows['quantity'] . '</td>
        <td>' . $rows['price'] . '</td>
        <td>' . $rows['address'] . '</td>';
# O for ordered
# P in progress
# D out for delivery
# C for completed
# X canceled 
$status = $rows['status'];
        if ($status == "O") {
            ?>
            <td> <button type="button" class="btn btn-success" style="font-size:20px">Ordered</button></td>
<?php
}
        if ($status == "P") { ?>
            <td> <button type="button" class="btn btn-primary"style="font-size:20px"></span>Order in progress</button></td>
<?php

}
        if ($status == "D") {
?>
            <td><button type="button" class="btn btn-warning"style="font-size:20px ">Out for delivery</button> </td>
 <?php                                           
}
        if ($status == "C") {
            ?>
            <td><button type="button" class="btn btn-info"style="font-size:20px">Completed</button> </td>
<?php
}
        ?>
<?php
        if ($status == "X") {
            ?>
            <td> <button type="button" class="btn btn-danger" style="font-size:20px"></i>Canceled</button></td>
<?php
}
        ?>
<?php
echo '  <td>' . $rows['order_date'] . '</td>';

 $user_order_id = $rows['user_order_id']; 
  $menu_item_id = $rows['menu_item_id']; 


        ?>
        <td>
            <form action='delete_orders.php' method='post'  enctype="multipart/form-data">
              <input type="hidden" name="user_order_id" value="<?= $user_order_id; ?>" />
              <input type="hidden" name="menu_item_id" value="<?= $menu_item_id; ?>" />

    <input onclick="return confirm('Are you sure?');" type="submit" name="submit" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10" value="Delete" style="font-size:20px">
            

            </form>

        </td>


        <td>
            <form action='order_update.php' method='post'  enctype="multipart/form-data">
              <input type="hidden" name="user_order_id" value="<?= $user_order_id; ?>" />
              <input type="hidden" name="menu_item_id" value="<?= $menu_item_id; ?>" />

   <input  type="submit" name="Modify" class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5" value="Modify" style="font-size:20px">
            



            </form>



            </td>
        </tr>


                                                <?php

                                                    
    }
}

?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End PAge Content -->
    </div>
    <!-- End Container fluid  -->

        <!-- footer -->
            <?php
include 'footer.php';
    ?>

<!-- End footer -->


    </div>



</body>

</html>

<?php
}

?>