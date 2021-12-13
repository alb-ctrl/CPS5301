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

if (isset($_POST['submit'])) //if upload btn is pressed
{

    if (empty($_POST['menu_item_name']) || empty($_POST['description']) || $_POST['price'] == '' ) {
        $error = '<div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>All fields are required</strong>
            </div>';

    } else {

        $menu_item_name = $_FILES['fileToUpload']['name'];
        $temp = $_FILES['fileToUpload']['tmp_name'];
        $fsize = $_FILES['fileToUpload']['size'];
        $extension = explode('.',$menu_item_name);
        $extension = strtolower(end($extension));  
        $picture_path = uniqid().'.'.$extension;

        $$store = "/menu_img/menu/".basename($picture_path);  // the path to store the upload image


        if ($extension == 'jpg' || $extension == 'png' || $extension == 'gif') {

            if ($fsize >= 1000000) {
                $error = '<div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Max Image Size is 1024kb!</strong> Try different Image.
                </div>';


            } else {



                
                $sql = "update menu set menu_item_name='$_POST[menu_item_name]',description='$_POST[description]',price='$_POST[price]',picture_path='$menu_item_name' where menu_item_id='$_GET[menu_upd]'"; // update the submited data ino the database :images
                mysqli_query($db, $sql);
                move_uploaded_file($temp, $store);

                $success = '<div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Menu Item Updated. </strong>
                     </div>';

            }
        } else {

                $error = '<div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Wrong!</strong> Upload an image.
                </div>';

        }

    }

}

?>
<head>

</head>
<body class="fix-header">
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- Main wrapper  -->
    <div id="main-wrapper">

        <!-- Page wrapper  -->
        <div class="page-wrapper" style="height:600px;">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary1"><b>Pizza Planet Menu </b></h3> </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
            <?php echo $error;
            echo $success; ?>


                        <div class="col-lg-12">
                        <div class="card card-outline-primary">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white"><b>Update Menu Item</b></h4>
                            </div>
                            <div class="card-body">
                                <form action='' method='post'  enctype="multipart/form-data">
                                    <div class="form-body">
                                        <?php $qml = "select * from menu where menu_item_id='$_GET[menu_upd]'";
                                        $rest= mysqli_query($db, $qml);
                                        $row = mysqli_fetch_array($rest);
                                        ?>
                                        <hr>
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Menu Item</label>
                                                    <input type="text" name="menu_item_name" value="<?php echo $row['menu_item_name']; ?>" class="form-control" >
                                                   </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Description</label>
                                                    <input type="text" name="description" value="<?php echo $row['description']; ?>" class="form-control form-control-danger" >
                                                    </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Price </label>
                                                    <input type="text" name="price" value="<?php echo $row['price']; ?>"  class="form-control" >
                                                   </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Image</label>
                                                    <input type="file" name="fileToUpload"  class="form-control form-control-danger" >
                                                    </div>
                                            </div>
                                        </div>
                                        <!--/row-->
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <input type="submit" name="submit" class="btn btn-success" value="save">
                                        <a href="dashboard.php" class="btn btn-inverse">Cancel</a>
                                    </div>
                                </form>
                            </div><!-- <div class="card-body"> -->
                        </div><!--  <div class="card card-outline-primary"> -->
                    </div><!-- <div class="col-lg-12"> -->
                </div><!-- <div class="container-fluid"> -->

<!-- footer -->
<?php
include 'footer.php';
?>

<!-- End footer -->    

            </div> <!-- Page wrapper  -->


   
        </div><!-- Main wrapper  -->


</body>
