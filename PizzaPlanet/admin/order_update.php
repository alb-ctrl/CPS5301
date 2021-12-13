<?php
require("/home/bitnami/dbconfig.php");
$db = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
    die('Coul not connect MySQL: ' . mysqli_connect_error());
// Set the encoding...
mysqli_set_charset($db, 'utf8');
include 'navbar.php';
error_reporting(0);
session_start();
if(strlen($_SESSION['adm_id'])==0)
  { 
echo "<script>alert('Login');
window.location.href='index.php';
</script>";
}
else
{
  if(isset($_POST['update']))
  {
$status=$_POST['status'];
$user_order_id = $_POST['user_order_id'];

$menu_item_id = $_POST['menu_item_id'];


//echo $user_order_id;

//echo $menu_item_id;
//echo $status;


$sql=mysqli_query($db,"UPDATE user_orders set status = '$status'  where user_order_id='$user_order_id' and menu_item_id='$menu_item_id' ");


echo "<script>alert('Order has been updated');
window.location.href='all_orders.php';
</script>";


  }

 ?>

<head>

<style>
    select {
        width: 150px;
        margin: 10px;
    }
    select:focus {
        min-width: 220px;
        width: auto;
    }

    table.center {
  margin-left: auto;
  margin-right: auto;
}
</style>
</head>





<body class="fix-header fix-sidebar">
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- Main wrapper  -->
    <div id="main-wrapper">
        <!-- Page wrapper  -->
        <div class="page-wrapper" style="min-height:200px;">
            <!-- Bread crumb -->
            <div class="row page-titles" >
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary1"><b>User Orders</b></h3>
                </div>

            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-12">


                        <div class="card">
                            <div class="card-body">
                                

                                <div class="table-responsive m-t-40">
                                   <form id="myTable" class="table table-bordered table-striped" method="post"> 

   <?php
  if(isset($_POST['Modify']))
  {

$user_order_id = $_POST['user_order_id'];

$menu_item_id = $_POST['menu_item_id'];

$sql   = "SELECT * FROM menu where menu_item_id = $menu_item_id";
$query = mysqli_query($db, $sql);
$rows = mysqli_fetch_array($query);




}
?>

      <h1><b><center>Order Number:    <?php echo $user_order_id;?></b></h1>

                                    <table id="myTable" class="center">
                                        <thead>
<tr >
     <?php
  echo '
  <td>' . $rows['menu_item_name'] . '</td>
  <td><div class="col-md-3 col-lg-8 m-b-10">
    <center><img src="menu_img/menu/' . $rows['picture_path'] . '" class="img-responsive  radius" style="max-height:100px;max-width:150px;" /></center>
    </div></td>';
    ?>

      <td><select name="status" required="required"  >
      <option value="">Select Status</option>
       <option value="P">Order in progress</option>
      <option value="D">Out for delivery</option>
    <option value="C">Completed</option>
   <option value="X">Canceled</option>

        
      </select></td>
                                                        <input type="hidden" name="user_order_id" value="<?= $user_order_id; ?>" />
                                                  <input type="hidden" name="menu_item_id" value="<?= $menu_item_id; ?>" />
      <td><input type="submit" name="update"  class="btn btn-primary" value="Submit"></td>

     
     <td> <input name="Submit2" type="submit"  class="btn btn-danger"  value="Back" onclick="location.href='all_orders.php';" style="cursor: pointer;"  /></td>
    </tr>
                                        </thead>
                                   
                                    </table>
                                  </form>
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

    </div>
    <!-- footer --> 
    <?php include 'footer.php'; ?>


    <!-- End Page wrapper  -->
    </div>

</body>

</html>
<?php } ?>