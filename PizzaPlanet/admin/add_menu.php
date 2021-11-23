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



if(isset($_POST['submit']))   //if upload btn is pressed
{
		
	if(empty($_POST['menu_item_name'])||empty($_POST['description'])||$_POST['price']==''){	
		$error = 	'<div class="alert alert-danger alert-dismissible fade show">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>All fields are required</strong>
						</div>';
									
		
								
	}else{
		
		$menu_item_name = $_FILES['fileToUpload']['name'];
		$temp = $_FILES['fileToUpload']['tmp_name'];
		$fsize = $_FILES['fileToUpload']['size'];
		$extension = explode('.',$menu_item_name);
		$extension = strtolower(end($extension));  
		$picture_path = uniqid().'.'.$extension;

		$store = "/menu_img/menu/".basename($picture_path);                      // the path to store the upload image

	
		if($extension == 'jpg'||$extension == 'png'||$extension == 'gif' ){        
			if($fsize>=1000000){


				$error = '<div class="alert alert-danger alert-dismissible fade show">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Max Image Size is 1024kb!</strong> Try different Image.
					</div>';

			}else{
						
				$sql = "INSERT INTO menu(menu_item_name,description,price,picture_path) VALUE('".$_POST['menu_item_name']."','".$_POST['description']."','".$_POST['price']."','".$menu_item_name."')";  // store the submited data ino the database :images
				mysqli_query($db, $sql); 

					//if (move_uploaded_file($_FILES['file']['name'], $store)) {
				  //  echo "The file  has been uploaded.";
				  //} else {
				    //echo "Sorry, there was an error uploading your file.";
				  //}

				//echo getcwd() . "\n";												//echo $temp ;

			  // move_uploaded_file($_FILES["file"]["tmp_name"],"../menu_img/menu/" . $_FILES["file"]["name"]);

			    $success = 	'<div class="alert alert-success alert-dismissible fade show">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Congrats!</strong> New Menu Item Added Successfully.
					</div>';


			}
		}elseif($extension == ''){
			$error = 	'<div class="alert alert-danger alert-dismissible fade show">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>select image</strong>
				</div>';
		} else{
		
			$error = 	'<div class="alert alert-danger alert-dismissible fade show">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>invalid extension!</strong>png, jpg, Gif are accepted.
				</div>';


		}               
	   
	   
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
    <!-- Main wrapper  -->
    <div id="main-wrapper">

        <!-- Page wrapper  -->
        <div class="page-wrapper" style="height:700px;">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary1"><b>Add Pizza</b></h3> </div>
                
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                  
									
									<?php  echo $error;
									        echo $success; ?>

					    <div class="col-lg-12">
                        <div class="card card-outline-primary">

                            <div class="card-body">
                                <form action='' method='post'  enctype="multipart/form-data">
                                    <div class="form-body">
                   
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Pizza Name</label>
                                                    <input type="text" name="menu_item_name" class="form-control" >
                                                   </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Description</label>
                                                <input type="text" name="description" class="form-control form-control-danger" >
                                                    </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Price </label>
                                                    <input type="text" name="price" class="form-control" placeholder="USD">
                                                   </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Image</label>
                                                    <input type="file" name="fileToUpload"  id="lastName" class="form-control form-control-danger" placeholder="12n">
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
                            </div>
                        </div>
                    </div>
					

                </div>
                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
<!-- footer --> <?php include 'footer.php'; ?>
        </div>
        <!-- End Page wrapper  -->
    </div>


</body>

</html>

<?php
}

?>