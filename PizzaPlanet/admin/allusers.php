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
        <div class="page-wrapper" >
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary1"><b>Registered users</b></h3> </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid"  style="min-height:400px;">
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-body">
                              

                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>First-Name</th>
                                                <th>Last-Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th>Delete</th>
                                                <th>Modify</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
$sql   = "SELECT * FROM users order by fname, lname";
    $query = mysqli_query($db, $sql);
    if (!mysqli_num_rows($query) > 0) {
        echo '<td colspan="7"><center>Empty!</center></td>';
    } else {
        while ($rows = mysqli_fetch_array($query)) {

            echo ' <tr><td>' . $rows['username'] . '</td>
            <td>' . $rows['fname'] . '</td>
            <td>' . $rows['lname'] . '</td>
            <td>' . $rows['email'] . '</td>
            <td>' . $rows['phone'] . '</td>
            <td>' . $rows['address'] . '</td>
         <td><a href="delete_users.php?user_del=' . $rows['username'] . '" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fas fa-trash" style="font-size:20px"></i></a>
        </td>
        <td>
         <a href="update_users.php?user_upd=' . $rows['username'] . '" " class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fas fa-cog"style="font-size:20px"></i></a>
         </td></tr>';

        }
    }
    ?>
                                        </tbody>
                                    </table>
                                </div><!-- table-responsive -->
                            </div> <!-- card-body -->
                        </div><!-- card -->
                    </div><!-- col-12 -->
                 </div> <!-- row -->
            </div><!-- End Container fluid  -->
            <!-- footer -->
            <?php
            include 'footer.php';
            ?>
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->
</body>
<?php
}

?>

</html>