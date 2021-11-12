<!DOCTYPE html>
<html lang="en">
    <?php


error_reporting(0);
session_start();

    ?>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Favicon icon -->
        <link rel="icon" type="" sizes="16x16" href="">
        <title></title>
        <!-- Bootstrap Core CSS -->
        <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="css/helper.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

        <!-- Font Awesome -->
        <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>

        <!-- All Jquery -->
        <script src="js/lib/jquery/jquery.min.js"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="js/lib/bootstrap/js/popper.min.js"></script>
        <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
        <!-- slimscrollbar scrollbar JavaScript -->
        <script src="js/jquery.slimscroll.js"></script>
        <!--Menu sidebar -->
        <script src="js/sidebarmenu.js"></script>
        <!--stickey kit -->
        <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
        <!--Custom JavaScript -->
        <script src="js/custom.min.js"></script>

    </head>
    <body >
                <div id="main-wrapper">
            <!-- header header  -->
            <div class="header">
                <nav class="navbar top-navbar navbar-expand-md navbar-light">

                               





                    <!-- Logo -->
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">
                            <!-- Logo icon -->
                              <!-- <b><img src="images/logo.png" alt="homepage" class="dark-logo" /></b> -->
                            <!--End Logo icon -->

                            <!-- Logo text -->

                        </a>
                    </div>
                    <!-- End Logo -->
                    <div class="navbar-collapse" >
                        <!-- toggle and nav items -->
                        <ul class="navbar-nav mr-auto mt-md-0">
       

                        </ul>
                        <!-- User profile and search -->
                        <ul class="navbar-nav my-lg-0">


                            <!-- Comment -->
                            <li class="nav-item dropdown">

                                <div class="dropdown-menu dropdown-menu-right mailbox animated zoomIn">
                                    <ul>
                                        <li>
                                            <div class="drop-title">Notifications</div>
                                        </li>

                                        <li>
                                            <a class="nav-link text-center" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- End Comment -->

                            <!--   Dashboard  -->

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-muted  "  href="dashboard.php" aria-expanded="false"><img class="fas fa-tachometer-alt fa-2x"  style="color:#B4000F;"/></a>   
                               
                            </li>


                            <!--   Users  -->

                             <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="fas fa-users fa-2x"  style="color:#B4000F;" /></a> 
                                <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                    <ul class="dropdown-user">
                                        <li><a href="allusers.php"><i class="fas fa-users"  style="color:#B4000F;"></i> Users</a></li>
                                        <li><a href="add_users.php"><i class="fas fa-users "  style="color:#B4000F;"></i> Add Users</a></li>
                                    </ul>
                                </div>
                            </li>
                            <!--  Menu -->
                             <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="fas fa-utensils fa-2x"  style="color:#B4000F;" /></a> 
                                <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                    <ul class="dropdown-user">
                                        <li><a href="all_menu.php"><i class="fas fa-utensils"  style="color:#B4000F;"></i> Pizza Planet Menu</a></li>
                                        <li><a href="add_menu.php"><i class="fas fa-pizza-slice "  style="color:#886839;"></i> Add Menu </a></li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-muted  " href="all_orders.php" aria-expanded="false"><img class="fa fa-shopping-cart fa-2x"  style="color:#B4000F;" /></a> 
      
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="fas fa-user-astronaut fa-2x"  style="color:#B4000F;" /></a> 
                                <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                    <ul class="dropdown-user">
                                        <!--  <li><a href="#"><i class="fas fa-user"></i> Profile</a></li> -->
                                        <li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                                    </ul>
                                </div>
                            </li>




                        </ul>
                    </div>
                </nav>

            </div>
            <!-- End header header -->
        

</body>
</html>
