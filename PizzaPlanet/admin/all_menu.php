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

<body class="fix-header fix-sidebar">
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- Main wrapper  -->
    <div id="main-wrapper">
        <!-- Page wrapper  -->
        <div class="page-wrapper" style="min-height:500px;">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary1"><b>Pizza Planet Menu </b></h3> </div>

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
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Menu Item</th>
                                                <th>Description</th>
                                                <th>Price</th>
                                                <th>Image</th>
                                               <th>Delete</th>
                                               <th>Modify</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                               	<?php
$sql   = "SELECT * FROM menu order by menu_item_id desc";
$query = mysqli_query($db, $sql);

if (!mysqli_num_rows($query) > 0) {
    echo '<td colspan="11"><center>No Menu!</center></td>';
} else {
    while ($rows = mysqli_fetch_array($query)) {


        echo '<tr></td>

		<td>' . $rows['menu_item_name'] . '</td>
		<td>' . $rows['description'] . '</td>
		<td>' . $rows['price'] . '</td>


		<td><div class="col-md-3 col-lg-8 m-b-10">
		<center><img src="menu_img/menu/' . $rows['picture_path'] . '" class="img-responsive  radius" style="max-height:100px;max-width:150px;" /></center>
		</div></td>


		<td><a href="delete_menu.php?menu_del=' . $rows['menu_item_id'] . '" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fas fa-trash" style="font-size:20px"></i></a>
			 
		</td>  
        <td>
             <a href="update_menu.php?menu_upd=' . $rows['menu_item_id'] . '" class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fas fa-cog" style="font-size:20px"></i></a>
            </td></tr>';

    }
} ?>
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
        <!-- End Page wrapper  -->
    </div>
    <!-- End Wrapper -->

</body>

</html>

<?php
}

?>